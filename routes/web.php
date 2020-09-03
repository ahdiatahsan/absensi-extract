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
Route::get('/', 'HomeController@index')->name('home');

//absensi
Route::resource('absensi', 'AbsensiController');
Route::put('absensi/{absensi}', 'AbsensiController@absensi_konfirmasi')->name('absensi_konfirmasi');
Route::get('tabel_absensi_terpenuhi', 'AbsensiController@absensi_terpenuhi')->name('absensi_terpenuhi');
Route::get('tabel_absensi_belum_terpenuhi', 'AbsensiController@absensi_belum_terpenuhi')->name('absensi_belum_terpenuhi');

//tahap
Route::resource('tahap', 'TahapController');

//agenda
Route::resource('agenda', 'AgendaController');

//konsentrasi
Route::resource('konsentrasi', 'KonsentrasiController');

//peserta
Route::resource('peserta', 'PesertaController', ['parameters' => ['peserta' => 'peserta']]);
