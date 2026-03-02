<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Local Profile Form</title>

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
          <div class="brand-sub">Staff Panel</div>
        </div>
      </div>

      <nav class="dash-nav">
        <a class="dash-link {{ request()->routeIs('staff.dashboard') ? 'active' : '' }}"
           href="{{ route('staff.dashboard') }}">
          <span class="dash-ico">🏠</span>
          <span>Dashboard</span>
        </a>

        <a class="dash-link {{ request()->routeIs('staff.local_profile_form') ? 'active' : '' }}"
           href="{{ route('staff.local_profile_form') }}">
          <span class="dash-ico">🧾</span>
          <span>Local Profile Form</span>
        </a>

        <a class="dash-link {{ request()->routeIs('staff.mapping') ? 'active' : '' }}"
           href="{{ route('staff.mapping') }}">
          <span class="dash-ico">🗺️</span>
          <span>Mapping</span>
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
          <h1>Local Profile Form</h1>
          <p>Fill up details for local profiling.</p>
        </div>

        <div class="topbar-right">
          <div class="topbar-chip">
            <span class="chip-dot"></span>
            Staff
          </div>
        </div>
      </header>

      <!-- CONTENT -->
      <section class="dash-content">

        @if (session('success'))
          <div class="panel" style="margin-bottom:16px;">
            <div class="panel-body">
              <b>{{ session('success') }}</b>
            </div>
          </div>
        @endif

        @if ($errors->any())
          <div class="panel" style="margin-bottom:16px;">
            <div class="panel-body">
              <b>Please fix the errors:</b>
              <ul style="margin:10px 0 0 18px;">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          </div>
        @endif

        <div class="panel">
          <div class="panel-head">
            <h2>Local Profile Form</h2>
            <span class="panel-pill">Form</span>
          </div>

          <div class="panel-body">
            <form method="POST" action="{{ route('staff.local_profile_form.store') }}">
              @csrf

              <div style="display:grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap:14px;">
                <div>
                  <label style="display:block; margin-bottom:6px;">Full Name</label>
                  <input
                    type="text"
                    name="full_name"
                    value="{{ old('full_name') }}"
                    placeholder="Juan Dela Cruz"
                    style="width:100%; padding:12px 12px; border-radius:12px; border:1px solid rgba(15,23,42,.12);"
                  >
                </div>

                <div>
                  <label style="display:block; margin-bottom:6px;">Contact Number</label>
                  <input
                    type="text"
                    name="contact_number"
                    value="{{ old('contact_number') }}"
                    placeholder="09xxxxxxxxx"
                    style="width:100%; padding:12px 12px; border-radius:12px; border:1px solid rgba(15,23,42,.12);"
                  >
                </div>

                <div>
                  <label style="display:block; margin-bottom:6px;">Address</label>
                  <input
                    type="text"
                    name="address"
                    value="{{ old('address') }}"
                    placeholder="Complete address"
                    style="width:100%; padding:12px 12px; border-radius:12px; border:1px solid rgba(15,23,42,.12);"
                  >
                </div>

                <div>
                  <label style="display:block; margin-bottom:6px;">Date of Birth</label>
                  <input
                    type="date"
                    name="dob"
                    value="{{ old('dob') }}"
                    style="width:100%; padding:12px 12px; border-radius:12px; border:1px solid rgba(15,23,42,.12);"
                  >
                </div>

                <div>
                  <label style="display:block; margin-bottom:6px;">Gender</label>
                  <select
                    name="gender"
                    style="width:100%; padding:12px 12px; border-radius:12px; border:1px solid rgba(15,23,42,.12); background:#fff;"
                  >
                    <option value="">-- Select --</option>
                    <option value="Male"   {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other"  {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                  </select>
                </div>

                <div>
                  <label style="display:block; margin-bottom:6px;">PWD ID No.</label>
                  <input
                    type="text"
                    name="pwd_id_no"
                    value="{{ old('pwd_id_no') }}"
                    placeholder="Optional"
                    style="width:100%; padding:12px 12px; border-radius:12px; border:1px solid rgba(15,23,42,.12);"
                  >
                </div>
              </div>

              <div style="margin-top:14px;">
                <label style="display:block; margin-bottom:6px;">Notes / Remarks</label>
                <textarea
                  name="remarks"
                  rows="4"
                  placeholder="Optional notes..."
                  style="width:100%; padding:12px 12px; border-radius:12px; border:1px solid rgba(15,23,42,.12); resize:vertical;"
                >{{ old('remarks') }}</textarea>
              </div>

              <div style="margin-top:16px; display:flex; gap:10px; justify-content:flex-end;">
                <a href="{{ route('staff.dashboard') }}"
                   class="dash-logout"
                   style="text-decoration:none; display:inline-flex; align-items:center; justify-content:center;">
                  Cancel
                </a>

                <button type="submit" class="dash-logout">
                  Save Form
                </button>
              </div>

            </form>
          </div>
        </div>

      </section>
    </main>

  </div>
</body>
</html>