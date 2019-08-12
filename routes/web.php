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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('charities', 'CharityController@index');

Route::get('charities/{charity_id}', 'CharityController@show');

Route::post('donation', 'DonationController@store');

Route::get('donation/search', 'DonationController@load');

Route::post('donation/filter', 'DonationController@filter')->name('filter.selected-id');;
