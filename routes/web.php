<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\C_Siswa;
use App\Http\Controllers\C_Guru;
use App\Http\Controllers\SuratController;

//siswa
Route::middleware(['auth', 'role:siswa'])->group(function () {
    Route::get('/', [C_Siswa::class, 'index']);
    Route::get('/dashboard', [C_Siswa::class, 'index'])->name('dashboard-siswa');

    Route::get('/ajukan-izin', [C_Siswa::class, 'ajukanIzin'])->name('ajukan_izin-siswa');
    Route::post('/ajukan-izin', [C_Siswa::class, 'storeSession'])->name('store_session-siswa');
    Route::post('/guru-approve', [C_Siswa::class, 'store'])->name('store-siswa');
    Route::get('/guru-approve', [C_Siswa::class, 'guruApprove'])->name('guru_approve-siswa');

    Route::get('/status-izin', [C_Siswa::class, 'statusIzin'])->name('status_izin-siswa');
    Route::post('/batal', [C_Siswa::class, 'batal'])->name('batal-siswa');

    Route::get('/riwayat-izin-siswa', [C_Siswa::class, 'riwayatIzinSiswa'])->name('riwayat-izin-siswa');

    Route::get('/tutorial-izin', function () {
        return view('siswa.tutorial-izin');
    })->name('tutorial-izin');

    Route::get('/profile-siswa', function () {
        return view('siswa.profile-siswa');
    })->name('profile-siswa');

    Route::get('/kata-sandi', function () {
        return view('siswa.kata-sandi');
    })->name('kata-sandi');
});

//guru
Route::middleware(['auth', 'role:guru umum,guru bk'])->group(function () {
    Route::get('/', [C_Guru::class, 'index']);
    Route::get('/dashboard-guru', [C_Guru::class, 'index'])->name('dashboard-guru');
    Route::get('/daftar-pengajuan', [C_Guru::class, 'daftarPengajuan'])->name('daftar-pengajuan-guru');
    Route::get('/riwayat-izin-guru', [C_Guru::class, 'riwayatIzinGuru'])->name('riwayat-izin-guru');
    Route::post('/persetujuan-guru', [C_Guru::class, 'persetujuanGuru'])->name('persetujuan-guru');

    Route::get('/profile-guru', function () {
        return view('guru.profile-guru');
    })->name('profile-guru');
});

// PDF Surat Izin
Route::get('/surat-izin', [SuratController::class, 'preview'])->name('surat.preview');
Route::get('/surat-izin/pdf', [SuratController::class, 'pdf'])->name('surat.pdf');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';

Route::get('/surat-izin/{id}', [C_Siswa::class, 'downloadPDF'])->name('surat-izin');
