@extends('layouts.app')

@section('content')

<section class="office-section">
    <div class="office-container">

        <div class="office-header">
            <span class="office-badge">e-PDAO Connect</span>
            <h1>Office Location</h1>
            <p>
                Persons with Disability Affairs Office (PDAO) – Manolo Fortich
            </p>
        </div>

        <div class="office-hero-card">
            <div class="office-hero-image">
                <img src="{{ asset('images/E-Connect.png') }}" alt="PDAO Office Location">
            </div>

            <div class="office-hero-content">
                <h2>PDAO Office – Manolo Fortich</h2>
                <p>
                    The <strong>Persons with Disability Affairs Office (PDAO)</strong> of Manolo Fortich
                    is located at the <strong>New Government Center</strong>,
                    Calanawan, Tankulan, Manolo Fortich, Bukidnon, 8703.
                </p>

                <div class="office-actions">
                    <a href="https://www.google.com/maps/search/New+Government+Center+Tankulan+Manolo+Fortich"
                       target="_blank"
                       class="btn-map">
                        <i class="fa-solid fa-map-location-dot"></i> Open in Google Maps
                    </a>

                    <a href="https://www.google.com/maps/dir/?api=1&destination=New+Government+Center+Tankulan+Manolo+Fortich"
                       target="_blank"
                       class="btn-direction">
                        <i class="fa-solid fa-route"></i> Get Directions
                    </a>

                    <a href="mailto:pdao@manolofortich.gov.ph" class="btn-email">
                        <i class="fa-solid fa-envelope"></i> Email Office
                    </a>
                </div>
            </div>
        </div>

        <div class="office-quick-grid">
            <div class="office-quick-card">
                <div class="quick-icon">
                    <i class="fa-solid fa-location-dot"></i>
                </div>
                <h3>Address</h3>
                <p>New Government Center, Calanawan, Tankulan, Manolo Fortich, Bukidnon, 8703</p>
            </div>

            <div class="office-quick-card">
                <div class="quick-icon">
                    <i class="fa-solid fa-road"></i>
                </div>
                <h3>Landmark</h3>
                <p>Located near the main Municipal Hall Complex and accessible via Sayre Highway.</p>
            </div>

            <div class="office-quick-card">
                <div class="quick-icon">
                    <i class="fa-solid fa-clock"></i>
                </div>
                <h3>Office Hours</h3>
                <p>Monday to Friday<br>8:00 AM – 5:00 PM</p>
            </div>

            <div class="office-quick-card">
                <div class="quick-icon">
                    <i class="fa-solid fa-envelope"></i>
                </div>
                <h3>Email</h3>
                <p>pdao@manolofortich.gov.ph</p>
            </div>
        </div>

        <div class="office-main-grid">
            <div class="office-info-card">
                <h3>Location Details</h3>

                <div class="info-list">
                    <div class="info-item">
                        <i class="fa-solid fa-building"></i>
                        <span>New Government Center (New Municipal Hall Complex)</span>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-map-pin"></i>
                        <span>Barangay Tankulan (Calanawan area)</span>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-road-circle-check"></i>
                        <span>Accessible via Sayre Highway</span>
                    </div>

                    <div class="info-item">
                        <i class="fa-solid fa-users"></i>
                        <span>Public service location for PWD-related concerns and assistance</span>
                    </div>
                </div>

                <div class="office-contact-panel">
                    <h4>Need Help?</h4>
                    <p>You may contact the office using the available channels below.</p>

                    <div class="office-contact-buttons">
                        <a href="mailto:pdao@manolofortich.gov.ph" class="contact-btn light-btn">
                            <i class="fa-solid fa-paper-plane"></i> Send Email
                        </a>

                        <a href="{{ route('inquiry') }}" class="contact-btn dark-btn">
                            <i class="fa-solid fa-circle-question"></i> Send Inquiry
                        </a>

                        <a href="{{ route('feedback') }}" class="contact-btn yellow-btn">
                            <i class="fa-solid fa-comment-dots"></i> Give Feedback
                        </a>
                    </div>
                </div>
            </div>

            <div class="office-map-card">
                <iframe
                    src="https://www.google.com/maps?q=New+Government+Center+Tankulan+Manolo+Fortich&output=embed"
                    loading="lazy"
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <div class="office-guide">
            <h3>How to Find the Office on Google Maps</h3>

            <div class="guide-steps">
                <div class="step">
                    <span>1</span>
                    <p>Open Google Maps</p>
                </div>

                <div class="step">
                    <span>2</span>
                    <p>Search “PDAO Manolo Fortich” or “New Government Center Tankulan”</p>
                </div>

                <div class="step">
                    <span>3</span>
                    <p>Drag the Street View pegman onto nearby roads</p>
                </div>

                <div class="step">
                    <span>4</span>
                    <p>Locate the Municipal Hall complex area in Tankulan</p>
                </div>
            </div>
        </div>

    </div>
</section>

@endsection