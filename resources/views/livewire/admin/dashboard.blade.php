@extends('layouts.admin_shell')

@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')

@section('page_subtitle')
  Welcome, <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }})
@endsection

@push('styles')
<style>
  .scoreboard-card {
    position: relative;
    overflow: hidden;
    background:
      radial-gradient(circle at top left, rgba(34, 197, 94, 0.14), transparent 35%),
      radial-gradient(circle at bottom right, rgba(59, 130, 246, 0.14), transparent 35%),
      linear-gradient(145deg, #0b1220, #111827 55%, #0f172a);
    border-radius: 22px;
    padding: 18px;
    min-height: 170px;
    box-shadow:
      0 18px 35px rgba(2, 6, 23, 0.28),
      inset 0 1px 0 rgba(255,255,255,0.04);
    color: #fff;
    border: 1px solid rgba(255,255,255,0.06);
  }

  .scoreboard-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background:
      repeating-linear-gradient(
        90deg,
        rgba(255,255,255,0.02) 0px,
        rgba(255,255,255,0.02) 2px,
        transparent 2px,
        transparent 18px
      );
    pointer-events: none;
    opacity: .45;
  }

  .scoreboard-live-dot {
    position: absolute;
    top: 14px;
    right: 14px;
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: #22c55e;
    box-shadow: 0 0 0 0 rgba(34, 197, 94, 0.7);
    animation: scoreboardPulse 1.5s infinite;
    z-index: 2;
  }

  @keyframes scoreboardPulse {
    0% { box-shadow: 0 0 0 0 rgba(34, 197, 94, .7); }
    70% { box-shadow: 0 0 0 10px rgba(34, 197, 94, 0); }
    100% { box-shadow: 0 0 0 0 rgba(34, 197, 94, 0); }
  }

  .scoreboard-header {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: stretch;
    justify-content: space-between;
    gap: 10px;
    margin-bottom: 14px;
  }

  .scoreboard-team {
    flex: 1;
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.06);
    border-radius: 12px;
    padding: 8px 10px;
    text-align: center;
    box-shadow: inset 0 0 12px rgba(255,255,255,0.02);
  }

  .scoreboard-team-label {
    font-size: 10px;
    letter-spacing: 1.8px;
    font-weight: 800;
    color: #cbd5e1;
    text-transform: uppercase;
  }

  .scoreboard-team-name {
    margin-top: 4px;
    font-size: 13px;
    font-weight: 700;
    color: #f8fafc;
  }

  .scoreboard-main {
    position: relative;
    z-index: 1;
    border-radius: 18px;
    padding: 14px 14px 12px;
    background:
      linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0.015)),
      #0a0f1d;
    border: 1px solid rgba(103, 232, 249, 0.12);
    box-shadow:
      inset 0 0 18px rgba(103, 232, 249, 0.05),
      0 8px 16px rgba(0,0,0,0.18);
  }

  .scoreboard-title {
    text-align: center;
    font-size: 11px;
    font-weight: 800;
    letter-spacing: 2px;
    color: #cbd5e1;
    text-transform: uppercase;
    margin-bottom: 8px;
  }

  .scoreboard-clock-row {
    display: flex;
    align-items: flex-end;
    justify-content: center;
    gap: 8px;
  }

  .scoreboard-time {
    font-family: "Courier New", monospace;
    font-size: 34px;
    font-weight: 900;
    letter-spacing: 4px;
    line-height: 1;
    color: #86efac;
    text-shadow:
      0 0 6px rgba(134, 239, 172, 0.85),
      0 0 14px rgba(134, 239, 172, 0.35),
      0 0 22px rgba(134, 239, 172, 0.18);
  }

  .scoreboard-ampm {
    font-size: 13px;
    font-weight: 800;
    color: #facc15;
    letter-spacing: 1px;
    margin-bottom: 5px;
    text-shadow: 0 0 10px rgba(250, 204, 21, 0.25);
  }

  .scoreboard-date {
    margin-top: 10px;
    text-align: center;
    font-size: 14px;
    font-weight: 700;
    color: #dbeafe;
    letter-spacing: 0.6px;
  }

  .scoreboard-sub {
    margin-top: 8px;
    text-align: center;
    font-size: 11px;
    color: rgba(255,255,255,0.72);
    letter-spacing: .5px;
  }

  .card-filter-form {
    margin: 0;
  }

  .card-filter-select {
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 10px;
    background: #fff;
    font-size: 14px;
    font-weight: 600;
    color: #111827;
    cursor: pointer;
    outline: none;
  }

  .recent-table-wrap {
    overflow-x: auto;
  }

  .recent-table {
    width: 100%;
    border-collapse: collapse;
  }

  .recent-table th {
    text-align: left;
    padding: 10px;
    border-bottom: 1px solid #e5e7eb;
  }

  .recent-table td {
    padding: 10px;
    border-bottom: 1px solid #f1f5f9;
  }

  .overview-stack {
    display: grid;
    gap: 12px;
  }

  .overview-box {
    padding: 12px;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    background: #fff;
  }

  @media (max-width: 768px) {
    .scoreboard-time {
      font-size: 26px;
      letter-spacing: 2px;
    }

    .scoreboard-date {
      font-size: 12px;
    }

    .scoreboard-team-name {
      font-size: 12px;
    }
  }
