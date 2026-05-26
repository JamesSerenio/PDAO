@extends('layouts.app')

@section('content')

<section class="news-hero">
    <div class="news-overlay"></div>

    <div class="news-hero-content">
        <span class="hero-badge">e-PDAO Manolo Fortich</span>

        <h1>Updates & Activities</h1>

        <div class="breadcrumb">
            <a href="/">Home</a>
            <span>›</span>
            <a href="{{ route('updates') }}">Updates</a>
            <span>›</span>
            <a href="{{ route('news') }}">News</a>
        </div>

        <p>
            Latest programs, community activities, announcements,
            and yearly accomplishments of the PDAO Office.
        </p>
    </div>
</section>

<section class="updates-main-section">
    <div class="updates-container">

        <!-- LEFT CONTENT -->
        <div class="news-main-content">

            <!-- 2026 -->
            <div class="news-year">
                <h2>2026 Programs & Activities</h2>

                <div class="news-card">
                    <div class="news-date">
                        <span>11</span>
                        <small>MAR 2026</small>
                    </div>

                    <div class="news-info">
                        <h3>Seed Capital – PWD Monitoring</h3>

                        <p>
                            The PDAO Office conducted a Seed Capital monitoring activity to evaluate the
                            progress of livelihood assistance provided to Persons with Disabilities.
                            Beneficiaries shared updates regarding their small businesses and community
                            livelihood projects. The activity aimed to strengthen economic empowerment,
                            sustainability, and inclusive livelihood opportunities for PWDs in Manolo Fortich.
                        </p>

                        <div class="news-tags">
                            <span>Livelihood Program</span>
                            <span>PWD Monitoring</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>17</span>
                        <small>MAR 2026</small>
                    </div>

                    <div class="news-info">
                        <h3>Women's Disability Day Celebration</h3>

                        <p>
                            The municipality celebrated Women's Disability Day to recognize the strength,
                            contribution, and empowerment of women with disabilities. The program included
                            awareness discussions, inspirational activities, and community engagement aimed
                            at promoting equality, inclusion, and women empowerment.
                        </p>

                        <div class="news-tags">
                            <span>Women Empowerment</span>
                            <span>Awareness Program</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>18</span>
                        <small>MAR 2026</small>
                    </div>

                    <div class="news-info">
                        <h3>SEED Capital 2nd Batch Payout</h3>

                        <p>
                            The second batch payout of the SEED Capital assistance program was successfully
                            distributed to qualified Persons with Disabilities. The initiative aims to help
                            beneficiaries establish or improve sustainable livelihood opportunities and
                            encourage financial independence within the community.
                        </p>

                        <div class="news-tags">
                            <span>Financial Assistance</span>
                            <span>Livelihood Support</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>28</span>
                        <small>MAR 2026</small>
                    </div>

                    <div class="news-info">
                        <h3>Audibly Hearing Aid Assistance Program</h3>

                        <p>
                            Hearing aid assistance was provided to selected beneficiaries with hearing
                            disabilities through the Audibly Hearing Aid Assistance Program. The initiative
                            supports accessibility, communication improvement, and better quality of life
                            for individuals with hearing impairments.
                        </p>

                        <div class="news-tags">
                            <span>Medical Assistance</span>
                            <span>Hearing Disability</span>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 2025 -->
            <div class="news-year">
                <h2>2025 Programs & Activities</h2>

                <div class="news-card">
                    <div class="news-date">
                        <span>07</span>
                        <small>MAR 2025</small>
                    </div>

                    <div class="news-info">
                        <h3>Disability Awareness & Sensitivity Training Seminar</h3>

                        <p>
                            A seminar on Disability Awareness and Sensitivity Training was conducted to
                            educate participants about inclusivity, proper communication, and understanding
                            the needs of Persons with Disabilities. The activity promoted respect, awareness,
                            and equal treatment within the community.
                        </p>

                        <div class="news-tags">
                            <span>Training Seminar</span>
                            <span>Disability Awareness</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>28</span>
                        <small>APR 2025</small>
                    </div>

                    <div class="news-info">
                        <h3>Distribution of Strollers for Children with Cerebral Palsy</h3>

                        <p>
                            Identified children with Cerebral Palsy received special strollers through the
                            assistance program of the PDAO Office. The distribution aimed to provide comfort,
                            mobility support, and improved accessibility for children and their families.
                        </p>

                        <div class="news-tags">
                            <span>Medical Support</span>
                            <span>Children Assistance</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>24</span>
                        <small>JUL 2025</small>
                    </div>

                    <div class="news-info">
                        <h3>Provincial PDAO Visitation for Mental Disabilities</h3>

                        <p>
                            The Provincial Persons with Disability Affairs Office conducted a visitation and
                            monitoring activity focused on individuals with mental disabilities. The visit
                            aimed to strengthen coordination, assess community needs, and improve support
                            services for beneficiaries.
                        </p>

                        <div class="news-tags">
                            <span>Provincial Activity</span>
                            <span>Mental Disability</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>01</span>
                        <small>AUG 2025</small>
                    </div>

                    <div class="news-info">
                        <h3>National Disability Rights Week – Paragames</h3>

                        <p>
                            Persons with Disabilities actively participated in the National Disability Rights
                            Week celebration through various Paragames activities. The event highlighted
                            inclusivity, sportsmanship, empowerment, and equal opportunities for all PWDs.
                        </p>

                        <div class="news-tags">
                            <span>Sports Event</span>
                            <span>NDR Week</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>19</span>
                        <small>AUG 2025</small>
                    </div>

                    <div class="news-info">
                        <h3>Distribution of School Supplies to SPED Students</h3>

                        <p>
                            School supplies were distributed to Special Education (SPED) students to support
                            their educational needs and encourage inclusive learning opportunities. The
                            activity emphasized the importance of accessible education for every learner.
                        </p>

                        <div class="news-tags">
                            <span>Educational Assistance</span>
                            <span>SPED Program</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>26</span>
                        <small>AUG 2025</small>
                    </div>

                    <div class="news-info">
                        <h3>Anti-Bullying Symposium</h3>

                        <p>
                            An Anti-Bullying Symposium was conducted to raise awareness about bullying,
                            discrimination, and mental wellness among students and community members.
                            Participants learned the importance of respect, inclusion, and positive social
                            behavior.
                        </p>

                        <div class="news-tags">
                            <span>Youth Program</span>
                            <span>Awareness Campaign</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>05</span>
                        <small>DEC 2025</small>
                    </div>

                    <div class="news-info">
                        <h3>Rice Distribution for Persons with Disabilities</h3>

                        <p>
                            Rice assistance was distributed to qualified Persons with Disabilities as part of
                            the municipality's community support and welfare initiative. The program aimed to
                            provide relief and strengthen support for vulnerable sectors.
                        </p>

                        <div class="news-tags">
                            <span>Relief Assistance</span>
                            <span>Community Support</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>19</span>
                        <small>DEC 2025</small>
                    </div>

                    <div class="news-info">
                        <h3>Year-End Gathering of PWD Officers</h3>

                        <p>
                            PWD Officers gathered for the year-end celebration and evaluation activity.
                            The event focused on recognizing accomplishments, strengthening teamwork,
                            and planning future programs for the PWD community.
                        </p>

                        <div class="news-tags">
                            <span>Leadership Activity</span>
                            <span>Community Gathering</span>
                        </div>
                    </div>
                </div>
            </div>


            <!-- 2024 -->
            <div class="news-year">
                <h2>2024 Programs & Activities</h2>

                <div class="news-card">
                    <div class="news-date">
                        <span>28</span>
                        <small>MAY 2024</small>
                    </div>

                    <div class="news-info">
                        <h3>Stress Management & Consultative Meeting</h3>

                        <p>
                            A Stress Management and Consultative Meeting was conducted to support the mental
                            wellness and emotional well-being of Persons with Disabilities and community
                            officers. Participants engaged in discussions, consultations, and wellness
                            activities promoting healthy community relationships.
                        </p>

                        <div class="news-tags">
                            <span>Mental Wellness</span>
                            <span>Consultative Meeting</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>30</span>
                        <small>MAY 2024</small>
                    </div>

                    <div class="news-info">
                        <h3>Barangay Profiling Activity</h3>

                        <p>
                            The Barangay Profiling activity was conducted to gather updated data and
                            information regarding Persons with Disabilities in different barangays.
                            The profiling supports proper planning, monitoring, and delivery of programs
                            and services within the municipality.
                        </p>

                        <div class="news-tags">
                            <span>Community Profiling</span>
                            <span>Data Gathering</span>
                        </div>
                    </div>
                </div>

                <div class="news-card">
                    <div class="news-date">
                        <span>10</span>
                        <small>JUL 2024</small>
                    </div>

                    <div class="news-info">
                        <h3>Cerecare Foundation Folding Cane Distribution</h3>

                        <p>
                            Folding canes for visually impaired individuals were distributed through the
                            support of Cerecare Foundation Incorporated. The assistance program aimed to
                            improve mobility, independence, and accessibility for blind beneficiaries.
                        </p>

                        <div class="news-tags">
                            <span>Assistive Device</span>
                            <span>Blind Assistance</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- SIDEBAR -->
        <aside class="updates-sidebar">

            <!-- SEARCH -->
            <div class="sidebar-card">
                <h3>Search</h3>

                <div class="sidebar-search">
                    <input type="text" placeholder="Search updates...">

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
        <a href="{{ route('updates.programs') }}">
            <i class="fa-solid fa-angle-right"></i>
            Programs
        </a>

        <span>(12)</span>
        </li>

        <li>
        <a href="{{ route('updates.announcements') }}">
            <i class="fa-solid fa-angle-right"></i>
            Announcements
        </a>

        <span>(8)</span>
        </li>

        <li>
        <a href="{{ route('updates.activities') }}">
            <i class="fa-solid fa-angle-right"></i>
            Activities
        </a>

        <span>(15)</span>
        </li>

        </ul>
            </div>

            <!-- RECENT -->
            <div class="sidebar-card">
                <h3>Recent Posts</h3>

                <div class="recent-post">
                    <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="">

                    <div>
                        <h4>PWD Community Program</h4>
                        <span>March 2026</span>
                    </div>
                </div>

                <div class="recent-post">
                    <img src="{{ asset('images/update/AIDS.jpg') }}" alt="">

                    <div>
                        <h4>Medical Assistance Activity</h4>
                        <span>March 2026</span>
                    </div>
                </div>
            </div>

        </aside>
    </div>
