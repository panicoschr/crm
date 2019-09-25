<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
Use App\User;

class ApiForAjaxController extends Controller {

    //
    public function getUsers() {

        $id = Auth::user()->id;
        $query = User::select('id', 'name', 'email', 'password', 'username', 'phone')->where('id', $id);
        return datatables($query)->make(true);
    }

}
