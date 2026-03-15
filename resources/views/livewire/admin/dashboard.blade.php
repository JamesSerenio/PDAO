@extends('layouts.admin_shell')

@section('title', 'Admin Dashboard')
@section('page_title', 'Admin Dashboard')

@section('page_subtitle')
  Welcome, <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }})
@endsection

@section('content')

@php
  use Illuminate\Support\Facades\DB;

  // Total registered PWD = Registered Person
  $pwdCount = DB::table('local_profiles')->count();

  // Senior Citizens = age 60 and above
  $seniorCount = DB::table('local_profiles')
      ->whereNotNull('date_of_birth')
      ->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60')
      ->count();

  // Non-senior PWD
  $nonSeniorPwdCount = DB::table('local_profiles')
      ->where(function ($q) {
          $q->whereNull('date_of_birth')
            ->orWhereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) < 60');
      })
      ->count();

  // Latest profiling date
  $latestProfile = DB::table('local_profiles')
      ->orderByDesc('profiling_date')
      ->first();

  // Recent registrations
  $recentProfiles = DB::table('local_profiles')
      ->select('id', 'first_name', 'middle_name', 'last_name', 'barangay', 'profiling_date', 'date_of_birth')
      ->orderByDesc('created_at')
      ->limit(5)
      ->get();

  // Today count
  $todayCount = DB::table('local_profiles')
      ->whereDate('created_at', now()->toDateString())
      ->count();

  // This month count
  $monthCount = DB::table('local_profiles')
      ->whereYear('created_at', now()->year)
      ->whereMonth('created_at', now()->month)
      ->count();
@endphp

  <!-- CARDS ROW -->
  <div class="dash-grid">
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

    <div class="dash-card">
      <div class="card-title">Non-Senior PWD</div>
      <div class="card-value">{{ $nonSeniorPwdCount }}</div>
      <div class="card-sub">Below 60 years old</div>
    </div>

    <div class="dash-card">
      <div class="card-title">Registered This Month</div>
      <div class="card-value">{{ $monthCount }}</div>
      <div class="card-sub">New records this month</div>
    </div>
  </div>

  <!-- PANELS -->
  <div class="dash-panels">
    <div class="panel">
      <div class="panel-head">
        <h2>Overview</h2>
        <span class="panel-pill">Live</span>
      </div>

      <div class="panel-body">
        <div style="display:grid; gap:12px;">
          <div style="padding:12px; border:1px solid #e5e7eb; border-radius:12px; background:#fff;">
            <strong>Total Registered PWD:</strong> {{ $pwdCount }}
          </div>

          <div style="padding:12px; border:1px solid #e5e7eb; border-radius:12px; background:#fff;">
            <strong>Total Senior Citizens:</strong> {{ $seniorCount }}
          </div>

          <div style="padding:12px; border:1px solid #e5e7eb; border-radius:12px; background:#fff;">
            <strong>Registered Today:</strong> {{ $todayCount }}
          </div>

          <div style="padding:12px; border:1px solid #e5e7eb; border-radius:12px; background:#fff;">
            <strong>Latest Profiling Date:</strong>
            {{ $latestProfile && $latestProfile->profiling_date ? \Carbon\Carbon::parse($latestProfile->profiling_date)->format('F d, Y') : 'No record yet' }}
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
          <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse;">
              <thead>
                <tr>
                  <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Name</th>
                  <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Barangay</th>
                  <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Profiling Date</th>
                  <th style="text-align:left; padding:10px; border-bottom:1px solid #e5e7eb;">Category</th>
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
                    <td style="padding:10px; border-bottom:1px solid #f1f5f9;">
                      {{ $person->last_name }}, {{ $person->first_name }} {{ $person->middle_name }}
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #f1f5f9;">
                      {{ $person->barangay ?: '—' }}
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #f1f5f9;">
                      {{ $person->profiling_date ? \Carbon\Carbon::parse($person->profiling_date)->format('M d, Y') : '—' }}
                    </td>
                    <td style="padding:10px; border-bottom:1px solid #f1f5f9;">
                      {{ $category }}
                    </td>
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