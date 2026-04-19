<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuratController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// siswa
Route::get('/dashboard', function () {
    return view('siswa.dashboard', ['role' => 'siswa']);
})->name('dashboard-siswa');

Route::get('/ajukan-izin', function () {
    return view('siswa.ajukan-izin');
})->name('ajukan-izin');

Route::get('/guru-approve', function () {
    return view('siswa.guru-approve');
})->name('guru-approve');

Route::get('/status-izin', function () {
    return view('siswa.status-izin', ['izin' => false]);
})->name('status-izin');

Route::get('/status-izin/{id}', function ($id) {
    return view('siswa.status-izin', ['izin' => true]);
})->name('status-izin.detail');

Route::get('/riwayat-izin-siswa', function () {
    return view('siswa.riwayat-izin-siswa');
})->name('riwayat-izin-siswa');

// guru
Route::get('/dashboard-guru', function () {
    return view('guru.dashboard-guru');
})->name('dashboard-guru');

Route::get('/daftar-pengajuan', function () {
    return view('guru.daftar-pengajuan');
})->name('daftar-pengajuan');

Route::get('/riwayat-izin-guru', function () {
    return view('guru.riwayat-izin-guru');
})->name('riwayat-izin-guru');

Route::get('/tutorial-izin', function () {
    return view('siswa.tutorial-izin');
})->name('tutorial-izin');

Route::get('/profile-siswa', function () {
    return view('siswa.profile-siswa');
})->name('profile-siswa');

Route::get('/profile-guru', function () {
    return view('guru.profile-guru');
})->name('profile-guru');

Route::get('/kata-sandi', function () {
    return view('siswa.kata-sandi');
})->name('kata-sandi');


// PDF Surat Izin
Route::get('/surat-izin', [SuratController::class, 'preview'])->name('surat.preview');
Route::get('/surat-izin/pdf', [SuratController::class, 'pdf'])->name('surat.pdf');


Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';