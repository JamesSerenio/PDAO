@extends('layouts.app')

@section('content')

<!-- =========================================
    HERO SECTION
========================================= -->
<section class="summary-hero">

    <div class="summary-overlay"></div>

    <div class="container">

        <div class="summary-hero-content">

            <span class="summary-badge">
                e-PDAO Manolo Fortich
            </span>

            <h1>
                PWD REGISTRATION <br>
                OVERALL SUMMARY
            </h1>

            <p>
                Consolidated registration records, disability categories,
                barangay coordination, and organizational structure of
                Persons with Disabilities in the Municipality of
                Manolo Fortich.
            </p>

        </div>

    </div>

</section>



<!-- =========================================
    DASHBOARD SECTION
========================================= -->
<section class="summary-dashboard">

    <div class="container">


        <!-- =========================================
            TOP STATS
        ========================================= -->
        <div class="stats-grid">

            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h2>2,204</h2>

                <p>
                    Registered PWD Members
                </p>

            </div>



            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fa-solid fa-building"></i>
                </div>

                <h2>22</h2>

                <p>
                    Covered Barangays
                </p>

            </div>



            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fa-solid fa-calendar-check"></i>
                </div>

                <h2>2022</h2>

                <p>
                    Start of Consolidation
                </p>

            </div>



            <div class="stat-card">

                <div class="stat-icon">
                    <i class="fa-solid fa-id-card"></i>
                </div>

                <h2>5 Years</h2>

                <p>
                    ID Renewal Validity
                </p>

            </div>

        </div>



        <!-- =========================================
            MAIN LAYOUT
        ========================================= -->
        <div class="summary-layout">


            <!-- =========================================
                LEFT CONTENT
            ========================================= -->
            <div class="summary-main">


                <!-- OVERVIEW -->
                <div class="dashboard-card">

                    <div class="card-title">

                        <div class="title-icon">
                            <i class="fa-solid fa-circle-info"></i>
                        </div>

                        <h2>
                            Registration Overview
                        </h2>

                    </div>

                    <p>
                        As of May 21, 2026, the Person with Disability
                        Affairs Office (PDAO) of the Municipality of
                        Manolo Fortich has officially recorded a total
                        of <strong>2,204 registered Persons with Disabilities</strong>
                        across twenty-two (22) barangays.
                    </p>

                    <p>
                        Registration and consolidation of records
                        officially started in January 2022, and all
                        registered members are currently enrolled
                        in the Department of Health (DOH) system.
                    </p>

                </div>




                <!-- DISABILITY TYPES -->
                <div class="dashboard-card">

                    <div class="card-title">

                        <div class="title-icon">
                            <i class="fa-solid fa-wheelchair"></i>
                        </div>

                        <h2>
                            Disability Categories
                        </h2>

                    </div>

                    <div class="disability-grid">

                        <div class="disability-item">
                            Deaf or Hard of Hearing
                        </div>

                        <div class="disability-item">
                            Intellectual Disability
                        </div>

                        <div class="disability-item">
                            Learning Disability
                        </div>

                        <div class="disability-item">
                            Mental Disability
                        </div>

                        <div class="disability-item">
                            Physical Disability
                        </div>

                        <div class="disability-item">
                            Psychosocial Disability
                        </div>

                        <div class="disability-item">
                            Speech & Language Impairment
                        </div>

                        <div class="disability-item">
                            Visual Disability
                        </div>

                        <div class="disability-item">
                            Cancer-related Disability
                        </div>

                        <div class="disability-item">
                            Rare Disease Cases
                        </div>

                    </div>

                </div>





                <!-- REQUIREMENTS -->
                <div class="dashboard-card">

                    <div class="card-title">

                        <div class="title-icon">
                            <i class="fa-solid fa-file-circle-check"></i>
                        </div>

                        <h2>
                            Registration Requirements
                        </h2>

                    </div>

                    <div class="requirements-grid">

                        <div class="requirement-box">

                            <i class="fa-solid fa-check"></i>

                            <span>
                                Barangay Certification
                            </span>

                        </div>


                        <div class="requirement-box">

                            <i class="fa-solid fa-check"></i>

                            <span>
                                Birth Certificate
                            </span>

                        </div>


                        <div class="requirement-box">

                            <i class="fa-solid fa-check"></i>

                            <span>
                                Three (3) 1x1 ID Pictures
                            </span>

                        </div>


                        <div class="requirement-box">

                            <i class="fa-solid fa-check"></i>

                            <span>
                                Certificate of Disability
                            </span>

                        </div>

                    </div>

                </div>





                <!-- FEDERATION -->
                <div class="dashboard-card">

                    <div class="card-title">

                        <div class="title-icon">
                            <i class="fa-solid fa-people-group"></i>
                        </div>

                        <h2>
                            Federation & Coordination
                        </h2>

                    </div>

                    <p>
                        The PDAO coordinates with Federation of
                        Differently-Abled Persons Association Presidents
                        and Parent Mobilization Action Group Presidents
                        across the 22 barangays of Manolo Fortich to
                        strengthen monitoring, implementation, and
                        delivery of inclusive programs and services.
                    </p>

                </div>

            </div>





            <!-- =========================================
                RIGHT SIDEBAR
            ========================================= -->
            <aside class="summary-sidebar">


                <!-- DOH STATUS -->
                <div class="sidebar-card doh-card">

                    <div class="sidebar-icon">
                        <i class="fa-solid fa-shield-heart"></i>
                    </div>

                    <h3>
                        DOH Registration Status
                    </h3>

                    <p>
                        All registered members are officially enrolled
                        in the Department of Health (DOH) system for
                        proper verification and monitoring.
                    </p>

                </div>





                <!-- RENEWAL -->
                <div class="sidebar-card">

                    <div class="sidebar-icon yellow-icon">
                        <i class="fa-solid fa-id-card"></i>
                    </div>

                    <h3>
                        PWD ID Renewal
                    </h3>

                    <p>
                        PWD Identification Cards are renewable every
                        five (5) years to maintain updated records
                        and continued access to benefits and services.
                    </p>

                </div>





                <!-- CLASSIFICATION -->
                <div class="sidebar-card">

                    <div class="sidebar-icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>

                    <h3>
                        Disability Classification
                    </h3>

                    <div class="classification-box apparent">

                        <strong>
                            Apparent Disability
                        </strong>

                        <p>
                            Easily visible physical conditions.
                        </p>

                    </div>

                    <div class="classification-box non-apparent">

                        <strong>
                            Non-Apparent Disability
                        </strong>

                        <p>
                            Requires certification from
                            a Rural Health Doctor.
                        </p>

                    </div>

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
.summary-hero{
    position: relative;
    padding: 70px 0 60px;
    overflow: hidden;

    background:
    linear-gradient(
        rgba(0, 47, 134, 0.82),
        rgba(0, 47, 134, 0.88)
    ),
    url('{{ asset("images/update/PARAGAMES.jpg") }}');

    background-position: center;
    background-size: cover;
    background-repeat: no-repeat;
}

