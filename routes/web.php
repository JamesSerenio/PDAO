<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminRegisteredController;

// Livewire Admin Pages
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Mapping as AdminMapping;

Route::get('/', function () {
    return redirect()->route('login.form');
});

// ======================
// AUTH
// ======================
Route::get('/login', [LoginController::class, 'showLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ======================
// ADMIN
// ======================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Livewire dashboard
    Route::get('/dashboard', AdminDashboard::class)->name('dashboard');

    // Wrapper pages
    Route::view('/mapping', 'pages.admin.mapping')->name('mapping');
    Route::view('/local-profile-form', 'pages.admin.local_profile_form')->name('local_profile_form');
    Route::view('/registered', 'pages.admin.registered')->name('registered');
    Route::view('/senior-citizens', 'pages.admin.senior_citizens')->name('senior_citizens');

    // Registered actions
    Route::put('/registered/{id}', [AdminRegisteredController::class, 'update'])
        ->name('registered.update');

    Route::get('/registered/{id}/pdf', [AdminRegisteredController::class, 'pdf'])
        ->name('registered.pdf');
});