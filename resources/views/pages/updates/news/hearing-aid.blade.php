@extends('layouts.app')

@push('styles')
    {{-- Ginagamit ang shared main CSS framework ng news --}}
    <link rel="stylesheet" href="{{ asset('css/news/news-main.css') }}">

    {{-- FIX: Dito natin inilagay ang background para hindi mag-error ang inline style validator ng VS Code --}}
    <style>
        .custom-hearing-hero {
            position: relative;
            background-image: linear-gradient(rgba(11, 61, 145, 0.85), rgba(11, 61, 145, 0.85)), url("{{ asset('images/update/AID.jpg') }}");
            background-repeat: no-repeat;
            background-position: center center;
            background-size: cover;
            padding: 60px 0;
            color: #ffffff;
        }
    </style>
@endpush

@section('content')

{{-- 1. UNIFORM HERO BANNER SECTION (Malinis na at walang inline CSS error) --}}
<section class="news-hero custom-hearing-hero">
    <div class="container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        <div class="news-hero-content" style="max-width: 850px; text-align: left; margin: 0;">

            {{-- Badge (Left Aligned) --}}
            <span class="hero-badge" style="display: inline-flex; align-items: center; background: rgba(255, 255, 255, 0.15); border: 1px solid rgba(255, 255, 255, 0.3); color: #ffffff; padding: 6px 16px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; margin-bottom: 20px; backdrop-filter: blur(5px);">
                <i class="fa-solid fa-ear-listen" style="margin-right: 8px; color: #f59e0b;"></i> e-PDAO Manolo Fortich
            </span>

            {{-- Main Title (Left Aligned) --}}
            <h1 style="font-size: 2.8rem; font-weight: 800; line-height: 1.2; color: #ffffff; margin: 0 0 20px 0; text-shadow: 0 2px 4px rgba(0,0,0,0.2);">
                Hearing Aid Assistance Program for PWD Beneficiaries
            </h1>

            {{-- Uniform Breadcrumb Tracking (Left Aligned) --}}
            <div class="breadcrumb" style="font-size: 0.95rem; font-weight: 500; display: flex; align-items: center; gap: 8px; margin-bottom: 20px; justify-content: flex-start;">
                <a href="/" style="color: #f59e0b; text-decoration: none; font-weight: 600;">Home</a>
                <span style="color: rgba(255,255,255,0.6);">&rsaquo;</span>
                <a href="{{ route('updates') }}" style="color: #f59e0b; text-decoration: none; font-weight: 600;">Updates</a>
                <span style="color: rgba(255,255,255,0.6);">&rsaquo;</span>
                <a href="{{ route('news') }}" style="color: #f59e0b; text-decoration: none; font-weight: 600;">News</a>
                <span style="color: rgba(255,255,255,0.6);">&rsaquo;</span>
                <span style="color: #ffffff; font-weight: 600;">Post</span>
            </div>

            {{-- Sub-description text beneath breadcrumbs (Left Aligned) --}}
            <p style="font-size: 1.1rem; color: rgba(255, 255, 255, 0.9); line-height: 1.6; margin: 0;">
                Providing hearing aid support to qualified beneficiaries to improve communication and access.
            </p>

        </div>
    </div>
</section>

