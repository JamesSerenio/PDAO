@extends('layouts.app')

@section('content')

<!-- =========================
   HERO SECTION
========================= -->
<section class="hero" id="home">
    <div class="hero-content">

        <div class="hero-text">
            <div class="hero-badge">e-PDAO Manolo Fortich</div>

            <h1>Empowering Persons with Disabilities Through Technology</h1>

            <p>
                A digital platform that connects PWDs with essential services,
                assistance programs, and real-time tracking of support systems.
            </p>


        </div>

        <div class="hero-card">
            <h3>Quick Access</h3>
            <p>Report concerns, register as PWD, or explore available services instantly.</p>
        </div>

    </div>
</section>

<!-- =========================
   GET TO KNOW US
========================= -->
<!-- =========================
   HISTORICAL BACKGROUND
========================= -->
<section class="history-section" id="history">

    <div class="history-overlay"></div>

    <div class="container">

        <div class="history-wrapper">

            <!-- LEFT CONTENT -->
            <div class="history-content">

                <span class="history-badge">
                    e-PDAO History
                </span>

                <h2>
                    Historical Background <br>
                    of e-PDAO <br>
                    Manolo Fortich
                </h2>

                <p>
                    The Persons with Disability Affairs Office (PDAO)
                    of Manolo Fortich was established to strengthen
                    programs, protection, and support services for
                    Persons with Disabilities within the municipality.
                </p>

                <p>
                    In 2022, the municipality started the consolidation
                    and digitization of PWD records to improve
                    accessibility, monitoring, and service delivery.
                    This initiative led to the development of the
                    <strong>e-PDAO Manolo Fortich</strong> system —
                    a modern platform designed for verification,
                    registration monitoring, concern reporting,
                    and centralized management of PWD information.
                </p>

                <div class="history-buttons">

                    <a href="{{ route('history') }}" class="history-btn primary-btn">
                        Read Full History
                    </a>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="history-cards">

                <div class="history-card">

                    <div class="history-icon">
                        <i class="fa-solid fa-landmark"></i>
                    </div>

                    <h3>
                        Established Programs
                    </h3>

                    <p>
                        Strengthening inclusive programs,
                        assistance, and protection for PWDs.
                    </p>

                </div>



                <div class="history-card">

                    <div class="history-icon">
                        <i class="fa-solid fa-database"></i>
                    </div>

                    <h3>
                        Digital Consolidation
                    </h3>

                    <p>
                        Organized and digitized records
                        for efficient monitoring and services.
                    </p>

                </div>



                <div class="history-card">

                    <div class="history-icon">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>

                    <h3>
                        Community Coordination
                    </h3>

                    <p>
                        Continuous coordination with barangays
                        and partner organizations.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   VISION SECTION
========================= -->
<section class="vision-section" id="vision">

    <div class="vision-overlay"></div>

    <div class="container">

        <div class="vision-wrapper">

            <div class="vision-content">

                <span class="vision-badge">
                    e-PDAO Vision
                </span>

                <h2>
                    Creating an Inclusive <br>
                    and Accessible Future <br>
                    for Every PWD
                </h2>

                <p>
                    The e-PDAO Manolo Fortich envisions a community
                    where Persons with Disabilities are empowered,
                    respected, and given equal opportunities through
                    accessible technology, inclusive governance,
                    and sustainable support systems.
                </p>

                <div class="vision-buttons">

                    <a href="{{ route('vision') }}" class="vision-btn primary-btn">
                        Read Full Vision
                    </a>

                    </div>

            </div>

            <div class="vision-cards">

                <div class="vision-card">

                    <div class="vision-icon">
                        <i class="fa-solid fa-globe"></i>
                    </div>

                    <h3>
                        Inclusive Community
                    </h3>

                    <p>
                        Promoting equality and participation
                        for all Persons with Disabilities.
                    </p>

                </div>

                <div class="vision-card">

                    <div class="vision-icon">
                        <i class="fa-solid fa-laptop"></i>
                    </div>

                    <h3>
                        Digital Accessibility
                    </h3>

                    <p>
                        Strengthening accessible digital
                        services and information systems.
                    </p>

                </div>

                <div class="vision-card">

                    <div class="vision-icon">
                        <i class="fa-solid fa-handshake-angle"></i>
                    </div>

                    <h3>
                        Sustainable Support
                    </h3>

                    <p>
                        Building long-term programs that
                        empower and protect every PWD.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   MISSION SECTION
