@extends('layouts.app')

@push('styles')
    {{-- Nakakonekta sa pinal at smooth na global news-story.css --}}
    <link rel="stylesheet" href="{{ asset('css/news/news-story.css') }}">
@endpush

@section('content')

<header class="story-hero">
    <div class="story-overlay"></div>
    <div class="story-hero-content">
        <span class="story-badge">
            <i class="fa-solid fa-chart-line"></i> e-PDAO Manolo Fortich
        </span>
        <h1>Seed Capital Monitoring for PWD Beneficiaries</h1>

        <div class="breadcrumb">
            <a href="/">Home</a>
            <span>›</span>
            <a href="{{ route('updates') }}">Updates</a>
            <span>›</span>
            <a href="{{ route('news') }}">News</a>
            <span>›</span>
            <span class="current">Post</span>
        </div>

        <p>
            Livelihood tracking and support activities to ensure sustainability
            and progress for PWD beneficiaries.
        </p>
    </div>
</header>

<main class="story-main-section">
    <div class="container">
        <div class="story-layout">

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
                    <img src="{{ asset('images/update/SEEDS.jpg') }}" alt="Seed Capital Program Main Banner">
                </div>

                <div class="story-text">
                    <p>
                        The PDAO Office conducted monitoring visits for seed capital beneficiaries to ensure proper use and to
                        provide technical assistance for sustainable growth. Ang aktibidad na ito ay naglalayong personal na
                        makita ang estado ng mga negosyo o pangkabuhayan na sinimulan ng ating mga PWD beneficiaries gamit
                        ang pondong ipinagkaloob ng lokal na pamahalaan.
                    </p>

                    <p>
                        Beneficiaries received mentoring on business development, record-keeping, and market linkages.
                        Sa pamamagitan ng gabay na ito mula sa e-PDAO, tinutulungan natin silang maunawaan ang tamang pagpapatakbo
                        ng maliit na negosyo, pagsubaybay sa kita at gastusin, at kung paano mas mapapalawak ang kanilang merkado
                        upang lumago ang kanilang kabuhayan.
                    </p>

                    <blockquote>
                        "Small capital, big impact — with proper guidance, financial transparency, and continuous community support, our PWD entrepreneurs can achieve long-term economic independence."
                    </blockquote>

                    <p>
                        The monitoring activity aimed to strengthen project sustainability and improve beneficiaries' livelihoods.
                        Naniniwala ang e-PDAO Manolo Fortich na hindi sapat ang magbigay lamang ng paunang puhunan; ang tunay na susi
                        sa tagumpay ay ang patuloy na pag-antabay at pagbibigay ng tulong-teknikal upang maging matatag ang kanilang
                        pinagkakakitaan sa gitna ng mga hamon sa ekonomiya.
                    </p>
                </div>

                <section class="story-gallery">

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/SEEDS.jpg') }}" alt="Seed Capital Program">
                        <div class="story-gallery-card-body">
                            <h4>Seed Capital Program</h4>
                            <p>
                                <strong>Explanation:</strong> Monitoring support strengthened sustainable livelihood projects for PWD beneficiaries.
                                Ang pagbisita sa kanilang mga lokasyon ay nagbigay-daan upang masuri ang mga pangangailangan ng kanilang mga negosyo.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/SPED.jpg') }}" alt="Educational Support">
                        <div class="story-gallery-card-body">
                            <h4>Educational Assistance</h4>
                            <p>
                                <strong>Explanation:</strong> School supplies were distributed to SPED students for more inclusive education.
                                Kaakibat ng pag-unlad ng pangkabuhayan ng pamilya ang pagsisiguro na ang kanilang mga anak ay may sapat na gamit sa pag-aaral.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="Community Support">
                        <div class="story-gallery-card-body">
                            <h4>Women's Disability Day</h4>
                            <p>
                                <strong>Explanation:</strong> An empowerment celebration highlighted the achievements of women with disabilities.
                                Marami sa ating mga matatag na micro-entrepreneurs ay mga kababaihang PWD na nagpapakita ng husay sa pamamahala ng negosyo.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="Inclusive Activities">
                        <div class="story-gallery-card-body">
                            <h4>Paragames Event</h4>
                            <p>
                                <strong>Explanation:</strong> Inclusive sports activities promoted teamwork and community participation.
                                Ang determinasyong ipinamamalas ng mga PWD sa larangan ng palakasan ay kaparehong sipag na nakikita sa kanilang mga kabuhayan.
                            </p>
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
                    <a href="{{ route('news.disability') }}">National Disability Rights Week</a>
                    <a href="{{ route('news.bullying') }}">Anti-Bullying Symposium</a>
                </div>

                <div class="story-side-card">
                    <h3>Categories</h3>
                    <span>Livelihood Programs</span>
                    <span>Economic Support</span>
                </div>

            </aside>

        </div>
    </div>
</main>

@endsection