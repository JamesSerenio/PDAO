@extends('layouts.app')

@section('content')

<section class="history-section">

    <div class="history-container">

        <h1 class="history-title">Our Journey</h1>
        <p class="history-subtitle">Evolution of e-PDAO Connect</p>

        <div class="timeline">

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fa-solid fa-lightbulb"></i></div>
                <div class="timeline-content">
                    <h3>Concept Phase</h3>
                    <p>The idea of a centralized PWD system was created to improve accessibility.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fa-solid fa-code"></i></div>
                <div class="timeline-content">
                    <h3>Development</h3>
                    <p>The system was built using modern web technologies for efficiency.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fa-solid fa-globe"></i></div>
                <div class="timeline-content">
                    <h3>Implementation</h3>
                    <p>Deployment to serve the community and improve digital accessibility.</p>
                </div>
            </div>

            <div class="timeline-item">
                <div class="timeline-icon"><i class="fa-solid fa-rocket"></i></div>
                <div class="timeline-content">
                    <h3>Future Evolution</h3>
                    <p>AI-driven analytics, smart services, and real-time support systems.</p>
                </div>
            </div>

        </div>

    </div>

</section>

@endsection