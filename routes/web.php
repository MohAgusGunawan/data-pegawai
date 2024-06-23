<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
|--------------------------------------------------------------------------
| Halaman Landing Page
|--------------------------------------------------------------------------
*/
Auth::routes();

// Group middleware auth
Route::group(['middleware' => 'auth'], function() {
    /*
    |--------------------------------------------------------------------------
    | Halaman Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    /*
    |--------------------------------------------------------------------------
    | Halaman Pegawai
    |--------------------------------------------------------------------------
    */
    Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
    
    /*
    |--------------------------------------------------------------------------
    | Halaman CRUD
    |--------------------------------------------------------------------------
    */
    Route::resource('pegawai', PegawaiController::class);
    Route::resource('dashboard', DashboardController::class);
    
    /*
    |--------------------------------------------------------------------------
    | Download Laporan
    |--------------------------------------------------------------------------
    */
    Route::get('/pegawai/download/1', [PegawaiController::class, 'downloadReport'])->name('pegawai.downloadReport');
    Route::get('/dashboard/download/1', [DashboardController::class, 'downloadReport'])->name('dashboard.downloadReport');
});