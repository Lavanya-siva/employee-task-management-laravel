<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class SendWelcomeEmail implements ShouldQueue
{
    /**
     * Handle the event.
     */
    public function handle(UserRegistered $event): void
    {
        $user = $event->user;
        Mail::to($user->email)->send(new WelcomeMail($user));
    }
}
