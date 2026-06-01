@extends('layouts.app')

@push('styles')
    {{-- Tinatawag natin ang hiwalay na CSS file para sa page na ito --}}
    <link rel="stylesheet" href="{{ asset('css/pages/citizen-charter.css') }}">
@endpush

@section('content')
<div class="charter-page-wrapper">
    <div class="container">

        {{-- SECTION HEADER (Left Aligned, Modernized) --}}
        <div class="charter-left-header">
            <span class="charter-badge">
                <i class="fa-solid fa-building-shield"></i> e-PDAO Manolo Fortich
            </span>
            <h2>PDAO Citizen Charter</h2>
            <p>
                Learn about the official services, procedures, requirements, and service standards
                of the Persons with Disability Affairs Office.
            </p>
        </div>

        {{-- MAIN CONTENT CARD (Solid White / Dark Slate Layout) --}}
        <div class="charter-solid-card">
            <h3 class="charter-card-title">
                <i class="fa-solid fa-file-invoice"></i> Citizen Charter Information
            </h3>

            <p class="charter-body-text">
                This page contains service procedures, expected processing times, documentary
                requirements, and important public service guidelines for citizens and clients
                of the PDAO office.
            </p>

            <div class="charter-link-box">
                <i class="fa-solid fa-arrow-up-right-from-square" style="color: #fbbf24; font-size: 1.2rem;"></i>
                <div>
                    <span style="display: block; font-size: 0.85rem; color: #64748b; font-weight: 600;">Access the Citizen Charter portal here:</span>
                    <a href="https://citizenscharter.manolofortich.gov.ph/" target="_blank" rel="noopener noreferrer">
                        citizenscharter.manolofortich.gov.ph
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection