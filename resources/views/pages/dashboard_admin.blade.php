<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin Dashboard</title>

  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">
  <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
</head>

<body class="dash-admin">
  <div class="dash-layout">

    <!-- SIDEBAR -->
    <aside class="dash-sidebar">
      <div class="dash-brand">
        <div class="brand-badge">
          <img src="{{ asset('img/LOGOP.png') }}" alt="Logo">
        </div>
        <div class="brand-text">
          <div class="brand-name">PDAO</div>
          <div class="brand-sub">Admin Panel</div>
        </div>
      </div>

      <nav class="dash-nav">
        <a class="dash-link active" href="#">
          <span class="dash-ico">🏠</span>
          <span>Dashboard</span>
        </a>

        <a class="dash-link" href="#">
          <span class="dash-ico">👤</span>
          <span>Users</span>
        </a>

        <a class="dash-link" href="#">
          <span class="dash-ico">🗂️</span>
          <span>Records</span>
        </a>

        <a class="dash-link" href="#">
          <span class="dash-ico">📄</span>
          <span>Reports</span>
        </a>

        <a class="dash-link" href="#">
          <span class="dash-ico">⚙️</span>
          <span>Settings</span>
        </a>
      </nav>

      <div class="dash-sidebar-footer">
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button class="dash-logout" type="submit">
            <span class="dash-ico">↩️</span>
            Logout
          </button>
        </form>
      </div>
    </aside>

    <!-- MAIN -->
    <main class="dash-main">

      <!-- TOPBAR -->
      <header class="dash-topbar">
        <div class="topbar-title">
          <h1>Admin Dashboard</h1>
          <p>Welcome, <b>{{ auth()->user()->name }}</b> ({{ auth()->user()->role }})</p>
        </div>

        <div class="topbar-right">
          <div class="topbar-chip">
            <span class="chip-dot"></span>
            Logged in
          </div>
        </div>
      </header>

      <!-- CONTENT -->
      <section class="dash-content">

        <!-- CARDS ROW -->
        <div class="dash-grid">
          <div class="dash-card">
            <div class="card-title">Total Users</div>
            <div class="card-value">0</div>
            <div class="card-sub">All registered accounts</div>
          </div>

          <div class="dash-card">
            <div class="card-title">Staff</div>
            <div class="card-value">0</div>
            <div class="card-sub">Active staff members</div>
          </div>

          <div class="dash-card">
            <div class="card-title">Reports</div>
            <div class="card-value">0</div>
            <div class="card-sub">Generated this month</div>
          </div>

          <div class="dash-card">
            <div class="card-title">System Status</div>
            <div class="card-value">OK</div>
            <div class="card-sub">No issues detected</div>
          </div>
        </div>

        <!-- BIG PANELS -->
        <div class="dash-panels">
          <div class="panel">
            <div class="panel-head">
              <h2>Overview</h2>
              <span class="panel-pill">Today</span>
            </div>
            <div class="panel-body panel-empty">
              No data yet. (Pwede natin lagyan chart later)
            </div>
          </div>

          <div class="panel">
            <div class="panel-head">
              <h2>Recent Activity</h2>
              <span class="panel-pill">Latest</span>
            </div>
            <div class="panel-body panel-empty">
              No recent activity.
            </div>
          </div>
        </div>

      </section>
    </main>

  </div>
</body>
</html>