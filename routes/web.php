<?php

use App\Http\Controllers\AbsenController;
use App\Http\Controllers\JabatanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\HutangController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\RembesController;
use App\Http\Controllers\PengajuanPenggajianController;
use App\Http\Controllers\DataPenggajianController;
use App\Http\Controllers\PresensiController;
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


Route::get('/', [LoginController::class, 'index']);
Route::post('/', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);


// Route::get('/insert', function () {
//     echo Hash::make('kelfin123');
// });

Route::group(['middleware' => 'auth'], function ($route) {
    $route->get('/dashboard', [CardController::class, 'index']);
    $route->get('/akun', [AkunController::class, 'index']);

    $route->get('/delete/{id}', [AkunController::class, 'delete'])->name('akun.delete');
    $route->post('/akun', [AkunController::class, 'store']);
    $route->post('/akun/update', [AkunController::class, 'update'])->name('akun.update');
    $route->get('/getAkun/{id}', [AkunController::class, 'getAkun'])->name('akun.getAkun');

    //Route Karyawan


    $route->get('/karyawan', [KaryawanController::class, 'index']);
    $route->post('/karyawan', [KaryawanController::class, 'store']);
    $route->post('/karyawan/update', [KaryawanController::class, 'update'])->name('karyawan.update');
    $route->get('/getKaryawan/{id}', [KaryawanController::class, 'getKaryawan'])->name('karyawan.getKaryawan');
    $route->get('/karyawan/{id}/delete', [KaryawanController::class, 'delete_karyawan'])->name('karyawan.delete');



    //jabatan
    $route->get('/jabatan', [JabatanController::class, 'index'])->name('jabatan.index');
    $route->post('/jabatan-create', [JabatanController::class, 'store'])->name('jabatan.create');
    $route->get('/getJabatan/{id}', [JabatanController::class, 'getJabatan'])->name('jabatan.getJabatan');
    $route->post('/jabatan-update/{id}', [JabatanController::class, 'update'])->name('jabatan.update');
    $route->get('/jabatan/{id}/delete', [JabatanController::class, 'delete_jabatan'])->name('jabatan.delete');


    //Hutang
    $route->get('/hutang', [HutangController::class, 'index'])->name('hutang.index');
    $route->post('/hutang-create', [HutangController::class, 'store'])->name('hutang.create');
    $route->get('/getHutang/{id}', [HutangController::class, 'getHutang'])->name('hutang.getHutang');
    $route->post('/hutang/update/{id}', [HutangController::class, 'update'])->name('hutang.update');
    $route->get('/hutang/{id}/delete', [HutangController::class, 'delete_hutang'])->name('hutang.delete');


    //Transport
    $route->get('/transport', [TransportController::class, 'index'])->name('transport.index');
    $route->post('/transport-create', [TransportController::class, 'store'])->name('transport.create');
    $route->get('/getTransport/{id}', [TransportController::class, 'getTransport'])->name('transport.getTransport');
    $route->post('/transport/update/{id}', [TransportController::class, 'update'])->name('transport.update');
    $route->get('/transport/{id}/delete', [TransportController::class, 'delete_transport'])->name('transport.delete');



    //Rembes
    $route->get('/rembes', [RembesController::class, 'index'])->name('rembes.index');
    $route->post('/rembes-create', [RembesController::class, 'store'])->name('rembes.create');
    $route->get('/getRembes/{id}', [RembesController::class, 'getRembes'])->name('rembes.getRembes');
    $route->post('/rembes/update/{id}', [RembesController::class, 'update'])->name('rembes.update');
    $route->get('/rembes/{id}/delete', [RembesController::class, 'delete_rembes'])->name('rembes.delete');



    // Route Presensi
    Route::get('/absen', [AbsenController::class, 'index'])->name('absen');
    Route::post('/absen', [AbsenController::class, 'store']);
    Route::post('/absen-pulang', [AbsenController::class, 'pulang']);
    Route::post('/reset-absen', [AbsenController::class, 'reset']);

    // Route Pengajuan Penggajian
    Route::get('/pengajuan-penggajian', [PengajuanPenggajianController::class, 'index']);
    Route::post('/pengajuan-penggajian', [PengajuanPenggajianController::class, 'store']);

    Route::get('/data-penggajian', [DataPenggajianController::class, 'index']);
    Route::get('/detail-penggajian/{id}', [DataPenggajianController::class, 'show']);
    Route::get('/detail-penggajian/{id}/approve', [DataPenggajianController::class, 'approve']);

    // Route /presensi
    Route::get('/presensi', [PresensiController::class, 'index']);
    Route::get('/presensi/{id}', [PresensiController::class, 'show']);
    Route::get('/presensi/{id}/lokasi', [PresensiController::class, 'lokasi']);
});