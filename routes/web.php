<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminRegisteredController;
use Illuminate\Http\Request;

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
    $total_pwd = DB::table('local_profiles')->count();

    return view('pages.trackingmap.pwd-registration', [
        'total_pwd' => $total_pwd,
    ]);
})->name('pwd-registration');

Route::get('/pwd-directory', function () {
    return view('pages.trackingmap.pwd-directory');
})->name('pwd-directory');

/*
|--------------------------------------------------------------------------
| PWD DIRECTORY DATABASE SEARCH
|--------------------------------------------------------------------------
*/
Route::get('/pwd-directory/search', function (Request $request) {
    $query = trim($request->get('query', ''));

    if ($query === '') {
        return response()->json([]);
    }

    $results = DB::table('local_profiles')
        ->select(
            'id',
            'pwd_id_no',
            'photo_1x1',
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'barangay',
            'municipality',
            'province'
        )
        ->where(function ($q) use ($query) {
            $q->where('pwd_id_no', 'LIKE', "%{$query}%")
              ->orWhere('id', 'LIKE', "%{$query}%")
              ->orWhere('first_name', 'LIKE', "%{$query}%")
              ->orWhere('middle_name', 'LIKE', "%{$query}%")
              ->orWhere('last_name', 'LIKE', "%{$query}%")
              ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$query}%"])
              ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ["%{$query}%"])
              ->orWhereRaw("CONCAT(last_name, ', ', first_name) LIKE ?", ["%{$query}%"]);
        })
        ->orderBy('last_name')
        ->orderBy('first_name')
        ->limit(10)
        ->get();

    return response()->json($results);
})->name('pwd-directory.search');

Route::get('/pwd-directory/verify', function (Request $request) {
    $query = trim($request->get('query', ''));

    if ($query === '') {
        return response()->json([
            'found' => false,
            'record' => null,
        ]);
    }

    $record = DB::table('local_profiles')
        ->select(
            'id',
            'pwd_id_no',
            'photo_1x1',
            'first_name',
            'middle_name',
            'last_name',
            'suffix',
            'barangay',
            'municipality',
            'province'
        )
        ->where(function ($q) use ($query) {
            $q->where('pwd_id_no', $query)
              ->orWhere('id', $query)
              ->orWhereRaw("CONCAT(first_name, ' ', last_name) = ?", [$query])
              ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) = ?", [$query])
              ->orWhereRaw("CONCAT(last_name, ', ', first_name) = ?", [$query]);
        })
        ->first();

    if (!$record) {
        $record = DB::table('local_profiles')
            ->select(
                'id',
                'pwd_id_no',
                'photo_1x1',
                'first_name',
                'middle_name',
                'last_name',
                'suffix',
                'barangay',
                'municipality',
                'province'
            )
            ->where(function ($q) use ($query) {
                $q->where('pwd_id_no', 'LIKE', "%{$query}%")
                  ->orWhere('id', 'LIKE', "%{$query}%")
                  ->orWhere('first_name', 'LIKE', "%{$query}%")
                  ->orWhere('middle_name', 'LIKE', "%{$query}%")
                  ->orWhere('last_name', 'LIKE', "%{$query}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$query}%"])
                  ->orWhereRaw("CONCAT(first_name, ' ', middle_name, ' ', last_name) LIKE ?", ["%{$query}%"])
                  ->orWhereRaw("CONCAT(last_name, ', ', first_name) LIKE ?", ["%{$query}%"]);
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->first();
    }

    return response()->json([
        'found' => $record ? true : false,
        'record' => $record,
    ]);
})->name('pwd-directory.verify');

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