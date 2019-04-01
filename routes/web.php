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
    Route::resources([
        'guilds' => 'GuildController',
        'games' => 'GameController',
        'auction' => 'AuctionController',
    ]);
    Route::get('/to_join/{guild}', 'GuildController@to_join')->name('guild.join');
    Route::post('/send_request', 'GuildController@send_req')->name('guild.request_new');
    Route::post('/addMember', 'GuildController@memberAdd')->name('guild.add_new_member');
    Route::post('/exitGuid', 'GuildController@exitMember')->name('guild.exitMember');
    Route::post('/usExec', 'GuildController@userException')->name('guild.usException');
    Route::post('/cencelaActi', 'GuildController@cce')->name('guild.cencel');
    Route::get('/auction/buy/{auction}', 'AuctionController@buy')->name('auc.buy');
    Route::post('/auction/buy', 'AuctionController@buyConfirm')->name('auc.buyConfirm');
});

Route::middleware('auth')->group(function(){
    Route::get('guilds/{guild}/promo', 'GuildController@promoPage')->name('guild.guildPromo');
    Route::get('users/{user}/request-confirmation', 'UserEmailConfirmationController@request')->name('request-confirm-email');
    Route::post('users/{user}/send-confirmation-email', 'UserEmailConfirmationController@sendEmail')->name('send-confirmation-email');
    Route::get('users/{user}/confirm-email/{token}', 'UserEmailConfirmationController@confirm')->name('confirm-email');
});

