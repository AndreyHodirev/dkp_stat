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

Route::middleware(['auth','confirmed'])->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/guilds', 'GuildController@index')->name('guilds');
});
Route::middleware('auth')->group(function(){
    Route::get('users/{user}/request-confirmation', 'UserEmailConfirmationController@request')->name('request-confirm-email');
    Route::post('users/{user}/send-confirmation-email', 'UserEmailConfirmationController@sendEmail')->name('send-confirmation-email');
    Route::get('users/{user}/confirm-email/{token}', 'UserEmailConfirmationController@confirm')->name('confirm-email');
});