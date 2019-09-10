<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@admin')    
    ->middleware('is_admin')    
    ->name('admin');


Route::get('/employees', 'EmployeesController@index');
Route::get('/employees/create', 'EmployeesController@create');
Route::post('/employees/{employee}/update', 'EmployeesController@update');
Route::get('/employees/{employee}', 'EmployeesController@show');
Route::get('/employees/{employee}/edit', 'EmployeesController@edit');
Route::post('/employees', 'EmployeesController@store');
Route::get('/employees/{employee}/delete', 'EmployeesController@destroy');


Route::get('/companies', 'CompaniesController@index');
Route::get('/companies/create', 'CompaniesController@create');
Route::post('/companies/{company}/update', 'CompaniesController@update');
Route::get('/companies/{company}', 'CompaniesController@show');
Route::get('/companies/{company}/edit', 'CompaniesController@edit');
Route::post('/companies', 'CompaniesController@store');
Route::get('/companies/{company}/delete', 'CompaniesController@destroy');



