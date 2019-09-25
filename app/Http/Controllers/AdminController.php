<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function adminapi() {
        $name = Auth::user()->name;
        return view('isadmin.admin', ['name' => $name]);
    }

}
