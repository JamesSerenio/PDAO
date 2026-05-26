@extends('layouts.app')

@section('content')

<!-- =========================================
    HERO SECTION
========================================= -->
<section class="news-hero-section">

    <div class="news-hero-overlay"></div>

    <div class="container">

        <div class="news-hero-content">

            <span class="news-badge">
                e-PDAO Manolo Fortich
            </span>

            <h1>
                News & Community Highlights
            </h1>

            <p>
                Stay updated with the latest programs,
                activities, announcements, and inclusive
                community initiatives of the PDAO Office
                of Manolo Fortich.
            </p>

        </div>

    </div>

</section>



<!-- =========================================
    NEWS SECTION
========================================= -->
<section class="news-page-section">

    <div class="container">

        <div class="news-layout">


            <!-- =========================================
                LEFT CONTENT
            ========================================= -->
            <div class="news-main-content">


                <!-- FEATURED NEWS -->
<div class="featured-news-card news-item"
     data-category="pwd">

    <!-- IMAGE -->
    <div class="featured-image">

        <img src="{{ asset('images/update/PARAGAMES.jpg') }}"
             alt="Paragames">

    </div>


    <!-- CONTENT -->
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

        <a href="{{ route('news.disability') }}"
           class="read-more-btn">

            Read Full Story

            <i class="fa-solid fa-arrow-right"></i>

        </a>

    </div>

</div>

                <!-- =========================================
                    NEWS GRID
                ========================================= -->
                <div class="news-grid">


                    <!-- CARD 1 -->
                    <a href="{{ route('news.school') }}"
                       class="news-card-modern news-item"
                       data-category="education">

                        <img src="{{ asset('images/update/SPED.jpg') }}"
                             alt="SPED">

                        <div class="news-card-body">

                            <span>
                                Educational Assistance
                            </span>

                            <h3>
                                Distribution of School Supplies for SPED Students
                            </h3>

                            <p>
                                School supplies were distributed
                                to SPED students to support accessible
                                and inclusive education.
                            </p>

                        </div>

                    </a>



                    <!-- CARD 2 -->
                    <a href="{{ route('news.bullying') }}"
                       class="news-card-modern news-item"
                       data-category="community">

                        <img src="{{ asset('images/update/ANTI.jpg') }}"
                             alt="Anti Bullying">

                        <div class="news-card-body">

                            <span>
                                Community Awareness
                            </span>

                            <h3>
                                Anti-Bullying Symposium Conducted
                            </h3>

                            <p>
                                Students and participants joined
                                the Anti-Bullying Symposium promoting
                                respect, inclusion, and awareness.
                            </p>

                        </div>

                    </a>



                    <!-- CARD 3 -->
                    <a href="{{ route('news.hearing') }}"
                       class="news-card-modern news-item"
                       data-category="medical">

                        <img src="{{ asset('images/update/AID.jpg') }}"
                             alt="Hearing Aid">

                        <div class="news-card-body">

                            <span>
                                Medical Assistance
                            </span>

                            <h3>
                                Hearing Aid Assistance Program for PWD Beneficiaries
                            </h3>

                            <p>
                                Qualified beneficiaries received
                                hearing aid assistance to improve
                                communication and accessibility.
                            </p>

                        </div>

                    </a>



                    <!-- CARD 4 -->
                    <a href="{{ route('news.seed') }}"
                       class="news-card-modern news-item"
                       data-category="livelihood">

                        <img src="{{ asset('images/update/SEEDS.jpg') }}"
                             alt="Seed Capital">

                        <div class="news-card-body">

                            <span>
                                Livelihood Program
                            </span>

                            <h3>
                                Seed Capital Monitoring for PWD Beneficiaries
                            </h3>

                            <p>
                                The PDAO Office monitored seed capital
                                beneficiaries to support sustainable
                                livelihood opportunities.
                            </p>

                        </div>

                    </a>

                </div>
                <!-- END NEWS GRID -->

            </div>
            <!-- END LEFT CONTENT -->





            <!-- =========================================
                SIDEBAR
            ========================================= -->
            <aside class="news-sidebar">


                <!-- SEARCH -->
                <div class="sidebar-card">

                    <h3>
                        Search News
                    </h3>

                    <div class="sidebar-search">

                        <input type="text"
                               id="newsSearch"
                               placeholder="Search news...">

                        <button type="button">

                            <i class="fa-solid fa-magnifying-glass"></i>

                        </button>

                    </div>

                </div>




                <!-- CATEGORIES -->
                <div class="sidebar-card">

                    <h3>
                        Categories
                    </h3>

                    <ul class="category-list">

                        <li>
                            <a href="#" data-category="pwd">

                                <i class="fa-solid fa-angle-right"></i>

                                PWD Programs

                            </a>
                        </li>

                        <li>
                            <a href="#" data-category="medical">

                                <i class="fa-solid fa-angle-right"></i>

                                Medical Assistance

                            </a>
                        </li>

                        <li>
                            <a href="#" data-category="community">

                                <i class="fa-solid fa-angle-right"></i>

                                Community Activities

                            </a>
                        </li>

                        <li>
                            <a href="#" data-category="education">

                                <i class="fa-solid fa-angle-right"></i>

                                Educational Support

                            </a>
                        </li>

                        <li>
                            <a href="#" data-category="livelihood">

                                <i class="fa-solid fa-angle-right"></i>

                                Livelihood Programs

                            </a>
                        </li>

                    </ul>

                </div>





                <!-- RECENT POSTS -->
                <div class="sidebar-card">

                    <h3>
                        Recent Posts
                    </h3>



                    <!-- POST 1 -->
                    <a href="{{ route('news.school') }}"
                       class="recent-post">

                        <img src="{{ asset('images/update/SPED.jpg') }}"
                             alt="SPED">

                        <div>

                            <h4>
                                School Supplies Distribution for SPED Students
                            </h4>

                            <span>
                                August 19, 2025
                            </span>

                        </div>

                    </a>




                    <!-- POST 2 -->
                    <a href="{{ route('news.bullying') }}"
                       class="recent-post">

                        <img src="{{ asset('images/update/ANTI.jpg') }}"
                             alt="Anti Bullying">

                        <div>

                            <h4>
                                Anti-Bullying Symposium 2025
                            </h4>

                            <span>
                                August 26, 2025
                            </span>

                        </div>

                    </a>




                    <!-- POST 3 -->
                    <a href="{{ route('news.seed') }}"
                       class="recent-post">

                        <img src="{{ asset('images/update/SEEDS.jpg') }}"
                             alt="Seed Capital">

                        <div>

                            <h4>
                                SEED Capital Monitoring Activity
                            </h4>

                            <span>
                                March 11, 2026
                            </span>

                        </div>

                    </a>

                </div>
                <!-- END SIDEBAR CARD -->


            </aside>
            <!-- END SIDEBAR -->


        </div>
        <!-- END NEWS LAYOUT -->


    </div>

</section>

@endsection