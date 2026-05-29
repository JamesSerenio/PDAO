@extends('layouts.app')

@section('content')

<section class="simple-section goals-bg">

    <div class="simple-container">

        <!-- HEADER -->
        <div class="goals-header">

            <span class="goals-badge">
                e-PDAO MANOLO FORTICH
            </span>

            <h1 class="section-title">
                Goals
            </h1>

            <p class="goals-description">
                The e-PDAO Manolo Fortich continuously promotes
                inclusive programs and community-based initiatives
                that help empower Persons with Disabilities through
                productivity, resilience, and equal opportunities.
            </p>

        </div>



        <!-- GOALS GRID -->
        <div class="goals-grid">


            <!-- PRODUCTIVE -->
            <div class="goal-card">

                <div class="goal-icon">
                    <i class="fa-solid fa-scale-balanced"></i>
                </div>

                <h3>
                    Productive
                </h3>

                <div class="goal-content">

                    <p class="goal-text short-text">
                        Promote sustainable livelihood opportunities,
                        skills development, and accessible programs
                        that encourage Persons with Disabilities to
                        actively participate in community growth...
                    </p>

                    <p class="goal-text full-text">
                        Promote sustainable livelihood opportunities,
                        skills development, and accessible programs
                        that encourage Persons with Disabilities to
                        actively participate in community growth and
                        economic development. The e-PDAO supports
                        inclusive livelihood activities, employment
                        opportunities, and training programs that help
                        improve the quality of life and independence
                        of registered PWD members.
                    </p>

                </div>

                <button class="goal-btn">
                    Read More
                </button>

            </div>





            <!-- RESILIENT -->
            <div class="goal-card">

                <div class="goal-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <h3>
                    Resilient
                </h3>

                <div class="goal-content">

                    <p class="goal-text short-text">
                        Strengthen the capacity of Persons with
                        Disabilities to overcome challenges through
                        inclusive support systems and healthcare...
                    </p>

                    <p class="goal-text full-text">
                        Strengthen the capacity of Persons with
                        Disabilities to overcome challenges through
                        inclusive support systems, healthcare
                        assistance, community-based programs, and
                        disaster-responsive initiatives. The program
                        promotes preparedness, social protection,
                        and stronger community participation for all.
                    </p>

                </div>

                <button class="goal-btn">
                    Read More
                </button>

            </div>





            <!-- EMPOWERED -->
            <div class="goal-card">

                <div class="goal-icon">
                    <i class="fa-solid fa-hand-holding-heart"></i>
                </div>

                <h3>
                    Empowered
                </h3>

                <div class="goal-content">

                    <p class="goal-text short-text">
                        Advocate equal rights, accessibility,
                        and inclusive participation through
                        education and awareness programs...
                    </p>

                    <p class="goal-text full-text">
                        Advocate equal rights, accessibility,
                        and inclusive participation by empowering
                        Persons with Disabilities through education,
                        awareness campaigns, leadership development,
                        and social protection programs. The e-PDAO
                        promotes dignity, equality, and active
                        participation in society.
                    </p>

                </div>

                <button class="goal-btn">
                    Read More
                </button>

            </div>


        </div>

    </div>

</section>



<!-- =========================================
    STYLE
========================================= -->
<style>

.goals-bg{
    padding:90px 20px;
    background:
    linear-gradient(
        rgba(0,47,134,.93),
        rgba(0,47,134,.93)
    ),
    url('{{ asset("images/update/SPED.jpg") }}');

    background-position:center;
    background-size:cover;
    background-repeat:no-repeat;
    min-height:100vh;
}

.simple-container{
    max-width:1200px;
    margin:auto;
}



/* HEADER */
.goals-header{
    text-align:center;
    margin-bottom:60px;
}

.goals-badge{
    display:inline-block;
    background:#ffd400;
    color:#002f86;
    padding:10px 22px;
    border-radius:50px;
    font-size:14px;
    font-weight:700;
    margin-bottom:20px;
}

.section-title{
    font-size:58px;
    font-weight:800;
    color:#fff;
    margin-bottom:20px;
}

.goals-description{
    max-width:760px;
    margin:auto;
    color:#e7eeff;
    font-size:18px;
    line-height:1.9;
}



/* GRID */
.goals-grid{
    display:flex;
    justify-content:center;
    align-items:stretch;
    gap:40px;
    flex-wrap:wrap;
}



/* CARD */
.goal-card{
    background:#fff;
    border-radius:30px;

    width:340px; /* mas malapad */
    min-height:470px;

    padding:45px 35px;

    text-align:center;

    box-shadow:0 10px 30px rgba(0,0,0,.12);

    transition:.35s ease;

    position:relative;
    overflow:hidden;

    display:flex;
    flex-direction:column;
    justify-content:flex-start;
    align-items:center;
}

.goal-card::before{
    content:'';
    position:absolute;
    top:0;
    left:0;
    width:100%;
    height:6px;
    background:#ffd400;
}

.goal-card:hover{
    transform:translateY(-8px);
}



/* ICON */
.goal-icon{
    width:90px;
    height:90px;

    margin-bottom:25px;

    border-radius:24px;

    background:#002f86;
    color:#ffd400;

    display:flex;
    align-items:center;
    justify-content:center;

    font-size:36px;
}



/* TITLE */
.goal-card h3{
    font-size:42px; /* dating laki */
    font-weight:800;
    color:#002f86;
    margin-bottom:25px;
}



/* CONTENT */
.goal-content{
    width:100%;
    flex:1;

    display:flex;
    flex-direction:column;
    justify-content:center;
}

.goal-text{
    color:#5c6785;
    line-height:2;
    font-size:18px;
}



/* DEFAULT */
.full-text{
    display:none;
}



/* BUTTON */
.goal-btn{
    margin-top:30px;

    border:none;
    background:#002f86;
    color:#fff;

    padding:14px 28px;

    border-radius:50px;

    font-weight:700;
    font-size:15px;

    cursor:pointer;

    transition:.3s ease;
}

.goal-btn:hover{
    background:#ffd400;
    color:#002f86;
}



/* ACTIVE */
.goal-card.active .short-text{
    display:none;
}

.goal-card.active .full-text{
    display:block;
}

.goal-card.active .goal-btn{
    background:#ffd400;
    color:#002f86;
}



/* RESPONSIVE */
@media(max-width:991px){

    .goals-grid{
        flex-direction:column;
        align-items:center;
    }

    .goal-card{
        width:100%;
        max-width:420px;
        min-height:auto;
    }

}

</style>



<!-- =========================================
    SCRIPT
========================================= -->
<script>

document.addEventListener("DOMContentLoaded", () => {

    const buttons = document.querySelectorAll(".goal-btn");

    buttons.forEach(button => {

        button.addEventListener("click", () => {

            const card = button.closest(".goal-card");

            card.classList.toggle("active");

            if(card.classList.contains("active")){

                button.innerText = "Show Less";

            } else {

                button.innerText = "Read More";

            }

        });

    });

});

</script>

@endsection