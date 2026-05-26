@extends('layouts.app')

@section('content')

<!-- =========================================
    HERO SECTION
========================================= -->
<section class="medical-hero">

    <div class="medical-overlay"></div>

    <div class="container">

        <div class="medical-hero-content">

            <span class="medical-badge">
                e-PDAO Manolo Fortich
            </span>

            <h1>
                Medical Assistance Program
            </h1>

            <p>
                Providing accessible healthcare assistance, medical
                support, and inclusive services for Persons with
                Disabilities in the Municipality of Manolo Fortich.
            </p>

        </div>

    </div>

</section>



<!-- =========================================
    MAIN SECTION
========================================= -->
<section class="medical-section">

    <div class="container">

        <div class="medical-layout">


            <!-- =========================================
                LEFT CONTENT
            ========================================= -->
            <div class="medical-main">


                <!-- MAIN CARD -->
                <div class="medical-card">

                    <div class="medical-image">

                        <img
                            src="{{ asset('images/update/AIDS.jpg') }}"
                            alt="Medical Assistance"
                        >

                    </div>

                    <div class="medical-content">

                        <div class="medical-title">

                            <div class="medical-icon">
                                <i class="fa-solid fa-hand-holding-medical"></i>
                            </div>

                            <h2>
                                Medical Assistance Services
                            </h2>

                        </div>

                        <p>
                            The e-PDAO Manolo Fortich Medical Assistance
                            Program aims to support Persons with Disabilities
                            by providing accessible healthcare-related
                            services, medical referrals, and coordination
                            with government and partner agencies.
                        </p>

                        <p>
                            This program helps qualified beneficiaries
                            access medical consultations, medicines,
                            assistive devices, transportation assistance,
                            and other health-related support necessary
                            for improving their quality of life.
                        </p>

                    </div>

                </div>





                <!-- PROGRAM BENEFITS -->
                <div class="medical-card">

                    <div class="medical-title">

                        <div class="medical-icon yellow-icon">
                            <i class="fa-solid fa-notes-medical"></i>
                        </div>

                        <h2>
                            Program Benefits
                        </h2>

                    </div>

                    <div class="benefits-grid">

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Medical Referral Assistance
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Hospital Coordination
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Assistive Devices Support
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Medicine Assistance
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Health Monitoring
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Community Healthcare Programs
                        </div>

                    </div>

                </div>





                <!-- OBJECTIVE -->
                <div class="medical-card">

                    <div class="medical-title">

                        <div class="medical-icon">
                            <i class="fa-solid fa-heart-pulse"></i>
                        </div>

                        <h2>
                            Program Objective
                        </h2>

                    </div>

                    <p>
                        The Medical Assistance Program promotes equal
                        access to healthcare services and strengthens
                        the protection, welfare, and well-being of
                        Persons with Disabilities through inclusive
                        and community-based support systems.
                    </p>

                </div>

            </div>





            <!-- =========================================
                SIDEBAR
            ========================================= -->
            <aside class="medical-sidebar">


                <!-- CONTACT -->
                <div class="sidebar-card">

                    <div class="sidebar-icon">
                        <i class="fa-solid fa-phone-volume"></i>
                    </div>

                    <h3>
                        Need Assistance?
                    </h3>

                    <p>
                        Visit the PDAO Office or coordinate with your
                        barangay representative for medical assistance
                        concerns and support services.
                    </p>

                </div>





                <!-- HEALTH SUPPORT -->
                <div class="sidebar-card support-card">

                    <div class="sidebar-icon support-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>

                    <h3>
                        Inclusive Healthcare
                    </h3>

                    <p>
                        e-PDAO promotes accessible and inclusive
                        healthcare programs for all registered
                        Persons with Disabilities.
                    </p>

                </div>





                <!-- REQUIREMENTS -->
                <div class="sidebar-card">

                    <div class="sidebar-icon yellow-icon">
                        <i class="fa-solid fa-file-medical"></i>
                    </div>

                    <h3>
                        Requirements
                    </h3>

                    <ul class="requirement-list">

                        <li>
                            Valid PWD ID
                        </li>

                        <li>
                            Medical Certificate
                        </li>

                        <li>
                            Barangay Certification
                        </li>

                        <li>
                            Referral Documents
                        </li>

                    </ul>

                </div>


            </aside>


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
.medical-hero{
    position:relative;
    padding:80px 0 70px;
    overflow:hidden;

    background:
    linear-gradient(
        rgba(0,47,134,.88),
        rgba(0,47,134,.90)
    ),
    url('{{ asset("images/update/AIDS.jpg") }}');

    background-position:center;
    background-size:cover;
    background-repeat:no-repeat;
}

