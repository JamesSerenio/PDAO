@extends('layouts.app')

@section('content')
<section class="simple-section">
    <div class="container">
        <div class="section-header">
            <span>Public Service Notice</span>
            <h2>Public Advisory</h2>
            <p>
                Important reminders, notices, and official advisories are posted here to help
                keep the public informed, prepared, and connected.
            </p>
        </div>

        <div class="info-grid">
            <div class="info-card">
                <h3>Office Announcements</h3>
                <p>
                    Please monitor this section for office schedule changes, special service hours,
                    and other official updates from the local government.
                </p>
            </div>

            <div class="info-card">
                <h3>Program Notices</h3>
                <p>
                    Advisories related to registration, assistance, submissions, and service
                    availability will be posted to guide users properly.
                </p>
            </div>

            <div class="info-card">
                <h3>Community Reminders</h3>
                <p>
                    Stay alert for timely reminders regarding public activities, deadlines,
                    documentation requirements, and other service-related concerns.
                </p>
            </div>
        </div>

        <div class="card-glow mt-5">
            <h3 class="mb-3">Official Reminder</h3>
            <p>
                For verified announcements, always refer to official e-PDAO Connect pages and
                authorized LGU communication channels.
            </p>
        </div>
    </div>
</section>
@endsection