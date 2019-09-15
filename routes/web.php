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

Route::get('lang/{locale}', 'HomeController@lang');

Route::get('/', function () {
    return view('welcome');
});

 //To send verification email
//Auth::routes(['verify' => true]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logoutUser', 'UsersController@logoutUserandRedirectLogin')->name('logoutUser');



Route::get('/adminapi', 'AdminController@adminapi')    
    ->middleware('is_admin')    
    ->name('admin');

Route::get('admin', function () {
    return view('admin');
});
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

Route::post('/apis/update', 'ApisController@update');
Route::get('/apis/edit', 'ApisController@edit');

//Route::get('/users/info', 'UsersController@datatable');
Route::get('/otp', 'UsersController@sendOtp')->name('otp');
Route::post('/verifyotp', 'UsersController@verifyOtp')->name('votp');

//Routes for the datatables
Route::get('/datatable', 'UsersController@datatable')->name('datatable');
Route::post('/editItem', 'UsersController@update');
Route::get('/apiuserinfo', 'ApiForAjaxController@getUsers')->name('api.user.info');
Route::get('/ajax', 'UsersController@ajax')->name('ajax');
