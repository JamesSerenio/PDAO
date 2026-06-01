document.addEventListener("DOMContentLoaded", function () {
    const navbar = document.getElementById("mainNavbar");
    const pinBtn = document.getElementById("pinNavbarBtn");

    const themeToggle = document.getElementById("themeToggle");
    const themeIcon = themeToggle ? themeToggle.querySelector("i") : null;

    const searchModal = document.getElementById("searchModal");
    const openSearch = document.getElementById("openSearch");
    const closeSearch = document.getElementById("closeSearch");
    const searchOverlay = document.getElementById("searchOverlay");
    const searchInput = document.getElementById("searchInput");

    const brandTitle = document.getElementById("animatedTitle");
    const brandTagline = document.getElementById("animatedTagline");

    let hideTimeout;
    let isPinned = false;

    /* =========================
        NAVBAR FUNCTIONS
    ========================= */
    function showNavbar() {
        if (!navbar) return;
        navbar.classList.remove("nav-hidden-top");
        navbar.classList.add("nav-visible-top");
    }

    function hideNavbar() {
        if (!navbar || isPinned) return;
        navbar.classList.remove("nav-visible-top");
        navbar.classList.add("nav-hidden-top");
    }

    function resetHideTimer(delay = 1500) {
        clearTimeout(hideTimeout);

        if (isPinned) return;

        hideTimeout = setTimeout(() => {
            hideNavbar();
        }, delay);
    }

    function pinNavbar() {
        isPinned = true;
        showNavbar();
        clearTimeout(hideTimeout);

        if (pinBtn) pinBtn.classList.add("active");
    }

    function unpinNavbar() {
        isPinned = false;

        if (pinBtn) pinBtn.classList.remove("active");

        resetHideTimer(800);
    }

    function togglePin() {
        isPinned ? unpinNavbar() : pinNavbar();
    }

    /* =========================
        DARK MODE
    ========================= */
    function applyTheme(theme) {
        if (theme === "dark") {
            document.body.classList.add("dark-mode");
            if (themeIcon) {
                themeIcon.classList.remove("fa-moon");
                themeIcon.classList.add("fa-sun");
            }
        } else {
            document.body.classList.remove("dark-mode");
            if (themeIcon) {
                themeIcon.classList.remove("fa-sun");
                themeIcon.classList.add("fa-moon");
            }
        }
    }

    const savedTheme = localStorage.getItem("epdao-theme") || "light";
    applyTheme(savedTheme);

    if (themeToggle) {
        themeToggle.addEventListener("click", function () {
            const nextTheme = document.body.classList.contains("dark-mode") ? "light" : "dark";
            localStorage.setItem("epdao-theme", nextTheme);
            applyTheme(nextTheme);
            pinNavbar();
        });
    }

    /* =========================
        SEARCH MODAL
    ========================= */
    function openSearchModal() {
        if (!searchModal) return;

        searchModal.classList.add("active");
        pinNavbar();

        setTimeout(() => {
            if (searchInput) searchInput.focus();
        }, 100);
    }

    function closeSearchModal() {
        if (!searchModal) return;
        searchModal.classList.remove("active");
    }

    if (openSearch) {
        openSearch.addEventListener("click", openSearchModal);
    }

    if (closeSearch) {
        closeSearch.addEventListener("click", closeSearchModal);
    }

    if (searchOverlay) {
        searchOverlay.addEventListener("click", closeSearchModal);
    }

    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            closeSearchModal();
            unpinNavbar();
        }
    });

    /* =========================
        SEARCH CHIPS
    ========================= */
    document.querySelectorAll(".search-chip[data-url]").forEach((chip) => {
        chip.addEventListener("click", function () {
            const url = chip.getAttribute("data-url");
            if (url) {
                window.location.href = url;
            }
        });
    });

    /* =========================
        NAVBAR BEHAVIOR
    ========================= */
    if (navbar) {
        hideNavbar();

        document.addEventListener("mousemove", function (e) {
            if (e.clientY <= 80) {
                showNavbar();
                resetHideTimer();
            }
        });

        navbar.addEventListener("mouseenter", function () {
            clearTimeout(hideTimeout);
            showNavbar();
        });

        navbar.addEventListener("mouseleave", function () {
            if (!isPinned) {
                resetHideTimer(600);
            }
        });

        navbar.querySelectorAll(".drop-btn, .search-btn, .theme-btn").forEach((el) => {
            el.addEventListener("click", function () {
                if (!el.closest("#pinNavbarBtn")) {
                    pinNavbar();
                }
            });
        });
    }

    if (pinBtn) {
        pinBtn.addEventListener("click", togglePin);
    }

    let lastScroll = window.scrollY;

    window.addEventListener("scroll", function () {
        const current = window.scrollY;

        if (current < lastScroll && !isPinned) {
            showNavbar();
            resetHideTimer();
        }

        lastScroll = current;
    });

    /* =========================
        BRAND TITLE + TAGLINE ANIMATION
    ========================= */
    if (brandTitle && brandTagline) {
        function animateSequence(element, className, delayOffset) {
            const text = element.innerText;
            element.innerHTML = '';

            text.split('').forEach((char, i) => {
                const span = document.createElement('span');
                span.innerHTML = char === ' ' ? '&nbsp;' : char;
                span.className = className;
                span.style.animationDelay = `${(i * 0.08) + delayOffset}s`;
                element.appendChild(span);
            });
        }

        animateSequence(brandTitle, 'char', 0);
        animateSequence(brandTagline, 'tagline-char', 4.8);
    }

    /* =========================
        PHILIPPINE STANDARD TIME
    ========================= */
    const pstClock = document.getElementById("pstClock");

    function updatePhilippineTime() {
        if (!pstClock) return;

        const now = new Date();
        const formatted = new Intl.DateTimeFormat("en-US", {
            timeZone: "Asia/Manila",
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
            hour12: true
        }).format(now);

        pstClock.textContent = formatted;
    }

    updatePhilippineTime();
    setInterval(updatePhilippineTime, 1000);

    /* =========================
        HERO BACKGROUND CAROUSEL
    ========================= */
    const hero = document.querySelector('.hero');
    const heroBackgrounds = [
        '/images/E-Connect.png',
        '/images/PDAO_Background.png',
        '/images/LGU_Background.png'
    ];
    let heroBackgroundIndex = 0;

    function setHeroBackground(src) {
        if (!hero) return;
        hero.style.background = `linear-gradient(rgba(11,61,145,0.72), rgba(20,86,184,0.72)), url('${src}') center/cover no-repeat`;
    }

    function preloadHeroImages() {
        heroBackgrounds.forEach((src) => {
            const img = new Image();
            img.src = src;
        });
    }

    function rotateHeroBackground() {
        heroBackgroundIndex = (heroBackgroundIndex + 1) % heroBackgrounds.length;
        setHeroBackground(heroBackgrounds[heroBackgroundIndex]);
    }

    if (hero) {
        preloadHeroImages();
        setHeroBackground(heroBackgrounds[heroBackgroundIndex]);
        setInterval(rotateHeroBackground, 6500);
    }

    /* =========================
        SCROLL TO TOP BUTTON
    ========================= */
    const scrollTopBtn = document.getElementById("scrollTopBtn");

    if (scrollTopBtn) {
        scrollTopBtn.addEventListener("click", function () {
            window.scrollTo({
                top: 0,
                behavior: "smooth"
            });
        });
    }

    /* =========================
        MOBILE HAMBURGER MENU
    ========================= */
    const hamburgerBtn = document.getElementById("hamburgerBtn");
    const mobileNavMenu = document.getElementById("mobileNavMenu");

    if (hamburgerBtn && mobileNavMenu) {
        hamburgerBtn.addEventListener("click", function () {
            mobileNavMenu.classList.toggle("mobile-open");

            const icon = hamburgerBtn.querySelector("i");
            if (icon) {
                icon.classList.toggle("fa-bars");
                icon.classList.toggle("fa-xmark");
            }
        });
    }

    document.querySelectorAll(".dropdown .drop-btn").forEach((btn) => {
        btn.addEventListener("click", function () {
            if (window.innerWidth <= 992) {
                const dropdown = btn.closest(".dropdown");
                dropdown.classList.toggle("mobile-dropdown-open");
            }
        });
    });

    /* =========================================
        NEWS SEARCH (Sidebar Input)
    ========================================= */
    const newsSearchInput = document.querySelector('.sidebar-search input');
    const newsItems = document.querySelectorAll('.news-item');

    if (newsSearchInput) {
        newsSearchInput.addEventListener('keyup', function () {
            const value = this.value.toLowerCase();
            newsItems.forEach(item => {
                const text = item.innerText.toLowerCase();
                item.style.display = text.includes(value) ? 'block' : 'none';
            });
        });
    }

    /* =========================================
        CATEGORY FILTER (Sidebar Links)
    ========================================= */
    const categoryButtons = document.querySelectorAll('.category-list a[data-category]');

    categoryButtons.forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            const category = this.dataset.category;
            newsItems.forEach(item => {
                item.style.display = (item.dataset.category === category) ? 'block' : 'none';
            });
        });
    });

    /* =========================================
        ALL UPDATES TOGGLE (Show More / Less)
    ========================================= */
    const allUpdatesToggle = document.getElementById('allUpdatesToggle');
    const extraUpdateCards = document.querySelectorAll('.all-update-card.extra-update-card');

    if (allUpdatesToggle && extraUpdateCards.length) {
        allUpdatesToggle.addEventListener('click', function () {
            const expanded = this.dataset.expanded === 'true';

            extraUpdateCards.forEach(card => {
                card.classList.toggle('hidden-update-card', expanded);
            });

            this.dataset.expanded = expanded ? 'false' : 'true';
            this.textContent = expanded ? 'Show More Updates' : 'Show Less Updates';
        });
    }

    /* =========================================
        NEWS SEARCH FILTER (Main Page Global Input)
    ========================================= */
    const newsSearch = document.getElementById("newsSearch");

    if (newsSearch) {
        newsSearch.addEventListener("keyup", function () {
            let value = this.value.toLowerCase();
            let mainNewsItems = document.querySelectorAll(".news-item");

            mainNewsItems.forEach(item => {
                let text = item.innerText.toLowerCase();
                item.style.display = text.includes(value) ? "block" : "none";
            });
        });
    }

    /* =========================================
        NEWS CATEGORY FILTER (Main Page Selection)
    ========================================= */
    const mainCategoryButtons = document.querySelectorAll(".category-list a[data-category]");

    mainCategoryButtons.forEach(button => {
        button.addEventListener("click", function (e) {
            e.preventDefault();
            const category = this.dataset.category;
            if (!category) return;

            let mainNewsItems = document.querySelectorAll(".news-item");
            mainNewsItems.forEach(item => {
                item.style.display = (item.dataset.category === category) ? "block" : "none";
            });
        });
    });

    /* =========================================
        UPDATES CATEGORY FILTER (Tab Buttons with Scroll)
    ========================================= */
    const updateButtons = document.querySelectorAll(".updates-category-btn");
    const updateCards = document.querySelectorAll(".news-card");

    updateButtons.forEach(button => {
        button.addEventListener("click", function(e){
            e.preventDefault();
            const filter = this.dataset.filter;

            updateButtons.forEach(btn => {
                btn.classList.remove("active-update-category");
            });
            this.classList.add("active-update-category");

            updateCards.forEach(card => {
                if (card.dataset.type === filter) {
                    card.style.display = "flex";
                    card.classList.add("show-update-card");
                } else {
                    card.style.display = "none";
                }
            });

            const targetYear = document.querySelector(".news-year");
            if (targetYear) {
                window.scrollTo({
                    top: targetYear.offsetTop - 120,
                    behavior: "smooth"
                });
            }
        });
    });

    /* ========================================================
        🆕🛡️ PWD DIRECTORY UNIFIED VERIFICATION LOGIC
    ======================================================== */
