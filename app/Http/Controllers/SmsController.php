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
        
        
       $request->validate([
            'to' => 'required',
            'messages' => 'required',
        ]);
        $to = explode(',', request('to'));
        $messages = request('messages');

        $postfieldsarr = array("body" => $messages, "to" => $to,
            "sender_id" => 'CRM Admin',
            "callback_url" => 'www.google.com');
        $postfields = json_encode($postfieldsarr);


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.sms.to/v1/sms/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $postfields,
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer " . $api,
                "Accept: application/json",
                "Content-Type: application/json"
            ),
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);        

        
        $responsedecoded = json_decode($response, true);

        
        if ($responsedecoded['success'] == true) {
            return back()->with('success', 'Messages has been queued and ready to be sent.');
        } else {
            return back()->withErrors($responsedecoded['message']);
        }        

    }



}
