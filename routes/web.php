<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffMapController;
use App\Http\Controllers\Staff\LocalProfileFormController; // ✅ ADD THIS
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminMapController;

Route::get('/', function () {
    return redirect()->route('login.form');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// ======================
// ADMIN
// ======================

Route::get('/admin', [AdminDashboardController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.dashboard');

Route::get('/admin/mapping', [AdminMapController::class, 'index'])
    ->middleware(['auth', 'role:admin'])
    ->name('admin.mapping');


// ======================
// STAFF
// ======================

Route::get('/staff', [StaffDashboardController::class, 'index'])
  ->middleware(['auth', 'role:staff'])
  ->name('staff.dashboard');

Route::get('/staff/mapping', [StaffMapController::class, 'index'])
  ->middleware(['auth', 'role:staff'])
  ->name('staff.mapping');


// ✅ ADD THIS (Local Profile Form)

Route::get('/staff/local-profile-form', [LocalProfileFormController::class, 'index'])
  ->middleware(['auth', 'role:staff'])
  ->name('staff.local_profile_form');

Route::post('/staff/local-profile-form', [LocalProfileFormController::class, 'store'])
  ->middleware(['auth', 'role:staff'])
  ->name('staff.local_profile_form.store');