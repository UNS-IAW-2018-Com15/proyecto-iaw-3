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
    return redirect('/complejos');
});

Route::get('/complejos', 'AdminController@show') -> middleware('auth');

Route::group(['prefix' => 'complejos'], function() {

	Route::get('/add', 'AdminController@add') -> middleware('auth');
	Route::post('/add', 'AdminController@save')-> middleware('auth');
	Route::post('/edit/cancha','AdminController@update')-> middleware('auth');
	Route::get('/edit/cancha/{id}','AdminController@edit')-> middleware('auth');
	Route::post('/add/cancha', 'AdminController@saveCancha')-> middleware('auth');
	Route::post('/delete/cancha','AdminController@deleteCancha')-> middleware('auth');
  	Route::get('/delete/{id}','AdminController@delete')-> middleware('auth');
  	Route::post('/delete/comentario','AdminController@deleteComentario')-> middleware('auth');
	
});

Route::get('/login', 'Auth\LoginController@showLoginForm') -> name('login');
Route::post('/login', 'Auth\LoginController@login');
Route::post('/logout', 'Auth\LoginController@logout') -> name('logout');
