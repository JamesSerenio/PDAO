@extends('layouts.app')

@push('styles')
    {{-- Tinatawag natin ang in-update nating css kanina --}}
    <link rel="stylesheet" href="{{ asset('css/trackingmap/pwd-directory.css') }}">
@endpush

@section('content')

<section class="pwd-directory-hero">
    <div class="hero-overlay"></div>
    <div class="container">
        <div class="hero-content">
            <span class="hero-badge">e-PDAO Manolo Fortich</span>
            <h1>
                PWD DIRECTORY <br>VERIFICATION SYSTEM
            </h1>
            <p>
                Verify registered Persons with Disabilities through the
                official PWD identification verification portal.
                Fast, secure, and accessible verification for everyone.
            </p>
        </div>
    </div>
</section>

<section class="directory-main-section">
    <div class="container">
        <div class="directory-wrapper">

            {{-- KALIWANG BAHAGI: ANG PINAG-ISANG SEARCH CARD --}}
            <div class="directory-left">
                <div class="directory-search-card">
                    <div class="card-top-accent"></div>
                    <span class="small-title">
                        PWD VERIFICATION PORTAL
                    </span>
                    <h2>Verify PWD Records</h2>
                    <p class="search-description">
                        Type the **PWD ID Number** or the person's **Full Name** in the input field below to validate registration logs inside the local e-PDAO system.
                    </p>

                    <div class="search-box">
                        <label class="unified-search-label" for="pwdUnifiedInput">Search Query</label>
                        <div class="search-input-wrapper">
                            <i class="fa-solid fa-magnifying-glass"></i>
                            <input
                                type="text"
                                id="pwdUnifiedInput"
                                placeholder="Enter PWD ID (e.g., 10-1234-000) or Full Name..."
                                autocomplete="off"
                            >
                        </div>

                        <button
                            type="button"
                            id="pwdSearchBtn"
                            class="verify-btn"
                        >
                            <i class="fa-solid fa-shield-halved"></i>
                            Verify Record
                        </button>
                    </div>

                    {{-- DYNAMIC RESULT BOX --}}
                    <div class="result-container" id="pwdResultBox">
                        <div class="default-result">
                            <i class="fa-solid fa-circle-info"></i>
                            <h3>Verification Result</h3>
                            <p>
                                Search a valid PWD ID number or Full Name
                                to display the verification result.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- KANANG BAHAGI: SIDEBAR INFO CARDS --}}
            <div class="directory-right">
                <div class="info-card yellow-card">
                    <div class="card-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>
                    <h3>Secure Verification</h3>
                    <p>
                        This system helps verify and validate
                        official PWD Identification Cards.
                    </p>
                </div>

                <div class="info-card blue-card">
                    <div class="card-icon">
                        <i class="fa-solid fa-circle-question"></i>
                    </div>
                    <h3>How to Verify</h3>
                    <ul>
                        <li>Type the complete ID Number OR Full Name</li>
                        <li>Ensure standard spelling or correct format</li>
                        <li>Click the Verify Record button</li>
                        <li>Check the active database feedback</li>
                    </ul>
                </div>

                <div class="info-card white-card">
                    <div class="card-icon">
                        <i class="fa-solid fa-building-shield"></i>
                    </div>
                    <h3>Official DOH Verification</h3>
                    <p>
                        Continue verification through the
                        official Department of Health website.
                    </p>
                    <a
                        href="https://pwd.doh.gov.ph/tbl_pwd_id_verificationlist.php"
                        target="_blank"
                        class="visit-btn"
                    >
                        Visit DOH Website
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {
    const searchBtn = document.getElementById("pwdSearchBtn");
    const unifiedInput = document.getElementById("pwdUnifiedInput");
    const resultBox = document.getElementById("pwdResultBox");

    searchBtn.addEventListener("click", verifyPWD);

    // Nakikinig sa Enter key para sa madaling pag-search
    unifiedInput.addEventListener("keypress", (e) => {
        if(e.key === "Enter") verifyPWD();
    });

    function verifyPWD() {
        const queryValue = unifiedInput.value.trim();

        // 1. INPUT VALIDATION (Kapag walang laman)
        if (queryValue === "") {
            showError(
                "Please Enter Your Search Query",
                "Input a valid PWD ID number or a Person's Name before initializing the verification sequence."
            );
            return;
        }

        // 2. SMART IDENTIFICATION (Awtomatikong tinitignan kung ID o Pangalan gamit ang Regex)
        const hasNumbers = /\d/.test(queryValue);
        let detectedTypeHTML = "";

        if (hasNumbers) {
            detectedTypeHTML = `Detected Input Type: <strong>PWD ID Number</strong><br>Query: <strong>${queryValue}</strong>`;
        } else {
            detectedTypeHTML = `Detected Input Type: <strong>Full Name Query</strong><br>Query: <strong>${queryValue}</strong>`;
        }

        // 3. LOADING STATE ANIMATION
        resultBox.innerHTML = `
            <div class="default-result">
                <i class="fa-solid fa-spinner fa-spin"></i>
                <h3 style="margin-top:15px;">Scanning PDAO Database...</h3>
                <p>Please wait while checking registration logs for any matching records.</p>
            </div>
        `;

        // 4. SIMULATED BACKEND RESPONSE (1.8s Timeout)
        setTimeout(() => {
            resultBox.innerHTML = `
                <div class="default-result">
                    <i class="fa-solid fa-circle-check" style="color:#16a34a;"></i>
                    <h3>Record Match Found</h3>
                    <p style="margin-bottom: 12px;">The system successfully processed your tracking inquiry across the database registry.</p>
                    <div style="background: rgba(0,40,85,0.04); padding: 14px; border-radius: 12px; margin-bottom: 15px; font-size: 14px; text-align: left; line-height: 1.6; color: #334155;">
                        ${detectedTypeHTML} <br>
                        Verification Status: <span style="color: #16a34a; font-weight: 700;">● Active Registered Member</span>
                    </div>
                    <a href="https://pwd.doh.gov.ph/tbl_pwd_id_verificationlist.php" target="_blank" class="visit-btn">
                        Cross-Check with National DOH
                    </a>
                </div>
            `;
        }, 1800);
    }

    function showError(title, description) {
        resultBox.innerHTML = `
            <div class="default-result">
                <i class="fa-solid fa-circle-exclamation" style="color: #dc2626;"></i>
                <h3>${title}</h3>
                <p>${description}</p>
            </div>
        `;
    }
});
</script>
@endpush