@extends('layouts.app')

@section('content')

<section class="contact-pro-section">
    <div class="contact-pro-container">

        <div class="contact-pro-header">
            <span class="contact-pro-badge">e-PDAO Manolo Fortich</span>
            <h1>Inquiry</h1>
            <p>
                Reach out to the Persons with Disability Affairs Office (PDAO) for questions,
                clarifications, and service-related concerns.
            </p>
        </div>

        <div class="contact-pro-grid">
            <div class="contact-pro-info-card">
                <h2>We’re Here to Help</h2>
                <p>
                    If you have questions about registration, programs, services, office procedures,
                    or assistance requests, you may send your inquiry through this page.
                </p>

                <div class="contact-pro-list">
                    <div class="contact-pro-item">
                        <i class="fa-solid fa-envelope"></i>
                        <div>
                            <strong>Email Address</strong>
                            <span>pdao@manolofortich.gov.ph</span>
                        </div>
                    </div>

                    <div class="contact-pro-item">
                        <i class="fa-solid fa-location-dot"></i>
                        <div>
                            <strong>Office Address</strong>
                            <span>New Government Center, Calanawan, Tankulan, Manolo Fortich, Bukidnon, 8703</span>
                        </div>
                    </div>

                    <div class="contact-pro-item">
                        <i class="fa-solid fa-clock"></i>
                        <div>
                            <strong>Office Hours</strong>
                            <span>Monday to Friday, 8:00 AM – 5:00 PM</span>
                        </div>
                    </div>
                </div>

                <div class="contact-pro-note">
                    <h4>Inquiry Reminder</h4>
                    <p>
                        Please provide complete and accurate details so the office can respond
                        to your concern clearly and efficiently.
                    </p>
                </div>
            </div>

            <div class="contact-pro-form-card">
                <h2>Send an Inquiry</h2>

                @if (session('success'))
                    <div class="form-success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('inquiry.submit') }}" method="POST" class="contact-pro-form">
                    @csrf

                    <div class="contact-pro-field">
                        <label for="name">Full Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter your full name">
                        @error('name') <small class="form-error">{{ $message }}</small> @enderror
                    </div>

                    <div class="contact-pro-field">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email address">
                        @error('email') <small class="form-error">{{ $message }}</small> @enderror
                    </div>

                    <div class="contact-pro-field">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" value="{{ old('subject') }}" placeholder="Enter inquiry subject">
                        @error('subject') <small class="form-error">{{ $message }}</small> @enderror
                    </div>

                    <div class="contact-pro-field">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Write your inquiry here...">{{ old('message') }}</textarea>
                        @error('message') <small class="form-error">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="contact-pro-btn primary-btn">
                        <i class="fa-solid fa-paper-plane"></i> Submit Inquiry
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection