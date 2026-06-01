@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trackingmap/pwd-registration.css') }}">
@endpush

@section('content')

<section class="summary-hero">
    <div class="summary-overlay"></div>
    <div class="container">
        <div class="summary-hero-content">
            <span class="summary-badge">
                e-PDAO Manolo Fortich
            </span>
            <h1>
                PWD REGISTRATION <br>
                OVERALL SUMMARY
            </h1>
            <p>
                Consolidated registration records, disability categories,
                barangay coordination, and organizational structure of
                Persons with Disabilities in the Municipality of
                Manolo Fortich.
            </p>
        </div>
    </div>
</section>

<section class="summary-dashboard">
    <div class="container">

        <div class="stats-grid">
            <div class="stat-card highlight-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>
                <h2 id="realtime-pwd-counter">{{ number_format($total_pwd ?? 0) }}</h2>
                <p>Registered PWD Members</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-building"></i>
                </div>
                <h2>{{ number_format($total_barangays ?? 0) }}</h2>
                <p>Covered Barangays</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>
                <h2>2022</h2>
                <p>Start of Consolidation</p>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <i class="fa-solid fa-id-card"></i>
                </div>
                <h2>5 Years</h2>
                <p>ID Renewal Validity</p>
            </div>
        </div>

        <div class="summary-layout">

            <div class="summary-main">

                <div class="dashboard-card">
                    <div class="card-title">
                        <div class="title-icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>
                        <h2>Registration Overview</h2>
                    </div>
                    <p>
                        As of today, the Person with Disability Affairs Office (PDAO) of the Municipality of
                        Manolo Fortich has officially recorded
                        {{ number_format($total_pwd ?? 0) }}
                        registered constituents across
                        {{ number_format($total_barangays ?? 0) }}
                        barangays.
                    </p>
                    <p>
                        Registration and consolidation of records officially started in January 2022,
                        and all registered members are currently enrolled in the Department of Health (DOH) system.
                    </p>
                </div>

                <div class="dashboard-card">
                    <div class="card-title">
                        <div class="title-icon">
                            <i class="fa-solid fa-wheelchair"></i>
                        </div>
                        <h2>Disability Categories</h2>
                    </div>
                    <div class="disability-grid">
                        <div class="disability-item">Deaf or Hard of Hearing</div>
                        <div class="disability-item">Intellectual Disability</div>
                        <div class="disability-item">Learning Disability</div>
                        <div class="disability-item">Mental Disability</div>
                        <div class="disability-item">Physical Disability</div>
                        <div class="disability-item">Psychosocial Disability</div>
                        <div class="disability-item">Speech & Language Impairment</div>
                        <div class="disability-item">Visual Disability</div>
                        <div class="disability-item">Cancer-related Disability</div>
                        <div class="disability-item">Rare Disease Cases</div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-title">
                        <div class="title-icon">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>
                        <h2>Registration Requirements</h2>
                    </div>
                    <div class="requirements-grid">
                        <div class="requirement-box">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Barangay Certification</span>
                        </div>
                        <div class="requirement-box">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Birth Certificate</span>
                        </div>
                        <div class="requirement-box">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Three (3) 1x1 ID Pictures</span>
                        </div>
                        <div class="requirement-box">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Certificate of Disability</span>
                        </div>
                    </div>
                </div>

                <div class="dashboard-card">
                    <div class="card-title">
                        <div class="title-icon">
                            <i class="fa-solid fa-people-group"></i>
                        </div>
                        <h2>Federation & Coordination</h2>
                    </div>
                    <p>
                        The PDAO coordinates with Federation of Differently-Abled Persons Association Presidents
                        and Parent Mobilization Action Group Presidents across the barangays of Manolo Fortich to
                        strengthen monitoring, implementation, and delivery of inclusive programs and services.
                    </p>
                </div>
            </div>

            <aside class="summary-sidebar">

                <div class="sidebar-card doh-card">
                    <div class="sidebar-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <h3>DOH Registration Status</h3>
                    <p>
                        All registered members are officially enrolled in the Department of Health (DOH) system for
                        proper verification and monitoring.
                    </p>
                </div>

                <div class="sidebar-card renewal-card">
                    <div class="sidebar-icon yellow-icon">
                        <i class="fa-solid fa-id-card"></i>
                    </div>
                    <h3>PWD ID Renewal</h3>
                    <p>
                        PWD Identification Cards are renewable every five (5) years to maintain updated records
                        and continued access to benefits and services.
                    </p>
                </div>

                <div class="sidebar-card classification-card">
                    <div class="sidebar-icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <h3>Disability Classification</h3>

                    <div class="classification-box apparent">
                        <strong>Apparent Disability</strong>
                        <p>Easily visible physical conditions.</p>
                    </div>

                    <div class="classification-box non-apparent">
                        <strong>Non-Apparent Disability</strong>
                        <p>Requires certification from a Rural Health Doctor.</p>
                    </div>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection