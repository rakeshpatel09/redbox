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

Route::get('/', function() {
	return view('index');
});

Route::group(['middleare'=>'is_login'] , function() {
	Route::get('/user_index', function () {
	    return view('user_index');
	});
});

Route::post('/login', "LoginController@check_user");
Route::post('/register', "LoginController@doRegister");
Route::post('/checkSponsor', "LoginController@checkSponsor");
Route::post('/fetchProfile', "ProfileController@fetchProfile");
Route::post('/updateProfile', "ProfileController@updateProfile");
Route::post('/uploadPayment', "PaymentController@uploadPayment");

Route::post('/fetchTree', "ProfileController@fetchTreeData");
Route::post('/fetchUpTree', "ProfileController@fetchUpTreeData");
Route::get('/customers/pdf','testController@export_pdf');
Route::get('/sponsorPdf/{users_id}', "ProfileController@generateSponsorPdf");

