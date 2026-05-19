@extends('layouts.app')

@section('content')
<section class="hero-section text-center" id="help-center">
    <div class="container">
        <h1 class="hero-title">Help Center</h1>
        <p class="hero-subtitle">We are here to guide and support you in using e-PDAO Connect.</p>
    </div>
</section>

<section class="services-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="vmg-title">How Can We Help You?</h2>
            <p class="vmg-text">
                e-PDAO Connect was created to make services more accessible, understandable, and inclusive for everyone.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <div class="service-card text-start">
                    <h4>Using the Website</h4>
                    <p>
                        Learn how to navigate the site, access services, locate contact details, and explore the digital
                        support tools available through e-PDAO Connect.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="service-card text-start">
                    <h4>Submitting Concerns</h4>
                    <p>
                        If you need assistance with reporting a concern or submitting a request, make sure to provide complete
                        and accurate details so the office can respond properly.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="service-card text-start">
                    <h4>PWD Registration Assistance</h4>
                    <p>
                        For questions related to registration requirements, eligibility, or follow-up processes, you may use
                        the help channels and contact information provided on the site.
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="service-card text-start">
                    <h4>Technical Support</h4>
                    <p>
                        If you experience page errors, loading issues, missing information, or accessibility problems,
                        please reach out so we can improve your experience and restore access as soon as possible.
                    </p>
                </div>
            </div>
        </div>

        <div class="goal-card mt-5 text-center">
            Need more assistance? Visit the Contact Us section and send us your message.<br>
            <strong>Konektado ang Tanan, Walay Mabilin.</strong>
        </div>
    </div>
</section>
@endsection