<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmationReservation;
use App\Models\Announce;
use App\Models\Facture;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class StripeController extends Controller
{
    public function checkout()
    {
        return view('reservations.index');
    }

    public function session(Request $request)
    {
        \Stripe\Stripe::setApiKey(config('stripe.sk'));

        $announce = Announce::find($request->get('productname'));
        $reservation = Reservation::find($request->get('reservation'));
        $totalprice = $request->get('total');

        $token = Str::random(40);

        $reservation->payment_token = $token;
        $reservation->save();

        $session = \Stripe\Checkout\Session::create([
            'line_items'  => [
                [
                    'price_data' => [
                        'currency'     => 'EUR',
                        'product_data' => [
                            "name" => $announce->title,
                        ],
                        'unit_amount'  => $totalprice * 100,
                    ],
                    'quantity'   => 1,
                ],
            ],
            'mode'        => 'payment',
            'success_url' => route('success', ['token' => $token]),
            'cancel_url'  => route('reservations.show', $request->get('reservation')),
        ]);

        return redirect()->away($session->url);
    }

    public function success(string $token)
    {

        $reservation = Reservation::where('payment_token', $token)->firstOrFail();

        if (!$reservation) {
            return redirect()->route('/');
        }

//        $reservation->status = ReservationStatus::PaiementAccepte;
        $reservation->payment_token = null;
        $reservation->save();

        $facture = new Facture();
        $facture->amount = $reservation->price;
        $facture->user_id = $reservation->user_id;
        $facture->announce_id = $reservation->announce_id;
        $facture->reservation_id = $reservation->id;
        $facture->save();

        $this->sendMail($reservation);

        return redirect()
            ->route('reservations.show', $reservation->id)
            ->with('success', 'Réservation payé avec succès!');
    }


    private function sendMail(Reservation $reservation) : void
    {
        $user = Auth::user();
        Mail::to($user->email)->send(new ConfirmationReservation($reservation));
    }

}
