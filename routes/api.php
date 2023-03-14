<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/report-poli', 'ApiReport@reportRegistPoli');
Route::get('/report-regist-month', 'ApiReport@reportRegistMonth');
Route::get('/report-regist-year', 'ApiReport@reportRegistYear');
Route::get('/report-regist-today', 'ApiReport@reportRegistToday');
Route::get('/report-stok-opname-obat', 'ApiReport@reportStokObat');
Route::get('/report-stok-opname-non-medis', 'ApiReport@reportNonMedis');

Route::get('/permintaan/pl/nomor', 'PatologiKlinisController@getNoOrder');
Route::get('/permintaan/pa/nomor', 'PatologiAnatomiController@getNoOrder');
Route::get('/permintaan/pr/nomor', 'PemeriksaanRadiologiController@getNoOrder');

Route::get('/isi-resep/nomor', 'RawatJalanController@noResep'); //isi resep
Route::get('/jadwal-kamar-operasi/jadwal', 'RawatJalanController@jadwalKamarOperasiByKamar'); //get jadwal kamar operasi berdasarkan kamar dipilih

Route::get('/monitor_antrian_farmasi_ralan', 'ApiAntrianFarmasi@ralan');
Route::get('/monitor_antrian_farmasi_ranap', 'ApiAntrianFarmasi@ranap');
Route::get('/antrian_farmasi_test', 'ApiAntrianFarmasi@get_patients');
// Api Excel
Route::get('/reportdata-stok-opname-obat', 'ApiReportData@reportStokObat');
Route::get('/reportdata-stok-opname-non-medis', 'ApiReportData@reportNonMedis');

Route::get('/monitor_antrian_poliklinik', 'ApiAntrianPoliklinik@index');

Route::get('/monitor_jadwal_operasi', 'ApiJadwalOperasi@index');

//generate qrcode image 


// ===================================Bridging E Pasien=============================
Route::post('/pasien/daftar_berobat', 'ApiBridgingEPasien@pendaftaran_berobat');
Route::get('/pasien/cek_antrian_poli/{no_rkm_medis}','ApiBridgingEPasien@cek_antrian_poli');
Route::get('/pasien/cek_antrian_resep/{no_rkm_medis}','ApiBridgingEPasien@cek_antrian_resep');
Route::get('/pasien/informasi_kamar','ApiBridgingEPasien@informasi_kamar');
Route::post('/pasien/referensi_dokter','ApiBridgingEPasien@referensi_dokter');
Route::post('/pasien/referensi_poliklinik','ApiBridgingEPasien@referensi_poliklinik');
Route::post('/pasien/ambulance','ApiBridgingEPasien@ambulance');
Route::post('/pasien/cek_login','ApiBridgingEPasien@cek_login');