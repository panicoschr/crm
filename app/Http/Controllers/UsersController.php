<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;
use App\Api;

class UsersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        
    }

    private function generateOTP() {
        $otp = mt_rand(1000, 9999);
        return $otp;
    }

    /**
     * Sends OTP and logs out the user but keeps the email
     * @return type
     */
    public function sendOtp() {

        $api = Api::where('id', 1)->first()->api;
        $user = Auth::user();
        $useremail = Auth::user()->email;
        $userphone = Auth::user()->phone;
        $this->logoutUser();
        $otp = $this->generateOTP();
        $user->otp = $otp;
        $user->save();

        $to = $userphone;
        $messages = 'Your OTP is ' . $otp;

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

        return view('smsto.otp', ['email' => $useremail]);
    }

    /**
     * Locates the user by the email, compares OTPs and login or logs out
     * @return type
     */
    public function verifyOtp() {
        $data = request()->all();
        $email = $data['email'];
        $otp = $data['otp'];
        $user = User::where('email', $email)->first();
        if ($user->otp == $otp) {
            //force to login the user
            Auth::loginUsingId($user->id, TRUE);
            return view('home');
        } else {
            $this->logoutUser();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        
    }

    /**
     * 
     * @return type
     */
    public function datatable() {
        $user_id = \Auth::user()->id;
        $users = User::all()->where('id', $user_id);
        return view('users.show', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function logoutUser() {
        Auth::logout();
        return redirect()->route('otp');
    }

}
