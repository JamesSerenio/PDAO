@extends('layouts.app')

@section('content')
<div class="vision-theme-page">

    <div class="vision-theme-hero">
        <div class="vision-theme-badge">
            <i class="fa-solid fa-clock-rotate-left"></i> e-PDAO Manolo Fortich
        </div>
        <h1 class="vision-theme-title">Historical Background</h1>
        <p class="vision-theme-sub">
            Building Inclusion, Empowerment, and Equal Opportunity through the years.
        </p>
    </div>

    <div class="vision-theme-card">
        <h2>About e-PDAO</h2>
        <p>
            The Persons with Disability Affairs Office (PDAO) of Manolo Fortich
            was established to champion the rights, welfare, and empowerment of
            Persons with Disabilities through inclusive governance, accessible
            services, and sustainable community programs.
        </p>
    </div>

    <div class="smooth-vision-timeline">

        <div class="smooth-timeline-item">
            <div class="smooth-timeline-marker">
                <div class="marker-dot"></div>
                <div class="marker-line"></div>
            </div>
            <div class="smooth-timeline-card">
                <div class="smooth-timeline-year">2021</div>
                <h4 class="smooth-timeline-subtitle">Legislative Foundation</h4>
                <p class="smooth-timeline-text">
                    Ordinance No. 2021-1440 was enacted on May 6, 2021, officially institutionalizing the Persons with Disability Affairs Office and appropriating municipal funds for its operation.
                </p>
            </div>
        </div>

        <div class="smooth-timeline-item">
            <div class="smooth-timeline-marker">
                <div class="marker-dot"></div>
                <div class="marker-line"></div>
            </div>
            <div class="smooth-timeline-card">
                <div class="smooth-timeline-year">2022</div>
                <h4 class="smooth-timeline-subtitle">Baseline Operations under Marchie S. Galindo</h4>
                <div class="smooth-officer-badge">
                    <img src="{{ asset('images/org/Galindo.jpg') }}" alt="Marchie S. Galindo">
                    <span>Marchie S. Galindo (Disability Affairs Assistant)</span>
                </div>
                <p class="smooth-timeline-text">
                    Under limited resources, utilizing only one desktop computer, PDAO began operations. The year marked the historic inauguration of the PDAO and Senior Citizens Day Center.
                </p>
            </div>
        </div>

        <div class="smooth-timeline-item">
            <div class="smooth-timeline-marker">
                <div class="marker-dot"></div>
                <div class="marker-line"></div>
            </div>
            <div class="smooth-timeline-card">
                <div class="smooth-timeline-year">2023</div>
                <h4 class="smooth-timeline-subtitle">Leadership Transition to Renante V. Moradas</h4>
                <div class="smooth-officer-badge">
                    <img src="{{ asset('images/org/Tikoy.png') }}" alt="Renante V. Moradas">
                    <span>Renante V. Moradas (Officer-in-Charge)</span>
                </div>
                <p class="smooth-timeline-text">
                    Following reassignment, leadership was transferred to expand profiling operations across all barangays and strengthen rigorous accessibility audits.
                </p>
            </div>
        </div>

        <div class="smooth-timeline-item">
            <div class="smooth-timeline-marker">
                <div class="marker-dot"></div>
                <div class="marker-line"></div>
            </div>
            <div class="smooth-timeline-card">
                <div class="smooth-timeline-year">2024</div>
                <h4 class="smooth-timeline-subtitle">Institutional Advancement</h4>
                <p class="smooth-timeline-text">
                    PDAO expanded healthcare referrals, assistive device distribution, leadership training, accessibility compliance monitoring, and achieved regional recognition in para sports competitions.
                </p>
            </div>
        </div>

        <div class="smooth-timeline-item">
            <div class="smooth-timeline-marker">
                <div class="marker-dot"></div>
            </div>
            <div class="smooth-timeline-card">
                <div class="smooth-timeline-year">2025</div>
                <h4 class="smooth-timeline-subtitle">Policy Milestones & Community Expansion</h4>
                <p class="smooth-timeline-text">
                    Landmark ordinances strengthened financial assistance and social pension programs for PWDs, while barangay PWD desks expanded grassroots accessibility and support services.
                </p>
            </div>
        </div>

    </div>

    <div class="vision-theme-footer">
        Empowerment • Inclusion • Accessibility • Equality
    </div>

</div>
@endsection