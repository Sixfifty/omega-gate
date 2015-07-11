<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Authentication routes...
Route::get('auth/login', ['uses' => 'Auth\AuthController@getLogin', 'as' => 'auth.login']);
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', ['uses' => 'Auth\AuthController@getLogout', 'as' => 'auth.logout']);

// Registration routes...
Route::get('auth/register', ['uses' => 'Auth\AuthController@getRegister', 'as' => 'auth.register']);
Route::post('auth/register', 'Auth\AuthController@postRegister');

Route::get('/home', ['middleware' => 'auth', function () {
    return view('home');
}]);

Route::get('user', ['uses' => 'UserController@whoAmI', 'as' => 'user.whoami']);