========================= -->
<section class="mission-section" id="mission">

    <div class="mission-overlay"></div>

    <div class="container">

        <div class="mission-wrapper">

            <!-- LEFT CONTENT -->
            <div class="mission-content">

                <span class="mission-badge">
                    e-PDAO Mission
                </span>

                <h2>
                    Building Inclusive <br>
                    Communities Through <br>
                    Accessible Services
                </h2>

                <p>
                    The e-PDAO Manolo Fortich is committed to providing
                    accessible, inclusive, and technology-driven services
                    that empower Persons with Disabilities through
                    community-based programs, responsive assistance,
                    and sustainable development initiatives.
                </p>

                <div class="mission-buttons">

                    <a href="{{ route('mission') }}" class="mission-btn primary-btn">
                        Read Full Mission
                    </a>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="mission-cards">

                <div class="mission-card">

                    <div class="mission-icon">
                        <i class="fa-solid fa-wheelchair"></i>
                    </div>

                    <h3>
                        Accessibility
                    </h3>

                    <p>
                        Improving access to programs,
                        government services, and support systems.
                    </p>

                </div>



                <div class="mission-card">

                    <div class="mission-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h3>
                        Inclusion
                    </h3>

                    <p>
                        Promoting equal opportunities and
                        active participation in the community.
                    </p>

                </div>

                <div class="mission-card">

                    <div class="mission-icon">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>

                    <h3>
                        Empowerment
                    </h3>

                    <p>
                        Supporting independence through
                        education, healthcare, and livelihood.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   GOALS SECTION
========================= -->
<section class="goals-section" id="goals">

    <div class="goals-overlay"></div>

    <div class="container">

        <div class="goals-wrapper">

            <!-- LEFT CONTENT -->
            <div class="goals-content">

                <span class="goals-badge">
                    e-PDAO Goals
                </span>

                <h2>
                    Strengthening Inclusive <br>
                    Programs and Services <br>
                    for Every PWD
                </h2>

                <p>
                    The e-PDAO Manolo Fortich continuously works
                    toward improving accessibility, service delivery,
                    and community participation through responsive
                    programs and technology-driven initiatives for
                    Persons with Disabilities.
                </p>

                <div class="goals-buttons">

                    <a href="{{ route('goals') }}" class="goals-btn primary-btn">
                        Read Full Goals
                    </a>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="goals-cards">

                <div class="goals-card">

                    <div class="goals-icon">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>

                    <h3>
                        Productive
                    </h3>

                    <p>
                        Promoting equal access to opportunities,
                        programs, and sustainable livelihood support.
                    </p>

                </div>



                <div class="goals-card">

                    <div class="goals-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h3>
                        Resilient
                    </h3>

                    <p>
                        Building stronger and responsive support
                        systems for every member of the community.
                    </p>

                </div>



                <div class="goals-card">

                    <div class="goals-icon">
                        <i class="fa-solid fa-hand-holding-heart"></i>
                    </div>

                    <h3>
                        Empowered
                    </h3>

                    <p>
                        Encouraging independence, participation,
                        and inclusive community engagement.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   ORGANIZATIONAL STRUCTURE