{{-- 2. MAIN CONTENT WRAPPER GRID --}}
<div class="news-page-container" style="max-width: 1200px; margin: 40px auto; padding: 0 20px;">
    <div class="news-layout-wrapper" style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px;">

        {{-- LEFT COLUMN: CONTENT STREAM --}}
        <main class="news-main-stream">
            <article class="news-card-disability news-item" style="background: #ffffff; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">

                {{-- Meta Info Badges --}}
                <div style="padding: 20px 25px 0 25px; display: flex; gap: 10px; flex-wrap: wrap;">
                    <span style="background: #f1f5f9; color: #475569; padding: 6px 14px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-calendar" style="color: #0b3d91;"></i> September 05, 2025
                    </span>
                    <span style="background: rgba(11, 61, 145, 0.08); color: #0b3d91; padding: 6px 14px; border-radius: 50px; font-size: 0.85rem; font-weight: 600; display: inline-flex; align-items: center; gap: 6px;">
                        <i class="fa-solid fa-folder"></i> Medical Assistance
                    </span>
                </div>

                <div class="news-card-content" style="padding: 25px;">
                    {{-- Article Main Body Text --}}
                    <div class="story-text-block" style="color: #334155; line-height: 1.8; font-size: 1.05rem;">
                        <p style="margin-bottom: 20px; text-align: justify;">
                            The Hearing Aid Assistance Program provided devices and support services to PWD beneficiaries
                            to enhance their daily communication and participation.
                        </p>

                        <p style="margin-bottom: 20px; text-align: justify;">
                            Medical screenings and fittings were conducted by trained health professionals to ensure
                            successful outcomes for recipients.
                        </p>

                        <blockquote style="border-left: 4px solid #0b3d91; background: #f8fafc; padding: 18px 20px; margin: 25px 0; font-style: italic; border-radius: 0 8px 8px 0; color: #0f172a; font-weight: 500; font-size: 1.1rem;">
                            "Accessibility to health services enables fuller participation."
                        </blockquote>

                        <p style="margin-bottom: 30px; text-align: justify;">
                            Follow-up services and maintenance support were arranged to ensure long-term benefit for recipients.
                        </p>
                    </div>

                    {{-- Mini Gallery Images Layout --}}
                    <div class="news-grid-stream" style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 20px; margin: 30px 0;">
                        <div style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; background: #fff;">
                            <img src="{{ asset('images/update/AID.jpg') }}" style="width: 100%; height: 160px; object-fit: cover;">
                            <div style="padding: 12px; border-top: 1px solid #e2e8f0;"><strong style="font-size: 0.9rem; color: #0f172a;">Hearing Aid Program</strong></div>
                        </div>
                        <div style="border: 1px solid #e2e8f0; border-radius: 8px; overflow: hidden; background: #fff;">
                            <img src="{{ asset('images/update/WOMENS.jpg') }}" style="width: 100%; height: 160px; object-fit: cover;">
                            <div style="padding: 12px; border-top: 1px solid #e2e8f0;"><strong style="font-size: 0.9rem; color: #0f172a;">Women's Disability Day</strong></div>
                        </div>
                    </div>

                    {{-- Back Button --}}
                    <div class="news-card-footer" style="border-top: 1px solid #e2e8f0; padding-top: 25px; margin-top: 20px;">
                        <a href="{{ route('news') }}" class="news-link-style-btn" style="text-decoration: none; display: inline-flex; align-items: center; gap: 8px; font-weight: 700; color: #0b3d91; font-size: 1rem;">
                            <i class="fa-solid fa-arrow-left"></i> Back to News
                        </a>
                    </div>
                </div>
            </article>
        </main>

        {{-- RIGHT COLUMN: SIDEBAR WIDGETS --}}
        <aside class="news-right-sidebar">
            <div class="sidebar-widget-card" style="background: #ffffff; border: 1px solid #e2e8f0; padding: 25px; border-radius: 12px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);">
                <h3 style="color: #0f172a; font-size: 1.15rem; font-weight: 700; margin-top: 0; margin-bottom: 20px; border-left: 4px solid #0b3d91; padding-left: 12px; text-transform: uppercase; letter-spacing: 0.5px;">
                    Related Stories
                </h3>
                <ul class="sidebar-category-links" style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 15px; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;"><a href="{{ route('news.school') }}" style="color: #0b3d91; text-decoration: none; font-size: 0.98rem; font-weight: 500; display: block;">School Supplies Distribution</a></li>
                    <li style="margin-bottom: 15px; padding-bottom: 12px; border-bottom: 1px dashed #e2e8f0;"><a href="{{ route('news.disability') }}" style="color: #0b3d91; text-decoration: none; font-size: 0.98rem; font-weight: 500; display: block;">National Disability Rights Week</a></li>
                    <li><a href="{{ route('news.seed') }}" style="color: #0b3d91; text-decoration: none; font-size: 0.98rem; font-weight: 500; display: block;">SEED Capital Monitoring</a></li>
                </ul>
            </div>
        </aside>

    </div>
</div>

@endsection