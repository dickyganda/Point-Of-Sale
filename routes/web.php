<?php

use Illuminate\Support\Facades\Route;

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
    return view('dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/dashboard', 'DashboardController@index');

Route::get('/datapelanggan/index', 'DatapelangganController@index');
Route::post('datapelanggan/tambahpelanggan', 'DatapelangganController@tambahpelanggan');
Route::get('datapelanggan/editpelanggan/{id_pelanggan}', 'DatapelangganController@editpelanggan');
Route::post('datapelanggan/updatepelanggan', 'DatapelangganController@updatepelanggan');
Route::get('datapelanggan/deletepelanggan/{id_pelanggan}', 'DatapelangganController@deletepelanggan');

Route::get('/datarekanan/index', 'DatarekananController@index');
Route::post('datarekanan/tambahrekanan', 'DatarekananController@tambahrekanan');
Route::get('datarekanan/editrekanan/{id_rekanan}', 'DatarekananController@editrekanan');
Route::post('datarekanan/updaterekanan', 'DatarekananController@updaterekanan');
Route::get('datarekanan/deleterekanan/{id_rekanan}', 'DatarekananController@deleterekanan');

Route::get('/databarang/index', 'DatabarangController@index');
Route::post('databarang/tambahbarang', 'DatabarangController@tambahrekanan');
Route::get('databarang/editbarang/{id_barang}', 'DatabarangController@editrekanan');
Route::post('databarang/updatebarang', 'DatabarangController@updatebarang');
Route::get('databarang/deletebarang/{id_barang}', 'DatabarangController@deletebarang');

Route::get('/dataharga/index', 'DatahargaController@index');
Route::post('dataharga/tambahharga', 'DatahargaController@tambahharga');
Route::get('dataharga/editharga/{id_harga}', 'DatahargaController@editharga');
Route::post('dataharga/updateharga', 'DatahargaController@updateharga');
Route::get('dataharga/deleteharga/{id_harga}', 'DatahargaController@deleteharga');

Route::get('/token', function () {
    return csrf_token();
});
