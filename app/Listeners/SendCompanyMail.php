<?php

namespace App\Listeners;

use Illuminate\Auth\Events\Verified;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\CompanyRegistered;
use Illuminate\Support\Facades\Mail;

class SendCompanyMail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  Verified  $event
     * @return void
     */
    public function handle(Verified $event) {

        $data = array('name' => $event->user->name, 'email' => $event->user->email, 'username' => $event->user->username, 'phone' => $event->user->phone);
        if ($event->user->entity == 'company') {
            Mail::to($event->user->email)->send(new CompanyRegistered($data));
        }
    }

}
