@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trackingmap/educational-assistance.css') }}">
@endpush

@section('content')

<section class="education-hero">
    <div class="education-overlay"></div>
    <div class="container">
        <div class="education-hero-content">
            <span class="education-badge">
                e-PDAO Manolo Fortich
            </span>
            <h1>
                Educational Assistance Program
            </h1>
            <p>
                Supporting inclusive education, learning opportunities,
                and academic assistance for Persons with Disabilities
                in the Municipality of Manolo Fortich.
            </p>
        </div>
    </div>
</section>

<section class="education-section">
    <div class="container">
        <div class="education-layout">

            <div class="education-main">
                <div class="education-card">
                    <div class="education-image">
                        <img src="{{ asset('images/update/SPED.jpg') }}" alt="Educational Assistance">
                    </div>
                    <div class="education-content">
                        <div class="education-title">
                            <div class="education-icon">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>
                            <h2>Educational Assistance Services</h2>
                        </div>
                        <p>
                            The Educational Assistance Program of
                            e-PDAO Manolo Fortich promotes equal
                            access to quality education for Persons
                            with Disabilities by supporting inclusive
                            learning programs, school coordination,
                            and educational opportunities.
                        </p>
                        <p>
                            The program aims to empower learners with
                            disabilities through educational support,
                            referrals, school assistance, and community
                            partnerships that help improve academic
                            participation and lifelong learning.
                        </p>
                    </div>
                </div>

                <div class="education-card">
                    <div class="education-title">
                        <div class="education-icon yellow-icon">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>
                        <h2>Program Benefits</h2>
                    </div>
                    <div class="benefits-grid">
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> School Coordination Assistance</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Inclusive Learning Support</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Scholarship Referrals</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> SPED Program Support</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Educational Monitoring</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Community Learning Programs</div>
                    </div>
                </div>

                <div class="education-card">
                    <div class="education-title">
                        <div class="education-icon">
                            <i class="fa-solid fa-school"></i>
                        </div>
                        <h2>Program Objective</h2>
                    </div>
                    <p>
                        The Educational Assistance Program strengthens
                        inclusive education and supports the academic
                        growth of Persons with Disabilities through
                        accessible educational opportunities, guidance,
                        and community-based learning initiatives.
                    </p>
                </div>
            </div>

            <aside class="education-sidebar">
                <div class="sidebar-card">
                    <div class="sidebar-icon">
                        <i class="fa-solid fa-hands-helping"></i>
                    </div>
                    <h3>Student Support</h3>
                    <p>
                        e-PDAO coordinates with schools, organizations,
                        and local agencies to provide educational
                        assistance and inclusive learning support.
                    </p>
                </div>

                <div class="sidebar-card support-card">
                    <div class="sidebar-icon support-icon">
                        <i class="fa-solid fa-universal-access"></i>
                    </div>
                    <h3>Inclusive Education</h3>
                    <p>
                        Promoting equal educational opportunities and
                        accessible learning environments for all
                        registered Persons with Disabilities.
                    </p>
                </div>

                <div class="sidebar-card">
                    <div class="sidebar-icon yellow-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>
                    <h3>Requirements</h3>
                    <ul class="requirement-list">
                        <li>Valid PWD ID</li>
                        <li>School Certification</li>
                        <li>Barangay Certification</li>
                        <li>Supporting Documents</li>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection