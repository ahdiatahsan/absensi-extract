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

//konfigurasi autentikasi
Auth::routes(['register' => false, 'verify' => false]);

//dashboard
Route::get('/dashboard', 'HomeController@index')->name('dashboard');

//agenda
Route::resource('agenda', 'AgendaController');

//konsentrasi
Route::resource('konsentrasi', 'KonsentrasiController');
