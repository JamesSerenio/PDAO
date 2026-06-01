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
            <i class="fa-solid fa-graduation-cap"></i> e-PDAO Manolo Fortich
        </span>
        <h1>Distribution of School Supplies for SPED Students</h1>

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
            Inclusive education support through school supplies for SPED students
            in Manolo Fortich.
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
                        August 19, 2025
                    </span>
                    <span>
                        <i class="fa-solid fa-folder"></i>
                        Educational Support
                    </span>
                </div>

                <div class="story-main-image">
                    <img src="{{ asset('images/update/SPED.jpg') }}" alt="SPED School Supplies Distribution Banner">
                </div>

                <div class="story-text">
                    <p>
                        The PDAO Office distributed school supplies to SPED students to enhance their learning experience
                        An open framework structure designed to ensure equitable access to educational resources. Ang pamamahagi
                        ng mga kagamitang pampaaralan na ito ay bahagi ng patuloy na adbokasya ng lokal na pamahalaan na bigyan
                        ng sapat at de-kalidad na suporta ang ating mga mag-aaral na may espesyal na pangangailangan.
                    </p>

                    <p>
                        The initiative aims to reduce barriers to learning by providing essential materials tailored to the
                        needs of learners with disabilities. Sa tulong ng mga school supplies na ito, nababawasan ang pinansyal
                        na isipin ng mga magulang, habang ang mga bata naman ay mas nagkakaroon ng inspirasyon at kumpiyansa
                        na pumasok at mag-aral araw-araw kasama ang kanilang mga guro.
                    </p>

                    <blockquote>
                        "Education opens doors — we strive to keep them open for everyone, ensuring that no special child is left behind in their journey toward growth."
                    </blockquote>

                    <p>
                        Parents, teachers, and community volunteers collaborated to ensure smooth distribution and proper support
                        for beneficiaries. Ang tagumpay ng gawaing ito ay patunay na kapag nagtutulungan ang pamilya, paaralan,
                        at ang e-PDAO Office, mas mabilis nating naihahatid ang mga programang tunay na makatutulong sa sektor ng PWD.
                    </p>
                </div>

                <section class="story-gallery">

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/SPED.jpg') }}" alt="SPED Distribution">
                        <div class="story-gallery-card-body">
                            <h4>School Supplies</h4>
                            <p>
                                <strong>Explanation:</strong> Distributed school supplies supported SPED students with accessible learning resources.
                                Ang mga kwaderno, lapis, at bags na ipinamahagi ay maingat na pinili upang umangkop sa antas at kakayahan ng bawat bata.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="PWD Community">
                        <div class="story-gallery-card-body">
                            <h4>Women's Disability Day</h4>
                            <p>
                                <strong>Explanation:</strong> Community programs uplifted women with disabilities through awareness and inclusion.
                                Isang mahalagang paalala na ang edukasyon at suporta sa komunidad ay kailangan ng bawat kabataang babaeng PWD upang sila ay maprotektahan.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/ANTI.jpg') }}" alt="Anti-Bullying">
                        <div class="story-gallery-card-body">
                            <h4>Anti-Bullying Symposium</h4>
                            <p>
                                <strong>Explanation:</strong> Students and educators joined in promoting respect and safe learning environments.
                                Kaakibat ng pamamahagi ng gamit ang pagtuturo sa mga paaralan na huwag tuksuhin o i-bully ang ating mga SPED learners.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/SEEDS.jpg') }}" alt="Seed Capital">
                        <div class="story-gallery-card-body">
                            <h4>Seed Capital Monitoring</h4>
                            <p>
                                <strong>Explanation:</strong> Livelihood monitoring ensured continued support for community beneficiaries.
                                Bukod sa edukasyon, sinisigurado rin ng lokal na pamahalaan na may sapat na pangkabuhayan ang mga magulang ng mga batang PWD.
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
                    <a href="{{ route('news.disability') }}">National Disability Rights Week</a>
                    <a href="{{ route('news.bullying') }}">Anti-Bullying Symposium</a>
                    <a href="{{ route('news.seed') }}">SEED Capital Monitoring</a>
                </div>

                <div class="story-side-card">
                    <h3>Categories</h3>
                    <span>Educational Support</span>
                    <span>Inclusive Programs</span>
                </div>

            </aside>

        </div>
    </div>
</main>

@endsection