.medical-overlay{
    position:absolute;
    inset:0;
    background:
    linear-gradient(
        135deg,
        rgba(255,212,0,.15),
        transparent
    );
}

.medical-hero-content{
    position:relative;
    z-index:2;
    max-width:760px;
    color:#fff;
}

.medical-badge{
    display:inline-block;
    background:#ffd400;
    color:#002f86;
    padding:10px 22px;
    border-radius:50px;
    font-size:14px;
    font-weight:700;
    margin-bottom:20px;
}

.medical-hero-content h1{
    font-size:58px;
    line-height:1.1;
    font-weight:800;
    margin-bottom:22px;
}

.medical-hero-content p{
    font-size:18px;
    line-height:1.8;
    color:#e6ecff;
}



/* MAIN */
.medical-section{
    padding:80px 0;
}

.medical-layout{
    display:grid;
    grid-template-columns:1.6fr .9fr;
    gap:35px;
}

.medical-main{
    display:flex;
    flex-direction:column;
    gap:30px;
}



/* CARD */
.medical-card{
    background:#fff;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.medical-image img{
    width:100%;
    height:380px;
    object-fit:cover;
}

.medical-content{
    padding:40px;
}

.medical-title{
    display:flex;
    align-items:center;
    gap:16px;
    margin-bottom:25px;
}

.medical-icon{
    width:60px;
    height:60px;
    background:#002f86;
    color:#ffd400;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:24px;
}

.yellow-icon{
    background:#ffd400;
    color:#002f86;
}

.medical-title h2{
    font-size:30px;
    color:#002f86;
    font-weight:800;
}

.medical-card p{
    color:#5d6785;
    line-height:1.9;
    margin-bottom:18px;
    padding:0 40px 10px;
}



/* BENEFITS */
.benefits-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
    padding:0 40px 40px;
}

.benefit-box{
    background:#f5f8ff;
    border:2px solid #edf2ff;
    padding:18px;
    border-radius:16px;
    font-weight:600;
    color:#002f86;
    transition:.3s;
}

.benefit-box:hover{
    background:#002f86;
    color:#fff;
}

.benefit-box i{
    color:#f2b400;
    margin-right:8px;
}



/* SIDEBAR */
.medical-sidebar{
    display:flex;
    flex-direction:column;
    gap:25px;
}

.sidebar-card{
    background:#fff;
    border-radius:24px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.sidebar-icon{
    width:65px;
    height:65px;
    background:#002f86;
    color:#ffd400;
    border-radius:18px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:28px;
    margin-bottom:20px;
}

.support-card{
    background:
    linear-gradient(
        135deg,
        #002f86,
        #004ec2
    );
}

.support-card h3,
.support-card p{
    color:#ffffff!important;
}

.support-icon{
    background:#fff;
    color:#002f86;
}

.sidebar-card h3{
    font-size:28px;
    color:#002f86;
    margin-bottom:15px;
    font-weight:800;
}

.sidebar-card p{
    color:#5d6785;
    line-height:1.8;
}

.requirement-list{
    padding-left:20px;
    color:#5d6785;
    line-height:2;
}



/* RESPONSIVE */
@media(max-width:991px){

    .medical-layout{
        grid-template-columns:1fr;
    }

    .medical-hero-content h1{
        font-size:44px;
    }

}

@media(max-width:768px){

    .medical-hero{
        padding:70px 0 60px;
    }

    .medical-hero-content h1{
        font-size:34px;
    }

    .medical-hero-content p{
        font-size:16px;
    }

    .benefits-grid{
        grid-template-columns:1fr;
    }

    .medical-content{
        padding:28px;
    }

    .medical-card p{
        padding:0 28px 10px;
    }

    .benefits-grid{
        padding:0 28px 28px;
    }

    .medical-image img{
        height:260px;
    }

}

</style>

@endsection