<?php

use App\Http\Controllers\LogoutController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Livewire\Auth\AuthLogin;
use App\Livewire\Auth\AuthRegistrasi;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardHome;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardData;

// auth routes
Route::middleware(['guestOnly'])->group(function () {
    Route::redirect('/', '/login');
    Route::get('/login', AuthLogin::class)->name('auth.login');
    Route::get('/registrasi', AuthRegistrasi::class)->name('auth.registrasi');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

// calon mahasiswa routes
Route::middleware(['loggedInOnly:calon_mahasiswa'])->group(function () {
    Route::prefix('calon')->group(function () {
        Route::get('/', CalonMahasiswaDashboardHome::class)->name('calon_mahasiswa');
        Route::get('/data', CalonMahasiswaDashboardData::class)->name('calon_mahasiswa.data');
    });
});

// admin routes
Route::middleware(['loggedInOnly:admin'])->group(function () {
    Route::get('/admin', fn () => dd('admin'))->name('admin');
});