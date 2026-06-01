@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trackingmap/livelihood-programs.css') }}">
@endpush

@section('content')

<section class="livelihood-hero">
    <div class="livelihood-overlay"></div>
    <div class="container">
        <div class="livelihood-hero-content">
            <span class="livelihood-badge">
                e-PDAO Manolo Fortich
            </span>
            <h1>
                Livelihood Programs
            </h1>
            <p>
                Empowering Persons with Disabilities through sustainable
                livelihood opportunities, skills development, and
                community-based economic support programs.
            </p>
        </div>
    </div>
</section>

<section class="livelihood-section">
    <div class="container">
        <div class="livelihood-layout">

            <div class="livelihood-main">
                <div class="livelihood-card">
                    <div class="livelihood-image">
                        <img src="{{ asset('images/update/SEEDS.jpg') }}" alt="Livelihood Programs">
                    </div>
                    <div class="livelihood-content">
                        <div class="livelihood-title">
                            <div class="livelihood-icon">
                                <i class="fa-solid fa-seedling"></i>
                            </div>
                            <h2>Livelihood Assistance Programs</h2>
                        </div>
                        <p>
                            The Livelihood Program of e-PDAO Manolo Fortich
                            promotes economic empowerment and self-sufficiency
                            among Persons with Disabilities through skills
                            training, livelihood opportunities, and community
                            support initiatives.
                        </p>
                        <p>
                            The program focuses on strengthening livelihood
                            capacity, improving productivity, and helping
                            registered PWD members participate actively in
                            sustainable income-generating activities within
                            the municipality.
                        </p>
                    </div>
                </div>

                <div class="livelihood-card">
                    <div class="livelihood-title">
                        <div class="livelihood-icon yellow-icon">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>
                        <h2>Program Opportunities</h2>
                    </div>
                    <div class="benefits-grid">
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Skills Training Programs</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Livelihood Starter Kits</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Community-Based Projects</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Small Business Support</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Employment Referrals</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Sustainable Livelihood Activities</div>
                    </div>
                </div>

                <div class="livelihood-card">
                    <div class="livelihood-title">
                        <div class="livelihood-icon">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>
                        <h2>Program Objective</h2>
                    </div>
                    <p>
                        The Livelihood Program aims to provide accessible
                        economic opportunities that help Persons with
                        Disabilities improve their quality of life,
                        develop sustainable income sources, and promote
                        inclusive community participation.
                    </p>
                </div>
            </div>

            <aside class="livelihood-sidebar">
                <div class="sidebar-card">
                    <div class="sidebar-icon">
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                    <h3>Community Support</h3>
                    <p>
                        e-PDAO coordinates with local agencies,
                        organizations, and barangays to support
                        livelihood development programs for
                        registered PWD members.
                    </p>
                </div>

                <div class="sidebar-card support-card">
                    <div class="sidebar-icon support-icon">
                        <i class="fa-solid fa-store"></i>
                    </div>
                    <h3>Economic Empowerment</h3>
                    <p>
                        Encouraging independence, productivity,
                        and financial sustainability through
                        inclusive livelihood opportunities.
                    </p>
                </div>

                <div class="sidebar-card">
                    <div class="sidebar-icon yellow-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <h3>Basic Requirements</h3>
                    <ul class="requirement-list">
                        <li>Valid PWD ID</li>
                        <li>Barangay Certification</li>
                        <li>Program Assessment</li>
                        <li>Supporting Documents</li>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection