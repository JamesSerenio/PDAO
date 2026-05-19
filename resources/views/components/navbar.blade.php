<div class="top-gov-bar">
    <div class="top-gov-container">

        <div class="gov-brand">
            <div class="gov-logo">
                <img src="{{ asset('images/Logo_PDAO.png') }}" alt="PDAO Logo">
            </div>

            <div class="gov-title-wrap">
                <span class="gov-small-title">Local Government Unit of</span>
                <h1>e-PDAO Manolo Fortich</h1>
                <p>Konektado ang Tanan, Walay Mabilin</p>
            </div>
        </div>

        <div class="gov-info-list">
            <div class="gov-info-item">
                <i class="fa-regular fa-calendar-days"></i>
                <div>
                    <strong>PH Standard Time</strong>
                    <span id="pstClock">Loading...</span>
                </div>
            </div>

            <div class="gov-info-item">
                <i class="fa-solid fa-phone-volume"></i>
                <div>
                    <strong>Contact Us</strong>
                    <span>09178120530</span>
                </div>
            </div>

            <div class="gov-info-item">
                <i class="fa-regular fa-envelope"></i>
                <div>
                    <strong>Email Us</strong>
                    <span>pdao@manolofortich.gov.ph</span>
                </div>
            </div>
        </div>

    </div>
</div>

<nav class="main-gov-nav" id="mainNavbar">
    <div class="main-gov-nav-inner">

        <button class="hamburger-btn" id="hamburgerBtn" type="button" aria-label="Open menu">
            <i class="fa-solid fa-bars"></i>
        </button>

        <div class="nav-bottom-row" id="mobileNavMenu">
            <ul class="nav-links">
                <li><a href="{{ route('home') }}">Home</a></li>

                <li class="dropdown">
                    <button class="drop-btn" type="button">
                        <span>Get To Know Us</span>
                        <i class="fa-solid fa-chevron-down nav-main-arrow"></i>
                    </button>

                    <div class="dropdown-menu">
                        <a href="{{ route('history') }}"><i class="fa-solid fa-clock-rotate-left submenu-icon"></i> History</a>
                        <a href="{{ route('vision') }}"><i class="fa-solid fa-eye submenu-icon"></i> Vision</a>
                        <a href="{{ route('mission') }}"><i class="fa-solid fa-bullseye submenu-icon"></i> Mission</a>
                        <a href="{{ route('goals') }}"><i class="fa-solid fa-flag-checkered submenu-icon"></i> Goals</a>
                        <a href="{{ route('organizational-chart') }}"><i class="fa-solid fa-sitemap submenu-icon"></i> Organizational Chart</a>
                        <a href="{{ route('set-of-officers') }}"><i class="fa-solid fa-user-tie submenu-icon"></i> Set of Officers</a>
                    </div>
                </li>

                <li class="dropdown">
                    <button class="drop-btn" type="button">
                        <span>TrackingMap</span>
                        <i class="fa-solid fa-chevron-down nav-main-arrow"></i>
                    </button>

                    <div class="dropdown-menu">
                        <a href="{{ route('report-concern') }}"><i class="fa-solid fa-triangle-exclamation submenu-icon"></i> Report Concern</a>
                        <a href="{{ route('pwd-registration') }}"><i class="fa-solid fa-id-card submenu-icon"></i> PWD Registration</a>
                        <a href="{{ route('pwd-directory') }}"><i class="fa-solid fa-address-book submenu-icon"></i> PWD Directory</a>
                    </div>
                </li>

                <li class="dropdown">
                    <button class="drop-btn" type="button">
                        <span>Services</span>
                        <i class="fa-solid fa-chevron-down nav-main-arrow"></i>
                    </button>

                    <div class="dropdown-menu">
                        <a href="{{ route('medical-assistance') }}"><i class="fa-solid fa-briefcase-medical submenu-icon"></i> Medical Assistance</a>
                        <a href="{{ route('livelihood-programs') }}"><i class="fa-solid fa-handshake-angle submenu-icon"></i> Livelihood Programs</a>
                        <a href="{{ route('educational-assistance') }}"><i class="fa-solid fa-graduation-cap submenu-icon"></i> Educational Assistance</a>
                    </div>
                </li>

                <li class="dropdown">
                    <button class="drop-btn" type="button">
                        <span>Contact Us</span>
                        <i class="fa-solid fa-chevron-down nav-main-arrow"></i>
                    </button>

                    <div class="dropdown-menu">
                        <a href="{{ route('inquiry') }}"><i class="fa-solid fa-circle-question submenu-icon"></i> Inquiry</a>
                        <a href="{{ route('feedback') }}"><i class="fa-solid fa-comment-dots submenu-icon"></i> Feedback</a>
                        <a href="{{ route('office-location') }}"><i class="fa-solid fa-location-dot submenu-icon"></i> Office Location</a>
                    </div>
                </li>

                <li><a href="{{ route('citizen-charter') }}">PDAO Citizen Charter</a></li>
            </ul>
        </div>

        <div class="nav-actions">
            <button class="search-btn" id="openSearch" type="button" aria-label="Search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>

            <button class="theme-btn" id="themeToggle" type="button" aria-label="Toggle dark mode">
                <i class="fa-solid fa-moon theme-icon"></i>
            </button>

            <a href="/login" class="login-btn">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Login</span>
            </a>
        </div>

    </div>
</nav>