========================= -->
<section class="org-section" id="org-chart">

    <div class="org-overlay"></div>

    <div class="container">

        <div class="org-wrapper">

            <!-- LEFT CONTENT -->
            <div class="org-content">

                <span class="org-badge">
                    e-PDAO Structure
                </span>

                <h2>
                    Organizational <br>
                    Structure of <br>
                    e-PDAO Manolo Fortich
                </h2>

                <p>
                    The organizational structure of the e-PDAO
                    Manolo Fortich strengthens coordination,
                    leadership, and implementation of inclusive
                    programs and services for Persons with Disabilities
                    across all barangays.
                </p>

                <p>
                    Through collaboration among municipal offices,
                    barangay coordinators, federation officers,
                    and partner organizations, the office ensures
                    proper delivery of assistance, monitoring,
                    and community-based programs.
                </p>

                <div class="org-buttons">

                    <a href="{{ route('organizational-chart') }}" class="org-btn primary-btn">
                        View Full Structure
                    </a>

                </div>

            </div>

            <!-- RIGHT SIDE -->
            <div class="org-cards">

                <div class="org-card">

                    <div class="org-icon">
                        <i class="fa-solid fa-building"></i>
                    </div>

                    <h3>
                        Leadership
                    </h3>

                    <p>
                        Organized leadership and coordination
                        for effective program implementation.
                    </p>

                </div>



                <div class="org-card">

                    <div class="org-icon">
                        <i class="fa-solid fa-users-gear"></i>
                    </div>

                    <h3>
                        Coordination
                    </h3>

                    <p>
                        Strengthening communication between
                        barangays and partner organizations.
                    </p>

                </div>



                <div class="org-card">

                    <div class="org-icon">
                        <i class="fa-solid fa-handshake"></i>
                    </div>

                    <h3>
                        Community Support
                    </h3>

                    <p>
                        Ensuring inclusive services and support
                        systems for every registered PWD.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   TRACKING MAP REPORT CONCERN
========================= -->

<section class="report-vision-section">
    <div class="report-vision-container">

        <div class="report-vision-grid">

            <div class="report-vision-info">

                <div class="report-vision-indicator">
                    <span class="track-parent-vision"><i class="fa-solid fa-map-location-dot"></i> Tracking Map Pages</span>
                    <i class="fa-solid fa-chevron-right track-divider-vision"></i>
                    <span class="track-current-vision">Report Concern Portal</span>
                </div>

                <h2 class="report-vision-title">Report a Concern or Accessibility Issue</h2>

                <p class="report-vision-description">
                    Mayroon ka bang nais isangguni o iulat tungkol sa mga pasilidad, diskriminasyon, o tulong na kinakailangan ng ating mga Persons with Disabilities sa Manolo Fortich?
                </p>

                <p class="report-vision-description">
                    Ang e-PDAO ay laging nakahandang makinig at umaksyon upang masigurong ligtas, inklusibo, at may pantay na oportunidad ang bawat isa sa ating komunidad.
                </p>

                <div class="report-vision-meta">
                    <div class="meta-vision-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>PDAO Hotline: <strong>(088) 123-4567</strong></span>
                    </div>
                    <div class="meta-vision-item">
                        <i class="fa-solid fa-envelope"></i>
                        <span>Email: <strong>pdao@manolofortich.gov.ph</strong></span>
                    </div>
                </div>
            </div>

            <div class="report-vision-form-card portal-gateway-card">

                <div class="gateway-header">
                    <div class="gateway-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <h3>e-PDAO Public Assistance Portal</h3>
                    <p>Mabilis, ligtas, at direktang pag-uulat sa pamahalaan ng Manolo Fortich.</p>
                </div>

                <div class="gateway-features">
                    <div class="g-feature-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <strong>Accessibility Barriers</strong>
                            <p>Mga sirang rampa, harang sa PWD lane, o kawalan ng access.</p>
                        </div>
                    </div>

                    <div class="g-feature-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <strong>Discrimination & Rights</strong>
                            <p>Paglabag sa karapatan, diskriminasyon, o hindi pagtanggap ng discounts.</p>
                        </div>
                    </div>

                    <div class="g-feature-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <div>
                            <strong>General Assistance</strong>
                            <p>Kahilingan para sa ayuda, suporta sa pamilya, o PWD ID verification.</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('report-concern') }}" class="report-vision-submit-btn gateway-btn">
                   Proceed to Reporting Form <i class="fa-solid fa-arrow-right-to-bracket"></i>
                </a>

            </div>

        </div>

    </div>
</section>

<!-- =========================
   PWD REGISTRATION SECTION
========================= -->
<section class="registration-section" id="pwd-registration">

    <div class="registration-overlay"></div>

    <div class="container">

        <div class="registration-wrapper">

            <!-- LEFT SIDE -->
            <div class="registration-cards">

                <div class="registration-card">

                    <div class="registration-icon">
                        <i class="fa-solid fa-id-card"></i>
                    </div>

                    <h3>
                        e-PDAO Online Registration
                    </h3>

                    <p>
                        Simplified registration process for
                        new Persons with Disabilities.
                    </p>

                </div>



                <div class="registration-card">

                    <div class="registration-icon">
                        <i class="fa-solid fa-file-circle-check"></i>
                    </div>

                    <h3>
                        Verified Documents
                    </h3>

                    <p>
                        Secure validation of submitted
                        requirements and information.
                    </p>

                </div>

            </div>



            <!-- RIGHT CONTENT -->
            <div class="registration-content">

                <span class="registration-badge">
                    e-PDAO PWD Registration
                </span>

                <h2>
                    Secure & Organized <br>
                    Registration System
                </h2>

                <p>
                    The e-PDAO Manolo Fortich registration system
                    provides a centralized and accessible platform
                    for registering Persons with Disabilities while
                    improving records management, monitoring,
                    and coordination across barangays.
                </p>

                <a href="{{ route('pwd-registration') }}" class="registration-btn">
                    Learn More
                </a>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   PWD DIRECTORY SECTION
========================= -->
<section class="directory-section" id="pwd-directory">

    <div class="directory-overlay"></div>

    <div class="container">

        <div class="directory-wrapper">

            <!-- LEFT CONTENT -->
            <div class="directory-content">

                <span class="directory-badge">
                    e-PDAO Directory
                </span>

                <h2>
                    PWD Directory <br>
                    Verification System
                </h2>

                <p>
                    The e-PDAO Manolo Fortich PWD Directory serves as a
                    centralized verification platform for registered
                    Persons with Disabilities within the municipality.
                    It helps ensure accurate records, proper identification,
                    and accessible verification of PWD information.
                </p>

                <div class="directory-highlight">

                    <div class="highlight-item">
                        <i class="fa-solid fa-id-card"></i>
                        Verified PWD Identification
                    </div>

                    <div class="highlight-item">
                        <i class="fa-solid fa-database"></i>
                        Centralized PWD Records
                    </div>

                    <div class="highlight-item">
                        <i class="fa-solid fa-shield-heart"></i>
                        Safe & Secure Verification
                    </div>

                </div>

                <a href="{{ route('pwd-directory') }}" class="directory-btn">
                    Open PWD Directory
                </a>

            </div>

            <!-- RIGHT SIDE -->
            <div class="directory-cards">

                <div class="directory-card">

                    <div class="directory-icon">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>

                    <h3>
                        Easy Verification
                    </h3>

                    <p>
                        Quickly verify PWD ID records through the
                        official e-PDAO verification portal.
                    </p>

                </div>

                <div class="directory-card">

                    <div class="directory-icon">
                        <i class="fa-solid fa-users"></i>
                    </div>

                    <h3>
                        Organized Database
                    </h3>

                    <p>
                        Maintains organized and updated records
                        of registered PWD members.
                    </p>

                </div>

                <div class="directory-card">

                    <div class="directory-icon">
                        <i class="fa-solid fa-wheelchair"></i>
                    </div>

                    <h3>
                        Inclusive Access
                    </h3>

                    <p>
                        Supports accessibility and inclusive
                        public service for every individual.
                    </p>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   SERVICES SECTION
