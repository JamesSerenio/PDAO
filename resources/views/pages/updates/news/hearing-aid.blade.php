@extends('layouts.app')

@section('content')

<section class="news-hero">

    <div class="news-overlay"></div>

    <div class="news-hero-content">

        <span class="hero-badge">e-PDAO Manolo Fortich</span>

        <h1>National Disability Rights Week 2025</h1>

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
            Celebrating inclusion, empowerment, and equal opportunity for PWDs
            in Manolo Fortich.
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
                        August 01, 2025
                    </span>

                    <span>
                        <i class="fa-solid fa-folder"></i>
                        PWD Programs
                    </span>

                </div>


                <div class="story-main-image">
                    <img src="{{ asset('images/update/news1.jpg') }}" alt="">
                </div>


                <div class="story-text">

                    <p>
                        The Municipality of Manolo Fortich proudly
                        celebrated the National Disability Rights Week
                        2025 through meaningful and inclusive activities
                        dedicated to empowering Persons with Disabilities.
                    </p>

                    <p>
                        The event highlighted equal rights,
                        accessibility, and active participation
                        of PWDs within the community through
                        sports, awareness programs, and social
                        engagement activities.
                    </p>

                    <blockquote>
                        “Promoting equal opportunities and
                        strengthening inclusion for every
                        member of the community.”
                    </blockquote>

                    <p>
                        One of the major highlights of the celebration
                        was the Paragames competition where participants
                        showcased teamwork, talent, determination,
                        and sportsmanship.
                    </p>

                    <p>
                        The activity also strengthened collaboration
                        among community leaders, stakeholders,
                        organizations, and the PDAO Office to
                        continue supporting inclusive governance
                        and accessible public services.
                    </p>

                </div>


                <!-- GALLERY -->
                <div class="story-gallery">

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="Paragames Event">
                        <div class="story-gallery-card-body">
                            <h4>Paragames Highlight</h4>
                            <p>Inclusive sports and competitions celebrated the strengths of PWD participants.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="Community Celebration">
                        <div class="story-gallery-card-body">
                            <h4>Women's Disability Day</h4>
                            <p>An awareness program focused on empowerment and community support for women.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/ANTI.jpg') }}" alt="Anti-Bullying">
                        <div class="story-gallery-card-body">
                            <h4>Anti-Bullying Symposium</h4>
                            <p>Discussions and activities promoted respect and safe environments for students.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/STRESS.jpg') }}" alt="Wellness Activities">
                        <div class="story-gallery-card-body">
                            <h4>Wellness Support</h4>
                            <p>Wellness programs encouraged mental health and resilience across the community.</p>
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

                    <a href="{{ route('news.bullying') }}">
                        Anti-Bullying Symposium
                    </a>

                    <a href="{{ route('news.seed') }}">
                        SEED Capital Monitoring
                    </a>

                </div>


                <div class="story-side-card">

                    <h3>
                        Categories
                    </h3>

                    <span>PWD Programs</span>
                    <span>Community Activities</span>
                    <span>Awareness Campaign</span>

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection