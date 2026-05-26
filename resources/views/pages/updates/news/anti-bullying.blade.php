@extends('layouts.app')

@section('content')

<section class="news-hero">

    <div class="news-overlay"></div>

    <div class="news-hero-content">

        <span class="hero-badge">e-PDAO Manolo Fortich</span>

        <h1>Anti-Bullying Symposium</h1>

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
            Promoting respect, inclusion, and awareness among students and
            community members in Manolo Fortich.
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
                        August 26, 2025
                    </span>

                    <span>
                        <i class="fa-solid fa-folder"></i>
                        Community Activities
                    </span>

                </div>


                <div class="story-main-image">
                    <img src="{{ asset('images/update/ANTI.jpg') }}" alt="">
                </div>


                <div class="story-text">

                    <p>
                        The Anti-Bullying Symposium brought together students,
                        educators, and advocates to discuss strategies for
                        fostering safe and respectful learning environments.
                    </p>

                    <p>
                        Sessions included talks on empathy, bystander intervention,
                        and building inclusive school cultures.
                    </p>

                    <blockquote>
                        "Respect and kindness are the foundation of a safe community."
                    </blockquote>

                    <p>
                        Schools will continue partnership programs with the PDAO
                        to sustain awareness and provide resources for students.
                    </p>

                </div>


                <!-- GALLERY -->
                <div class="story-gallery">

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/ANTI.jpg') }}" alt="Anti-Bullying Symposium">
                        <div class="story-gallery-card-body">
                            <h4>Anti-Bullying Symposium</h4>
                            <p>Students and educators joined in promoting respect and safer learning spaces.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/STRESS.jpg') }}" alt="Wellness Program">
                        <div class="story-gallery-card-body">
                            <h4>Wellness Seminar</h4>
                            <p>Programs on stress management supported PWD officers' mental health.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="Women's Disability Day">
                        <div class="story-gallery-card-body">
                            <h4>Women's Disability Day</h4>
                            <p>A community event celebrated the strength and contribution of women with disabilities.</p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="Paragames Event">
                        <div class="story-gallery-card-body">
                            <h4>Paragames Event</h4>
                            <p>Inclusive sports activities built camaraderie and visibility for PWDs.</p>
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

                    <span>Community Activities</span>
                    <span>Inclusion</span>

                </div>

            </aside>

        </div>

    </div>

</section>

@endsection