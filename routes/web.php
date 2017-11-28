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

Route::group(['middleware' => 'auth'], function () {

    Route::resource('posts', PostsController::class);

    Route::get('posts/create/search', 'PostsController@search')->name('posts.search');

    Route::post('ibm/personality-traits', 'IbmWatsonController@getPersonalityTraits')->name('personality.get');
    Route::post('ibm/speech-to-text', 'IbmWatsonController@getSpeechToText')->name('tone.get');
});