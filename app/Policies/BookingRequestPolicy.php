<?php

namespace App\Policies;

use App\User;
use App\BookingRequest;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingRequestPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the spot.
     *
     * @param  \App\User  $user
     * @param  \App\BookingRequest  $bookingRequest
     * @return mixed
     */
    public function view(User $user, BookingRequest $bookingRequest)
    {
        return true;
    }

    /**
     * Determine whether the user can create spots.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return false;
    }

    /**
     * Determine whether the user can update the spot.
     *
     * @param  \App\User  $user
     * @param  \App\BookingRequest  $bookingRequest
     * @return mixed
     */
    public function update(User $user, BookingRequest $bookingRequest)
    {
        return false;
    }

    /**
     * Determine whether the user can delete the spot.
     *
     * @param  \App\User  $user
     * @param  \App\BookingRequest  $bookingRequest
     * @return mixed
     */
    public function delete(User $user, BookingRequest $bookingRequest)
    {
        return false;
    }

    /**
     * Determine whether the user can restore the spot.
     *
     * @param  \App\User  $user
     * @param  \App\BookingRequest  $bookingRequest
     * @return mixed
     */
    public function restore(User $user, BookingRequest $bookingRequest)
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the spot.
     *
     * @param  \App\User  $user
     * @param  \App\BookingRequest  $bookingRequest
     * @return mixed
     */
    public function forceDelete(User $user, BookingRequest $bookingRequest)
    {
        return false;
    }
}
