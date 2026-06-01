@extends('layouts.app')

@push('styles')
    {{-- Tinuturo ang tamang file path mo ngayon --}}
    <link rel="stylesheet" href="{{ asset('css/news/news-story.css') }}">
@endpush

@section('content')

<header class="story-hero">
    <div class="story-overlay"></div>
    <div class="story-hero-content">
        <span class="story-badge">
            <i class="fa-solid fa-ribbon"></i> e-PDAO Manolo Fortich
        </span>
        <h1>National Disability Rights Week 2025</h1>

        <div class="breadcrumb">
            <a href="/">Home</a>
            <span>›</span>
            <a href="{{ route('updates') }}">Updates</a>
            <span>›</span>
            <a href="{{ route('news') }}">News</a>
            <span>›</span>
            <span class="current">Post</span>
        </div>

        <p>Celebrating inclusion, empowerment, and equal opportunity for PWDs in Manolo Fortich.</p>
    </div>
</header>

<main class="story-main-section">
    <div class="story-layout">

        <article class="story-content">

            <div class="story-meta">
                <span><i class="fa-solid fa-calendar"></i> August 01, 2025</span>
                <span><i class="fa-solid fa-folder"></i> PWD Programs</span>
            </div>

            <div class="story-main-image">
                <img src="{{ asset('images/update/NEWS.jpg') }}" alt="Disability Rights Week Main Banner">
            </div>

            <div class="story-text">
                <p>The Municipality of Manolo Fortich proudly celebrated the National Disability Rights Week 2025 through meaningful and inclusive activities dedicated to empowering Persons with Disabilities (PWDs). Ang pagdiriwang na ito ay nagsilbing malakas na paalala na ang bawat sektor ng lipunan ay may mahalagang papel sa pag-unlad ng ating komunidad, anuman ang kanilang pisikal na katayuan.</p>

                <p>The week-long event highlighted equal rights, accessibility, and active participation of PWDs within the community through sports, awareness programs, and social engagement activities. Layunin ng lokal na pamahalaan at ng e-PDAO na basagin ang mga hadlang sa diskriminasyon at mas palawakin pa ang mga oportunidad para sa pangkabuhayan, edukasyon, at proteksyon ng kanilang mga karapatan.</p>

                <blockquote>
                    “Promoting equal opportunities and strengthening inclusion for every member of the community—tungo sa isang lipunang walang naiiwan at lahat ay pinahahalagahan.”
                </blockquote>

                <p>One of the major highlights of the celebration was the Paragames competition, where participants showcased teamwork, talent, determination, and sportsmanship. Dito ay ipinamalas ng ating mga PWD athletes na ang kapansanan ay hindi hadlang upang magtagumpay at magningning sa larangan ng palakasan.</p>

                <p>The activity also strengthened collaboration among community leaders, stakeholders, organizations, and the PDAO Office to continue supporting inclusive governance and accessible public services. Sa pamamagitan ng pagkakaisang ito, mas sinisiguro natin na ang mga programa sa Manolo Fortich ay mananatiling "PWD-friendly" at bukas para sa lahat.</p>
            </div>

            <section class="story-gallery">

                <div class="story-gallery-card">
                    <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="Paragames Event">
                    <div class="story-gallery-card-body">
                        <h4>Paragames Highlight</h4>
                        <p><strong>Explanation:</strong> Inclusive sports and competitions celebrated the core strengths of PWD participants. Sa pamamagitan ng larong ito, naipakita ang matatag na determinasyon at sportsmanship ng mga atleta.</p>
                    </div>
                </div>

                <div class="story-gallery-card">
                    <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="Community Celebration">
                    <div class="story-gallery-card-body">
                        <h4>Women's Disability Day</h4>
                        <p><strong>Explanation:</strong> An empowerment program focused on providing strong community support for women with disabilities. Binigyang-diin sa seminar na ito ang karapatan ng mga kababaihan laban sa diskriminasyon.</p>
                    </div>
                </div>

                <div class="story-gallery-card">
                    <img src="{{ asset('images/update/ANTI.jpg') }}" alt="Anti-Bullying">
                    <div class="story-gallery-card-body">
                        <h4>Anti-Bullying Symposium</h4>
                        <p><strong>Explanation:</strong> Dynamic educational discussions and activities promoted mutual respect and safe environments for students. Tinalakay dito ang kahalagahan ng paggalang sa bawat isa.</p>
                    </div>
                </div>

                <div class="story-gallery-card">
                    <img src="{{ asset('images/update/STRESS.jpg') }}" alt="Wellness Activities">
                    <div class="story-gallery-card-body">
                        <h4>Wellness Support</h4>
                        <p><strong>Explanation:</strong> Tailored holistic programs encouraged mental health awareness, emotional resilience, and overall well-being ng ating mga PWD members.</p>
                    </div>
                </div>

            </section>

            <div class="story-back-wrap">
                <a href="{{ url()->previous() }}" class="story-back-btn">
                    <i class="fa-solid fa-arrow-left"></i> Back to News
                </a>
            </div>

        </article>

        <aside class="story-sidebar">

            <div class="story-side-card">
                <h3>Related Stories</h3>
                <a href="{{ route('news.school') }}">School Supplies Distribution</a>
                <a href="{{ route('news.bullying') }}">Anti-Bullying Symposium</a>
                <a href="{{ route('news.seed') }}">SEED Capital Monitoring</a>
            </div>

            <div class="story-side-card">
                <h3>Categories</h3>
                <span>PWD Programs</span>
                <span>Community Activities</span>
                <span>Awareness Campaign</span>
            </div>

        </aside>

    </div>
</main>

@endsection