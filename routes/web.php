<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;

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
// Route::get('/', function () {
//     return view('auth.login');
// });
// Route::post('/autentikasi', [LoginController::class, 'autentikasi']);
Auth::routes();
/*
|--------------------------------------------------------------------------
| Halaman Dashboard
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

/*
|--------------------------------------------------------------------------
| Halaman Pegawai
|--------------------------------------------------------------------------
*/
Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai');

/*
|--------------------------------------------------------------------------
| Halaman CRUD
|--------------------------------------------------------------------------
*/
Route::resource('pegawais', PegawaiController::class);