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


Auth::routes(['verify' => true]);



Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/logoutuser', 'UsersController@logoutUserandRedirectLogin')->name('logoutuser')->middleware('verified');


Route::get('admin', function () {
    return view('admin');
});


Route::post('/apis/update', 'ApisController@update')->middleware('is_admin');
Route::get('/apisedit', 'ApisController@edit')->middleware('is_admin');

Route::get('/otp', 'UsersController@sendOtp')->name('otp');
Route::post('/verifyotp', 'UsersController@verifyOtp')->name('votp');

//Routes for the datatables
//Route::get('/datatable', 'UsersController@datatable')->name('datatable')->middleware('verified')->middleware('is_admin')->middleware('is_admin');
Route::get('/datatable/{entity_value}/', 'UsersController@datatable')->name('datatable')->middleware('verified');
Route::post('/newItem', 'UsersController@create')->middleware('verified');
Route::post('/editItem', 'UsersController@update')->middleware('verified');
Route::get('/apiuserinfo', 'ApiForAjaxController@getUsers')->name('api.user.info')->middleware('verified');
Route::get('/ajax', 'UsersController@ajax')->name('ajax')->middleware('verified');


//Route::post('/employees', 'EmployeesController@store')->middleware('auth');
Route::post('/deleteItem', 'UsersController@destroy')->middleware('verified');


Route::get('/employees', 'EmployeesController@index')->middleware('auth');
Route::get('/employees/create', 'EmployeesController@create')->middleware('auth');
Route::post('/employees/{employee}/update', 'EmployeesController@update')->middleware('auth');
Route::get('/employees/{employee}', 'EmployeesController@show')->middleware('auth');
Route::get('/employees/{employee}/edit', 'EmployeesController@edit')->middleware('auth');
Route::post('/employees', 'EmployeesController@store')->middleware('auth');
Route::get('/employees/{employee}/delete', 'EmployeesController@destroy')->middleware('auth');

Route::get('/companies', 'CompaniesController@index')->middleware('auth');
Route::get('/companies/create', 'CompaniesController@create')->middleware('auth');
Route::post('/companies/{company}/update', 'CompaniesController@update')->middleware('auth');
Route::get('/companies/{company}', 'CompaniesController@show')->middleware('auth');
Route::get('/companies/{company}/edit', 'CompaniesController@edit')->middleware('auth');
Route::post('/companies', 'CompaniesController@store')->middleware('auth');
Route::get('/companies/{company}/delete', 'CompaniesController@destroy')->middleware('auth');
