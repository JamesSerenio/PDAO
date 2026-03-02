<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffMapController;

Route::get('/', function () {
    return redirect()->route('login.form');
});

Route::get('/login', [LoginController::class, 'showLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin', function () {
    return view('pages.dashboard_admin');
})->middleware(['auth', 'role:admin'])->name('admin.dashboard');


Route::get('/staff', [StaffDashboardController::class, 'index'])
  ->middleware(['auth', 'role:staff'])
  ->name('staff.dashboard');

Route::get('/staff/mapping', [StaffMapController::class, 'index'])
  ->middleware(['auth', 'role:staff'])
  ->name('staff.mapping');