========================= -->
<section class="services-section" id="available-programs">

    <div class="services-overlay"></div>

    <div class="container">

        <div class="services-header">
            <span class="services-badge">
                e-PDAO Services
            </span>
            <h2>
                Available Programs
            </h2>
            <p>
                Explore inclusive programs and support services designed to empower Persons with Disabilities in Manolo Fortich.
            </p>
        </div>

        <div class="services-carousel-container">
            <div class="services-grid">

                <div class="service-card">
                    <div>
                        <div class="service-icon"><i class="fa-solid fa-handshake-angle"></i></div>
                        <h3>Educational Assistance</h3>
                        <p>Providing scholarship programs and financial aid for qualified students with disabilities.</p>
                    </div>
                    <a href="{{ route('educational-assistance') }}" class="service-btn">
                        Read Full Program <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card">
                    <div>
                        <div class="service-icon"><i class="fa-solid fa-wheelchair"></i></div>
                        <h3>Medical Assistance</h3>
                        <p>Distribution of assistive devices, medical supplies, and health support programs.</p>
                    </div>
                    <a href="{{ route('medical-assistance') }}" class="service-btn">
                        Read Full Program <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card">
                    <div>
                        <div class="service-icon"><i class="fa-solid fa-briefcase"></i></div>
                        <h3>Livelihood Support</h3>
                        <p>Skills training and employment opportunities tailored for capability building.</p>
                    </div>
                    <a href="{{ route('livelihood-programs') }}" class="service-btn">
                        Read Full Program <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>


                <div class="service-card" aria-hidden="true">
                    <div>
                        <div class="service-icon"><i class="fa-solid fa-handshake-angle"></i></div>
                        <h3>Educational Assistance</h3>
                        <p>Providing scholarship programs and financial aid for qualified students with disabilities.</p>
                    </div>
                    <a href="{{ route('educational-assistance') }}" class="service-btn">
                        Read Full Program <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card" aria-hidden="true">
                    <div>
                        <div class="service-icon"><i class="fa-solid fa-wheelchair"></i></div>
                        <h3>Medical Assistance</h3>
                        <p>Distribution of assistive devices, medical supplies, and health support programs.</p>
                    </div>
                    <a href="{{ route('medical-assistance') }}" class="service-btn">
                        Read Full Program <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

                <div class="service-card" aria-hidden="true">
                    <div>
                        <div class="service-icon"><i class="fa-solid fa-briefcase"></i></div>
                        <h3>Livelihood Support</h3>
                        <p>Skills training and employment opportunities tailored for capability building.</p>
                    </div>
                    <a href="{{ route('livelihood-programs') }}" class="service-btn">
                        Read Full Program <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>

    </div>

</section>
<!-- =========================
   CONTACT
========================= -->
<!-- =========================
   INQUIRY SECTION
========================= -->
<section class="inquiry-section" id="inquiry">

    <div class="inquiry-overlay"></div>

    <div class="container">

        <div class="inquiry-wrapper">

            <!-- LEFT CONTENT -->
            <div class="inquiry-content">

                <span class="inquiry-badge">
                    e-PDAO Contact Us
                </span>

                <h2>
                    Inquiry & Assistance
                </h2>

                <p>
                    The e-PDAO Manolo Fortich is committed to providing
                    accessible communication and support services for
                    Persons with Disabilities, families, and community
                    members seeking information and assistance.
                </p>

                <div class="inquiry-features">

                    <div class="inquiry-feature">
                        <i class="fa-solid fa-circle-check"></i>
                        Assistance & program inquiries
                    </div>

                    <div class="inquiry-feature">
                        <i class="fa-solid fa-circle-check"></i>
                        Registration concerns & verification
                    </div>

                    <div class="inquiry-feature">
                        <i class="fa-solid fa-circle-check"></i>
                        Accessible and responsive communication
                    </div>

                </div>

                <a href="{{ route('inquiry') }}" class="inquiry-btn">
                    Send Inquiry
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>



            <!-- RIGHT CARD -->
            <div class="inquiry-card">

                <div class="inquiry-icon">
                    <i class="fa-solid fa-envelope-open-text"></i>
                </div>

                <h3>
                    Need Assistance?
                </h3>

                <p>
                    Reach out to the e-PDAO office for questions,
                    support services, program details, and other
                    disability-related concerns.
                </p>

                <div class="inquiry-contact-box">

                    <div class="contact-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <span>Manolo Fortich, Bukidnon</span>
                    </div>

                    <div class="contact-item">
                        <i class="fa-solid fa-phone"></i>
                        <span>Available during office hours</span>
                    </div>

                    <div class="contact-item">
                        <i class="fa-solid fa-users"></i>
                        <span>Inclusive & community-based support</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   FEEDBACK SECTION
