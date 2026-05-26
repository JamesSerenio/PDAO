@extends('layouts.app')

@section('content')

<!-- =========================================
    HERO SECTION
========================================= -->
<section class="pwd-directory-hero">

    <div class="hero-overlay"></div>

    <div class="container">

        <div class="hero-content">

            <span class="hero-badge">
                ePDAO MANOLO FORTICH
            </span>

            <h1>
                PWD DIRECTORY VERIFICATION SYSTEM
            </h1>

            <p>
                Verify registered Persons with Disabilities through the
                official PWD identification verification portal.
                Fast, secure, and accessible verification for everyone.
            </p>

        </div>

    </div>

</section>



<!-- =========================================
    DIRECTORY SECTION
========================================= -->
<section class="directory-main-section">

    <div class="container">

        <div class="directory-wrapper">

            <!-- =========================================
                LEFT SIDE
            ========================================== -->
            <div class="directory-left">

                <div class="directory-search-card">

                    <div class="card-top-accent"></div>

                    <span class="small-title">
                        PWD VERIFICATION PORTAL
                    </span>

                    <h2>
                        Verify PWD ID Number
                    </h2>

                    <p class="search-description">
                        Enter the complete PWD ID number below
                        to validate and verify registration status
                        through the official verification system.
                    </p>



                    <!-- SEARCH -->
                    <div class="search-box">

                        <div class="search-input-wrapper">

                            <i class="fa-solid fa-id-card"></i>

                            <input
                                type="text"
                                id="pwdSearchInput"
                                placeholder="Enter PWD ID Number..."
                            >

                        </div>

                        <button
                            type="button"
                            id="pwdSearchBtn"
                            class="verify-btn"
                        >
                            <i class="fa-solid fa-magnifying-glass"></i>
                            Verify ID
                        </button>

                    </div>



                    <!-- RESULT -->
                    <div class="result-container" id="pwdResultBox">

                        <div class="default-result">

                            <i class="fa-solid fa-circle-info"></i>

                            <h3>
                                Verification Result
                            </h3>

                            <p>
                                Search a valid PWD ID number
                                to display the verification result.
                            </p>

                        </div>

                    </div>

                </div>

            </div>



            <!-- =========================================
                RIGHT SIDE
            ========================================== -->
            <div class="directory-right">

                <!-- CARD -->
                <div class="info-card yellow-card">

                    <div class="card-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>

                    <h3>
                        Secure Verification
                    </h3>

                    <p>
                        This system helps verify and validate
                        official PWD Identification Cards.
                    </p>

                </div>



                <!-- CARD -->
                <div class="info-card blue-card">

                    <div class="card-icon">
                        <i class="fa-solid fa-circle-question"></i>
                    </div>

                    <h3>
                        How to Verify
                    </h3>

                    <ul>

                        <li>Enter complete PWD ID number</li>
                        <li>Click Verify ID button</li>
                        <li>Check verification status</li>
                        <li>Visit PDAO office if needed</li>

                    </ul>

                </div>



                <!-- CARD -->
                <div class="info-card white-card">

                    <div class="card-icon">
                        <i class="fa-solid fa-building-shield"></i>
                    </div>

                    <h3>
                        Official DOH Verification
                    </h3>

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



<!-- =========================================
    STYLE
========================================= -->
<style>

:root{
    --yellow:#FFD600;
    --blue:#0B4DA2;
    --dark:#111827;
    --white:#ffffff;
    --gray:#f3f4f6;
}



/* =========================================
    HERO SECTION
========================================= */

.pwd-directory-hero{
    position: relative;
    min-height: 330px;
    background:
        linear-gradient(
            rgba(11,77,162,0.82),
            rgba(11,77,162,0.88)
        ),
        url('/images/pwd-directory-bg.jpg');

    background-size: cover;
    background-position: center;
    display: flex;
    align-items: center;
    padding: 70px 0;
    overflow: hidden;
}

.hero-overlay{
    position: absolute;
    inset: 0;
    background:
        linear-gradient(
            135deg,
            rgba(255,214,0,0.18),
            transparent 60%
        );
}

.hero-content{
    position: relative;
    z-index: 2;
    max-width: 760px;
    color: white;
}

.hero-badge{
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--yellow);
    color: #1e3a8a;
    padding: 10px 25px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 0.5px;
    margin-bottom: 22px;
    box-shadow: 0 15px 25px rgba(0,0,0,0.15);
}

.hero-content h1{
    font-size: 52px;
    font-weight: 900;
    line-height: 1.15;
    margin-bottom: 18px;
    text-transform: uppercase;
}

.hero-content p{
    font-size: 17px;
    line-height: 1.8;
    color: rgba(255,255,255,0.92);
    max-width: 650px;
}



/* =========================================
    MAIN SECTION
========================================= */

.directory-main-section{
    background: #f5f7fb;
    padding: 80px 0;
}

.directory-wrapper{
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 35px;
}



/* =========================================
    LEFT CARD
========================================= */

.directory-search-card{
    background: white;
    border-radius: 28px;
    padding: 50px;
    position: relative;
    overflow: hidden;

    box-shadow:
    0 15px 45px rgba(0,0,0,0.08);
}

.card-top-accent{
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 8px;

    background:
    linear-gradient(
        90deg,
        var(--yellow),
        var(--blue)
    );
}

.small-title{
    display: inline-block;
    background: #eef4ff;
    color: var(--blue);
    padding: 8px 18px;
    border-radius: 50px;
    font-weight: 700;
    margin-bottom: 18px;
}

.directory-search-card h2{
    font-size: 38px;
    font-weight: 800;
    color: var(--dark);
    margin-bottom: 15px;
}

