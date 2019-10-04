<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Api;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        $usertype = Auth::user()->type;
        $useremail = Auth::user()->email;
        $userphone = Auth::user()->phone;

        if ($usertype != 'admin') {
            $this->logoutUserAndRedirectOtp();
            $otp = $this->generateOTP();
            $user->otp = $otp;
            $user->save();

            $firstCharacter = substr($userphone, 0, 1);
            $secondCharacter = substr($userphone, 1, 1);
            $thirdCharacter = substr($userphone, 2, 1);

            $prefix = '';
            if ($firstCharacter == '+' && $secondCharacter == '0' && $thirdCharacter == '0') {
                $userphone = substr($userphone, 3);
                $prefix = '+';
            }
            if ($firstCharacter == '0' && $secondCharacter == '0') {
                $userphone = substr($userphone, 2);
                $prefix = '+';
            }
            if ($firstCharacter == '0' && $secondCharacter != '0') {
                $userphone = substr($userphone, 1);
                $prefix = '+';
            }
            if ($firstCharacter == '9') {
                $prefix = '+357';
            }
            if ($firstCharacter == '+' && $secondCharacter != '0') {
                $prefix = '';
            }
            $userphone = $prefix . $userphone;

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

            return view('layouts.otp', ['email' => $useremail]);
        } else {
            return view('home');
        }
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
            $user->otp = NULL;
            $user->save();
            return redirect()->route('home');
        } else {
            $user->otp = NULL;
            $user->save();
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {

        $data = request()->all();
        $user = new User();
        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:50', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'username' => ['string', 'required', 'min:6', 'max:30', 'unique:users'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        ];

        if ($data['entity'] == 'employee') {
            $validator = Validator::make($request->all(), $rules);
        }

        if ($data['entity'] == 'company') {

            if ($data['url'] == !'') {
                $rules['url'] = ['required', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'];
            }
            $validator = Validator::make($request->all(), $rules);
        }

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                            'success' => false,
                            'message' => 'There are incorect values in the form!',
                            'errors' => $validator->getMessageBag()->toArray()
                                ), 422);
            }
            $this->throwValidationException(
                    $request, $validator
            );
        }


        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->username = $data['username'];
        $user->phone = $data['phone'];

        if ($data['entity'] != 'all') {
            $user->entity = $data['entity'];
        }
        //if it is an employee save the company
        if ($data['entity'] == 'employee') {
            $user->company_id = $data['company'];
        }
        //    if ($data['entity'] == 'company') {
        $user->url = $data['url'];

        //temporary arrangement
        //  $user->logo = $data['logo'];    
        //       if ($_FILES['logo']['name'] !== '') {
        //    $user->logo = $_FILES['logo']['name'];}
        //   $user->logo = $data['logo'];            
        //  }
        /*


          if ($data['entity'] == 'company') {
          $user->logo = $data['logo'];
          $user->url = $data['url'];
          }

          //entity must be employeee or company to save


         */

        $user->save();
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
    public function datatable($entity_value) {

        $user_id = \Auth::user()->id;
        $name = Auth::user()->name;
        if (Auth::user()->type == 'admin') {
            if ($entity_value == 'all') {
                $data = User::all();
            } else {
                $data = User::all()->where('entity', $entity_value);
            }
        } else {
            $data = User::all()->where('id', $user_id);
            $entity_value = Auth::user()->entity;
        }

        //to pass the companies for the drop down item in the modal
        $companies = User::all()->where('entity', 'company');

        return view('datatables.datatable', ['data' => $data,
            'name' => $name, 'entity_value' => $entity_value, 'companies' => $companies]);
    }

    public function ajax() {
        $name = Auth::user()->name;
        return view('datatables.ajaxtable', ['name' => $name]);
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
    public function update(Request $request) {

        $data = request()->all();
        $user = User::find($data['id']);
        $user_id = $user->id;
        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:50', Rule::unique('users')->ignore($user_id)],
            'username' => ['string', 'required', 'min:6', 'max:30', Rule::unique('users')->ignore($user_id)],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        ];

        //to validate url
        if ($data['entity'] == 'employee') {
            if ($data['password'] !== NULL && $data['password'] !== '') {
                $rules['password'] = ['required', 'string', 'min:8'];
                $validator = Validator::make($request->all(), $rules);
            } else {
                $validator = Validator::make($request->all(), $rules);
            }
        }
        if ($data['entity'] == 'company') {
            if ($data['password'] !== NULL && $data['password'] !== '') {
                $rules['password'] = ['required', 'string', 'min:8'];
                if ($data['url'] !== NULL && $data['url'] !== '') {
                    $rules['url'] = ['required', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'];
                    $validator = Validator::make($request->all(), $rules);
                } else {
                    $validator = Validator::make($request->all(), $rules);
                }
            } else {
                if ($data['url'] !== NULL && $data['url'] !== '') {
                    $rules['url'] = ['required', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'];
                    $validator = Validator::make($request->all(), $rules);
                } else {
                    $validator = Validator::make($request->all(), $rules);
                }
            }
        }

        if ($validator->fails()) {
            if ($request->ajax()) {
                return response()->json(array(
                            'success' => false,
                            'message' => 'There are incorect values in the form!',
                            'errors' => $validator->getMessageBag()->toArray()
                                ), 422);
            }
            $this->throwValidationException(
                    $request, $validator
            );
        }

        $a_new_email = false;
        $user->name = $data['name'];

        //if it is a different email it needs verification
        if ($user->email != $data['email']) {
            $user->email = $data['email'];
            $a_new_email = true;
        }
        if ($data['password'] !== NULL && $data['password'] !== '') {
            $user->password = Hash::make($data['password']);
        }
        $user->username = $data['username'];
        $user->phone = $data['phone'];

        if ($data['entity'] == 'employee') {
            $user->company_id = $data['company'];
        }
        if ($data['entity'] == 'company') {
            $user->url = $data['url'];
          //$user->logo = $data['logo'];
        }
        $user->save();

        //to force email verification
        if ($a_new_email) {
            $user->email_verified_at = NULL;
            $user->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
        $data = request()->all();
        $user = User::find($data['id']);
        $user->delete();
    }

    public function logoutUserAndRedirectLogin() {
        $user = Auth::user();
        $user->remember_token = NULL;
        $user->save();
        Auth::logout();
        return redirect()->route('login');
    }

    public function logoutUserAndRedirectOtp() {
        Auth::logout();
        return redirect()->route('otp');
    }

}
