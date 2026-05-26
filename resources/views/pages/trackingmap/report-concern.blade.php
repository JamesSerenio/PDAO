@extends('layouts.app')

@section('content')

<!-- =========================================
    HERO SECTION
========================================= -->
<section class="report-hero">

    <div class="report-overlay"></div>

    <div class="container">

        <div class="report-hero-content">

            <span class="report-badge">
                e-PDAO Manolo Fortich
            </span>

            <h1>
                REPORT A CONCERN
            </h1>

            <p>
                Submit complaints, concerns, accessibility issues,
                discrimination reports, or requests related to
                Persons with Disabilities (PWDs) in Manolo Fortich.
                Your report helps improve accessibility,
                inclusivity, and protection for all PWD members.
            </p>

        </div>

    </div>

</section>



<!-- =========================================
    REPORT SECTION
========================================= -->
<section class="report-section">

    <div class="container">

        <div class="report-wrapper">

            <!-- LEFT -->
            <div class="report-left">

                <div class="report-card">

                    <div class="report-header">

                        <span class="report-small-title">
                            e-PDAO Reporting Portal
                        </span>

                        <h2>
                            Reporting & Assistance Center
                        </h2>

                        <p>
                            The e-PDAO Manolo Fortich system allows
                            individuals to report issues involving
                            accessibility barriers, discrimination,
                            abuse, lack of PWD accommodations,
                            and other concerns affecting
                            Persons with Disabilities.
                        </p>

                    </div>

                    <!-- FEATURES -->
                    <div class="report-grid">

                        <div class="report-box">
                            <div class="report-icon">
                                <i class="fa-solid fa-file-circle-exclamation"></i>
                            </div>

                            <h3>
                                Reports
                            </h3>

                            <p>
                                Submit official complaints
                                and accessibility concerns.
                            </p>
                        </div>


                        <div class="report-box">
                            <div class="report-icon">
                                <i class="fa-solid fa-shield-heart"></i>
                            </div>

                            <h3>
                                Protection
                            </h3>

                            <p>
                                Support for PWD rights,
                                welfare, and safety.
                            </p>
                        </div>


                        <div class="report-box">
                            <div class="report-icon">
                                <i class="fa-solid fa-universal-access"></i>
                            </div>

                            <h3>
                                Accessibility
                            </h3>

                            <p>
                                Report inaccessible
                                facilities and services.
                            </p>
                        </div>


                        <div class="report-box">
                            <div class="report-icon">
                                <i class="fa-solid fa-handshake-angle"></i>
                            </div>

                            <h3>
                                Assistance
                            </h3>

                            <p>
                                Request guidance and
                                support from PDAO.
                            </p>
                        </div>

                    </div>

                </div>

            </div>



            <!-- RIGHT -->
            <div class="report-right">

                <!-- REPORT CARD -->
                <div class="info-card">

                    <div class="info-icon">
                        <i class="fa-solid fa-circle-info"></i>
                    </div>

                    <h3>
                        How to Submit a Concern
                    </h3>

                    <ul class="info-list">

                        <li>
                            Prepare complete concern details
                        </li>

                        <li>
                            Include valid PWD information
                        </li>

                        <li>
                            Attach supporting documents if needed
                        </li>

                        <li>
                            Submit directly to the PDAO office
                        </li>

                    </ul>

                </div>



                <!-- RA10754 CARD -->
                <div class="info-card ra-card">

                    <div class="info-icon">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>

                    <h3>
                        Republic Act No. 10754
                    </h3>

                    <p>
                        An Act expanding the benefits and privileges
                        of Persons with Disability (PWD).
                    </p>

                    <div class="ra-benefits">

                        <div class="ra-item">
                            <i class="fa-solid fa-check"></i>
                            <span>20% Discount & VAT Exemption</span>
                        </div>

                        <div class="ra-item">
                            <i class="fa-solid fa-check"></i>
                            <span>Educational Assistance</span>
                        </div>

                        <div class="ra-item">
                            <i class="fa-solid fa-check"></i>
                            <span>Priority Lane Privileges</span>
                        </div>

                        <div class="ra-item">
                            <i class="fa-solid fa-check"></i>
                            <span>Special Discounts</span>
                        </div>

                        <div class="ra-item">
                            <i class="fa-solid fa-check"></i>
                            <span>Support for Families & Caregivers</span>
                        </div>

                    </div>

                    <div class="ra-reminder">
                        <i class="fa-solid fa-thumbtack"></i>

                        <span>
                            Always bring a valid PWD ID
                            to avail official benefits.
                        </span>
                    </div>

                </div>



                <!-- ACTION CARD -->
                <div class="info-card action-card">

                    <div class="info-icon">
                        <i class="fa-solid fa-paper-plane"></i>
                    </div>

                    <h3>
                        Need Immediate Assistance?
                    </h3>

                    <p>
                        Visit the e-PDAO Office of
                        Manolo Fortich for proper
                        assistance and verification.
                    </p>

                    <a href="#" class="report-btn">
                        Submit Concern
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

