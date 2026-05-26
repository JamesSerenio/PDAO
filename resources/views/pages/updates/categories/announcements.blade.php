@extends('layouts.app')

@section('content')

<section class="category-page-section announcement-bg">

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

            <h3 class="category-subtitle">Announcements</h3>

            <p>
                Stay informed with official announcements,
                schedules, advisories, and public notices
                from the PDAO Office.
            </p>

            <a href="{{ route('updates') }}" class="story-back-btn">Back to Updates</a>
        </div>

        <div class="category-grid">

            <div class="category-card">
                <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="">

                <div class="category-card-content">
                    <h3>National Disability Rights Week</h3>

                    <p>
                        Official announcement and
                        celebration highlights.
                    </p>
                </div>
            </div>

            <div class="category-card">
                <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="">

                <div class="category-card-content">
                    <h3>Women's Disability Day</h3>

                    <p>
                        Community awareness and
                        empowerment celebration.
                    </p>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection