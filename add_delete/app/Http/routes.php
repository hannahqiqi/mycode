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


Route::get('lady/{pageNum?}', 'LadyController@index')->where('pageNum', '[0-9]+');
Route::get('search', 'LadyController@search');
Route::get('storeGoods', 'LadyController@store');
Route::get('deleteGoods/{id}', 'LadyController@delete');
Route::get('updateGoods/{id}', 'LadyController@delete');