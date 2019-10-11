<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        
         $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'entity' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'min:8', 'unique:users'],
            'phone' => ['required', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
        ];

        if ($data['url'] !== NULL && $data['url'] !== '') {
            $rules['url'] = ['required', 'regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/'];
        } 
        if (array_key_exists('logo', $data)) {
            if ($data['logo'] == !''){
                $rules['logo'] = ['image', 'dimensions:min_width=100,min_height=100'];     
            }
        }        
              
        return Validator::make($data, $rules);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {

        $final_filename = null;

        if (array_key_exists('logo', $data)) {

            if ($data['logo'] == !'') {
                $target_dir = '../public/logos/';
                $file = $_FILES['logo']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['logo']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . '.' . $ext;
                move_uploaded_file($temp_name, $path_filename_ext);
                $final_filename = $filename . '.' . $ext;
            }
        } else {
            $final_filename = null;
        }

        return User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'password' => Hash::make($data['password']),
                    'type' => User::DEFAULT_TYPE,
                    'entity' => $data['entity'],
                    'username' => $data['username'],
                    'phone' => $data['phone'],
                    'url' => $data['url'],
                    'logo' => $final_filename,
        ]);
     }
    
    
}
