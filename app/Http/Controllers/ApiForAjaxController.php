<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use App\User;

class ApiForAjaxController extends Controller
{
    //
      public function getUsers()
    {
        $query = User::select('id', 'name', 'email', 'password', 'username', 'phone');
        return datatables($query)->make(true);
    }  
    
}
