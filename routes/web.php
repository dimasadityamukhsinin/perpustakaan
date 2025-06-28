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
    ])->except(['show']);
    Route::get('anggota/{anggota}/password', [AdminAnggotaController::class, 'editPassword'])->name('anggota.editPassword');
    Route::put('anggota/{anggota}/password', [AdminAnggotaController::class, 'updatePassword'])->name('anggota.updatePassword');
    Route::get('anggota/laporan', [AdminAnggotaController::class, 'laporan'])->name('anggota.laporan');
    Route::resource('buku', AdminBukuController::class)->except(['show']);
    Route::get('buku/laporan', [AdminBukuController::class, 'laporan'])->name('buku.laporan');
    Route::resource('kategori_buku', AdminKategoriBukuController::class)->except(['show']);
    Route::get('kategori_buku/laporan', [AdminKategoriBukuController::class, 'laporan'])->name('kategori_buku.laporan');
    Route::resource('rak_buku', AdminRakBukuController::class)->except(['show']);
    Route::get('rak_buku/laporan', [AdminRakBukuController::class, 'laporan'])->name('rak_buku.laporan');
    Route::resource('peminjaman', AdminPeminjamanController::class)->except(['show']);
    Route::get('peminjaman/{id}/konfirmasi', [AdminPeminjamanController::class, 'konfirmasi'])->name('peminjaman.konfirmasi');
    Route::get('peminjaman/laporan', [AdminPeminjamanController::class, 'laporan'])->name('peminjaman.laporan');
    Route::resource('pengembalian', AdminPengembalianController::class)->except(['show']);
    Route::get('pengembalian/kembalikan/{id}', [AdminPengembalianController::class, 'kembalikanForm'])->name('pengembalian.kembalikan');
    Route::get('pengembalian/laporan', [AdminPengembalianController::class, 'laporan'])->name('pengembalian.laporan');
});


Route::prefix('anggota')->name('anggota.')->middleware(['auth', 'role:anggota'])->group(function () {
    Route::get('dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard');
    Route::resource('peminjaman', AnggotaPeminjamanController::class);
    Route::resource('pengembalian', AnggotaPengembalianController::class);
});
