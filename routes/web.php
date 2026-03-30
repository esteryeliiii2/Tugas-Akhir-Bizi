<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/ajukan-izin', function () {
    return view('ajukan-izin');
})->name('ajukan-izin');

Route::get('/guru-approve', function () {
    return view('guru-approve');
})->name('guru-approve');

Route::get('/status-izin', function () {
    return view('status-izin');
})->name('status-izin');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';