.summary-overlay{
    position:absolute;
    inset:0;
    background:
    linear-gradient(
        135deg,
        rgba(255,215,0,.15),
        transparent
    );
}

.summary-hero-content{
    position:relative;
    z-index:2;
    max-width:760px;
    color:#fff;
}

.summary-badge{
    display:inline-block;
    background:#ffd400;
    color:#002f86;
    padding:10px 22px;
    border-radius:50px;
    font-size:14px;
    font-weight:700;
    margin-bottom:20px;
    letter-spacing:.5px;
}

.summary-hero-content h1{
    font-size:58px;
    line-height:1.1;
    font-weight:800;
    margin-bottom:22px;
}

.summary-hero-content p{
    font-size:18px;
    line-height:1.8;
    color:#e6ecff;
}



/* DASHBOARD */
.summary-dashboard{
    padding:80px 0;
}



/* STATS */
.stats-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:25px;
    margin-top:-110px;
    position:relative;
    z-index:10;
    margin-bottom:40px;
}

.stat-card{
    background:#fff;
    border-radius:24px;
    padding:35px 30px;
    text-align:center;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
    transition:.3s;
}

.stat-card:hover{
    transform:translateY(-8px);
}

.stat-icon{
    width:70px;
    height:70px;
    background:#002f86;
    color:#ffd400;
    margin:auto;
    border-radius:20px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:30px;
    margin-bottom:20px;
}

.stat-card h2{
    font-size:42px;
    color:#002f86;
    font-weight:800;
    margin-bottom:10px;
}

.stat-card p{
    color:#5d6785;
    font-size:15px;
}



/* LAYOUT */
.summary-layout{
    display:grid;
    grid-template-columns:1.6fr .9fr;
    gap:35px;
}



/* MAIN */
.summary-main{
    display:flex;
    flex-direction:column;
    gap:30px;
}



/* CARD */
.dashboard-card{
    background:#fff;
    border-radius:25px;
    padding:40px;
    box-shadow:0 10px 30px rgba(0,0,0,.07);
}

.card-title{
    display:flex;
    align-items:center;
    gap:16px;
    margin-bottom:25px;
}

.title-icon{
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

.card-title h2{
    font-size:30px;
    color:#002f86;
    font-weight:800;
}

.dashboard-card p{
    color:#5d6785;
    line-height:1.9;
    margin-bottom:18px;
}



/* DISABILITY GRID */
.disability-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
}

.disability-item{
    background:#f5f8ff;
    border:2px solid #eef2ff;
    padding:18px;
    border-radius:16px;
    color:#002f86;
    font-weight:600;
    transition:.3s;
}

.disability-item:hover{
    background:#002f86;
    color:#fff;
    border-color:#002f86;
}



/* REQUIREMENTS */
.requirements-grid{
    display:grid;
    grid-template-columns:repeat(2,1fr);
    gap:18px;
}

.requirement-box{
    background:#fff8d9;
    border-left:5px solid #ffd400;
    padding:18px;
    border-radius:16px;
    display:flex;
    align-items:center;
    gap:12px;
    color:#002f86;
    font-weight:600;
}

.requirement-box i{
    color:#f2b400;
}



/* SIDEBAR */
.summary-sidebar{
    display:flex;
    flex-direction:column;
    gap:25px;
}

.sidebar-card{
    background:#fff;
    border-radius:24px;
    padding:35px;
    box-shadow:0 10px 30px rgba(0,0,0,.07);
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

.yellow-icon{
    background:#ffd400;
    color:#002f86;
}

.sidebar-card h3{
    font-size:28px;
    color:#002f86;
    margin-bottom:16px;
    font-weight:800;
}

.sidebar-card p{
    color:#5d6785;
    line-height:1.8;
}



/* DOH CARD */
.doh-card{
    background:
    linear-gradient(
        135deg,
        #002f86,
        #004ec2
    );
}

.doh-card h3,
.doh-card p{
    color:#fff;
}



/* CLASSIFICATION */
.classification-box{
    padding:18px;
    border-radius:16px;
    margin-top:18px;
}

.classification-box strong{
    display:block;
    margin-bottom:8px;
}

.apparent{
    background:#eef5ff;
    border-left:5px solid #002f86;
}

.non-apparent{
    background:#fff7d8;
    border-left:5px solid #ffd400;
}



/* RESPONSIVE */
@media(max-width:991px){

    .stats-grid{
        grid-template-columns:repeat(2,1fr);
    }

    .summary-layout{
        grid-template-columns:1fr;
    }

    .summary-hero-content h1{
        font-size:44px;
    }

}

@media(max-width:768px){

    .stats-grid{
        grid-template-columns:1fr;
        margin-top:-80px;
    }

    .disability-grid,
    .requirements-grid{
        grid-template-columns:1fr;
    }

    .dashboard-card,
    .sidebar-card{
        padding:28px;
    }

    .summary-hero{
        padding:75px 0 60px;
    }

    .summary-hero-content h1{
        font-size:34px;
    }

    .summary-hero-content p{
        font-size:16px;
    }

}

</style>

@endsection