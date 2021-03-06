<?php

use Illuminate\Support\Facades\Route;

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
	//return redirect('login');
});
Route::get('my-profile/password', ['as' => 'my-profile.reset', 'uses' => 'MyProfileController@reset']);
Route::post('my-profile/password', ['as' => 'my-profile.doreset', 'uses' => 'MyProfileController@doReset']);	
Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/googlemaps', 'GoogleMapsController@index')->name('google_maps');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::post('home/rating', ['as' => 'home.rating', 'uses' => 'HomeController@feedbackrating'])->middleware('auth');
Route::post('home/upload', ['as' => 'home.upload', 'uses' => 'HomeController@uploadfile'])->middleware('auth');
Route::get('home/download/{id}', ['as' => 'home.download', 'uses' => 'HomeController@downloadfile'])->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('lembur', 'LemburController@index')->name('lembur')->middleware('auth');
	Route::get('lembur/request', ['as' => 'lembur.request', 'uses' => 'LemburController@request']);
	Route::get('lembur/request/{id}', ['as' => 'lembur.edit', 'uses' => 'LemburController@edit']);
	Route::post('lembur/add', ['as' => 'lembur.add', 'uses' => 'LemburController@add']);
	Route::post('lembur/notification', ['as' => 'lembur.notif', 'uses' => 'LemburController@notification']);
	Route::post('lembur/edit', ['as' => 'lembur.doedit', 'uses' => 'LemburController@doEdit']);
	Route::get('lembur/history', ['as' => 'lembur.history', 'uses' => 'LemburController@history']);

Route::get('home/my-profile', ['as' => 'home.my_profile', 'uses' => 'MyProfileController@index']);
	Route::post('my-profile/change-password', ['as' => 'my-profile.changepass', 'uses' => 'MyProfileController@changePass']);
	Route::post('my-profile/edit-profile', ['as' => 'my-profile.editprofile', 'uses' => 'MyProfileController@editProfile']);
	Route::get('my-profile/help', ['as' => 'my-profile.help', 'uses' => 'MyProfileController@help']);
	Route::post('my-profile/save', ['as' => 'my-profile.savehelp', 'uses' => 'MyProfileController@savehelp']);
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);	
});

