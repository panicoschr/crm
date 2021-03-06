<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ApisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Constructs the class
     */
    public function __construct() {
        //   $this->middleware('auth');
    }
    
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function show(Api $api)
    {
 
    }

    /**
     * Show the form for editing the API value
     *
     * @param  \App\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function edit()
    { 
        $name = Auth::user()->name;
        $api = Api::where('id', 1)->first();
        return view('isadmin.edit', ['api' => $api, 'name' => $name]);
    }

    /**
     * Update the API value
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
{
        $data = request()->all();
        $api = Api::where('id', 1)->first();
        $api->api = $data['api'];
        $api->save();
        return(redirect('/home'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function destroy(Api $api)
    {
        //
    }
}
