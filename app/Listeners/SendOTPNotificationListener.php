<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\SendOTPNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOTPNotificationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Registered $event): void
    {
        //
        if ($event->user instanceof User) {
            $event->user->notify(new SendOTPNotification);
        }
    }
}
