@extends('layouts.app')

@section('content')

<!-- =========================================
    HERO SECTION
========================================= -->
<section class="livelihood-hero">

    <div class="livelihood-overlay"></div>

    <div class="container">

        <div class="livelihood-hero-content">

            <span class="livelihood-badge">
                e-PDAO Manolo Fortich
            </span>

            <h1>
                Livelihood Programs
            </h1>

            <p>
                Empowering Persons with Disabilities through sustainable
                livelihood opportunities, skills development, and
                community-based economic support programs.
            </p>

        </div>

    </div>

</section>



<!-- =========================================
    MAIN SECTION
========================================= -->
<section class="livelihood-section">

    <div class="container">

        <div class="livelihood-layout">


            <!-- =========================================
                LEFT CONTENT
            ========================================= -->
            <div class="livelihood-main">


                <!-- MAIN CARD -->
                <div class="livelihood-card">

                    <div class="livelihood-image">

                        <img
                            src="{{ asset('images/update/SEEDS.jpg') }}"
                            alt="Livelihood Programs"
                        >

                    </div>

                    <div class="livelihood-content">

                        <div class="livelihood-title">

                            <div class="livelihood-icon">
                                <i class="fa-solid fa-seedling"></i>
                            </div>

                            <h2>
                                Livelihood Assistance Programs
                            </h2>

                        </div>

                        <p>
                            The Livelihood Program of e-PDAO Manolo Fortich
                            promotes economic empowerment and self-sufficiency
                            among Persons with Disabilities through skills
                            training, livelihood opportunities, and community
                            support initiatives.
                        </p>

                        <p>
                            The program focuses on strengthening livelihood
                            capacity, improving productivity, and helping
                            registered PWD members participate actively in
                            sustainable income-generating activities within
                            the municipality.
                        </p>

                    </div>

                </div>





                <!-- PROGRAM BENEFITS -->
                <div class="livelihood-card">

                    <div class="livelihood-title">

                        <div class="livelihood-icon yellow-icon">
                            <i class="fa-solid fa-briefcase"></i>
                        </div>

                        <h2>
                            Program Opportunities
                        </h2>

                    </div>

                    <div class="benefits-grid">

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Skills Training Programs
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Livelihood Starter Kits
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Community-Based Projects
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Small Business Support
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Employment Referrals
                        </div>

                        <div class="benefit-box">
                            <i class="fa-solid fa-check"></i>
                            Sustainable Livelihood Activities
                        </div>

                    </div>

                </div>





                <!-- OBJECTIVE -->
                <div class="livelihood-card">

                    <div class="livelihood-title">

                        <div class="livelihood-icon">
                            <i class="fa-solid fa-hand-holding-dollar"></i>
                        </div>

                        <h2>
                            Program Objective
                        </h2>

                    </div>

                    <p>
                        The Livelihood Program aims to provide accessible
                        economic opportunities that help Persons with
                        Disabilities improve their quality of life,
                        develop sustainable income sources, and promote
                        inclusive community participation.
                    </p>

                </div>

            </div>





            <!-- =========================================
                SIDEBAR
            ========================================= -->
            <aside class="livelihood-sidebar">


                <!-- SUPPORT -->
                <div class="sidebar-card">

                    <div class="sidebar-icon">
                        <i class="fa-solid fa-people-group"></i>
                    </div>

                    <h3>
                        Community Support
                    </h3>

                    <p>
                        e-PDAO coordinates with local agencies,
                        organizations, and barangays to support
                        livelihood development programs for
                        registered PWD members.
                    </p>

                </div>





                <!-- LIVELIHOOD -->
                <div class="sidebar-card support-card">

                    <div class="sidebar-icon support-icon">
                        <i class="fa-solid fa-store"></i>
                    </div>

                    <h3>
                        Economic Empowerment
                    </h3>

                    <p>
                        Encouraging independence, productivity,
                        and financial sustainability through
                        inclusive livelihood opportunities.
                    </p>

                </div>





                <!-- REQUIREMENTS -->
                <div class="sidebar-card">

                    <div class="sidebar-icon yellow-icon">
                        <i class="fa-solid fa-file-lines"></i>
                    </div>

                    <h3>
                        Basic Requirements
                    </h3>

                    <ul class="requirement-list">

                        <li>
                            Valid PWD ID
                        </li>

                        <li>
                            Barangay Certification
                        </li>

                        <li>
                            Program Assessment
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
.livelihood-hero{
    position:relative;
    padding:80px 0 70px;
    overflow:hidden;

    background:
    linear-gradient(
        rgba(0,47,134,.88),
        rgba(0,47,134,.92)
    ),
    url('{{ asset("images/update/SEEDS.jpg") }}');

    background-position:center;
    background-size:cover;
    background-repeat:no-repeat;
}

.livelihood-overlay{
    position:absolute;
    inset:0;
    background:
    linear-gradient(
        135deg,
        rgba(255,212,0,.15),
        transparent
    );
}

.livelihood-hero-content{
    position:relative;
    z-index:2;
    max-width:760px;
    color:#fff;
}

.livelihood-badge{
    display:inline-block;
    background:#ffd400;
    color:#002f86;
    padding:10px 22px;
    border-radius:50px;
    font-size:14px;
    font-weight:700;
    margin-bottom:20px;
}

.livelihood-hero-content h1{
    font-size:58px;
    line-height:1.1;
    font-weight:800;
    margin-bottom:22px;
}

.livelihood-hero-content p{
    font-size:18px;
    line-height:1.8;
    color:#e6ecff;
}



/* MAIN */
.livelihood-section{
    padding:80px 0;
}

.livelihood-layout{
    display:grid;
    grid-template-columns:1.6fr .9fr;
    gap:35px;
}

.livelihood-main{
    display:flex;
    flex-direction:column;
    gap:30px;
}



/* CARD */
.livelihood-card{
    background:#fff;
    border-radius:25px;
    overflow:hidden;
    box-shadow:0 10px 30px rgba(0,0,0,.08);
}

.livelihood-image img{
    width:100%;
    height:380px;
    object-fit:cover;
}

.livelihood-content{
    padding:40px;
}

.livelihood-title{
    display:flex;
    align-items:center;
    gap:16px;
    margin-bottom:25px;
    padding:0 40px;
}

.livelihood-icon{
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

.livelihood-title h2{
    font-size:30px;
    color:#002f86;
    font-weight:800;
}

.livelihood-card p{
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
.livelihood-sidebar{
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

    .livelihood-layout{
        grid-template-columns:1fr;
    }

    .livelihood-hero-content h1{
        font-size:44px;
    }

}

@media(max-width:768px){

    .livelihood-hero{
        padding:70px 0 60px;
    }

    .livelihood-hero-content h1{
        font-size:34px;
    }

    .livelihood-hero-content p{
        font-size:16px;
    }

    .benefits-grid{
        grid-template-columns:1fr;
    }

    .livelihood-content{
        padding:28px;
    }

    .livelihood-title{
        padding:0 28px;
    }

    .livelihood-card p{
        padding:0 28px 10px;
    }

    .benefits-grid{
        padding:0 28px 28px;
    }

    .livelihood-image img{
        height:260px;
    }

}

</style>

@endsection