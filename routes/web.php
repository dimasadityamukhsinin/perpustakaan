<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AnggotaController as AdminAnggotaController;
use App\Http\Controllers\Admin\BukuController as AdminBukuController;
use App\Http\Controllers\Admin\KategoriBukuController as AdminKategoriBukuController;
use App\Http\Controllers\Admin\RakBukuController as AdminRakBukuController;
use App\Http\Controllers\Admin\PeminjamanController as AdminPeminjamanController;
use App\Http\Controllers\Admin\PengembalianController as AdminPengembalianController;

use App\Http\Controllers\Anggota\DashboardController as AnggotaDashboardController;
use App\Http\Controllers\Anggota\PeminjamanController as AnggotaPeminjamanController;
use App\Http\Controllers\Anggota\PengembalianController as AnggotaPengembalianController;


Route::get('/', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::resource('anggota', AdminAnggotaController::class)->parameters([
        'anggota' => 'users'
    ]);
    Route::get('anggota/{anggota}/password', [AdminAnggotaController::class, 'editPassword'])->name('anggota.editPassword');
    Route::put('anggota/{anggota}/password', [AdminAnggotaController::class, 'updatePassword'])->name('anggota.updatePassword');
    Route::resource('buku', AdminBukuController::class);
    Route::resource('kategori_buku', AdminKategoriBukuController::class);
    Route::resource('rak_buku', AdminRakBukuController::class);
    Route::resource('peminjaman', AdminPeminjamanController::class);
    Route::get('peminjaman/{id}/konfirmasi', [AdminPeminjamanController::class, 'konfirmasi'])->name('peminjaman.konfirmasi');
    Route::resource('pengembalian', AdminPengembalianController::class);
    Route::get('pengembalian/kembalikan/{id}', [AdminPengembalianController::class, 'kembalikanForm'])->name('pengembalian.kembalikan');
});


Route::prefix('anggota')->name('anggota.')->middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard');
    Route::resource('peminjaman', AnggotaPeminjamanController::class);
    Route::resource('pengembalian', AnggotaPengembalianController::class);
});
