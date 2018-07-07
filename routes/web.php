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

Auth::routes();
Route::get('user/activation/{token}', 'Auth\LoginController@activateUser')->name('user.activate');
Route::get('/auth/{social_network}/login', 'Auth\LoginController@redirect_to_provider');
Route::get('/auth/{social_network}/login/callback', 'Auth\LoginController@handle_provider_callback');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/contact', 'ContactController@index')->name('contact');
Route::post('/contact', 'ContactController@send');
    
Route::get('/channel/{channel}', 'ChannelController@show')->name('channel');
Route::get('/channel/{channel}/videos', 'ChannelController@videos');  

Route::get('/videos/{video}', 'VideoController@show')->name('video.show');
Route::post('/videos/{video}/view', 'VideoViewController@create');
Route::get('/videos/{video}/votes', 'VideoVoteController@show');
Route::get('/videos/{video}/comments', 'VideoCommentController@index');

Route::get('/search', 'SearchController@search')->name('search');

Route::get('/subscriptions/{channel}', 'ChannelSubscriptionController@show');

Route::group(['middleware' => ['auth']], function() {
    Route::post('/upload-image', 'ImageUploadController@store');
    Route::post('/upload-video', 'VideoUploadController@store');

    Route::get('/videos', 'VideoController@index')->name('videos');
    Route::get('/videos/{video}/edit', 'VideoController@edit')->name('videos.edit');
    Route::delete('/videos/{video}', 'VideoController@delete');
    Route::post('/videos', 'VideoController@store');
    Route::put('/videos/{video}', 'VideoController@update');

    Route::post('/videos/{video}/votes', 'VideoVoteController@create');
    Route::delete('/videos/{video}/votes', 'VideoVoteController@remove');

    Route::post('/videos/{video}/comment', 'VideoCommentController@create');
    Route::delete('/videos/{video}/comments/{comment}', 'VideoCommentController@delete');

    Route::get('/channel/{channel}/edit', 'ChannelSettingsController@edit')->name('channel.edit');
    Route::put('/channel/{channel}/edit', 'ChannelSettingsController@update');

    Route::post('/subscription/{channel}', 'ChannelSubscriptionController@create');
    Route::delete('/subscription/{channel}', 'ChannelSubscriptionController@delete');

    Route::get('/account/@{slug}/{section}', 'AccountController@index')->name('account');
    Route::post('/account/@{slug}/{section}', 'AccountController@update');

    Route::post('/cards/data', 'CardController@getCards');
    Route::post('/card/{token}', 'CardController@getCard');
    Route::post('/card/{token}/update', 'CardController@update');
    Route::get('/card/{token}/delete', 'CardController@delete');

    Route::get('/plans', 'PlanController@index')->name('plans');
});