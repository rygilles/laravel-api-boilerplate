<?php

namespace App\Observers;

use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserCreatedNotification;

class UserObserver
{
    /**
     * Listen to the User created event.
     *
     * @param  User  $user
     * @return void
     */
    public function created(User $user)
    {
        // Notify developers

        Notification::send(User::all(), new UserCreatedNotification($user));
    }
}
