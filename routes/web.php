<?php

use App\Http\Controllers\ProfileController;
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
});

Route::get('/status-izin/{id}', function ($id) {
    return view('siswa.status-izin', ['izin' => true]);
});

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



Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';