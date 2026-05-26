@extends('layouts.app')

@section('content')

<section class="contact-pro-section">
    <div class="contact-pro-container">

        <div class="contact-pro-header">
            <span class="contact-pro-badge">e-PDAO Manolo Fortich</span>
            <h1>Feedback</h1>
            <p>
                Share your experience, suggestions, and comments to help improve the quality
                of services provided by the Persons with Disability Affairs Office (PDAO).
            </p>
        </div>

        <div class="contact-pro-grid">
            <div class="contact-pro-info-card">
                <h2>Your Feedback Matters</h2>
                <p>
                    We value your comments, suggestions, and service experience.
                    Your feedback helps us improve accessibility, responsiveness,
                    and the quality of public service for everyone.
                </p>

                <div class="contact-pro-list">
                    <div class="contact-pro-item">
                        <i class="fa-solid fa-comment-dots"></i>
                        <div>
                            <strong>Purpose</strong>
                            <span>To gather comments, suggestions, and service impressions</span>
                        </div>
                    </div>

                    <div class="contact-pro-item">
                        <i class="fa-solid fa-handshake-angle"></i>
                        <div>
                            <strong>Commitment</strong>
                            <span>We are committed to improving inclusion and service delivery</span>
                        </div>
                    </div>

                    <div class="contact-pro-item">
                        <i class="fa-solid fa-shield-heart"></i>
                        <div>
                            <strong>Respect</strong>
                            <span>All feedback is treated with professionalism and respect</span>
                        </div>
                    </div>
                </div>

                <div class="contact-pro-note">
                    <h4>Feedback Reminder</h4>
                    <p>
                        Please keep your comments respectful, specific, and constructive
                        so they can be reviewed properly by the office.
                    </p>
                </div>
            </div>

            <div class="contact-pro-form-card">
                <h2>Send Feedback</h2>

                @if (session('success'))
                    <div class="form-success-message">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('feedback.submit') }}" method="POST" class="contact-pro-form">
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
                        <label for="category">Feedback Category</label>
                        <select id="category" name="category">
                            <option value="">Select category</option>
                            <option value="service" {{ old('category') == 'service' ? 'selected' : '' }}>Service Quality</option>
                            <option value="website" {{ old('category') == 'website' ? 'selected' : '' }}>Website Experience</option>
                            <option value="accessibility" {{ old('category') == 'accessibility' ? 'selected' : '' }}>Accessibility</option>
                            <option value="suggestion" {{ old('category') == 'suggestion' ? 'selected' : '' }}>Suggestion</option>
                            <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('category') <small class="form-error">{{ $message }}</small> @enderror
                    </div>

                    <div class="contact-pro-field">
                        <label for="message">Feedback Message</label>
                        <textarea id="message" name="message" rows="6" placeholder="Write your feedback here...">{{ old('message') }}</textarea>
                        @error('message') <small class="form-error">{{ $message }}</small> @enderror
                    </div>

                    <button type="submit" class="contact-pro-btn secondary-btn">
                        <i class="fa-solid fa-paper-plane"></i> Submit Feedback
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection