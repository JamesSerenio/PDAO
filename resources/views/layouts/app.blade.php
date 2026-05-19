<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-PDAO Connect</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- NAVBAR --}}
    @include('components.navbar')

    {{-- PAGE CONTENT --}}
    <main>
        @yield('content')
    </main>

    <!-- SEARCH MODAL -->
    <div class="search-modal" id="searchModal" aria-hidden="true">
        <div class="search-modal-overlay" id="searchOverlay"></div>

        <div class="search-modal-box" role="dialog" aria-modal="true" aria-labelledby="searchModalTitle">
            <div class="search-modal-header">
                <h3 id="searchModalTitle">Search e-PDAO Connect</h3>
                <button class="search-close-btn" id="closeSearch" type="button" aria-label="Close search">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>

            <div class="search-input-wrap">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search services, registration, concerns, directory, contact..."
                    autocomplete="off"
                >
            </div>

            <div class="search-suggestions">
                <button class="search-chip" type="button" data-url="{{ route('history') }}">History</button>
                <button class="search-chip" type="button" data-url="{{ route('pwd-registration') }}">PWD Registration</button>
                <button class="search-chip" type="button" data-url="{{ route('medical-assistance') }}">Medical Assistance</button>
                <button class="search-chip" type="button" data-url="{{ route('feedback') }}">Feedback</button>
                <button class="search-chip" type="button" data-url="{{ route('office-location') }}">Office Location</button>
            </div>

            <div class="search-results" id="searchResults">
                <a href="{{ route('history') }}" class="search-result-item">History</a>
                <a href="{{ route('vision') }}" class="search-result-item">Vision</a>
                <a href="{{ route('mission') }}" class="search-result-item">Mission</a>
                <a href="{{ route('goals') }}" class="search-result-item">Goals</a>
                <a href="{{ route('organizational-chart') }}" class="search-result-item">Organizational Chart</a>
                <a href="{{ route('report-concern') }}" class="search-result-item">Report Concern</a>
                <a href="{{ route('pwd-registration') }}" class="search-result-item">PWD Registration</a>
                <a href="{{ route('pwd-directory') }}" class="search-result-item">PWD Directory</a>
                <a href="{{ route('medical-assistance') }}" class="search-result-item">Medical Assistance</a>
                <a href="{{ route('livelihood-programs') }}" class="search-result-item">Livelihood Programs</a>
                <a href="{{ route('educational-assistance') }}" class="search-result-item">Educational Assistance</a>
                <a href="{{ route('inquiry') }}" class="search-result-item">Inquiry</a>
                <a href="{{ route('feedback') }}" class="search-result-item">Feedback</a>
                <a href="{{ route('office-location') }}" class="search-result-item">Office Location</a>
            </div>
        </div>
    </div>

    {{-- FOOTER --}}
    @include('components.footer')

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>