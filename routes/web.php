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
Route::post('databarang/tambahbarang', 'DatabarangController@tambahbarang');
Route::get('databarang/editbarang/{id_barang}', 'DatabarangController@editbarang');
Route::post('databarang/updatebarang', 'DatabarangController@updatebarang');
Route::get('databarang/deletebarang/{id_barang}', 'DatabarangController@deletebarang');

Route::get('/dataharga/index', 'DatahargaController@index');
Route::post('dataharga/tambahharga', 'DatahargaController@tambahharga');
Route::get('dataharga/editharga/{id_harga}', 'DatahargaController@editharga');
Route::post('dataharga/updateharga', 'DatahargaController@updateharga');
Route::get('dataharga/deleteharga/{id_harga}', 'DatahargaController@deleteharga');

Route::get('/datauser/index', 'DatauserController@index');
Route::post('datauser/tambahuser', 'DatauserController@tambahuser');
Route::get('datauser/edituser/{id_user}', 'DatauserController@edituser');
Route::post('datauser/updateuser', 'DatauserController@updateuser');
Route::get('datauser/deleteuser/{id_user}', 'DatauserController@deleteuser');

Route::get('/transaksipenjualan/index', 'TransaksipenjualanController@index');
Route::post('transaksipenjualan/tambahpenjualan', 'TransaksipenjualanController@tambahtransaksipenjualan');
Route::get('transaksipenjualan/edituser/{id_user}', 'TransaksipenjualanController@edituser');
Route::post('transaksipenjualan/updateuser', 'TransaksipenjualanController@updateuser');
Route::get('transaksipenjualan/deleteuser/{id_user}', 'TransaksipenjualanController@deleteuser');

Route::get('/transaksikas/index', 'TransaksikasController@index');
Route::post('transaksikas/tambahpenjualan', 'TransaksipenjualanController@tambahuser');
Route::get('transaksikas/edituser/{id_user}', 'TransaksipenjualanController@edituser');
Route::post('transaksikas/updateuser', 'TransaksipenjualanController@updateuser');
Route::get('transaksikas/deleteuser/{id_user}', 'TransaksipenjualanController@deleteuser');

Route::get('/transaksicuci/index', 'TransaksicuciController@index');
Route::post('transaksicuci/tambahtransaksicuci', 'TransaksicuciController@tambahtransaksicuci');
Route::get('transaksicuci/edittransaksicuci/{id_cuci}', 'TransaksicuciController@edittransaksicuci');
Route::post('transaksicuci/updatetransaksicuci', 'TransaksicuciController@updatetransaksicuci');
Route::get('transaksicuci/deleteuser/{id_user}', 'TransaksicuciController@deleteuser');


Route::get('/token', function () {
    return csrf_token();
});
