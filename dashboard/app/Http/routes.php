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


/* Halaman-halaman */
Route::get('/', 'DashboardController@index');
Route::get('politic', 'DashboardController@politic');
Route::get('economy', 'DashboardController@economy');
Route::get('social', 'DashboardController@social');
Route::get('technology', 'DashboardController@technology');
Route::get('legal', 'DashboardController@legal');
Route::get('environment', 'DashboardController@environment');
Route::get('keyword', 'DashboardController@keyword');

Route::get('dashboard/crawl', 'DashboardController@crawl');
Route::get('dashboard/content', 'DashboardController@content_ext');
Route::get('dashboard/keyword', 'DashboardController@keyword_ext');
Route::get('dashboard/sentiment', 'DashboardController@sentiment_anl');

/* Resources */
Route::resource('news', 'NewsController');
Route::resource('metric', 'MetricController');
Route::resource('site', 'SiteController');
Route::resource('condition', 'ConditionController');
Route::resource('crawlered', 'CrawleredController');
Route::resource('dashboard', 'DashboardController');

/* Percobaan-percobaan */
Route::get('test', 'DashboardController@test');
Route::get('cek', 'DashboardController@cek');
Route::get('cek2', 'DashboardController@cek2');
Route::get('crawl', 'DashboardController@muain');

/* dari Laravel 5 */
Route::get('home', 'HomeController@index');
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);