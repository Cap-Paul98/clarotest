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
});

Auth::routes(["register" => false]);

Route::get('/home', 'HomeController@index')->name('home');

// rutas para el crud de usuarios 
Route::middleware(['permission:index users'])->group(function () {
    Route::get('users', 'UserController@index')->name('users');
});

Route::middleware(['permission:create users'])->group(function () {
    Route::get('createuser', 'UserController@create')->name('createuser');
    Route::post('storeuser', 'UserController@store')->name('storeuser');
});

Route::middleware(['permission:edit users'])->group(function () {
    Route::get('edituser/{id}', 'UserController@edit')->name('edituser');
    Route::post('updateuser/{id}', 'UserController@update')->name('updateuser');
});

Route::middleware(['permission:delete users'])->group(function () {
    Route::post('deleteuser', 'UserController@destroy')->name('deleteuser');
});

// rutas para indexar y crear emails
Route::middleware(['permission:index email'])->group(function () {
    Route::get('emails', 'EmailController@index')->name('emails');
});

Route::middleware(['permission:send email'])->group(function () {
    Route::get('createemail', 'EmailController@create')->name('createemail');
    Route::post('storeemail', 'EmailController@store')->name('storeemail');
});
