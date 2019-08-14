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

Route::get('/',  'HomeController@welcome');
Route::get('/home',  'HomeController@index');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();


Route::group(['prefix' => '/'], function () {
    //
    Route::get('Mentions','MentionsController@index')->name('mentions.index');
    Route::get('Mentions/add','MentionsController@add')->name('mentions.add');
    Route::post('Mentions/add','MentionsController@store')->name('mentions.store');
    Route::get('Mentions/delete/{id}','MentionsController@delete')->name('mentions.delete');


    Route::get('Profile','UserController@profile')->name('profile.index');




    Route::get('/{slug}','HomeController@page')->name('page');
});



