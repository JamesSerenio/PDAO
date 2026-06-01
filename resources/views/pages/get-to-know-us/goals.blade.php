@extends('layouts.app')

@section('content')

<section class="simple-section goals-bg">
    <div class="simple-container">

        <div class="goals-header">
            <span class="goals-badge">
                e-PDAO Manolo Fortich
            </span>
            <h1 class="section-title">
                Goals
            </h1>
            <p class="goals-description">
                The e-PDAO Manolo Fortich continuously promotes inclusive programs and community-based initiatives that help empower Persons with Disabilities through productivity, resilience, and equal opportunities.
            </p>
        </div>

        <div class="goals-carousel-container">
            <div class="goals-grid">

                <div class="goal-card" data-goal="productive">
                    <div>
                        <div class="goal-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                        <h3>Productive</h3>
                        <p class="goal-text">Promote sustainable livelihood opportunities, skills development, and accessible programs...</p>
                    </div>
                    <button class="goal-btn">Read More <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <div class="goal-card" data-goal="resilient">
                    <div>
                        <div class="goal-icon"><i class="fa-solid fa-users"></i></div>
                        <h3>Resilient</h3>
                        <p class="goal-text">Strengthen the capacity of Persons with Disabilities to overcome challenges through inclusive support...</p>
                    </div>
                    <button class="goal-btn">Read More <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <div class="goal-card" data-goal="empowered">
                    <div>
                        <div class="goal-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                        <h3>Empowered</h3>
                        <p class="goal-text">Advocate equal rights, accessibility, and inclusive participation through education...</p>
                    </div>
                    <button class="goal-btn">Read More <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <div class="goal-card" data-goal="productive" aria-hidden="true">
                    <div>
                        <div class="goal-icon"><i class="fa-solid fa-scale-balanced"></i></div>
                        <h3>Productive</h3>
                        <p class="goal-text">Promote sustainable livelihood opportunities, skills development, and accessible programs...</p>
                    </div>
                    <button class="goal-btn">Read More <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <div class="goal-card" data-goal="resilient" aria-hidden="true">
                    <div>
                        <div class="goal-icon"><i class="fa-solid fa-users"></i></div>
                        <h3>Resilient</h3>
                        <p class="goal-text">Strengthen the capacity of Persons with Disabilities to overcome challenges through inclusive support...</p>
                    </div>
                    <button class="goal-btn">Read More <i class="fa-solid fa-arrow-right"></i></button>
                </div>

                <div class="goal-card" data-goal="empowered" aria-hidden="true">
                    <div>
                        <div class="goal-icon"><i class="fa-solid fa-hand-holding-heart"></i></div>
                        <h3>Empowered</h3>
                        <p class="goal-text">Advocate equal rights, accessibility, and inclusive participation through education...</p>
                    </div>
                    <button class="goal-btn">Read More <i class="fa-solid fa-arrow-right"></i></button>
                </div>

            </div>
        </div>

    </div>
</section>

<div class="goal-modal-overlay" id="goalModal">
    <div class="goal-modal-card">
        <button class="goal-modal-close" id="closeGoalModal">&times;</button>
        <div class="goal-modal-icon" id="modalIcon"></div>
        <h3 id="modalTitle">Goal Title</h3>
        <p id="modalFullText">Full text story goes here...</p>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
    const goalStories = {
        productive: {
            title: "Productive",
            icon: '<i class="fa-solid fa-scale-balanced"></i>',
            text: "Promote sustainable livelihood opportunities, skills development, and accessible programs that encourage Persons with Disabilities to actively participate in community growth and economic development. The e-PDAO supports inclusive livelihood activities, employment opportunities, and training programs that help improve the quality of life and independence of registered PWD members."
        },
        resilient: {
            title: "Resilient",
            icon: '<i class="fa-solid fa-users"></i>',
            text: "Strengthen the capacity of Persons with Disabilities to overcome challenges through inclusive support systems, healthcare assistance, community-based programs, and disaster-responsive initiatives. The program promotes preparedness, social protection, and stronger community participation for all."
        },
        empowered: {
            title: "Empowered",
            icon: '<i class="fa-solid fa-hand-holding-heart"></i>',
            text: "Advocate equal rights, accessibility, and inclusive participation by empowering Persons with Disabilities through education, awareness campaigns, leadership development, and social protection programs. The e-PDAO promotes dignity, equality, and active participation in society."
        }
    };

    const modal = document.getElementById("goalModal");
    const modalTitle = document.getElementById("modalTitle");
    const modalIcon = document.getElementById("modalIcon");
    const modalFullText = document.getElementById("modalFullText");
    const closeBtn = document.getElementById("closeGoalModal");

    document.querySelectorAll(".goal-btn").forEach(button => {
        button.addEventListener("click", () => {
            const card = button.closest(".goal-card");
            const goalType = card.getAttribute("data-goal");
            const story = goalStories[goalType];

            if (story) {
                modalTitle.textContent = story.title;
                modalIcon.innerHTML = story.icon;
                modalFullText.textContent = story.text;
                modal.classList.add("open");
            }
        });
    });

    closeBtn.addEventListener("click", () => {
        modal.classList.remove("open");
    });

    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.classList.remove("open");
        }
    });
});
</script>

@endsection