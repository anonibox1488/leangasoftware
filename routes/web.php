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

Route::group(['middleware' => 'auth'], function(){

	Route::get('/home', 'HomeController@index')->name('home');

	Route::get('/servicios', 'ServicioController@create');
	Route::post('/servicios', 'ServicioController@store');
	Route::get('/servicios/{slug}', 'ServicioController@show');

	Route::post('/mensajes', 'MensajeController@store');
	Route::post('/responder', 'MensajeController@responder');
	Route::get('/mensajes/{id}', 'MensajeController@getMensajesModal');
	Route::get('mis-mensajes', 'MensajeController@index');
	Route::get('/mensajes/{servicio}/{user}', 'MensajeController@getMensajesInbox');
});

