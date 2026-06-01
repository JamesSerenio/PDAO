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
            <i class="fa-solid fa-shield-halved"></i> e-PDAO Manolo Fortich
        </span>
        <h1>Anti-Bullying Symposium</h1>

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
            Promoting respect, inclusion, and awareness among students and
            community members in Manolo Fortich.
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
                        August 26, 2025
                    </span>
                    <span>
                        <i class="fa-solid fa-folder"></i>
                        Community Activities
                    </span>
                </div>

                <div class="story-main-image">
                    <img src="{{ asset('images/update/ANTI.jpg') }}" alt="Anti-Bullying Symposium Main Banner">
                </div>

                <div class="story-text">
                    <p>
                        The Anti-Bullying Symposium brought together students, educators, and advocates to discuss strategies
                        for fostering safe and respectful learning environments. Ang programang ito ay naglalayong bigyang-proteksyon
                        ang mga kabataan, lalo na ang mga mag-aaral na may kapansanan (PWDs), laban sa anumang uri ng diskriminasyon
                        at pang-aapi sa loob at labas ng paaralan.
                    </p>

                    <p>
                        Sessions included talks on empathy, bystander intervention, and building inclusive school cultures.
                        Binigyang-diin ng mga eksperto na ang pagpapanatili ng isang ligtas na kapaligiran ay hindi lamang responsibilidad
                        ng mga guro, kundi responsibilidad ng buong komunidad sa pamamagitan ng hindi pagpapahintulot sa "bullying"
                        at pag-antabay sa kapakanan ng bawat isa.
                    </p>

                    <blockquote>
                        "Respect and kindness are the foundation of a safe community — ang paggalang sa pagkakaiba-iba ng bawat tao ang susi sa isang matiwasay na lipunan."
                    </blockquote>

                    <p>
                        Schools will continue partnership programs with the PDAO to sustain awareness and provide resources
                        for students. Sa pamamagitan ng e-PDAO Manolo Fortich, mas palalalimin pa ang mga monitoring systems upang
                        matiyak na ang bawat PWD student ay may malalapitan at makakakuha ng agarang tulong at proteksyon sa kanilang mga karapatan.
                    </p>
                </div>

                <section class="story-gallery">

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/ANTI.jpg') }}" alt="Anti-Bullying Symposium">
                        <div class="story-gallery-card-body">
                            <h4>Anti-Bullying Symposium</h4>
                            <p>
                                <strong>Explanation:</strong> Students and educators joined in promoting respect and safer learning spaces.
                                Ang talakayang ito ay nagbukas ng kamalayan sa mga kabataan na maging boses ng kapayapaan at pagtanggap sa kapwa.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/STRESS.jpg') }}" alt="Wellness Program">
                        <div class="story-gallery-card-body">
                            <h4>Wellness Seminar</h4>
                            <p>
                                <strong>Explanation:</strong> Programs on stress management supported PWD officers' mental health.
                                Kaakibat ng pag-iwas sa bullying ang pangangalaga sa emosyonal na kalusugan upang patuloy na maging matatag ang ating komunidad.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="Women's Disability Day">
                        <div class="story-gallery-card-body">
                            <h4>Women's Disability Day</h4>
                            <p>
                                <strong>Explanation:</strong> A community event celebrated the strength and contribution of women with disabilities.
                                Sektor na nangunguna rin sa pagsusulong ng mga ligtas na espasyo para sa mga bata at kababaihan laban sa karahasan.
                            </p>
                        </div>
                    </div>

                    <div class="story-gallery-card">
                        <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="Paragames Event">
                        <div class="story-gallery-card-body">
                            <h4>Paragames Event</h4>
                            <p>
                                <strong>Explanation:</strong> Inclusive sports activities built camaraderie and visibility for PWDs.
                                Sa pamamagitan ng palakasan, pinatutunayan natin na ang pagkakaibigan at pagkakaisa ay walang pinipiling pisikal na katayuan.
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
                    <a href="{{ route('news.seed') }}">SEED Capital Monitoring</a>
                </div>

                <div class="story-side-card">
                    <h3>Categories</h3>
                    <span>Community Activities</span>
                    <span>Inclusion</span>
                </div>

            </aside>

        </div>
    </div>
</main>

@endsection