body{
    background:#f5f8ff;
    font-family:'Poppins',sans-serif;
}


/* HERO */
.report-hero{
    position:relative;
    padding:90px 0 70px;
    background:
    linear-gradient(
        rgba(0,40,120,.82),
        rgba(0,40,120,.88)
    ),
    url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?q=80&w=1400')
    center/cover no-repeat;
    overflow:hidden;
}

.report-overlay{
    position:absolute;
    inset:0;
    background:
    linear-gradient(
        135deg,
        rgba(255,215,0,.15),
        transparent
    );
}

.report-hero-content{
    position:relative;
    z-index:2;
    max-width:750px;
    color:#fff;
}

.report-badge{
    display:inline-block;
    background:#ffd400;
    color:#002f86;
    font-weight:700;
    padding:10px 20px;
    border-radius:50px;
    margin-bottom:18px;
    font-size:14px;
    letter-spacing:.5px;
}

.report-hero-content h1{
    font-size:58px;
    line-height:1.1;
    font-weight:800;
    margin-bottom:20px;
}

.report-hero-content p{
    font-size:18px;
    line-height:1.8;
    color:#e7ecff;
}


/* SECTION */
.report-section{
    padding:80px 0;
}

.report-wrapper{
    display:grid;
    grid-template-columns:1.5fr 1fr;
    gap:35px;
}

.report-card{
    background:#fff;
    border-radius:25px;
    padding:45px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.report-small-title{
    color:#f2b400;
    font-weight:700;
    font-size:14px;
    text-transform:uppercase;
    letter-spacing:1px;
}

.report-header h2{
    font-size:38px;
    color:#002f86;
    margin:12px 0;
    font-weight:800;
}

.report-header p{
    color:#5d6785;
    line-height:1.8;
    margin-bottom:35px;
}


/* GRID */
.report-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:25px;
}

.report-box{
    background:#f7faff;
    border:2px solid #eef2ff;
    border-radius:20px;
    padding:30px;
    transition:.3s;
}

.report-box:hover{
    transform:translateY(-6px);
    border-color:#ffd400;
}

.report-icon{
    width:65px;
    height:65px;
    background:#002f86;
    color:#ffd400;
    display:flex;
    align-items:center;
    justify-content:center;
    border-radius:18px;
    font-size:28px;
    margin-bottom:18px;
}

.report-box h3{
    color:#002f86;
    font-size:22px;
    margin-bottom:10px;
    font-weight:700;
}

.report-box p{
    color:#5d6785;
    line-height:1.7;
}


/* RIGHT */
.report-right{
    display:flex;
    flex-direction:column;
    gap:25px;
}

.info-card{
    background:#fff;
    border-radius:22px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.07);
}

.info-icon{
    width:65px;
    height:65px;
    background:#ffd400;
    color:#002f86;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    margin-bottom:20px;
}

.info-card h3{
    font-size:28px;
    color:#002f86;
    margin-bottom:15px;
    font-weight:800;
}

.info-card p{
    color:#5d6785;
    line-height:1.8;
}

.info-list{
    padding-left:18px;
    color:#5d6785;
}

.info-list li{
    margin-bottom:12px;
    line-height:1.7;
}


/* RA CARD */
.ra-card{
    background:
    linear-gradient(
        135deg,
        #002f86,
        #004ec2
    );
    color:#fff;
}

.ra-card h3,
.ra-card p{
    color:#fff;
}

.ra-benefits{
    margin-top:20px;
}

.ra-item{
    display:flex;
    align-items:flex-start;
    gap:12px;
    margin-bottom:15px;
}

.ra-item i{
    color:#ffd400;
    margin-top:4px;
}

.ra-reminder{
    margin-top:25px;
    background:rgba(255,255,255,.12);
    border-left:4px solid #ffd400;
    padding:15px;
    border-radius:12px;
    display:flex;
    gap:12px;
    align-items:flex-start;
}

.ra-reminder i{
    color:#ffd400;
}


/* BUTTON */
.report-btn{
    display:inline-block;
    margin-top:18px;
    background:#ffd400;
    color:#002f86;
    padding:14px 28px;
    border-radius:50px;
    text-decoration:none;
    font-weight:700;
    transition:.3s;
}

.report-btn:hover{
    background:#002f86;
    color:#fff;
}


/* RESPONSIVE */
@media(max-width:991px){

    .report-wrapper{
        grid-template-columns:1fr;
    }

    .report-hero-content h1{
        font-size:42px;
    }

}

@media(max-width:768px){

    .report-grid{
        grid-template-columns:1fr;
    }

    .report-card{
        padding:30px;
    }

    .info-card{
        padding:28px;
    }

    .report-hero{
        padding:70px 0 60px;
    }

    .report-hero-content h1{
        font-size:34px;
    }

    .report-hero-content p{
        font-size:16px;
    }

}

</style>

@endsection