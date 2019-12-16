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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::group(['middleware' => 'auth'], function () {

    // All my routes that needs a logged in user
    Route::get('/', 'HomeController@index')->name('home');
    Route::resource('users','UserController');
});

/*Route::get('/', function () {
    return view('dashboard.index');
});*/

Auth::routes();

/*Route::get('/home', 'HomeController@index')->name('home');*/
