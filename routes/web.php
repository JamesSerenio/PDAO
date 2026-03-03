<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

// ✅ Livewire Admin Pages
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Mapping as AdminMapping;

// ✅ Livewire Staff Pages
use App\Livewire\Staff\Dashboard as StaffDashboard;
use App\Livewire\Staff\Mapping as StaffMapping;
use App\Livewire\Staff\LocalProfileForm as StaffLocalProfileForm;

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
// ADMIN (Livewire)
// ======================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', AdminDashboard::class)
        ->name('admin.dashboard');

    Route::get('/admin/mapping', AdminMapping::class)
        ->name('admin.mapping');

});


// ======================
// STAFF (Livewire)
// ======================
Route::middleware(['auth', 'role:staff'])->group(function () {

    Route::get('/staff', StaffDashboard::class)
        ->name('staff.dashboard');

    Route::get('/staff/mapping', StaffMapping::class)
        ->name('staff.mapping');

    Route::get('/staff/local-profile-form', StaffLocalProfileForm::class)
        ->name('staff.local_profile_form');

});