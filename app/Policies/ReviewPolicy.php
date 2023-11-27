<?php

namespace App\Policies;

use App\Http\Controllers\Reservation\ReservationController;
use App\Models\Announce;
use App\Models\Review;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReviewPolicy
{

    private ReservationController $controller;

    public function __construct(ReservationController $controller) {
        $this->controller = $controller;
    }

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Announce $announce): bool
    {
        if($this->controller->findCurrentUserWithReservation($user, $announce)) return true;
        return false;
    }

}
