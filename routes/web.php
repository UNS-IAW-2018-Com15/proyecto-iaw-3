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

Route::group(['prefix' => 'complejos'], function() {

	//Complejos
	Route::get('/', 'ComplejosController@show') ;


	Route::get('/add', 'ComplejosController@add') ;
	Route::post('/add', 'ComplejosController@save');

	Route::post('/edit','ComplejosController@update');
	Route::get('/edit/{id}','ComplejosController@edit');

  	Route::get('/delete/{id}','ComplejosController@delete');

  	//Canchas
	Route::post('/add/cancha', 'CanchasController@save');
	Route::post('/delete/cancha','CanchasController@delete');

	//Comentarios
  	Route::post('/delete/comentario','ComentariosController@delete');
	
});


Route::get('/login', function(){
	return view('auth.login')->with('guest','guest');
}) -> name('login');
Route::post('/login', 'Auth\LoginController@login');

Route::post('/logout', 'Auth\LoginController@logout') -> name('logout');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout' );

/*Route::get('/register', function(){
	return view('auth.register2')->with('guest','guest');
}) -> name('register');
Route::post('/register', 'Auth\RegisterController@register');
*/
//Estas rutas son para usar el Auth de laravel (con blade)
//Auth::routes();
