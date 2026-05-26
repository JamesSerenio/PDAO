@extends('layouts.app')

@section('content')

<style>
:root {
    --blue: #0057B8;
    --yellow: #F4C300;
    --white: #ffffff;
    --light: #f8fbff;
    --text: #1e293b;
}

.history-page {
    background: linear-gradient(135deg, #ffffff, #eef6ff);
    min-height: 100vh;
    padding: 60px 20px;
    overflow-x: hidden;
}

/* HERO */
.hero-history {
    text-align: center;
    margin-bottom: 70px;
}

.hero-badge {
    display: inline-block;
    background: var(--yellow);
    color: #1e3a8a; /* <--- Nilagyan ng pormal na kulay asul para visible ang text */
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 700;
    margin-bottom: 20px;
}

.hero-title {
    font-size: 4rem;
    font-weight: 900;
    color: var(--blue);
}

.hero-sub {
    font-size: 1.2rem;
    color: #64748b;
}

/* ABOUT */
.about-box {
    max-width: 1100px;
    margin: auto;
    background: white;
    padding: 40px;
    border-left: 8px solid var(--yellow);
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    margin-bottom: 80px;
}

.about-box h2 {
    color: var(--);
    font-weight: 800;
    margin-bottom: 20px;
}

/* TIMELINE */
.timeline {
    position: relative;
    max-width: 1200px;
    margin: auto;
}

.timeline::after {
    content: '';
    position: absolute;
    width: 6px;
    background: linear-gradient(to bottom, var(--yellow), var(--blue));
    top: 0;
    bottom: 0;
    left: 50%;
    margin-left: -3px;
    border-radius: 20px;
}

.timeline-item {
    padding: 20px 40px;
    position: relative;
    width: 50%;
}

.timeline-item.left { left: 0; }
.timeline-item.right { left: 50%; }

.timeline-dot {
    position: absolute;
    width: 28px;
    height: 28px;
    background: var(--yellow);
    border: 5px solid var(--blue);
    border-radius: 50%;
    top: 35px;
    z-index: 99;
}

.left .timeline-dot { right: -14px; }
.right .timeline-dot { left: -14px; }

.timeline-content {
    background: white;
    padding: 30px;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0,0,0,0.08);
    transition: .3s ease;
}

.timeline-content:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0,87,184,0.15);
}

.timeline-content h3 {
    color: var(--blue);
    font-size: 2rem;
    font-weight: 800;
}

.timeline-content h4 {
    color: var(--yellow);
    margin: 10px 0;
    font-weight: 700;
}

.timeline-content p {
    color: var(--text);
    line-height: 1.7;
}

/* IMAGES */
.officer {
    width: 120px;
    height: 120px;
    border-radius: 50%;
    object-fit: cover;
    border: 5px solid var(--yellow);
    margin-bottom: 15px;
}

/* FOOTER */
.history-footer {
    text-align: center;
    margin-top: 100px;
    color: var(--blue);
    font-weight: 700;
}

/* MOBILE */
@media(max-width:768px){
    .hero-title {
        font-size: 2.4rem;
    }

    .timeline::after {
        left: 20px;
    }

    .timeline-item {
        width: 100%;
        padding-left: 60px;
        padding-right: 15px;
    }

    .timeline-item.left,
    .timeline-item.right {
        left: 0;
    }

    .timeline-dot {
        left: 7px !important;
    }
}
</style>

<div class="history-page">

    <!-- HERO -->
    <div class="hero-history">
        <div class="hero-badge">e-PDAO Manolo Fortich</div>
        <h1 class="hero-title">Historical Background</h1>
        <p class="hero-sub">
            Building Inclusion, Empowerment, and Equal Opportunity
        </p>
    </div>

    <!-- ABOUT -->
    <div class="about-box">
        <h2>About e-PDAO</h2>
        <p>
            The Persons with Disability Affairs Office (PDAO) of Manolo Fortich
            was established to champion the rights, welfare, and empowerment of
            Persons with Disabilities through inclusive governance, accessible
            services, and sustainable community programs.
        </p>
    </div>

    <!-- TIMELINE -->
    <div class="timeline">

        <!-- 2021 -->
        <div class="timeline-item left">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <h3>2021</h3>
                <h4>Legislative Foundation</h4>
                <p>
                    Ordinance No. 2021-1440 was enacted on May 6, 2021,
                    officially institutionalizing the Persons with Disability
                    Affairs Office and appropriating municipal funds for its operation.
                </p>
            </div>
        </div>

        <!-- 2022 -->
        <div class="timeline-item right">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <img src="{{ asset('images/org/Galindo.jpg') }}" class="officer">
                <h3>2022</h3>
                <h4>Baseline Operations under Marchie S. Galindo</h4>
                <p>
                    Under Disability Affairs Assistant <strong>Marchie S. Galindo</strong>,
                    PDAO began operations despite limited resources, utilizing only
                    one desktop computer. The year marked the inauguration of the
                    PDAO and Senior Citizens Day Center.
                </p>
            </div>
        </div>

        <!-- 2023 -->
        <div class="timeline-item left">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <img src="{{ asset('images/org/Tikoy.png') }}" class="officer">
                <h3>2023</h3>
                <h4>Leadership Transition to Renante V. Moradas</h4>
                <p>
                    Following the reassignment of Marchie S. Galindo,
                    <strong>Renante V. Moradas</strong> assumed leadership as Officer-in-Charge,
                    expanding profiling operations across barangays and strengthening
                    accessibility audits.
                </p>
            </div>
        </div>

        <!-- 2024 -->
        <div class="timeline-item right">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <h3>2024</h3>
                <h4>Institutional Advancement</h4>
                <p>
                    PDAO expanded healthcare referrals, assistive device distribution,
                    leadership training, accessibility compliance monitoring, and
                    achieved regional recognition in para sports competitions.
                </p>
            </div>
        </div>

        <!-- 2025 -->
        <div class="timeline-item left">
            <div class="timeline-dot"></div>
            <div class="timeline-content">
                <h3>2025</h3>
                <h4>Policy Milestones & Community Expansion</h4>
                <p>
                    Landmark ordinances strengthened financial assistance and social
                    pension programs for PWDs, while barangay PWD desks expanded
                    grassroots accessibility and support services.
                </p>
            </div>
        </div>

    </div>

    <div class="history-footer">
        Empowerment • Inclusion • Accessibility • Equality
    </div>

</div>

@endsection