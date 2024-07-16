<?php

use App\Models\Kategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\HistoryPermintaanController;
use App\Http\Controllers\HistoryBulanController;
use App\Http\Controllers\RiwayatController;

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

// routing login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// routing sign out
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// akses setelah user berhasil login
// akun ada di seeder
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/kelola/create', [KelolaController::class, 'showForm'])->name('kelola.create');
    Route::resource('/kelola', KelolaController::class)->except(['create']);
    Route::resource('/permintaan', PermintaanController::class);
    Route::get('/history', [HistoryPermintaanController::class, 'index'])->name('historypermintaan');
    Route::get('/bulanan', [HistoryBulanController::class, 'index'])->name('historybulan');

    // mencoba fitur edit dan detail di kelola controller tapi tidak bisa akhirnya aku buat controller baru nanti bisa dihapus
    Route::get('/editcoba', [CobaController::class, 'index'])->name('editcoba');
    Route::get('/detailcoba', [CobaController::class, 'detail'])->name('detailcoba');
    Route::get('/riwayatlogin', [RiwayatController::class, 'index'])->name('riwayatlogin');
});
