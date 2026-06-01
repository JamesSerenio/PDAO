@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trackingmap/pwd-report.css') }}">
@endpush

@section('content')

<section class="report-hero">
    <div class="report-overlay"></div>
    <div class="container">
        <div class="report-hero-content">
            <span class="report-badge">e-PDAO Manolo Fortich</span>
            <h1>REPORT A CONCERN</h1>
            <p>
                Submit complaints, concerns, accessibility issues,
                discrimination reports, or requests related to
                Persons with Disabilities (PWDs) in Manolo Fortich.
                Your report helps improve accessibility and inclusivity.
            </p>
        </div>
    </div>
</section>

<section class="report-section">
    <div class="container">
        <div class="report-wrapper">

            <div class="report-left">
                <div class="report-card">
                    <div class="report-header">
                        <span class="report-small-title">e-PDAO Reporting Portal</span>
                        <h2>Reporting & Assistance Center</h2>
                        <p>
                            Please fill out the form below with accurate details. You may choose to submit this report anonymously if you wish to protect your privacy.
                        </p>
                    </div>

                    <div id="formAlert" class="form-alert d-none"></div>

                    <form id="pwdConcernForm" class="interactive-report-form">
                        @csrf
                        <div class="form-grid-2">
                            <div class="form-group">
                                <label for="reporter_name">Full Name <small>(Optional)</small></label>
                                <input type="text" id="reporter_name" name="name" placeholder="Juan Dela Cruz">
                            </div>
                            <div class="form-group">
                                <label for="reporter_contact">Contact Number <small>(Required)</small></label>
                                <input type="text" id="reporter_contact" name="contact" placeholder="0917XXXXXXX" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="concern_type">Nature of Concern</label>
                            <select id="concern_type" name="concern_type" required>
                                <option value="" disabled selected>Select the type of issue...</option>
                                <option value="accessibility">Accessibility Barrier (Ramps, PWD Lanes, etc.)</option>
                                <option value="discrimination">Discrimination / Unfair Treatment</option>
                                <option value="abuse">Abuse or Exploitation Case</option>
                                <option value="benefits">PWD Benefits & Discounts Issues</option>
                                <option value="others">Other Concerns / General Assistance</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="concern_details">Detailed Description</label>
                            <textarea id="concern_details" name="details" rows="5" placeholder="Provide as much details as possible (What happened, Where, When...)" required></textarea>
                        </div>

                        <button type="submit" class="submit-portal-btn">
                            <i class="fa-solid fa-paper-plane"></i> Submit Report Securely
                        </button>
                    </form>
                </div>
            </div>

            <div class="report-right">
                <div class="info-card">
                    <div class="info-icon"><i class="fa-solid fa-circle-info"></i></div>
                    <h3>How it Works</h3>
                    <ul class="info-list">
                        <li>Fill out the secure online portal form accurately.</li>
                        <li>Your report is immediately routed to the PDAO Officer.</li>
                        <li>An official will review and reach out via your contact number.</li>
                        <li>Strict confidentiality is maintained at all times.</li>
                    </ul>
                </div>

                <div class="info-card ra-card">
                    <div class="info-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                    <h3>Republic Act No. 10754</h3>
                    <p>An Act expanding the benefits and privileges of Persons with Disability (PWD).</p>
                    <div class="ra-benefits">
                        <div class="ra-item"><i class="fa-solid fa-check"></i> <span>20% Discount & VAT Exemption</span></div>
                        <div class="ra-item"><i class="fa-solid fa-check"></i> <span>Educational Assistance Priority</span></div>
                        <div class="ra-item"><i class="fa-solid fa-check"></i> <span>Express / Priority Lane Privileges</span></div>
                    </div>
                    <div class="ra-reminder">
                        <i class="fa-solid fa-thumbtack"></i>
                        <span>Violations of RA 10754 can be reported directly through this portal for proper legal actions.</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const form = document.getElementById("pwdConcernForm");
    const alertBox = document.getElementById("formAlert");

    form.addEventListener("submit", function(e) {
        e.preventDefault();

        // Disable target button simulation
        const btn = form.querySelector('.submit-portal-btn');
        btn.disabled = true;
        btn.innerHTML = `<i class="fa-solid fa-spinner fa-spin"></i> Submitting Report...`;

        // Simulate AJAX request
        setTimeout(() => {
            alertBox.className = "form-alert success-alert";
            alertBox.innerHTML = `
                <i class="fa-solid fa-circle-check"></i>
                <div>
                    <strong>Report Submitted Successfully!</strong><br>
                    Thank you for reaching out. A PDAO administrator will review your concern shortly.
                </div>
            `;

            form.reset();
            btn.disabled = false;
            btn.innerHTML = `<i class="fa-solid fa-paper-plane"></i> Submit Report Securely`;

            // Auto scroll down to view alert smoothly
            alertBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 1500);
    });
});
</script>
@endpush