const pwdSearchBtn = document.getElementById("pwdSearchBtn");
const pwdUnifiedInput = document.getElementById("pwdUnifiedInput");
const pwdResultBox = document.getElementById("pwdResultBox");
const pwdSuggestionBox = document.getElementById("pwdSuggestionBox");

if (pwdSearchBtn && pwdUnifiedInput && pwdResultBox) {

    pwdSearchBtn.addEventListener("click", function () {
        runPwdVerification(pwdUnifiedInput.value.trim());
    });

    pwdUnifiedInput.addEventListener("input", function () {
        fetchPwdSuggestions();
    });

    pwdUnifiedInput.addEventListener("keydown", function (e) {
        if (e.key === "Enter") {
            e.preventDefault();

            if (pwdSuggestionBox) {
                pwdSuggestionBox.style.display = "none";
            }

            runPwdVerification(pwdUnifiedInput.value.trim());
        }
    });

    document.addEventListener("click", function (e) {
        if (!e.target.closest(".search-input-wrapper") && pwdSuggestionBox) {
            pwdSuggestionBox.style.display = "none";
        }
    });

    function fetchPwdSuggestions() {
        const queryValue = pwdUnifiedInput.value.trim();

        if (!pwdSuggestionBox) return;

        if (queryValue === "") {
            pwdSuggestionBox.innerHTML = "";
            pwdSuggestionBox.style.display = "none";
            return;
        }

        fetch(`/pwd-directory/search?query=${encodeURIComponent(queryValue)}`)
            .then(response => response.json())
            .then(data => {
                pwdSuggestionBox.innerHTML = "";

                if (!data.length) {
                    pwdSuggestionBox.innerHTML = `
                        <div class="suggestion-item">
                            <div class="suggestion-name">No matching record found</div>
                            <div class="suggestion-id">Try another name or PWD ID number</div>
                        </div>
                    `;
                    pwdSuggestionBox.style.display = "block";
                    return;
                }

                data.forEach(item => {
                    const fullName = formatFullName(item);
                    const pwdId = item.pwd_id_no ? item.pwd_id_no : "No PWD ID encoded";

                    const suggestion = document.createElement("div");
                    suggestion.className = "suggestion-item";

                    suggestion.innerHTML = `
                        <div class="suggestion-name">${escapeHtml(fullName)}</div>
                        <div class="suggestion-id">PWD ID: ${escapeHtml(pwdId)} | Record ID: ${escapeHtml(item.id)}</div>
                    `;

                    suggestion.addEventListener("click", function () {
                        pwdUnifiedInput.value = item.pwd_id_no ? item.pwd_id_no : fullName;
                        pwdSuggestionBox.style.display = "none";
                        runPwdVerification(pwdUnifiedInput.value.trim());
                    });

                    pwdSuggestionBox.appendChild(suggestion);
                });

                pwdSuggestionBox.style.display = "block";
            })
            .catch(() => {
                pwdSuggestionBox.innerHTML = "";
                pwdSuggestionBox.style.display = "none";
            });
    }

    function runPwdVerification(queryValue) {
        if (queryValue === "") {
            showPwdError(
                "Please Enter a Query",
                "Input a valid PWD ID number or Full Name before running the verification system."
            );
            return;
        }

        pwdResultBox.innerHTML = `
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
        const cleanPhotoPath = record.photo_1x1
            ? record.photo_1x1.replace(/^\/+/, "")
            : "";

        const photoUrl = cleanPhotoPath
            ? `${window.location.origin}/storage/${cleanPhotoPath}`
            : `https://ui-avatars.com/api/?name=${encodeURIComponent(fullName)}&background=0B3D91&color=fff&size=200`;

            pwdResultBox.innerHTML = `
                <div class="default-result">
                    <i class="fa-solid fa-circle-check" style="color:#16a34a;"></i>
                    <h3>Record Match Found</h3>
                    <p style="margin-bottom: 12px;">This person is found in the PDAO database.</p>

                    <div style="
                        max-width: 430px;
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
                            <img 
                                src="${photoUrl}" 
                                alt="PWD Photo"
                                onerror="this.onerror=null; this.src='https://ui-avatars.com/api/?name=${encodeURIComponent(fullName)}&background=0B3D91&color=fff&size=200';"
                                style="
                                width: 105px;
                                height: 105px;
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
                    pwdResultBox.innerHTML = `
                        <div class="default-result">
                            <i class="fa-solid fa-circle-xmark" style="color: #dc2626;"></i>
                            <h3>No Record Found</h3>
                            <p style="margin-bottom: 12px;">The system cannot find any record matching your inquiry.</p>

                            <div style="background: rgba(220,38,38,0.04); padding: 12px; border-radius: 10px; margin-bottom: 15px; font-size: 14px; border: 1px solid rgba(220,38,38,0.1); text-align: left;">
                                Search Query: <strong>${escapeHtml(queryValue)}</strong><br>
                                Status: <span style="color: #dc2626; font-weight: 700;">● Unverified / Not in Database</span>
                            </div>

                            <p style="font-size: 13.5px; color: #6b7280;">
                                Please double-check the spelling or PWD ID number and try again.
                            </p>
                        </div>
                    `;
                }
            })
            .catch(() => {
                showPwdError(
                    "Database Connection Error",
                    "Unable to verify record. Please check your route, database connection, or server."
                );
            });
    }

    function formatFullName(item) {
        let middle = item.middle_name ? ` ${item.middle_name}` : "";
        let suffix = item.suffix ? ` ${item.suffix}` : "";
        return `${item.first_name ?? ""}${middle} ${item.last_name ?? ""}${suffix}`.replace(/\s+/g, " ").trim();
    }

    function showPwdError(title, description) {
        pwdResultBox.innerHTML = `
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
}
});