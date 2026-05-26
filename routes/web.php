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

/*
|--------------------------------------------------------------------------
| Get To Know Us
|--------------------------------------------------------------------------
*/
Route::get('/history', function () {
    return view('pages.get-to-know-us.history');
})->name('history');

Route::get('/vision', function () {
    return view('pages.get-to-know-us.vision');
})->name('vision');

Route::get('/mission', function () {
    return view('pages.get-to-know-us.mission');
})->name('mission');

Route::get('/goals', function () {
    return view('pages.get-to-know-us.goals');
})->name('goals');

Route::get('/organizational-chart', function () {
    return view('pages.get-to-know-us.organizational-chart');
})->name('organizational-chart');

/*
|--------------------------------------------------------------------------
| TrackingMap
|--------------------------------------------------------------------------
*/
Route::get('/report-concern', function () {
    return view('pages.trackingmap.report-concern');
})->name('report-concern');

Route::get('/pwd-registration', function () {
    return view('pages.trackingmap.pwd-registration');
})->name('pwd-registration');

Route::get('/pwd-directory', function () {
    return view('pages.trackingmap.pwd-directory');
})->name('pwd-directory');

/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
*/
Route::get('/medical-assistance', function () {
    return view('pages.services.medical-assistance');
})->name('medical-assistance');

Route::get('/livelihood-programs', function () {
    return view('pages.services.livelihood-programs');
})->name('livelihood-programs');

Route::get('/educational-assistance', function () {
    return view('pages.services.educational-assistance');
})->name('educational-assistance');

/*
|--------------------------------------------------------------------------
| Contact Us
|--------------------------------------------------------------------------
*/
Route::get('/inquiry', function () {
    return view('pages.contact-us.inquiry');
})->name('inquiry');

Route::get('/feedback', function () {
    return view('pages.contact-us.feedback');
})->name('feedback');

Route::get('/office-location', function () {
    return view('pages.contact-us.office-location');
})->name('office-location');

Route::get('/contact', function () {
    return view('pages.contact-us.inquiry');
})->name('contact');

Route::post('/inquiry-submit', [ContactController::class, 'submitInquiry'])->name('inquiry.submit');
Route::post('/feedback-submit', [ContactController::class, 'submitFeedback'])->name('feedback.submit');

/*
|--------------------------------------------------------------------------
| Footer Legal / Info Pages
|--------------------------------------------------------------------------
*/
Route::view('/terms-of-use', 'pages.term_of_use')->name('terms');
Route::view('/privacy-policy', 'pages.privacy_policy')->name('privacy');
Route::view('/cookies-policy', 'pages.cookies')->name('cookies');
Route::view('/help', 'pages.help')->name('help');
Route::view('/faqs', 'pages.faqs')->name('faqs');

/*
|--------------------------------------------------------------------------
| Footer Extra Pages
|--------------------------------------------------------------------------
*/
Route::get('/updates', function () {
    return view('pages.updates.updates');
})->name('updates');

/* ========================================
   UPDATE CATEGORIES
======================================== */

Route::get('/updates/programs', function () {
    return view('pages.updates.categories.programs');
})->name('updates.programs');

Route::get('/updates/announcements', function () {
    return view('pages.updates.categories.announcements');
})->name('updates.announcements');

Route::get('/updates/activities', function () {
    return view('pages.updates.categories.activities');
})->name('updates.activities');

Route::get('/full-disclosure-policy', function () {
    return view('pages.full_disclosure_policy');
})->name('full-disclosure-policy');

Route::get('/career-oppurtunities', function () {
    return view('pages.career_oppurtunities');
})->name('career-oppurtunities');

Route::get('/news', function () {
    return view('pages.updates.news');
})->name('news');

/* ========================================
   NEWS WHOLE STORY PAGES
======================================== */

Route::get('/news/disability-rights-week', function () {
    return view('pages.updates.news.disability-rights-week');
})->name('news.disability');

Route::get('/news/school-supplies', function () {
    return view('pages.updates.news.school-supplies');
})->name('news.school');

Route::get('/news/anti-bullying', function () {
    return view('pages.updates.news.anti-bullying');
})->name('news.bullying');

Route::get('/news/hearing-aid', function () {
    return view('pages.updates.news.hearing-aid');
})->name('news.hearing');

Route::get('/news/seed-capital', function () {
    return view('pages.updates.news.seed-capital');
})->name('news.seed');

Route::get('/public-advisory', function () {
    return view('pages.public_advisory');
})->name('public-advisory');

Route::get('/citizen-charter', function () {
    return view('pages.citizen_charter');
})->name('citizen-charter');

Route::get('/set-of-officers', function () {
    return view('pages.get-to-know-us.set-of-officers');
})->name('set-of-officers');