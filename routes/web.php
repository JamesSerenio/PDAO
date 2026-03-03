<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginController;

// Admin Controllers (stay controller-based)
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMapController;

// ✅ Keep this controller ONLY for POST submit (temporary)
use App\Http\Controllers\Staff\LocalProfileFormController;

// ✅ Livewire Staff Pages
use App\Livewire\Staff\Dashboard;
use App\Livewire\Staff\Mapping;
use App\Livewire\Staff\LocalProfileForm;

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
// ADMIN (Controllers)
// ======================
Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/admin/mapping', [AdminMapController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.mapping');


// ======================
// STAFF (Livewire Navigate)
// ======================
Route::middleware(['auth', 'role:staff'])->group(function () {

    // ✅ Livewire pages (NO FULL REFRESH, works with wire:navigate)
    Route::get('/staff', Dashboard::class)->name('staff.dashboard');
    Route::get('/staff/mapping', Mapping::class)->name('staff.mapping');
    Route::get('/staff/local-profile-form', LocalProfileForm::class)->name('staff.local_profile_form');

    // ✅ Keep POST route for saving (controller)
    Route::post('/staff/local-profile-form', [LocalProfileFormController::class, 'store'])
        ->name('staff.local_profile_form.store');

}); // ✅ IMPORTANT: close group