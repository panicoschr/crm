<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use App\Company;

class EmployeesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        // $this->middleware('auth');
    }

    public function index() {
        $employees = Employee::paginate(10);
        return view('employees.index', ['employees' => $employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $companies = Company::all();
        return view('employees.create', ['companies' => $companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required'
        ]);

        $data = request()->all();
        $employee = new Employee();
        $employee->first_name = $data['first_name'];
        $employee->last_name = $data['last_name'];
        $employee->company_id = $data['company_id'];
        $employee->email = $data['email'];
        $employee->phone = $data['phone'];
        $employee->save();
        return(redirect('/employees'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee) {
        return view('employees.show', ['employee' => $employee]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee) {

        $companies = Company::all();

        return view('employees.edit', [
            'employee' => $employee,
            'companies' => $companies
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee) {
        $this->validate(request(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required'
        ]);

        $data = request()->all();
        $employee->first_name = $data['first_name'];
        $employee->last_name = $data['last_name'];
        $employee->company_id = $data['company_id'];
        $employee->email = $data['email'];
        $employee->phone = $data['phone'];
        $employee->save();
        session()->flash('success', 'Employee updated successfully');
        return(redirect('/employees'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee) {
        $employee->delete();
        return redirect('/employees');
    }

}