</style>
@endpush

@section('content')

@php
  use Illuminate\Support\Facades\DB;
  use Carbon\Carbon;

  $range = request('range', 'month');

  $registeredQuery = DB::table('local_profiles');

  if ($range === 'day') {
      $registeredQuery->whereDate('created_at', Carbon::today());
  } elseif ($range === 'week') {
      $registeredQuery->whereBetween('created_at', [
          Carbon::now()->startOfWeek(),
          Carbon::now()->endOfWeek()
      ]);
  } elseif ($range === 'month') {
      $registeredQuery->whereYear('created_at', Carbon::now()->year)
                     ->whereMonth('created_at', Carbon::now()->month);
  } elseif ($range === 'year') {
      $registeredQuery->whereYear('created_at', Carbon::now()->year);
  }

  $registeredCount = (clone $registeredQuery)->count();

  $pwdCount = DB::table('local_profiles')->count();

  $seniorCount = DB::table('local_profiles')
      ->whereNotNull('date_of_birth')
      ->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60')
      ->count();

  $recentProfiles = DB::table('local_profiles')
      ->select(
          'id',
          'first_name',
          'middle_name',
          'last_name',
          'barangay',
          'profiling_date',
          'date_of_birth',
          'created_at'
      )
      ->orderByDesc('created_at')
      ->limit(5)
      ->get();

  $rangeLabel = match($range) {
      'day' => 'This Day',
      'week' => 'This Week',
      'month' => 'This Month',
      'year' => 'This Year',
      default => 'Overall',
  };
@endphp

<div class="dash-grid">

  <div class="dash-card">
    <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:12px; flex-wrap:wrap;">
      <div>
        <div class="card-title">Registered</div>
        <div class="card-value">{{ $registeredCount }}</div>
        <div class="card-sub">{{ $rangeLabel }} records</div>
      </div>

      <form method="GET" action="" class="card-filter-form">
        <select name="range" onchange="this.form.submit()" class="card-filter-select">
          <option value="day" {{ $range === 'day' ? 'selected' : '' }}>This Day</option>
          <option value="week" {{ $range === 'week' ? 'selected' : '' }}>This Week</option>
          <option value="month" {{ $range === 'month' ? 'selected' : '' }}>This Month</option>
          <option value="year" {{ $range === 'year' ? 'selected' : '' }}>This Year</option>
          <option value="overall" {{ $range === 'overall' ? 'selected' : '' }}>Overall</option>
        </select>
      </form>
    </div>
  </div>

  <div class="dash-card">
    <div class="card-title">Registered PWD</div>
    <div class="card-value">{{ $pwdCount }}</div>
    <div class="card-sub">Total registered persons</div>
  </div>

  <div class="dash-card">
    <div class="card-title">Senior Citizens</div>
    <div class="card-value">{{ $seniorCount }}</div>
    <div class="card-sub">Age 60 years old and above</div>
  </div>

  <div class="scoreboard-card">
    <span class="scoreboard-live-dot"></span>

    <div class="scoreboard-header">
      <div class="scoreboard-team">
        <div class="scoreboard-team-label">Date</div>
        <div class="scoreboard-team-name">PDAO</div>
      </div>
      <div class="scoreboard-team">
        <div class="scoreboard-team-label">Time</div>
        <div class="scoreboard-team-name">LIVE</div>
      </div>
    </div>

    <div class="scoreboard-main">
      <div class="scoreboard-title">System Clock</div>

      <div class="scoreboard-clock-row">
        <div class="scoreboard-time" id="liveTimeText">{{ now()->format('h:i:s') }}</div>
        <div class="scoreboard-ampm" id="liveAmPm">{{ now()->format('A') }}</div>
      </div>

      <div class="scoreboard-date" id="liveDateText">{{ now()->format('l, F d, Y') }}</div>
      <div class="scoreboard-sub">Real-time dashboard display</div>
    </div>
  </div>

