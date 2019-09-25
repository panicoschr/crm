<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
Use App\User;

class ApiForAjaxController extends Controller {

    //
    public function getUsers() {

        $id = Auth::user()->id;
        if (Auth::user()->type == 'admin') {
            $query = User::select('id', 'name', 'email', 'username', 'phone');
        } else {
            $query = User::select('id', 'name', 'email', 'username', 'phone')->where('id', $id);
        }
        return datatables($query)->make(true);
    }

}
