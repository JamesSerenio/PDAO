@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trackingmap/medical-assistance.css') }}">
@endpush

@section('content')

<section class="medical-hero">
    <div class="medical-overlay"></div>
    <div class="container">
        <div class="medical-hero-content">
            <span class="medical-badge">
                e-PDAO Manolo Fortich
            </span>
            <h1>
                Medical Assistance Program
            </h1>
            <p>
                Providing accessible healthcare assistance, medical
                support, and inclusive services for Persons with
                Disabilities in the Municipality of Manolo Fortich.
            </p>
        </div>
    </div>
</section>

<section class="medical-section">
    <div class="container">
        <div class="medical-layout">

            <div class="medical-main">
                <div class="medical-card">
                    <div class="medical-image">
                        <img src="{{ asset('images/update/AIDS.jpg') }}" alt="Medical Assistance">
                    </div>
                    <div class="medical-content">
                        <div class="medical-title">
                            <div class="medical-icon">
                                <i class="fa-solid fa-hand-holding-medical"></i>
                            </div>
                            <h2>Medical Assistance Services</h2>
                        </div>
                        <p>
                            The e-PDAO Manolo Fortich Medical Assistance
                            Program aims to support Persons with Disabilities
                            by providing accessible healthcare-related
                            services, medical referrals, and coordination
                            with government and partner agencies.
                        </p>
                        <p>
                            This program helps qualified beneficiaries
                            access medical consultations, medicines,
                            assistive devices, transportation assistance,
                            and other health-related support necessary
                            for improving their quality of life.
                        </p>
                    </div>
                </div>

                <div class="medical-card">
                    <div class="medical-title">
                        <div class="medical-icon yellow-icon">
                            <i class="fa-solid fa-notes-medical"></i>
                        </div>
                        <h2>Program Benefits</h2>
                    </div>
                    <div class="benefits-grid">
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Medical Referral Assistance</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Hospital Coordination</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Assistive Devices Support</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Medicine Assistance</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Health Monitoring</div>
                        <div class="benefit-box"><i class="fa-solid fa-check"></i> Community Healthcare Programs</div>
                    </div>
                </div>

                <div class="medical-card">
                    <div class="medical-title">
                        <div class="medical-icon">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>
                        <h2>Program Objective</h2>
                    </div>
                    <p>
                        The Medical Assistance Program promotes equal
                        access to healthcare services and strengthens
                        the protection, welfare, and well-being of
                        Persons with Disabilities through inclusive
                        and community-based support systems.
                    </p>
                </div>
            </div>

            <aside class="medical-sidebar">
                <div class="sidebar-card">
                    <div class="sidebar-icon">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>
                    <h3>Need Assistance?</h3>
                    <p>
                        Visit the PDAO Office or coordinate with your
                        barangay representative for medical assistance
                        concerns and support services.
                    </p>
                </div>

                <div class="sidebar-card support-card">
                    <div class="sidebar-icon support-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <h3>Inclusive Healthcare</h3>
                    <p>
                        e-PDAO promotes accessible and inclusive
                        healthcare programs for all registered
                        Persons with Disabilities.
                    </p>
                </div>

                <div class="sidebar-card">
                    <div class="sidebar-icon yellow-icon">
                        <i class="fa-solid fa-file-medical"></i>
                    </div>
                    <h3>Requirements</h3>
                    <ul class="requirement-list">
                        <li>Valid PWD ID</li>
                        <li>Medical Certificate</li>
                        <li>Barangay Certification</li>
                        <li>Referral Documents</li>
                    </ul>
                </div>
            </aside>

        </div>
    </div>
</section>

@endsection