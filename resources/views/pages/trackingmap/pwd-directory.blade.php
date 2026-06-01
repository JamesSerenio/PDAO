@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/trackingmap/pwd-directory.css') }}">

    <style>
        .suggestion-box {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            margin-top: 8px;
            z-index: 999;
            box-shadow: 0 12px 30px rgba(0,0,0,0.12);
            overflow: hidden;
            display: none;
        }

        .suggestion-item {
            padding: 12px 15px;
            cursor: pointer;
            border-bottom: 1px solid #f1f5f9;
            font-size: 14px;
        }

        .suggestion-item:hover {
            background: #f1f5f9;
        }

        .suggestion-name {
            font-weight: 700;
            color: #002855;
        }

        .suggestion-id {
            font-size: 13px;
            color: #64748b;
            margin-top: 3px;
        }

        .search-input-wrapper {
            position: relative;
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
                        <i class="fa-solid fa-building-shield"></i> PWD VERIFICATION PORTAL
                    </span>

                    <h2>Verify PWD Records</h2>
                    <p class="search-description">
                        Search by PWD ID Number or Full Name. Matching names and ID numbers will appear while typing.
                    </p>

                    <div class="search-box">
                        <div class="search-input-wrapper" style="flex: 1;">
                            <i class="fa-solid fa-magnifying-glass"></i>

                            <input
                                type="text"
                                id="pwdUnifiedInput"
                                placeholder="Enter PWD ID Number or Full Name..."
                                autocomplete="off"
                            >

                            <div id="pwdSuggestionBox" class="suggestion-box"></div>
                        </div>

                        <button type="button" id="pwdSearchBtn" class="verify-btn">
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
                    <p>This system helps verify and validate official PWD Identification Cards.</p>
                </div>

                <div class="info-card blue-card">
                    <div class="card-icon">
                        <i class="fa-solid fa-circle-question"></i>
                    </div>
                    <h3>How to Verify</h3>
                    <ul>
                        <li>Type a name or PWD ID number</li>
                        <li>Select from the suggested result</li>
                        <li>Or press Enter to search</li>
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
                    <a href="https://pwd.doh.gov.ph/tbl_pwd_id_verificationlist.php" target="_blank" class="visit-btn">
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
    const suggestionBox = document.getElementById("pwdSuggestionBox");

    unifiedInput.addEventListener("input", fetchSuggestions);

    searchBtn.addEventListener("click", () => {
        verifyPWD(unifiedInput.value.trim());
    });

    unifiedInput.addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            e.preventDefault();
            suggestionBox.style.display = "none";
            verifyPWD(unifiedInput.value.trim());
        }
    });

    document.addEventListener("click", (e) => {
        if (!e.target.closest(".search-input-wrapper")) {
            suggestionBox.style.display = "none";
        }
    });

    function fetchSuggestions() {
        const query = unifiedInput.value.trim();

        if (query.length < 1) {
            suggestionBox.innerHTML = "";
            suggestionBox.style.display = "none";
            return;
        }

        fetch(`/pwd-directory/search?query=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                suggestionBox.innerHTML = "";

                if (!data.length) {
                    suggestionBox.innerHTML = `
                        <div class="suggestion-item">
                            <div class="suggestion-name">No matching record found</div>
                            <div class="suggestion-id">Try another name or PWD ID number</div>
                        </div>
                    `;
                    suggestionBox.style.display = "block";
                    return;
                }

                data.forEach(item => {
                    const fullName = formatFullName(item);
                    const pwdId = item.pwd_id_no ? item.pwd_id_no : "No PWD ID encoded";

                    const div = document.createElement("div");
                    div.classList.add("suggestion-item");

                    div.innerHTML = `
                        <div class="suggestion-name">${escapeHtml(fullName)}</div>
                        <div class="suggestion-id">PWD ID: ${escapeHtml(pwdId)} | Record ID: ${escapeHtml(item.id)}</div>
                    `;

                    div.addEventListener("click", () => {
                        unifiedInput.value = item.pwd_id_no ? item.pwd_id_no : fullName;
                        suggestionBox.style.display = "none";
                        verifyPWD(unifiedInput.value.trim());
                    });

                    suggestionBox.appendChild(div);
                });

                suggestionBox.style.display = "block";
            });
    }

    function verifyPWD(queryValue) {
        if (queryValue === "") {
            showError("Please Enter a Query", "Input a valid PWD ID number or Full Name before running the verification system.");
            return;
        }

        resultBox.innerHTML = `
            <div class="default-result">
                <i class="fa-solid fa-spinner fa-spin" style="color: #002855;"></i>
                <h3 style="margin-top:15px;">Scanning PDAO Database...</h3>
                <p>Please wait while checking registration records.</p>
            </div>
        `;

        fetch(`/pwd-directory/verify?query=${encodeURIComponent(queryValue)}`)
            .then(response => response.json())
            .then(data => {
                if (data.found) {
                    const record = data.record;
                    const fullName = formatFullName(record);
                    const pwdId = record.pwd_id_no ? record.pwd_id_no : "No PWD ID encoded";

                    const photoUrl = record.photo_1x1
                        ? `/storage/${record.photo_1x1}`
                        : `https://ui-avatars.com/api/?name=${encodeURIComponent(fullName)}&background=0B3D91&color=fff&size=200`;

                    resultBox.innerHTML = `
                        <div class="default-result">
                            <i class="fa-solid fa-circle-check" style="color:#16a34a;"></i>
                            <h3>Record Match Found</h3>
                            <p style="margin-bottom: 12px;">This person is found in the PDAO database.</p>

                            <div style="
                                max-width: 460px;
                                margin: 0 auto 18px auto;
                                background: linear-gradient(135deg, #ffffff, #eef5ff);
                                border: 2px solid #0b3d91;
                                border-radius: 18px;
                                overflow: hidden;
                                text-align: left;
                                box-shadow: 0 14px 30px rgba(0,0,0,0.12);
                            ">
                                <div style="
                                    background: #0b3d91;
                                    color: white;
                                    padding: 10px 14px;
                                    text-align: center;
                                    font-weight: 800;
                                    letter-spacing: .5px;
                                ">
                                    PWD IDENTIFICATION RECORD
                                </div>

                                <div style="display: flex; gap: 14px; padding: 16px; align-items: center;">
                                    <img src="${photoUrl}" alt="PWD Photo" style="
                                        width: 110px;
                                        height: 110px;
                                        object-fit: cover;
                                        border-radius: 12px;
                                        border: 3px solid #facc15;
                                        background: #e5e7eb;
                                    ">

                                    <div style="font-size: 14px; line-height: 1.55;">
                                        <div><strong>Name:</strong> ${escapeHtml(fullName)}</div>
                                        <div><strong>PWD ID:</strong> ${escapeHtml(pwdId)}</div>
                                        <div><strong>Record ID:</strong> ${escapeHtml(record.id)}</div>
                                        <div><strong>Barangay:</strong> ${escapeHtml(record.barangay ?? "Not encoded")}</div>
                                        <div><strong>Municipality:</strong> ${escapeHtml(record.municipality ?? "Not encoded")}</div>
                                        <div>
                                            <strong>Status:</strong>
                                            <span style="color:#16a34a; font-weight:800;">● Active Registered</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <a href="https://pwd.doh.gov.ph/tbl_pwd_id_verificationlist.php" target="_blank" class="visit-btn">
                                Cross-Check with National DOH
                            </a>
                        </div>
                    `;
                } else {
                    resultBox.innerHTML = `
                        <div class="default-result">
                            <i class="fa-solid fa-circle-xmark" style="color: #dc2626;"></i>
                            <h3>No Record Found</h3>
                            <p style="margin-bottom: 12px;">The system cannot find any record matching your inquiry.</p>

                            <div style="background: rgba(220,38,38,0.04); padding: 12px; border-radius: 10px; margin-bottom: 15px; font-size: 14px; border: 1px solid rgba(220,38,38,0.1); text-align: left;">
                                Search Query: <strong>${escapeHtml(queryValue)}</strong><br>
                                Status: <span style="color: #dc2626; font-weight: 700;">● Unverified / Not in Database</span>
                            </div>
                        </div>
                    `;
                }
            })
            .catch(() => {
                showError("Database Connection Error", "Unable to verify record. Please check your route, database connection, or server.");
            });
    }

    function formatFullName(item) {
        let middle = item.middle_name ? ` ${item.middle_name}` : "";
        let suffix = item.suffix ? ` ${item.suffix}` : "";
        return `${item.first_name ?? ""}${middle} ${item.last_name ?? ""}${suffix}`.replace(/\s+/g, " ").trim();
    }

    function showError(title, description) {
        resultBox.innerHTML = `
            <div class="default-result">
                <i class="fa-solid fa-circle-exclamation" style="color: #dc2626;"></i>
                <h3>${escapeHtml(title)}</h3>
                <p>${escapeHtml(description)}</p>
            </div>
        `;
    }

    function escapeHtml(text) {
        return String(text)
            .replaceAll("&", "&amp;")
            .replaceAll("<", "&lt;")
            .replaceAll(">", "&gt;")
            .replaceAll('"', "&quot;")
            .replaceAll("'", "&#039;");
    }
});
</script>
@endpush