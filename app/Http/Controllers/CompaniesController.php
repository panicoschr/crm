<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct()
    {
    //   $this->middleware('auth');
    }  
    
    
    
    
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', ['companies'=>$companies]);
        

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          // $companies = Company::all();
           return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
                 $this->validate(request(), [
                     'name'=>'required'
                  ])   ;
                     
                 $data = request()->all();
                 
                 $company = new Company();
                 $company->name = $data['name'];
                 $company->email = $data['email'];
                 $company->logo = $data['logo'];                 
                 $company->url = $data['url'];
                  $company->save();
                 return(redirect('/companies'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
            return view('companies.show', ['company' => $company]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
           
            return view('companies.edit', ['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
                $this->validate(request(), [
                     'name'=>'required'
                 ])   ;
                     
                 $data = request()->all();
                 $company->name = $data['name'];
                 $company->email = $data['email'];
                 $company->logo = $data['logo'];
                 $company->email = $data['url'];                 
                 $company->save();
                 return(redirect('/companies'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
                $company->delete();
                return redirect('/companies');
    }
}
