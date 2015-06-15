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

Route::get('/', 'DashboardController@index');

Route::get('home', 'HomeController@index');
Route::get('politic', 'DashboardController@politic');
Route::get('economy', 'DashboardController@economy');
Route::get('social', 'DashboardController@social');
Route::get('technology', 'DashboardController@technology');
Route::get('legal', 'DashboardController@legal');
Route::get('environment', 'DashboardController@environment');
Route::get('keyword', 'DashboardController@keyword');
Route::get('test', 'DashboardController@test');
Route::get('cek', 'DashboardController@cek');
Route::get('cek2', 'DashboardController@cek2');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);