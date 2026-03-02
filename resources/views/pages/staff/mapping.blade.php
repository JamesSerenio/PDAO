<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Staff Mapping</title>

  <link rel="icon" type="image/png" href="{{ asset('img/LOGOP.png') }}">
  <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">

  <!-- ✅ Page CSS -->
  <link rel="stylesheet" href="{{ asset('css/staffmapping.css') }}">

  <!-- Leaflet CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
</head>

<body class="dash-admin staffmapping">
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

      <!-- TOPBAR -->
      <header class="dash-topbar">
        <div class="topbar-title">
          <h1>Mapping</h1>
          <p>Search location and get coordinates</p>
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
        <div class="map-wrap">

          <!-- ✅ TOP BAR -->
          <div class="map-topbar anim-in">
            <div class="left">
              <h2 class="welcome">Welcome, {{ auth()->user()->name }}</h2>
              <p>Click map / drag marker to get latitude & longitude</p>
            </div>

            <div class="right">
              <div class="search-mini">
                <div class="search-box">
                  <input
                    id="searchInput"
                    class="search-input"
                    type="text"
                    placeholder="Search place..."
                    autocomplete="off"
                  />

                  <!-- ✅ Suggestion dropdown -->
                  <div id="suggestions" class="suggestions hidden"></div>
                </div>

                <button id="searchBtn" class="btn" type="button">
                  <span class="btn-txt">Search</span>
                  <span class="btn-glow"></span>
                </button>
              </div>
            </div>
          </div>

          <!-- ✅ COORDS CARD -->
          <div class="coords-card anim-in" style="animation-delay:.06s">
            <div class="coords" id="coords">Click the map to get latitude & longitude.</div>
            <div class="hint" id="hint"></div>
            <div class="micro" id="microTip">Tip: Use Enter to search faster.</div>
          </div>

          <!-- ✅ MAP PANEL -->
          <div class="panel map-panel anim-in" style="animation-delay:.12s">
            <div id="map"></div>
          </div>

        </div>
      </section>

    </main>
  </div>

  <!-- Leaflet JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    const barangays = [
      "Agusan Canyon","Alae","Dahilayan","Dalirig","Damilag","Diclum",
      "Guilang-guilang","Kalugmanan","Lindaban","Lingion","Lunocan","Maluko",
      "Mambatangan","Mampayag","Mantibugao","Minsuro","San Miguel","Sankanan",
      "Santiago","Santo Niño","Tankulan","Ticala"
    ];

    const defaultLat = 8.3132;
    const defaultLng = 124.8613;

    const map = L.map("map").setView([defaultLat, defaultLng], 12);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
      maxZoom: 19,
      attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

    const coordsEl = document.getElementById("coords");
    const hintEl = document.getElementById("hint");
    const microTip = document.getElementById("microTip");
    const searchInput = document.getElementById("searchInput");
    const searchBtn = document.getElementById("searchBtn");
    const suggestionsEl = document.getElementById("suggestions");

    function pulse(el) {
      el.classList.remove("pulse");
      void el.offsetWidth;
      el.classList.add("pulse");
    }

    function setCoords(lat, lng) {
      coordsEl.textContent = `Latitude: ${lat.toFixed(6)} | Longitude: ${lng.toFixed(6)}`;
      pulse(coordsEl);
    }

    function setHint(msg) {
      hintEl.textContent = msg || "";
      if (msg) pulse(hintEl);
    }

    function showSuggestions(items) {
      if (!items.length) {
        suggestionsEl.innerHTML = "";
        suggestionsEl.classList.add("hidden");
        return;
      }

      suggestionsEl.innerHTML = items.map(name => `
        <button type="button" class="sug-item" data-value="${name}">
          <span class="sug-pin">📍</span>
          <span class="sug-name">${name}</span>
          <span class="sug-sub">Manolo Fortich</span>
        </button>
      `).join("");

      suggestionsEl.classList.remove("hidden");
      suggestionsEl.classList.add("pop");
      setTimeout(() => suggestionsEl.classList.remove("pop"), 250);
    }

    function hideSuggestions() {
      suggestionsEl.classList.add("hidden");
    }

    function handleTyping() {
      const q = (searchInput.value || "").trim().toLowerCase();

      if (!q) {
        showSuggestions(barangays.slice(0, 8));
        return;
      }

      const matches = barangays
        .filter(b => b.toLowerCase().includes(q))
        .slice(0, 8);

      showSuggestions(matches);
    }

    suggestionsEl.addEventListener("click", (e) => {
      const btn = e.target.closest(".sug-item");
      if (!btn) return;

      const value = btn.getAttribute("data-value");
      searchInput.value = value;
      hideSuggestions();
      searchPlace();
    });

    document.addEventListener("click", (e) => {
      const isInside = e.target.closest(".search-box") || e.target.closest(".search-mini");
      if (!isInside) hideSuggestions();
    });

    searchInput.addEventListener("focus", handleTyping);
    searchInput.addEventListener("input", handleTyping);

    searchInput.addEventListener("keydown", (e) => {
      if (e.key === "Escape") hideSuggestions();
      if (e.key === "Enter") {
        hideSuggestions();
        searchPlace();
      }
    });

    setCoords(defaultLat, defaultLng);

    map.on("click", (e) => {
      marker.setLatLng(e.latlng);
      setCoords(e.latlng.lat, e.latlng.lng);
      setHint("");
      microTip.textContent = "✅ Coordinates updated from map click.";
      pulse(microTip);
    });

    marker.on("dragend", () => {
      const pos = marker.getLatLng();
      setCoords(pos.lat, pos.lng);
      setHint("");
      microTip.textContent = "✅ Coordinates updated from marker drag.";
      pulse(microTip);
    });

    async function searchPlace() {
      const q = (searchInput.value || "").trim();
      if (!q) {
        setHint("Type a place name first.");
        microTip.textContent = "⚠️ Please enter a place to search.";
        pulse(microTip);
        searchInput.focus();
        showSuggestions(barangays.slice(0, 8));
        return;
      }

      setHint("Searching...");
      searchBtn.classList.add("loading");
      microTip.textContent = "🔎 Searching location...";
      pulse(microTip);

      try {
        const query = `${q}, Manolo Fortich, Bukidnon, Philippines`;
        const url = `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(query)}`;
        const res = await fetch(url, { headers: { "Accept": "application/json" } });
        if (!res.ok) throw new Error("Search failed");

        const data = await res.json();
        if (!data || data.length === 0) {
          setHint("No results. Try a more specific keyword.");
          microTip.textContent = "❌ No result. Try adding city/province.";
          pulse(microTip);
          return;
        }

        const lat = parseFloat(data[0].lat);
        const lng = parseFloat(data[0].lon);

        map.setView([lat, lng], 15, { animate: true });
        marker.setLatLng([lat, lng]);
        setCoords(lat, lng);

        setHint(data[0].display_name || "Found!");
        microTip.textContent = "✅ Location found and marker moved.";
        pulse(microTip);
      } catch (err) {
        setHint("Error searching. Check internet connection and try again.");
        microTip.textContent = "⚠️ Search error. Try again.";
        pulse(microTip);
      } finally {
        searchBtn.classList.remove("loading");
      }
    }

    searchBtn.addEventListener("click", () => {
      hideSuggestions();
      searchPlace();
    });
  </script>
</body>
</html>