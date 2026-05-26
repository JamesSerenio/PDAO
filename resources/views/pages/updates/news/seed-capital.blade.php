@extends('layouts.app')

@section('content')

<section class="news-hero">

    <div class="news-overlay"></div>

    <div class="news-hero-content">

        <span class="hero-badge">e-PDAO Manolo Fortich</span>

        <h1>Seed Capital Monitoring for PWD Beneficiaries</h1>

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
            Livelihood tracking and support activities to ensure sustainability
            and progress for PWD beneficiaries.
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
                        March 11, 2026
                    </span>

                    <span>
                        <i class="fa-solid fa-folder"></i>
                        Livelihood Programs
                    </span>

                </div>


                <div class="story-main-image">
                    <img src="{{ asset('images/update/SEEDS.jpg') }}" alt="Seed Capital Program">
                </div>


                <div class="story-text">

                    <p>
                        The PDAO Office conducted monitoring visits for seed
                        capital beneficiaries to ensure proper use and to
                        provide technical assistance for sustainable growth.
                    </p>

                    <p>
                        Beneficiaries received mentoring on business
                        development, record-keeping, and market linkages.
                    </p>

                    <blockquote>
                        "Small capital, big impact — with guidance and support."
                    </blockquote>

                    <p>
                        The monitoring activity aimed to strengthen project
                        sustainability and improve beneficiaries' livelihoods.
                    </p>

                </div>


                <!-- GALLERY -->
                <div class="story-gallery">

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/SEEDS.jpg') }}" alt="Seed Capital Program">
                        <div class="story-gallery-card-body">
                            <h4>Seed Capital Program</h4>
                            <p>Monitoring support strengthened sustainable livelihood projects for PWD beneficiaries.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/SPED.jpg') }}" alt="Educational Support">
                        <div class="story-gallery-card-body">
                            <h4>Educational Assistance</h4>
                            <p>School supplies were distributed to SPED students for more inclusive education.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="Community Support">
                        <div class="story-gallery-card-body">
                            <h4>Women's Disability Day</h4>
                            <p>An empowerment celebration highlighted the achievements of women with disabilities.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="Inclusive Activities">
                        <div class="story-gallery-card-body">
                            <h4>Paragames Event</h4>
                            <p>Inclusive sports activities promoted teamwork and community participation.</p>
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

                    <a href="{{ route('news.bullying') }}">
                        Anti-Bullying Symposium
                    </a>

                </div>


                <div class="story-side-card">

                    <h3>
                        Categories
                    </h3>

                    <span>Livelihood Programs</span>
                    <span>Economic Support</span>

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection