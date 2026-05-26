@extends('layouts.app')

@section('content')

<section class="news-hero">

    <div class="news-overlay"></div>

    <div class="news-hero-content">

        <span class="hero-badge">e-PDAO Manolo Fortich</span>

        <h1>Hearing Aid Assistance Program for PWD Beneficiaries</h1>

        <div class="breadcrumb">
            <a href="/">Home</a>
            <span>›</span>
            <a href="{{ route('updates') }}">Updates</a>
            <span>›</span>
            <a href="{{ route('news') }}">News</a>
            <span>›</span>
            <span>Post</span>
        </div>

        <p>
            Providing hearing aid support to qualified beneficiaries to improve
            communication and access.
        </p>

    </div>

</section>


<section class="story-main-section">

    <div class="container">

        <div class="story-layout">

            <!-- ARTICLE -->
            <article class="story-content">

                <div class="story-meta">

                    <span>
                        <i class="fa-solid fa-calendar"></i>
                        September 05, 2025
                    </span>

                    <span>
                        <i class="fa-solid fa-folder"></i>
                        Medical Assistance
                    </span>

                </div>


                <div class="story-main-image">
                    <img src="{{ asset('images/update/AID.jpg') }}" alt="">
                </div>


                <div class="story-text">

                    <p>
                        The Hearing Aid Assistance Program provided devices
                        and support services to PWD beneficiaries to enhance
                        their daily communication and participation.
                    </p>

                    <p>
                        Medical screenings and fittings were conducted by
                        trained health professionals to ensure successful
                        outcomes for recipients.
                    </p>

                    <blockquote>
                        "Accessibility to health services enables fuller participation."
                    </blockquote>

                    <p>
                        Follow-up services and maintenance support were arranged
                        to ensure long-term benefit for recipients.
                    </p>

                </div>


                <!-- GALLERY -->
                <div class="story-gallery">

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/AID.jpg') }}" alt="Hearing Aid Assistance">
                        <div class="story-gallery-card-body">
                            <h4>Hearing Aid Program</h4>
                            <p>Providing hearing devices and support improved daily communication for beneficiaries.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="Community Health Support">
                        <div class="story-gallery-card-body">
                            <h4>Women's Disability Day</h4>
                            <p>A community celebration that highlighted empowerment and inclusion for women with disabilities.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="Inclusive Events">
                        <div class="story-gallery-card-body">
                            <h4>Paragames Event</h4>
                            <p>Inclusive sports activities fostered teamwork and community participation.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/STRESS.jpg') }}" alt="Wellness Program">
                        <div class="story-gallery-card-body">
                            <h4>Wellness Seminar</h4>
                            <p>Wellness activities supported mental health and resilience among participants.</p>
                        </div>
                    </div>

                </div>


                <!-- BACK BUTTON -->
                <div class="story-back-wrap">

                    <a href="{{ url()->previous() }}"
                       class="story-back-btn">

                        <i class="fa-solid fa-arrow-left"></i>
                        Back to News

                    </a>

                </div>

            </article>



            <!-- SIDEBAR -->
            <aside class="story-sidebar">

                <div class="story-side-card">

                    <h3>
                        Related Stories
                    </h3>

                    <a href="{{ route('news.school') }}">
                        School Supplies Distribution
                    </a>

                    <a href="{{ route('news.disability') }}">
                        National Disability Rights Week
                    </a>

                    <a href="{{ route('news.seed') }}">
                        SEED Capital Monitoring
                    </a>

                </div>


                <div class="story-side-card">

                    <h3>
                        Categories
                    </h3>

                    <span>Medical Assistance</span>
                    <span>Health Programs</span>

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection