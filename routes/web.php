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

// Routing login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Routing sign out
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Akses setelah user berhasil login
// Akun ada di seeder
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Routes untuk Kelola
    Route::get('/kelola/index', [KelolaController::class, 'index'])->name('kelola.index');
    Route::get('/kelola/create', [KelolaController::class, 'showForm'])->name('kelola.create');
    Route::get('/barang/search', [KelolaController::class, 'search'])->name('barang.search');


    // Routes untuk CRUD form tambah barang
    Route::prefix('barang')->group(function () {
        Route::get('/', [KelolaController::class, 'index'])->name('barang.index');
        Route::get('/create', [KelolaController::class, 'create'])->name('barang.create');
        Route::post('/', [KelolaController::class, 'store'])->name('barang.store');
        Route::get('/{barang}', [KelolaController::class, 'show'])->name('barang.show');
        Route::get('/{barang}/edit', [KelolaController::class, 'edit'])->name('barang.edit');
        Route::put('/{barang}', [KelolaController::class, 'update'])->name('barang.update');
        Route::delete('/{barang}', [KelolaController::class, 'destroy'])->name('barang.destroy');

        Route::get('/tambah-jumlah/{id}', [KelolaController::class, 'showTambahJumlahForm'])->name('barang.tambahJumlahForm');
        Route::post('/tambah-jumlah/{id}', [KelolaController::class, 'tambahJumlah'])->name('barang.tambahJumlah');

    });

    // Routes untuk Permintaan
    Route::resource('/permintaan', PermintaanController::class);

    // Routes untuk History
    Route::get('/history', [HistoryPermintaanController::class, 'index'])->name('historypermintaan');
    Route::get('/bulanan', [HistoryBulanController::class, 'index'])->name('historybulan');

    // Input form tambah barang (duplikat, bisa dihapus jika tidak diperlukan)
    // Route::get('/barangs/create', [KelolaController::class, 'create'])->name('barangs.create');
    // Route::post('/barangs', [KelolaController::class, 'store'])->name('barangs.store');

    // Routes untuk CobaController (untuk fitur edit dan detail coba)
    // Route::get('/editcoba', [CobaController::class, 'index'])->name('editcoba');
    // Route::get('/detailcoba', [CobaController::class, 'detail'])->name('detailcoba');

    // Routes untuk Riwayat Login
    Route::get('/riwayatlogin', [RiwayatController::class, 'index'])->name('riwayatlogin');
});