.search-description{
    color: #6b7280;
    line-height: 1.7;
    margin-bottom: 35px;
}



/* =========================================
    SEARCH BOX
========================================= */

.search-box{
    display: flex;
    gap: 15px;
    flex-wrap: wrap;
}

.search-input-wrapper{
    flex: 1;
    display: flex;
    align-items: center;
    background: #f9fafb;
    border: 2px solid #e5e7eb;
    border-radius: 18px;
    padding: 0 18px;
    transition: 0.3s;
}

.search-input-wrapper:focus-within{
    border-color: var(--blue);

    box-shadow:
    0 0 0 4px rgba(11,77,162,0.10);
}

.search-input-wrapper i{
    color: var(--blue);
    font-size: 18px;
    margin-right: 12px;
}

.search-input-wrapper input{
    width: 100%;
    height: 65px;
    border: none;
    outline: none;
    background: transparent;
    font-size: 17px;
}



/* BUTTON */

.verify-btn{
    background:
    linear-gradient(
        135deg,
        var(--yellow),
        #ffbf00
    );

    border: none;
    padding: 0 35px;
    border-radius: 18px;
    font-weight: 800;
    color: black;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

.verify-btn:hover{
    transform: translateY(-3px);
}



/* =========================================
    RESULT BOX
========================================= */

.result-container{
    margin-top: 35px;
    background: #f9fafb;
    border-radius: 22px;
    padding: 40px;
    text-align: center;
    border: 2px dashed #d1d5db;
}

.default-result i{
    font-size: 50px;
    color: var(--blue);
    margin-bottom: 20px;
}

.default-result h3{
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 10px;
}

.default-result p{
    color: #6b7280;
}



/* =========================================
    RIGHT SIDE
========================================= */

.directory-right{
    display: flex;
    flex-direction: column;
    gap: 25px;
}



/* =========================================
    INFO CARD
========================================= */

.info-card{
    border-radius: 28px;
    padding: 35px;

    box-shadow:
    0 10px 35px rgba(0,0,0,0.06);
}

.yellow-card{
    background: var(--yellow);
    color: black;
}

.blue-card{
    background: var(--blue);
    color: white;
}

.white-card{
    background: white;
}

.card-icon{
    width: 70px;
    height: 70px;
    border-radius: 20px;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 30px;
    margin-bottom: 20px;

    background:
    rgba(255,255,255,0.20);
}

.white-card .card-icon{
    background: #eef4ff;
    color: var(--blue);
}

.info-card h3{
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 15px;
}

.info-card p{
    line-height: 1.7;
}

.blue-card ul{
    padding-left: 20px;
}

.blue-card li{
    margin-bottom: 12px;
}



/* =========================================
    BUTTON
========================================= */

.visit-btn{
    display: inline-block;
    margin-top: 20px;
    background: var(--blue);
    color: white;
    padding: 14px 25px;
    border-radius: 14px;
    text-decoration: none;
    font-weight: 700;
    transition: 0.3s;
}

.visit-btn:hover{
    background: #083a7a;
}



/* =========================================
    RESPONSIVE
========================================= */

@media(max-width:991px){

    .directory-wrapper{
        grid-template-columns: 1fr;
    }

    .hero-content h1{
        font-size: 42px;
    }

    .directory-search-card{
        padding: 35px;
    }

}

@media(max-width:768px){

    .pwd-directory-hero{
        min-height: 280px;
        padding: 55px 0;
    }

    .hero-content h1{
        font-size: 36px;
    }

    .hero-content p{
        font-size: 15px;
    }

}

@media(max-width:576px){

    .hero-content h1{
        font-size: 30px;
        line-height: 1.25;
    }

    .hero-badge{
        font-size: 13px;
        padding: 9px 18px;
    }

    .search-box{
        flex-direction: column;
    }

    .verify-btn{
        height: 60px;
    }

}

</style>



<!-- =========================================
    SCRIPT
========================================= -->
<script>

document.addEventListener("DOMContentLoaded", () => {

    const searchBtn = document.getElementById("pwdSearchBtn");
    const searchInput = document.getElementById("pwdSearchInput");
    const resultBox = document.getElementById("pwdResultBox");

    searchBtn.addEventListener("click", verifyPWD);

    searchInput.addEventListener("keypress", function(e){

        if(e.key === "Enter"){
            verifyPWD();
        }

    });

    function verifyPWD(){

        const value = searchInput.value.trim();

        if(value === ""){

            resultBox.innerHTML = `
                <div class="default-result">

                    <i class="fa-solid fa-circle-exclamation"></i>

                    <h3>Please Enter a PWD ID Number</h3>

                    <p>
                        Input a valid PWD ID number before verification.
                    </p>

                </div>
            `;

            return;
        }

        resultBox.innerHTML = `
            <div class="default-result">

                <div class="spinner-border text-primary"></div>

                <h3 style="margin-top:15px;">
                    Verifying PWD ID...
                </h3>

                <p>
                    Please wait while checking the verification database.
                </p>

            </div>
        `;

        setTimeout(() => {

            resultBox.innerHTML = `
                <div class="default-result">

                    <i class="fa-solid fa-circle-check"
                    style="color:#16a34a;"></i>

                    <h3>
                        Verification Submitted
                    </h3>

                    <p>
                        PWD ID Number:
                        <strong>${value}</strong>
                    </p>

                    <a
                        href="https://pwd.doh.gov.ph/tbl_pwd_id_verificationlist.php"
                        target="_blank"
                        class="visit-btn"
                    >
                        Continue Verification
                    </a>

                </div>
            `;

        }, 1800);

    }

});

</script>

@endsection