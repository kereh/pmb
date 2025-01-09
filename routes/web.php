<?php

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ResetPasswordController;
use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\AuthLogin;
use App\Livewire\Auth\AuthRegistrasi;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardHome;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardData;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardPembayaran;

// auth routes
Route::middleware(['guestOnly'])->group(function () {
    Route::redirect('/', '/login');
    Route::get('/login', AuthLogin::class)->name('auth.login');
    Route::get('/registrasi', AuthRegistrasi::class)->name('auth.registrasi');
    Route::get('/lupa-password', [ResetPasswordController::class, 'index'])->name('auth.lupa');
    Route::get('/lupa-password/reset/{token}', [ResetPasswordController::class, 'reset'])->name('password.reset');
    Route::post('/lupa-password', [ResetPasswordController::class, 'send'])->name('auth.kirim-link'); 
    Route::post('/lupa-password/update', [ResetPasswordController::class, 'update'])->name('password.update');
});

// calon mahasiswa routes
Route::middleware(['loggedInOnly:calon_mahasiswa'])->group(function () {
    Route::prefix('calon')->group(function () {
        Route::get('/', CalonMahasiswaDashboardHome::class)->name('calon_mahasiswa');
        Route::get('/data', CalonMahasiswaDashboardData::class)->name('calon_mahasiswa.data');
        Route::get('/pembayaran', CalonMahasiswaDashboardPembayaran::class)->name('calon_mahasiswa.pembayaran');
        Route::get('/pembayaran/check/{id}', [PaymentController::class, 'check'])->name('calon_mahasiswa.pembayaran.check');
        Route::get('/pembayaran/verify/{id}', [PaymentController::class, 'verify'])->name('calon_mahasiswa.pembayaran.verify');
    });
});

// logout
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});