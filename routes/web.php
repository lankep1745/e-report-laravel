<?php

use App\Livewire\Admin;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;
use App\Livewire\LandingPage;
use App\Livewire\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - E-Report Civic Platform
|--------------------------------------------------------------------------
*/

// 1. Public Routes (Tamu / Pengunjung Umum)
Route::get('/', LandingPage::class)->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

// Logout Route (Auth)
Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect('/');
})->name('logout')->middleware('auth');

// 2. Warga Group Middleware ['auth', 'role:warga'] (Prefix /warga, Name warga.)
Route::middleware(['auth', 'role:warga'])
    ->prefix('warga')
    ->name('warga.')
    ->group(function () {
        Route::get('/dashboard', Warga\Dashboard::class)->name('dashboard');
        Route::get('/laporan', Warga\LaporanList::class)->name('laporan');
        Route::get('/laporan/buat', Warga\LaporanBuat::class)->name('laporan.buat');
        Route::get('/profil', Warga\Profil::class)->name('profil');
    });

// 3. Admin Group Middleware ['auth', 'role:admin'] (Prefix /admin, Name admin.)
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', Admin\Dashboard::class)->name('dashboard');
        Route::get('/laporan', Admin\LaporanIndex::class)->name('laporan');
        Route::get('/warga', Admin\WargaIndex::class)->name('warga');
    });
