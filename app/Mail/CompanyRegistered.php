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
    public function __construct($data)
    {
            $this->data = $data;

    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
        
        $data = $this->data;

        return $this->from('info@mepro.co', 'Mini-CRM Administrator')
                        ->subject('Company Registration Confirmation')
                        ->markdown('mails.emailbody')
                        ->with([
                            'name' => 'You have just registered your company, ' . $data['name']. '. '.
                            'Email is ' . $data['email']. ' , '.
                            'Username is ' . $data['username']. ', and '.
                            'Phone is ' . $data['phone']
        ]);
    }

}
