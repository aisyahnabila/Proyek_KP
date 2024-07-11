<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\HistoryPermintaanController;
use App\Http\Controllers\HistoryBulanController;

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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('/kelola', KelolaController::class);
Route::resource('/permintaan', PermintaanController::class);
Route::get('/history', [HistoryPermintaanController::class, 'index'])->name('historypermintaan');
Route::get('/bulanan', [HistoryBulanController::class, 'index'])->name('historybulan');

// mencoba fitur edit dan detail di kelola controller tapi tidak bisa akhirnya aku buat controller baru nanti bisa dihapus
Route::get('/editcoba', [CobaController::class, 'index'])->name('editcoba');
Route::get('/detailcoba', [CobaController::class, 'detail'])->name('detailcoba');

