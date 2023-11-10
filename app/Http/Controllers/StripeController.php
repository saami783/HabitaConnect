<?php

namespace App\Http\Controllers;

use App\Enum\ReservationStatus;
use App\Models\Announce;
use App\Models\Reservation;
use Illuminate\Http\Request;
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

        $reservation->status = ReservationStatus::PaiementAccepte;
        $reservation->payment_token = null;
        $reservation->save();
        $announce = Announce::find($reservation->announce_id);
        $this->sendMail($reservation, $announce);

        return redirect()->route('reservations.show', $reservation->id)->with('success', 'Réservation payé avec succès!');
    }


    private function sendMail(Reservation $reservation, Announce $announce) : void {

    }
}
