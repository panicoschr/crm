<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmsTo;
use App\Api;

class SmsController extends Controller {

    public function sendsms() {
        return view('smsto.sendsms');
    }

    public function postSendSms(Request $request) {
        $api = Api::where('id', 1)->first()->api;

        $request->headers->set('Authorization', 'Bearer ' . $api);
        $request->headers->set('Accept', 'application/json');


        $request->validate([
            'to' => 'required',
            'messages' => 'required',
        ]);
        $to = explode(',', request('to'));

        $response = SmsTo::setMessage(request('messages'))
                ->setRecipients($to)
                ->setSenderId('SMSTO')
                ->setCallbackUrl('https://mysite.org/smscallback')
                ->sendMultiple();
        if ($response['success'] == true) {
            return back()->with('success', 'Messages has been queued and ready to be sent.');
        } else {
            return back()->withErrors($response['errors']);
        }
    }

}