</div>

<div class="dash-panels">
  <div class="panel">
    <div class="panel-head">
      <h2>Overview</h2>
      <span class="panel-pill">{{ $rangeLabel }}</span>
    </div>

    <div class="panel-body">
      <div class="overview-stack">
        <div class="overview-box">
          <strong>Filtered Registered:</strong> {{ $registeredCount }}
        </div>

        <div class="overview-box">
          <strong>Total Registered PWD:</strong> {{ $pwdCount }}
        </div>

        <div class="overview-box">
          <strong>Total Senior Citizens:</strong> {{ $seniorCount }}
        </div>

        <div class="overview-box">
          <strong>Current Date & Time:</strong>
          <span id="overviewLiveDateTime">{{ now()->format('F d, Y h:i:s A') }}</span>
        </div>
      </div>
    </div>
  </div>

  <div class="panel">
    <div class="panel-head">
      <h2>Recent Registrations</h2>
      <span class="panel-pill">Latest 5</span>
    </div>

    <div class="panel-body">
      @if($recentProfiles->count())
        <div class="recent-table-wrap">
          <table class="recent-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>Barangay</th>
                <th>Profiling Date</th>
                <th>Category</th>
              </tr>
            </thead>
            <tbody>
              @foreach($recentProfiles as $person)
                @php
                  $age = null;
                  if (!empty($person->date_of_birth)) {
                      $age = \Carbon\Carbon::parse($person->date_of_birth)->age;
                  }
                  $category = ($age !== null && $age >= 60) ? 'Senior Citizen' : 'PWD';
                @endphp
                <tr>
                  <td>{{ $person->last_name }}, {{ $person->first_name }} {{ $person->middle_name }}</td>
                  <td>{{ $person->barangay ?: '—' }}</td>
                  <td>{{ $person->profiling_date ? \Carbon\Carbon::parse($person->profiling_date)->format('M d, Y') : '—' }}</td>
                  <td>{{ $category }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @else
        <div class="panel-empty">
          No recent records.
        </div>
      @endif
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  function updateDashboardClock() {
    const now = new Date();

    const dateOptions = {
      weekday: 'long',
      year: 'numeric',
      month: 'long',
      day: '2-digit'
    };

    const liveDateText = document.getElementById('liveDateText');
    const liveTimeText = document.getElementById('liveTimeText');
    const liveAmPm = document.getElementById('liveAmPm');
    const overviewLiveDateTime = document.getElementById('overviewLiveDateTime');

    let hours = now.getHours();
    const minutes = String(now.getMinutes()).padStart(2, '0');
    const seconds = String(now.getSeconds()).padStart(2, '0');
    const realAmpm = hours >= 12 ? 'PM' : 'AM';

    hours = hours % 12;
    hours = hours ? hours : 12;

    const formattedTime = `${String(hours).padStart(2, '0')}:${minutes}:${seconds}`;
    const formattedDate = now.toLocaleDateString('en-US', dateOptions);

    if (liveDateText) liveDateText.textContent = formattedDate;
    if (liveTimeText) liveTimeText.textContent = formattedTime;
    if (liveAmPm) liveAmPm.textContent = realAmpm;
    if (overviewLiveDateTime) overviewLiveDateTime.textContent = `${formattedDate} ${formattedTime} ${realAmpm}`;
  }

  setInterval(updateDashboardClock, 1000);
  updateDashboardClock();
</script>
@endpush