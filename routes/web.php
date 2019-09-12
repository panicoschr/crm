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

//To send verification email
//Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'AdminController@admin')    
    ->middleware('is_admin')    
    ->name('admin');

Route::get('/employees', 'EmployeesController@index')->middleware('verified');
Route::get('/employees/create', 'EmployeesController@create')->middleware('verified');
Route::post('/employees/{employee}/update', 'EmployeesController@update')->middleware('verified');
Route::get('/employees/{employee}', 'EmployeesController@show')->middleware('verified');
Route::get('/employees/{employee}/edit', 'EmployeesController@edit')->middleware('verified');
Route::post('/employees', 'EmployeesController@store')->middleware('verified');
Route::get('/employees/{employee}/delete', 'EmployeesController@destroy')->middleware('verified');

Route::get('/companies', 'CompaniesController@index')->middleware('verified');
Route::get('/companies/create', 'CompaniesController@create')->middleware('verified');
Route::post('/companies/{company}/update', 'CompaniesController@update')->middleware('verified');
Route::get('/companies/{company}', 'CompaniesController@show')->middleware('verified');
Route::get('/companies/{company}/edit', 'CompaniesController@edit')->middleware('verified');
Route::post('/companies', 'CompaniesController@store')->middleware('verified');
Route::get('/companies/{company}/delete', 'CompaniesController@destroy')->middleware('verified');



//change the verified


Route::post('/apis/{api}/update', 'ApisController@update');

Route::get('/apis/{api}/edit', 'ApisController@edit');

Route::get('/sms/send', 'SmsController@sendSms');
Route::post('/sms/send', 'SmsController@postSendSms');

Route::get('/users/info', 'UsersController@datatable')->middleware('auth');;
