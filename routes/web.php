<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PaymentController;
use App\Livewire\Auth\AuthLogin;
use App\Livewire\Auth\AuthRegistrasi;
use App\Livewire\Auth\AuthLupaPassword;
use App\Livewire\Auth\AuthResetPassword;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardHome;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardData;
use App\Livewire\CalonMahasiswa\CalonMahasiswaDashboardPembayaran;
// use App\Livewire\Admin\AdminDashboardHome;
// use App\Livewire\Admin\AdminDashboardCalon;

// auth routes
Route::middleware(['guestOnly'])->group(function () {
    Route::redirect('/', '/login');
    Route::get('/login', AuthLogin::class)->name('auth.login');
    Route::get('/registrasi', AuthRegistrasi::class)->name('auth.registrasi');
    Route::get('/lupa-password', AuthLupaPassword::class)->name('password.request');
    Route::get('/lupa-password/{token}', AuthResetPassword::class)->name('password.reset');
});

// calon mahasiswa routes
Route::middleware(['loggedIn:calon'])->prefix('calon')->group(function () {
    Route::get('/', CalonMahasiswaDashboardHome::class)->name('calon_mahasiswa');
    Route::get('/data', CalonMahasiswaDashboardData::class)->name('calon_mahasiswa.data');
    Route::get('/pembayaran', CalonMahasiswaDashboardPembayaran::class)->name('calon_mahasiswa.pembayaran');
    Route::get('/pembayaran/check/{id}', [PaymentController::class, 'check'])->name('calon_mahasiswa.pembayaran.check');
    Route::get('/pembayaran/verify/{id}', [PaymentController::class, 'verify'])->name('calon_mahasiswa.pembayaran.verify');
});

// admin routes
// Route::middleware(['loggedIn:admin'])->prefix('admin')->group(function () {
//     Route::get('/', AdminDashboardHome::class)->name('admin');
//     Route::get('/calon', AdminDashboardCalon::class)->name('admin.calon_mahasiswa');
// });

// logout
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});