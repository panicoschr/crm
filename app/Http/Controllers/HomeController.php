<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App;

use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
       

        $name = Auth::user()->name;
        return view('home', ['name' => $name]);
    }

    public function lang($locale)
    {
        App::setLocale($locale);
        //storing the locale in session to get it back in the middleware
        session()->put('locale', $locale);
        return redirect()->back();
    }
}
