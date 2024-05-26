<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\KoperasiController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UsersController;

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

Route::get('/', [HomeController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| Hak akses untuk admin (Guru dan Siswa)
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => 'admin'], function() {
    // Guru
    Route::get('/guru', [GuruController::class, 'index'])->name('guru');

    Route::get('/guru/detail/{id_guru}', [GuruController::class, 'detail']);

    Route::get('/guru/add', [GuruController::class, 'add']);
    Route::post('/guru/insert', [GuruController::class, 'insert']);

    Route::get('/guru/edit/{id_guru}', [GuruController::class, 'edit']);
    Route::post('/guru/update/{id_guru}', [GuruController::class, 'update']);

    Route::get('/guru/delete/{id_guru}', [GuruController::class, 'delete']);

    // Siswa
    Route::get('/siswa', [SiswaController::class, 'index']);

    // Users
    Route::get('/users', [UsersController::class, 'index'])->name('users');

    // Koperasi
    Route::get('/koperasi', [KoperasiController::class, 'index']);

    Route::get('/koperasi/print', [KoperasiController::class, 'print']);
    Route::get('/koperasi/printpdf', [KoperasiController::class, 'printpdf']);

    // Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
});

Route::group(['middleware' => 'users'], function() {
    // Users
    Route::get('/users', [UsersController::class, 'index'])->name('users');

    // Koperasi
    Route::get('/koperasi', [KoperasiController::class, 'index']);
    
    Route::get('/koperasi/print', [KoperasiController::class, 'print']);
    Route::get('/koperasi/printpdf', [KoperasiController::class, 'printpdf']);
});

Route::group(['middleware' => 'pelanggan'], function() {
    // Pelanggan
    Route::get('/pelanggan', [PelangganController::class, 'index'])->name('pelanggan');
});