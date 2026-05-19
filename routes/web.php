<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminRegisteredController;

Route::view('/', 'landing.index')->name('home');

// ======================
// AUTH
// ======================
Route::get('/login', [LoginController::class, 'showLogin'])->name('login.form');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ======================
// GET TO KNOW US
// ======================
Route::view('/history', 'pages.get-to-know-us.history')->name('history');
Route::view('/vision', 'pages.get-to-know-us.vision')->name('vision');
Route::view('/mission', 'pages.get-to-know-us.mission')->name('mission');
Route::view('/goals', 'pages.get-to-know-us.goals')->name('goals');
Route::view('/organizational-chart', 'pages.get-to-know-us.organizational-chart')->name('organizational-chart');
Route::view('/set-of-officers', 'pages.get-to-know-us.set-of-officers')->name('set-of-officers');

// ======================
// TRACKING MAP
// ======================
Route::view('/report-concern', 'pages.trackingmap.report-concern')->name('report-concern');
Route::view('/pwd-registration', 'pages.trackingmap.pwd-registration')->name('pwd-registration');
Route::view('/pwd-directory', 'pages.trackingmap.pwd-directory')->name('pwd-directory');

// ======================
// SERVICES
// ======================
Route::view('/medical-assistance', 'pages.services.medical-assistance')->name('medical-assistance');
Route::view('/livelihood-programs', 'pages.services.livelihood-programs')->name('livelihood-programs');
Route::view('/educational-assistance', 'pages.services.educational-assistance')->name('educational-assistance');

// ======================
// CONTACT US
// ======================
Route::view('/inquiry', 'pages.contact-us.inquiry')->name('inquiry');
Route::view('/feedback', 'pages.contact-us.feedback')->name('feedback');
Route::view('/office-location', 'pages.contact-us.office-location')->name('office-location');
Route::view('/contact', 'pages.contact-us.inquiry')->name('contact');

Route::post('/inquiry-submit', [ContactController::class, 'submitInquiry'])->name('inquiry.submit');
Route::post('/feedback-submit', [ContactController::class, 'submitFeedback'])->name('feedback.submit');

// ======================
// FOOTER LEGAL / INFO PAGES
// ======================
Route::view('/terms-of-use', 'pages.term_of_use')->name('terms');
Route::view('/privacy-policy', 'pages.privacy_policy')->name('privacy');
Route::view('/cookies-policy', 'pages.cookies')->name('cookies');
Route::view('/help', 'pages.help')->name('help');
Route::view('/faqs', 'pages.faqs')->name('faqs');

// ======================
// FOOTER EXTRA PAGES
// ======================
Route::view('/updates', 'pages.updates')->name('updates');
Route::view('/full-disclosure-policy', 'pages.full_disclosure_policy')->name('full-disclosure-policy');
Route::view('/career-oppurtunities', 'pages.career_oppurtunities')->name('career-oppurtunities');
Route::view('/news', 'pages.news')->name('news');
Route::view('/public-advisory', 'pages.public_advisory')->name('public-advisory');
Route::view('/citizen-charter', 'pages.citizen_charter')->name('citizen-charter');

// ======================
// ADMIN
// ======================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::view('/dashboard', 'pages.admin.dashboard')->name('dashboard');

    Route::view('/mapping', 'pages.admin.mapping')->name('mapping');
    Route::view('/local-profile-form', 'pages.admin.local_profile_form')->name('local_profile_form');
    Route::view('/registered', 'pages.admin.registered')->name('registered');
    Route::view('/senior-citizens', 'pages.admin.senior_citizens')->name('senior_citizens');

    Route::put('/registered/{id}', [AdminRegisteredController::class, 'update'])
        ->name('registered.update');

    Route::put('/registered/{id}/status-tags', [AdminRegisteredController::class, 'updateStatusTags'])
        ->name('registered.status-tags');

    Route::delete('/registered/{id}', [AdminRegisteredController::class, 'destroy'])
        ->name('registered.destroy');

    Route::get('/registered/{id}/pdf', [AdminRegisteredController::class, 'pdf'])
        ->name('registered.pdf');
});