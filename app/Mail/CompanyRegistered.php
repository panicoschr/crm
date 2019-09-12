<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CompanyRegistered extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {

        return $this->from('admin@admin.com', 'Mini-CRM Administrator')
                        ->subject('Company Registration Confirmation')
                        ->markdown('mails.emailbody')
                        ->with([
                            'name' => 'You have just registered your company'
        ]);
    }

}
