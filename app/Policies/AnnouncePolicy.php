<?php

namespace App\Policies;

use App\Models\Announce;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AnnouncePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true; // Assuming any authenticated user can view all announcements
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Announce $announce): bool
    {
        return true; // Assuming any authenticated user can view a specific announcement
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return in_array('ROLE_BUSINESS', $user->role);
    }

    /**
     * Determine whether the user can edit the model.
     */
    public function edit(User $user) : bool {
        return in_array('ROLE_BUSINESS', $user->role) && $user->id === $announce->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Announce $announce): bool
    {
        return in_array('ROLE_BUSINESS', $user->role) && $user->id === $announce->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Announce $announce): bool
    {
        return $user->id === $announce->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Announce $announce): bool
    {
        return $user->id === $announce->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Announce $announce): bool
    {
        return $user->id === $announce->user_id;
    }
}
