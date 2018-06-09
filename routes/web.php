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
    return view('index');
});

Route::get('/complejos', 'AdminController@show');

Route::group(['prefix' => 'complejos'], function() {

	Route::get('/add', 'AdminController@add');
  Route::get('/delete/{id}','AdminController@delete');
	Route::post('/add', 'AdminController@save');
});