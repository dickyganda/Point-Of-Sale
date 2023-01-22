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
    return view('autentikasi/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/autentikasi/login', 'AuthController@login');
Route::post('/dashboard/index', 'AuthController@postlogin2');
// Route::get('autentikasi/ubahpassord/{id_user}', 'AuthController@ubahpassword');
// Route::post('autentikasi/updatepassword', 'AuthController@updatepassword');
Route::get('/logout', 'AuthController@logout2');

Route::get('/dashboard/index', 'DashboardController@index')->name('dashboard');;

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
Route::get('transaksipenjualan/editpenjualan/{id_penjualan}', 'TransaksipenjualanController@editpenjualan');
Route::post('transaksipenjualan/updatepenjualan', 'TransaksipenjualanController@updatepenjualan');
Route::get('transaksipenjualan/deletepenjualan/{id_dt_penjualan}', 'TransaksipenjualanController@deletepenjualan');
Route::post('transaksipenjualan/getbarang', 'TransaksipenjualanController@getbarang');
Route::get('print/printpenjualan/{id_cart}', 'TransaksipenjualanController@printthermal');
Route::get('transaksipenjualan/closingpenjualan', 'TransaksipenjualanController@closingpenjualan');

Route::get('/transaksikas/index', 'TransaksikasController@index');
Route::post('transaksikas/tambahkas', 'TransaksikasController@tambahkas');
Route::get('transaksikas/editkas/{id_kas}', 'TransaksikasController@edituser');
Route::post('transaksikas/updatekas', 'TransaksikasController@updateuser');
Route::get('transaksikas/deletekas/{id_kas}', 'TransaksikasController@deleteuser');

Route::get('/transaksicuci/index', 'TransaksicuciController@index');
Route::post('transaksicuci/tambahtransaksicuci', 'TransaksicuciController@tambahtransaksicuci');
Route::get('transaksicuci/edittransaksicuci/{id_cuci}', 'TransaksicuciController@editcuci');
Route::post('transaksicuci/updatetransaksicuci', 'TransaksicuciController@updatecuci');
Route::get('transaksicuci/deleteuser/{id_user}', 'TransaksicuciController@deleteuser');

Route::get('/closing/index', 'ClosingController@index');

Route::get('/report/index', 'ReportController@index');



Route::get('/token', function () {
    return csrf_token();
});