========================= -->
<section class="feedback-section" id="feedback">

    <div class="feedback-overlay"></div>

    <div class="container">

        <div class="feedback-wrapper">

            <!-- LEFT CONTENT -->
            <div class="feedback-content">

                <span class="feedback-badge">
                    e-PDAO Community Feedback
                </span>

                <h2>
                    Your Voice Matters
                </h2>

                <p>
                    The e-PDAO Manolo Fortich values the experiences,
                    suggestions, and feedback of Persons with Disabilities,
                    families, and community members to continuously improve
                    accessibility, services, and inclusive programs.
                </p>

                <div class="feedback-features">

                    <div class="feedback-feature">
                        <i class="fa-solid fa-star"></i>
                        Service improvement recommendations
                    </div>

                    <div class="feedback-feature">
                        <i class="fa-solid fa-star"></i>
                        Program evaluation and suggestions
                    </div>

                    <div class="feedback-feature">
                        <i class="fa-solid fa-star"></i>
                        Inclusive and community-driven support
                    </div>

                </div>

                <a href="{{ route('feedback') }}" class="feedback-btn">
                    Send Feedback
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>

            <!-- RIGHT CARD -->
            <div class="feedback-card">

                <div class="feedback-icon">
                    <i class="fa-solid fa-comments"></i>
                </div>

                <h3>
                    Help Us Improve
                </h3>

                <p>
                    Your feedback helps the e-PDAO office strengthen
                    programs, improve accessibility, and deliver better
                    services for the PWD community.
                </p>

                <div class="feedback-box">

                    <div class="feedback-item">
                        <i class="fa-solid fa-check"></i>
                        <span>Share service experiences</span>
                    </div>

                    <div class="feedback-item">
                        <i class="fa-solid fa-check"></i>
                        <span>Recommend improvements</span>
                    </div>

                    <div class="feedback-item">
                        <i class="fa-solid fa-check"></i>
                        <span>Support inclusive governance</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

<!-- =========================
   OFFICE LOCATION SECTION
========================= -->
<section class="office-section" id="office-location">

    <div class="office-overlay"></div>

    <div class="container">

        <div class="office-wrapper">

            <!-- LEFT CONTENT -->
            <div class="office-content">

                <span class="office-badge">
                    e-PDAO Office Location
                </span>

                <h2>
                    Visit the e-PDAO Office
                </h2>

                <p>
                    The e-PDAO Manolo Fortich office is open to assist
                    Persons with Disabilities, families, and community
                    members with registration, verification, programs,
                    and other disability-related services.
                </p>

                <div class="office-features">

                    <div class="office-feature">
                        <i class="fa-solid fa-location-dot"></i>
                        Accessible office location
                    </div>

                    <div class="office-feature">
                        <i class="fa-solid fa-building"></i>
                        Inclusive government services
                    </div>

                    <div class="office-feature">
                        <i class="fa-solid fa-users"></i>
                        Community-based support assistance
                    </div>

                </div>

                <a href="https://maps.google.com" target="_blank" class="office-btn">
                    View Location
                    <i class="fa-solid fa-arrow-right"></i>
                </a>

            </div>



            <!-- RIGHT CARD -->
            <div class="office-card">

                <div class="office-icon">
                    <i class="fa-solid fa-map-location-dot"></i>
                </div>

                <h3>
                    Municipality of Manolo Fortich
                </h3>

                <p>
                    Visit the office during official working hours for
                    registration concerns, verification assistance,
                    inquiries, and community support programs.
                </p>

                <div class="office-box">

                    <div class="office-item">
                        <i class="fa-solid fa-location-pin"></i>
                        <span>Manolo Fortich, Bukidnon</span>
                    </div>

                    <div class="office-item">
                        <i class="fa-solid fa-clock"></i>
                        <span>Monday - Friday Office Hours <br>
                        <strong>8:00 AM – 5:00 PM</strong>
                        </span>
                    </div>

                    <div class="office-item">
                        <i class="fa-solid fa-wheelchair"></i>
                        <span>PWD Accessible Environment</span>
                    </div>

                </div>

            </div>

        </div>

    </div>

</section>

@endsection