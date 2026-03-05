<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StaffRegisteredController;

// ✅ Livewire Admin Pages
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\Mapping as AdminMapping;

// ✅ Livewire Staff Pages
use App\Livewire\Staff\Dashboard as StaffDashboard;

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
// ADMIN (Livewire Direct OK)
// ======================
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin', AdminDashboard::class)
        ->name('admin.dashboard');

    Route::get('/admin/mapping', AdminMapping::class)
        ->name('admin.mapping');

});


// ======================
// STAFF (Dashboard Livewire, pages wrapper for others)
// ======================
Route::middleware(['auth', 'role:staff'])->group(function () {

    // ✅ pwede Livewire direct (simple page)
    Route::get('/staff', StaffDashboard::class)
        ->name('staff.dashboard');

    // ✅ wrapper page (para stable CSS + scripts)
    Route::view('/staff/mapping', 'pages.staff.mapping')
        ->name('staff.mapping');

    // ✅ wrapper page (para stable CSS + scripts)
    Route::view('/staff/local-profile-form', 'pages.staff.local_profile_form')
        ->name('staff.local_profile_form');

    // ✅ Registered Person (registered.blade.php)
    Route::view('/staff/registered', 'pages.staff.registered')
        ->name('staff.registered');

    // ✅ SAVE EDIT (for Save Changes button)
    Route::put('/staff/registered/{id}', [StaffRegisteredController::class, 'update'])
        ->name('staff.registered.update');

});