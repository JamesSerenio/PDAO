@extends('layouts.app')

@section('content')

<section class="category-page-section activities-bg">

    <div class="category-overlay"></div>

    <div class="container">

        <div class="category-header">
            <span class="hero-badge">ePDAO Manolo Fortich</span>

            <h2 class="main-title">Updates &amp; Activities</h2>

            <div class="breadcrumb">
                <a href="/">Home</a>
                <span>›</span>
                <a href="{{ route('updates') }}">Updates</a>
                <span>›</span>
                <a href="{{ route('news') }}">News</a>
                <span>›</span>
                <span>Post</span>
            </div>

            <h3 class="category-subtitle">Activities</h3>

            <p>
                Browse seminars, awareness programs,
                community activities, and PDAO events.
            </p>

            <a href="{{ route('updates') }}" class="story-back-btn">Back to Updates</a>
        </div>

        <div class="category-grid">

            <div class="category-card">
                <img src="{{ asset('images/update/ANTI.jpg') }}" alt="">

                <div class="category-card-content">
                    <h3>Anti-Bullying Symposium</h3>

                    <p>
                        Awareness activity promoting
                        inclusion and respect.
                    </p>
                </div>
            </div>

            <div class="category-card">
                <img src="{{ asset('images/update/STRESS.jpg') }}" alt="">

                <div class="category-card-content">
                    <h3>Stress Management Seminar</h3>

                    <p>
                        Wellness and consultative
                        activities for PWD officers.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection