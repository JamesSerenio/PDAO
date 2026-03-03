@extends('layouts.staff_shell')

@section('title', 'Staff Dashboard')
@section('page_title', 'Staff Dashboard')

@section('page_subtitle')
  Welcome, <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }})
@endsection

@section('content')

  <!-- CARDS ROW -->
  <div class="dash-grid">
    <div class="dash-card">
      <div class="card-title">My Tasks</div>
      <div class="card-value">0</div>
      <div class="card-sub">Assigned to you</div>
    </div>

    <div class="dash-card">
      <div class="card-title">Reports Submitted</div>
      <div class="card-value">0</div>
      <div class="card-sub">This month</div>
    </div>

    <div class="dash-card">
      <div class="card-title">Status</div>
      <div class="card-value">Active</div>
      <div class="card-sub">Account status</div>
    </div>

    <div class="dash-card">
      <div class="card-title">System</div>
      <div class="card-value">OK</div>
      <div class="card-sub">Running normally</div>
    </div>
  </div>

  <!-- PANELS -->
  <div class="dash-panels">
    <div class="panel">
      <div class="panel-head">
        <h2>My Overview</h2>
        <span class="panel-pill">Today</span>
      </div>
      <div class="panel-body panel-empty">
        No activity yet.
      </div>
    </div>

    <div class="panel">
      <div class="panel-head">
        <h2>Recent Actions</h2>
        <span class="panel-pill">Latest</span>
      </div>
      <div class="panel-body panel-empty">
        No recent records.
      </div>
    </div>
  </div>

@endsection