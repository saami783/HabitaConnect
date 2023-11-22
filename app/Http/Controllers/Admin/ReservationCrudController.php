<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationCrudController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::paginate(10);
        return view('admin.reservations.index', compact('reservations'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        return view('admin.reservations.show', compact('reservation'));
    }

}