</section>

<section class="all-updates-section hidden-all-updates" id="all-updates">
    <div class="all-updates-header">
        <div class="all-updates-inner">
            <span>All Updates</span>
            <h2>All Update Topics</h2>
            <p>
                Browse every update topic in one place. Each card includes an image so you can
                later replace it with the actual photo for that update.
            </p>
            <button id="allUpdatesToggle" class="all-updates-toggle-btn" type="button">
                Show More Updates
            </button>
        </div>
    </div>

    <div class="all-updates-grid">
        <div class="all-update-card">
            <div class="all-update-image">
                <img src="{{ asset('images/update/SEEDS.jpg') }}" alt="Seed Capital Monitoring">
            </div>
            <div class="all-update-info">
                <h3>Seed Capital – PWD Monitoring</h3>
                <span>Livelihood Program</span>
            </div>
        </div>

        <div class="all-update-card">
            <div class="all-update-image">
                <img src="{{ asset('images/update/WOMENS.jpg') }}" alt="Women's Disability Day Celebration">
            </div>
            <div class="all-update-info">
                <h3>Women's Disability Day Celebration</h3>
                <span>Women Empowerment</span>
            </div>
        </div>

        <div class="all-update-card">
            <div class="all-update-image">
                <img src="{{ asset('images/update/PARAGAMES.jpg') }}" alt="National Disability Rights Week">
            </div>
            <div class="all-update-info">
                <h3>National Disability Rights Week – Paragames</h3>
                <span>Sports Event</span>
            </div>
        </div>

        <div class="all-update-card">
            <div class="all-update-image">
                <img src="{{ asset('images/update/SPED.jpg') }}" alt="Distribution of School Supplies">
            </div>
            <div class="all-update-info">
                <h3>Distribution of School Supplies to SPED Students</h3>
                <span>Educational Assistance</span>
            </div>
        </div>

        <div class="all-update-card hidden-update-card extra-update-card">
            <div class="all-update-image">
                <img src="{{ asset('images/update/ANTI.jpg') }}" alt="Anti-Bullying Symposium">
            </div>
            <div class="all-update-info">
                <h3>Anti-Bullying Symposium</h3>
                <span>Awareness Campaign</span>
            </div>
        </div>

        <div class="all-update-card hidden-update-card extra-update-card">
            <div class="all-update-image">
                <img src="{{ asset('images/update/AID.jpg') }}" alt="Hearing Aid Assistance Program">
            </div>
            <div class="all-update-info">
                <h3>Audibly Hearing Aid Assistance Program</h3>
                <span>Medical Assistance</span>
            </div>
        </div>
    </div>
</section>

@endsection