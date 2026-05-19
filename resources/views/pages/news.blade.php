@extends('layouts.app')

@section('content')

<!-- HERO -->
<section class="news-hero-section">
    <div class="news-hero-overlay"></div>

    <div class="container">
        <div class="news-hero-content">
            <span class="news-badge">e-PDAO Manolo Fortich</span>

            <h1>News & Community Highlights</h1>

            <p>
                Stay updated with the latest programs, activities,
                announcements, and inclusive community initiatives
                of the PDAO Office of Manolo Fortich.
            </p>
        </div>
    </div>
</section>


<!-- NEWS SECTION -->
<section class="news-page-section">
    <div class="container">

        <div class="news-layout">

            <!-- LEFT CONTENT -->
            <div class="news-main-content">

                <!-- FEATURED -->
                <div class="featured-news-card">

                    <div class="featured-image">
                        <img src="{{ asset('images/news/PARAGAMES.jpg') }}" alt="">
                    </div>

                    <div class="featured-content">
                        <span class="featured-tag">
                            Featured Program
                        </span>

                        <h2>
                            National Disability Rights Week 2025 Successfully Celebrated
                        </h2>

                        <p>
                            The Municipality of Manolo Fortich successfully celebrated
                            the National Disability Rights Week through inclusive
                            activities, Paragames, awareness campaigns, and community
                            empowerment programs for Persons with Disabilities.
                        </p>

                        <a href="#" class="read-more-btn">
                            Read Full Story
                        </a>
                    </div>
                </div>


                <!-- NEWS GRID -->
                <div class="news-grid">

                    <div class="news-card-modern">
                        <img src="{{ asset('images/news/SPED.jpg') }}" alt="">

                        <div class="news-card-body">
                            <span>Educational Assistance</span>

                            <h3>
                                Distribution of School Supplies for SPED Students
                            </h3>

                            <p>
                                School supplies were distributed to SPED students
                                to support accessible and inclusive education.
                            </p>
                        </div>
                    </div>


                    <div class="news-card-modern">
                        <img src="{{ asset('images/news/ANTI.jpg') }}" alt="">

                        <div class="news-card-body">
                            <span>Community Awareness</span>

                            <h3>
                                Anti-Bullying Symposium Conducted
                            </h3>

                            <p>
                                Students and participants joined the Anti-Bullying
                                Symposium promoting respect, inclusion, and awareness.
                            </p>
                        </div>
                    </div>


                    <div class="news-card-modern">
                        <img src="{{ asset('images/news/AID.jpg') }}" alt="">

                        <div class="news-card-body">
                            <span>Medical Assistance</span>

                            <h3>
                                Hearing Aid Assistance Program for PWD Beneficiaries
                            </h3>

                            <p>
                                Qualified beneficiaries received hearing aid assistance
                                to improve communication and accessibility.
                            </p>
                        </div>
                    </div>


                    <div class="news-card-modern">
                        <img src="{{ asset('images/news/SEED.jpg') }}" alt="">

                        <div class="news-card-body">
                            <span>Livelihood Program</span>

                            <h3>
                                Seed Capital Monitoring for PWD Beneficiaries
                            </h3>

                            <p>
                                The PDAO Office monitored seed capital beneficiaries
                                to support sustainable livelihood opportunities.
                            </p>
                        </div>
                    </div>

                </div>
            </div>



            <!-- SIDEBAR -->
            <aside class="news-sidebar">

                <!-- SEARCH -->
                <div class="sidebar-card">
                    <h3>Search News</h3>

                    <div class="sidebar-search">
                        <input type="text" placeholder="Search news...">

                        <button>
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </div>
                </div>


                <!-- CATEGORIES -->
                <div class="sidebar-card">
                    <h3>Categories</h3>

                    <ul class="category-list">
                        <li>
                            <a href="#">PWD Programs</a>
                        </li>

                        <li>
                            <a href="#">Medical Assistance</a>
                        </li>

                        <li>
                            <a href="#">Community Activities</a>
                        </li>

                        <li>
                            <a href="#">Educational Support</a>
                        </li>

                        <li>
                            <a href="#">Livelihood Programs</a>
                        </li>
                    </ul>
                </div>


                <!-- RECENT POSTS -->
                <div class="sidebar-card">
                    <h3>Recent Posts</h3>

                    <div class="recent-post">

                        <img src="{{ asset('images/news/SPED.jpg') }}" alt="">

                        <div>
                            <h4>
                                School Supplies Distribution for SPED Students
                            </h4>

                            <span>August 19, 2025</span>
                        </div>
                    </div>


                    <div class="recent-post">

                        <img src="{{ asset('images/news/ANTI.jpg') }}" alt="">

                        <div>
                            <h4>
                                Anti-Bullying Symposium 2025
                            </h4>

                            <span>August 26, 2025</span>
                        </div>
                    </div>


                    <div class="recent-post">

                        <img src="{{ asset('images/news/SEED.jpg') }}" alt="">

                        <div>
                            <h4>
                                SEED Capital Monitoring Activity
                            </h4>

                            <span>March 11, 2026</span>
                        </div>
                    </div>

                </div>

            </aside>

        </div>
    </div>
</section>

@endsection