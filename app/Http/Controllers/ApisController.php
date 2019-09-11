<?php

namespace App\Http\Controllers;

use App\Api;
use Illuminate\Http\Request;


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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function edit(Api $api)
    { 
        return view('isadmin.api.edit', ['api' => $api]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Api  $api
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Api $api)
{
        $data = request()->all();
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
