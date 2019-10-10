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

Route::get('/apisedit', 'ApisController@edit')->middleware('verified','is_admin');
Route::post('/apis/update', 'ApisController@update')->middleware('verified','is_admin');


Route::get('/otp', 'UsersController@sendOtp')->name('otp');
Route::post('/verifyotp', 'UsersController@verifyOtp')->name('votp');

Route::get('/employee', 'UsersController@datatable')->name('employee')->middleware('verified');
Route::get('/company', 'UsersController@datatable')->name('company')->middleware('verified');
Route::get('/all', 'UsersController@datatable')->name('all')->middleware('verified');

Route::post('/newItem', 'UsersController@create')->middleware('verified', 'is_admin');
Route::post('/editItem', 'UsersController@update')->middleware('verified');
Route::post('/deleteItem', 'UsersController@destroy')->middleware('verified','is_admin');

Route::get('/apiuserinfo', 'ApiForAjaxController@getUsers')->name('api.user.info')->middleware('verified');
Route::get('/ajax', 'UsersController@ajax')->name('ajax')->middleware('verified');

Route::get('/logoutuser', 'UsersController@logoutUserandRedirectLogin')->name('logoutuser')->middleware('verified');

