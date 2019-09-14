<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SmsTo;
use App\Api;

class SmsController extends Controller {

    public function sendsms() {
        return view('smsto.sendsms');
    }





}
