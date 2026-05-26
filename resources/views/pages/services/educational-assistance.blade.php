@extends('layouts.app')

@section('content')

<!-- =========================================
    HERO SECTION
========================================= -->
<section class="education-hero">

    <div class="education-overlay"></div>

    <div class="container">

        <div class="education-hero-content">

            <span class="education-badge">
                e-PDAO Manolo Fortich
            </span>

            <h1>
                Educational Assistance Program
            </h1>

            <p>
                Supporting inclusive education, learning opportunities,
                and academic assistance for Persons with Disabilities
                in the Municipality of Manolo Fortich.
            </p>

        </div>

    </div>

</section>



<!-- =========================================
    MAIN SECTION
========================================= -->
<section class="education-section">

    <div class="container">

        <div class="education-layout">


            <!-- =========================================
                LEFT CONTENT
            ========================================= -->
            <div class="education-main">


                <!-- MAIN CARD -->
                <div class="education-card">

                    <div class="education-image">

                        <img
                            src="{{ asset('images/update/SPED.jpg') }}"
                            alt="Educational Assistance"
                        >

                    </div>

                    <div class="education-content">

                        <div class="education-title">

                            <div class="education-icon">
                                <i class="fa-solid fa-graduation-cap"></i>
                            </div>

                            <h2>
                                Educational Assistance Services
                            </h2>

                        </div>

                        <p>
                            The Educational Assistance Program of
                            e-PDAO Manolo Fortich promotes equal
                            access to quality education for Persons
                            with Disabilities by supporting inclusive
                            learning programs, school coordination,
                            and educational opportunities.
                        </p>

                        <p>
                            The program aims to empower learners with
                            disabilities through educational support,
                            referrals, school assistance, and community
                            partnerships that help improve academic
                            participation and lifelong learning.
                        </p>

                    </div>

                </div>





                <!-- PROGRAM BENEFITS -->
                <div class="education-card">

                    <div class="education-title">

                        <div class="education-icon yellow-icon">
                            <i class="fa-solid fa-book-open-reader"></i>
                        </div>

                        <h2>
                            Program Benefits
                        </h2>

                    </div>

                    <div class="benefits-grid">

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            School Coordination Assistance
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Inclusive Learning Support
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Scholarship Referrals
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            SPED Program Support
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Educational Monitoring
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Community Learning Programs
                        </div>

                    </div>

                </div>





                <!-- OBJECTIVE -->
                <div class="education-card">

                    <div class="education-title">

                        <div class="education-icon">
                            <i class="fa-solid fa-school"></i>
                        </div>

                        <h2>
                            Program Objective
                        </h2>

                    </div>

                    <p>
                        The Educational Assistance Program strengthens
                        inclusive education and supports the academic
                        growth of Persons with Disabilities through
                        accessible educational opportunities, guidance,
                        and community-based learning initiatives.
                    </p>

                </div>

            </div>





            <!-- =========================================
                SIDEBAR
            ========================================= -->
            <aside class="education-sidebar">


                <!-- SUPPORT -->
                <div class="sidebar-card">

                    <div class="sidebar-icon">
                        <i class="fa-solid fa-hands-helping"></i>
                    </div>

                    <h3>
                        Student Support
                    </h3>

                    <p>
                        e-PDAO coordinates with schools, organizations,
                        and local agencies to provide educational
                        assistance and inclusive learning support.
                    </p>

                </div>





                <!-- INCLUSIVE EDUCATION -->
                <div class="sidebar-card support-card">

                    <div class="sidebar-icon support-icon">
                        <i class="fa-solid fa-universal-access"></i>
                    </div>

                    <h3>
                        Inclusive Education
                    </h3>

                    <p>
                        Promoting equal educational opportunities and
                        accessible learning environments for all
                        registered Persons with Disabilities.
                    </p>

                </div>





                <!-- REQUIREMENTS -->
                <div class="sidebar-card">

                    <div class="sidebar-icon yellow-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>

                    <h3>
                        Requirements
                    </h3>

                    <ul class="requirement-list">

                        <li>
                            Valid PWD ID
                        </li>

                        <li>
                            School Certification
                        </li>

                        <li>
                            Barangay Certification
                        </li>

                        <li>
                            Supporting Documents
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
.education-hero{
    position:relative;
    padding:80px 0 70px;
    overflow:hidden;

    background:
    linear-gradient(
        rgba(0,47,134,.88),
        rgba(0,47,134,.90)
    ),
    url('{{ asset("images/update/SPED.jpg") }}');

    background-position:center;
    background-size:cover;
    background-repeat:no-repeat;
}

.education-overlay{
    position:absolute;
    inset:0;
    background:
    linear-gradient(
        135deg,
        rgba(255,212,0,.15),
        transparent
    );
}

.education-hero-content{
    position:relative;
    z-index:2;
    max-width:760px;
    color:#fff;
}

.education-badge{
    display:inline-block;
    background:#ffd400;
    color:#002f86;
    padding:10px 22px;
    border-radius:50px;
    font-size:14px;
    font-weight:700;
    margin-bottom:20px;
}

.education-hero-content h1{
    font-size:58px;
    line-height:1.1;
    font-weight:800;
    margin-bottom:22px;
}

.education-hero-content p{
    font-size:18px;
    line-height:1.8;
    color:#e6ecff;
}



/* MAIN */
.education-section{
    padding:80px 0;
}

.education-layout{
    display:grid;
    grid-template-columns:1.6fr .9fr;
    gap:35px;
}

.education-main{
    display:flex;
    flex-direction:column;
    gap:30px;
}



/* CARD */
.education-card{
    background:#fff;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.education-image img{
    width:100%;
    height:380px;
    object-fit:cover;
}

.education-content{
    padding:40px;
}

.education-title{
    display:flex;
    align-items:center;
    gap:16px;
    margin-bottom:25px;
}

.education-icon{
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

.education-title h2{
    font-size:30px;
    color:#002f86;
    font-weight:800;
}

.education-card p{
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
.education-sidebar{
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

    .education-layout{
        grid-template-columns:1fr;
    }

    .education-hero-content h1{
        font-size:44px;
    }

}

@media(max-width:768px){

    .education-hero{
        padding:70px 0 60px;
    }

    .education-hero-content h1{
        font-size:34px;
    }

    .education-hero-content p{
        font-size:16px;
    }

    .benefits-grid{
        grid-template-columns:1fr;
    }

    .education-content{
        padding:28px;
    }

    .education-card p{
        padding:0 28px 10px;
    }

    .benefits-grid{
        padding:0 28px 28px;
    }

    .education-image img{
        height:260px;
    }

}

</style>

@endsection