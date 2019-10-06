<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
Use App\User;

class ApiForAjaxController extends Controller {

    /*
     * Rendering of data
     * Admin sees all data, otherwise if not an admin, own data
     */
    public function getUsers() {

        $id = Auth::user()->id;
        if (Auth::user()->type == 'admin') {
            $query = User::select('id', 'name', 'email', 'username', 'phone', 'entity');
        } else {
            $query = User::select('id', 'name', 'email', 'username', 'phone', 'entity')->where('id', $id);
        }
        return datatables($query)->make(true);
    }

}
