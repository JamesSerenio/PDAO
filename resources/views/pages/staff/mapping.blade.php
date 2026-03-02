<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Staff Mapping</title>

  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">
  <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">

  <!-- Leaflet -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
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

      <header class="dash-topbar">
        <div class="topbar-title">
          <h1>Mapping</h1>
          <p>Click the map to add a marker</p>
        </div>

        <div class="topbar-right">
          <div class="topbar-chip">
            <span class="chip-dot"></span>
            Staff
          </div>
        </div>
      </header>

      <section class="dash-content">
        <div class="panel">
          <div class="panel-head">
            <h2>Map</h2>
            <span class="panel-pill">Live</span>
          </div>

          <div class="panel-body" style="padding:0;">
            <div id="map" style="height: 560px; width:100%; border-radius: 18px;"></div>
          </div>
        </div>
      </section>

    </main>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    const map = L.map('map').setView([8.1486, 123.8445], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap'
    }).addTo(map);

    // Click-to-drop marker (sample)
    map.on('click', function(e) {
      const { lat, lng } = e.latlng;
      L.marker([lat, lng]).addTo(map)
        .bindPopup(`Lat: ${lat.toFixed(6)}<br>Lng: ${lng.toFixed(6)}`)
        .openPopup();
    });
  </script>
</body>
</html>