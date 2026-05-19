@extends('layouts.app')

@section('content')

<!-- =========================
   HERO SECTION
========================= -->
<section class="hero" id="home">
    <div class="hero-content">

        <div class="hero-text">
            <div class="hero-badge">e-PDAO Manolo Fortich</div>

            <h1>Empowering Persons with Disabilities Through Technology</h1>

            <p>
                A digital platform that connects PWDs with essential services,
                assistance programs, and real-time tracking of support systems.
            </p>

            <div class="hero-buttons">
                <a href="#services" class="btn-primary">Explore Services</a>
                <a href="#inquiry" class="btn-secondary">Contact Us</a>
            </div>
        </div>

        <div class="hero-card">
            <h3>Quick Access</h3>
            <p>Report concerns, register as PWD, or explore available services instantly.</p>
        </div>

    </div>
</section>

<!-- =========================
   GET TO KNOW US
========================= -->
<section class="section" id="history">
    <div class="container">
        <div class="section-header">
            <span>Get To Know Us</span>
            <h2>History</h2>
            <p>Background and development of the PDAO system.</p>
        </div>
        <div class="info-card">
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
        </div>
    </div>
</section>

<section class="section" id="vision">
    <div class="container">
        <div class="section-header">
            <h2>Vision</h2>
        </div>
        <div class="info-card">
            <p>To create an inclusive digital environment for all persons with disabilities.</p>
        </div>
    </div>
</section>

<section class="section" id="mission">
    <div class="container">
        <div class="section-header">
            <h2>Mission</h2>
        </div>
        <div class="info-card">
            <p>Provide accessible and efficient services through technology.</p>
        </div>
    </div>
</section>

<section class="section" id="goals">
    <div class="container">
        <div class="section-header">
            <h2>Goals</h2>
        </div>
        <div class="info-card">
            <p>Improve accessibility, efficiency, and service delivery.</p>
        </div>
    </div>
</section>

<section class="section" id="org-chart">
    <div class="container">
        <div class="section-header">
            <h2>Organizational Structure</h2>
        </div>
        <div class="info-card">
            <p>Organizational structure of the PDAO office.</p>
        </div>
    </div>
</section>

<!-- =========================
   TRACKING MAP
========================= -->
<section class="section" id="report-concern">
    <div class="container">
        <div class="section-header">
            <span>TrackingMap</span>
            <h2>Report Concern</h2>
        </div>
        <div class="info-card">
            <p>Submit issues and concerns for immediate action.</p>
        </div>
    </div>
</section>

<section class="section" id="pwd-registration">
    <div class="container">
        <div class="section-header">
            <h2>PWD Registration</h2>
        </div>
        <div class="info-card">
            <p>Register and become part of the PWD database.</p>
        </div>
    </div>
</section>

<section class="section" id="pwd-directory">
    <div class="container">
        <div class="section-header">
            <h2>PWD Directory</h2>
        </div>
        <div class="info-card">
            <p>Browse registered PWD individuals.</p>
        </div>
    </div>
</section>

<!-- =========================
   SERVICES
========================= -->
<section class="section" id="services">
    <div class="container">
        <div class="section-header">
            <span>Services</span>
            <h2>Available Programs</h2>
        </div>

        <div class="info-grid">
            <div class="info-card" id="medical-assistance">
                <h3>Medical Assistance</h3>
                <p>Support for healthcare needs.</p>
            </div>

            <div class="info-card" id="livelihood-programs">
                <h3>Livelihood Programs</h3>
                <p>Opportunities for income and employment.</p>
            </div>

            <div class="info-card" id="educational-assistance">
                <h3>Educational Assistance</h3>
                <p>Scholarships and training programs.</p>
            </div>
        </div>
    </div>
</section>

<!-- =========================
   CONTACT
========================= -->
<section class="section" id="inquiry">
    <div class="container">
        <div class="section-header">
            <span>Contact Us</span>
            <h2>Inquiry</h2>
        </div>
        <div class="info-card">
            <p>Send us your questions.</p>
        </div>
    </div>
</section>

<section class="section" id="feedback">
    <div class="container">
        <div class="section-header">
            <h2>Feedback</h2>
        </div>
        <div class="info-card">
            <p>Share your experience with us.</p>
        </div>
    </div>
</section>

<section class="section" id="office-location">
    <div class="container">
        <div class="section-header">
            <h2>Office Location</h2>
        </div>
        <div class="info-card">
            <p>Visit our office.</p>
        </div>
    </div>
</section>

@endsection