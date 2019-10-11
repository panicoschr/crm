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
use Illuminate\Support\Carbon;

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
        /**
         * If the user is not an admin log out, and generate and save in DB the OTP. If an admin no OTP required.
         * @return type
         */
        if ($usertype != 'admin') {
            $this->logoutUserAndRedirectOtp();
            $otp = $this->generateOTP();
            $user->otp = $otp;
            $user->save();
        /**
         * Constructs a  phone number as required for OTP to work.
         * Takes into consideration some possible phone formats that will be entered by the user
         * @return type
         */
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
            /**
             * Creates the array format to send the OTP
             * @return type
             */
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
     * Locates the user by the email, compares OTPs and login the user or log out the 
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
        //validate input data
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
               //validate input URL if any
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
        //if it is a company save the url
        if ($data['entity'] == 'company') {
            $user->url = $data['url'];
            //Upload the file to the server
            $files = $request->file('logo');
            $final_filename = null;
            if ($files) {
                $target_dir = '../public/logos/';
                $file = $_FILES['logo']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['logo']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . '.' . $ext;
                move_uploaded_file($temp_name, $path_filename_ext);
                $final_filename = $filename . '.' . $ext;
                $user->logo = $final_filename;
            }
        }
        
        // all new employees and company insertions made by the administrator will be verified immediately
        $user->email_verified_at = new Carbon();
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

    /** We are passing the entity_value in the request by the menu selection items to 
     * know if we need 'company' or 'employee' or 'all' reports
     * 'employee' or 'company' is used for admin menu items whereas 'all' is used for users menu items. 
     * This arrangement is made because admin has also access to users menu items
     * @return type
     */
    public function datatable(Request $request) {
        
        $url_entity_value = $request->getPathInfo();
        //from the url take the entity value, to be aware which data we need, employee or company or all
        $entity_value = substr($url_entity_value, 1) ;    
        $user_id = \Auth::user()->id;
        $name = Auth::user()->name;
        // an admin can see all data
        if (Auth::user()->type == 'admin') {
            //referes to the users menu items
            if ($entity_value == 'all') {
                $data = User::all();
            } else {
                //referes to the admin menu items
                $data = User::all()->where('entity', $entity_value);
            }
        } else {
            // a regular user (company or employee) sees own data
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
        //validate input data
        $data = request()->all();
        $user = User::find($data['id']);
        $user_id = $user->id;
        $rules = [
            'name' => ['required', 'max:255'],
            'email' => ['email', 'required', 'max:50', Rule::unique('users')->ignore($user_id)],
            'username' => ['string', 'required', 'min:6', 'max:30', Rule::unique('users')->ignore($user_id)],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        ];

        
        if ($data['entity'] == 'employee') {
               //validate a new input password if any 
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
                //   to validate a url if any
                if ($data['url'] !== NULL && $data['url'] !== '') {
                    $rules['url'] = ['required', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'];
                    $validator = Validator::make($request->all(), $rules);
                } else {
                    $validator = Validator::make($request->all(), $rules);
                }
            } else {
                if ($data['url'] !== NULL && $data['url'] !== '') {
                        //   to validate a url if any
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

        //if it is a different email we keep a dummy variable to force verification
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
            //upload of file to the server
            $files = $request->file('logo');
            $final_filename = null;
            if ($files) {
                $target_dir = '../public/logos/';
                $file = $_FILES['logo']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['logo']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . '.' . $ext;
                move_uploaded_file($temp_name, $path_filename_ext);
                $final_filename = $filename . '.' . $ext;
                $user->logo = $final_filename;
            }
        }
        $user->save();

        //use dummy variable to force email verification only when the update 
        //of the email is done by the person itself and not the admin
        if (($a_new_email) && (Auth::user()->type == 'default')) {
            $user->email_verified_at = NULL;
            $user->save();
            $user->sendEmailVerificationNotification();
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
