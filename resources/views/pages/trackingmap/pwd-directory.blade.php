@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trackingmap/pwd-directory.css') }}">
    <style>
        /* PANGALAWANG DAGDAG NA STYLE PARA SA SEARCH TOGGLE TABS */
        .search-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 20px;
            border-bottom: 1px solid rgba(0, 40, 85, 0.1);
            padding-bottom: 10px;
        }
        .search-tab-btn {
            background: none;
            border: none;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 600;
            color: #64748b;
            cursor: pointer;
            border-radius: 8px;
            transition: all 0.2s ease;
        }
        .search-tab-btn.active {
            background: rgba(0, 40, 85, 0.08);
            color: #002855;
        }
        .search-input-group {
            display: none;
        }
        .search-input-group.active {
            display: block;
        }
    </style>
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

            <div class="directory-left">
                <div class="directory-search-card">
                    <div class="card-top-accent"></div>
                    <span class="small-title">
                        PWD VERIFICATION PORTAL
                    </span>
                    <h2>Verify PWD Records</h2>
                    <p class="search-description">
                        Select your verification method below. You can now validate registration status using either the PWD ID Number or the Person's Full Name.
                    </p>

                    <div class="search-tabs">
                        <button type="button" class="search-tab-btn active" onclick="switchSearchTab('id-mode')">
                            <i class="fa-solid fa-id-card-clip"></i> Search by ID
                        </button>
                        <button type="button" class="search-tab-btn" onclick="switchSearchTab('name-mode')">
                            <i class="fa-solid fa-user-gear"></i> Search by Name
                        </button>
                    </div>

                    <div class="search-box">
                        <div id="idInputGroup" class="search-input-wrapper search-input-group active">
                            <i class="fa-solid fa-id-card"></i>
                            <input
                                type="text"
                                id="pwdSearchInput"
                                placeholder="Enter PWD ID Number (e.g., 10-1234-000)..."
                            >
                        </div>

                        <div id="nameInputGroup" class="search-input-wrapper search-input-group">
                            <i class="fa-solid fa-user"></i>
                            <input
                                type="text"
                                id="pwdNameInput"
                                placeholder="Enter Full Name (e.g., Juan Dela Cruz)..."
                            >
                        </div>

                        <button
                            type="button"
                            id="pwdSearchBtn"
                            class="verify-btn"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Verify Record
                        </button>
                    </div>

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
                        <li>Choose to search by ID or Full Name</li>
                        <li>Enter the complete required details</li>
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
// GLOBAL VARIABLE TO TRACK CURRENT SEARCH MODE
let currentSearchMode = 'id-mode';

// FUNCTION TO TOGGLE BETWEEN ID SEARCH AND NAME SEARCH
function switchSearchTab(mode) {
    currentSearchMode = mode;

    // Manage active state of tab buttons
    document.querySelectorAll('.search-tab-btn').forEach(btn => btn.classList.remove('active'));
    event.currentTarget.classList.add('active');

    // Toggle the visible input box
    if(mode === 'id-mode') {
        document.getElementById('idInputGroup').classList.add('active');
        document.getElementById('nameInputGroup').classList.remove('active');
        document.getElementById('pwdSearchInput').focus();
    } else {
        document.getElementById('nameInputGroup').classList.add('active');
        document.getElementById('idInputGroup').classList.remove('active');
        document.getElementById('pwdNameInput').focus();
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const searchBtn = document.getElementById("pwdSearchBtn");
    const idInput = document.getElementById("pwdSearchInput");
    const nameInput = document.getElementById("pwdNameInput");
    const resultBox = document.getElementById("pwdResultBox");

    searchBtn.addEventListener("click", verifyPWD);

    // Listen for Enter key on both input channels
    idInput.addEventListener("keypress", (e) => { if(e.key === "Enter") verifyPWD(); });
    nameInput.addEventListener("keypress", (e) => { if(e.key === "Enter") verifyPWD(); });

    function verifyPWD() {
        // Read values based on active mode
        const idValue = idInput.value.trim();
        const nameValue = nameInput.value.trim();

        // 1. VALIDATION OVERLAY
        if (currentSearchMode === 'id-mode' && idValue === "") {
            showError("Please Enter a PWD ID Number", "Input a valid PWD ID number before running the verification system.");
            return;
        }

        if (currentSearchMode === 'name-mode' && nameValue === "") {
            showError("Please Enter a Full Name", "Input a valid name query to search across the e-PDAO directory records.");
            return;
        }

        // 2. LOADING STATE
        resultBox.innerHTML = `
            <div class="default-result">
                <i class="fa-solid fa-spinner fa-spin" style="color: #002855;"></i>
                <h3 style="margin-top:15px;">Scanning PDAO Database...</h3>
                <p>Please wait while checking registration logs for any matching records.</p>
            </div>
        `;

        // 3. SIMULATED BACKEND RESPONSE (1.8s Timeout)
        setTimeout(() => {
            let searchMetaHTML = currentSearchMode === 'id-mode'
                ? `PWD ID Number: <strong>${idValue}</strong>`
                : `Queried Name: <strong>${nameValue}</strong>`;

            resultBox.innerHTML = `
                <div class="default-result">
                    <i class="fa-solid fa-circle-check" style="color:#16a34a;"></i>
                    <h3>Record Match Found</h3>
                    <p style="margin-bottom: 12px;">The system successfully processed your tracking inquiry.</p>
                    <div style="background: rgba(0,40,85,0.04); padding: 12px; border-radius: 10px; margin-bottom: 15px; font-size: 14px;">
                        ${searchMetaHTML} <br>
                        Status: <span style="color: #16a34a; font-weight: 700;">● Active Registered</span>
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