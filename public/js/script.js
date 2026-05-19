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
});