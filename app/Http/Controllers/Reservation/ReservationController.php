<?php

namespace App\Http\Controllers\Reservation;

use App\Enum\ReservationStatus;
use App\Http\Controllers\Controller;
use App\Models\Announce;
use App\Models\Reservation;
use App\Models\User;
use DateTime;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws AuthorizationException
     */
    public function index()
    {
        $this->authorize('viewAny', Reservation::class);

        $reservations = Reservation::with('announce')
            ->where('user_id', auth()->user()->id)
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $announce = Announce::find($request->announce_id);

        if (!$announce->is_disponible) {
            return redirect()->back()->with('error', 'Impossible de réserver une annonce indisponible.');
        }

        $validatedData = $request->validate([
            'begin_at' => 'required|date',
            'end_at' => 'required|date|after:begin_at',
            'announce_id' => 'required|exists:announces,id',
        ]);

        // Calcul de la différence en jours entre begin_at et end_at
        $daysDifference = (new DateTime($validatedData['begin_at']))->diff(new DateTime($validatedData['end_at']))->days;

        $reservation = new Reservation();
        $reservation->begin_at = $validatedData['begin_at'];
        $reservation->end_at = $validatedData['end_at'];
        $reservation->announce_id = $announce->id;
        $reservation->user_id = auth()->user()->id;
        $reservation->total_days = $daysDifference;

        $reservation->status = ReservationStatus::NonFinalise;
        $reservation->price = $daysDifference * $announce->price_per_night;

        $reservation->save();

        $announce->is_disponible = false;
        $announce->save();

        return redirect()->route('reservations.index')->with('success', 'Réservation créée avec succès!');
    }


    /**
     * Display the specified resource.
     * @throws AuthorizationException
     */
    public function show(Reservation $reservation)
    {
        $this->authorize('view', $reservation);
        return view('reservations.show', ['reservation' => $reservation]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        $this->authorize('delete', $reservation);
        $reservation->deleteOrFail();

        return redirect()->route('reservations.index')->with('success', 'Announce deleted successfully.');
    }

    public function findCurrentUserWithReservation(User $user, Announce $announce) : bool {

       $reservation = DB::table("reservations")
            ->join("users", function($join){
                $join->on("users.id", "=", "reservations.user_id");
            })
            ->join("announces", function($join){
                $join->on("announces.id", "=", "reservations.announce_id");
            })
            ->select("reservations.*")
            ->where("users.id", "=", $user->id)
            ->where("announces.id", "=", $announce->id)
            ->get();


       if ($reservation->count() > 0) return true;
       return false;
    }

}
