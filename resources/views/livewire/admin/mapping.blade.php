{{-- resources/views/livewire/admin/mapping.blade.php --}}

<div class="map-wrap">

  <div class="map-topbar anim-in">
    <div class="left">
      <h2 class="welcome">Welcome, {{ auth()->user()->name }}</h2>
      <p>Search barangay then view PWD profiles under that barangay.</p>
    </div>

    <div class="right">
      <div class="search-mini">
        <div class="search-box">
          <input
            id="searchInput"
            class="search-input"
            type="text"
            placeholder="Search barangay..."
            autocomplete="off"
            wire:model.defer="searchBarangay"
          />
          <div id="suggestions" class="suggestions hidden"></div>
        </div>

        <button
          id="searchBtn"
          class="btn"
          type="button"
          wire:click="search"
          wire:loading.attr="disabled"
        >
          <span class="btn-txt" wire:loading.remove>Search</span>
          <span class="btn-txt" wire:loading>Searching...</span>
          <span class="btn-glow"></span>
        </button>
      </div>
    </div>
  </div>

<div class="coords-card anim-in hidden-coords-card">
  <div id="coords"></div>
  <div id="hint"></div>
  <div id="microTip"></div>
</div>

  <div class="map-shell anim-in" style="animation-delay:.12s">
    <div class="map-panel">
      <div wire:ignore id="map"></div>

    <div id="purokLegend" class="purok-legend is-hidden" style="display:none !important;">
      <div class="legend-sub" id="legendBarangay"></div>
      <div class="legend-list" id="legendList"></div>
    </div>

      <aside id="resultsDrawer"
             class="results-drawer {{ $showResults ? '' : 'is-hidden' }}"
             aria-label="Results Panel">

        <div class="results-head">
          <div class="results-title">
            <div>
              <h3 style="margin:0;">Results</h3>
              <div class="results-meta">
                Barangay: <b>{{ $searchBarangay ?: '—' }}</b>
                <span class="dot">•</span>
                Barangay Overall: <b>{{ array_sum($purokCounts ?? []) ?: count($profiles) }}</b>
                    <span class="dot">•</span>
                    Showing: <b>{{ count($profiles) }}</b>
                <span wire:loading class="loading">(Loading...)</span>
              </div>
            </div>

            <button
              type="button"
              class="drawer-close"
              aria-label="Close results"
              wire:click="closeResults"
            >×</button>
          </div>

        <div class="results-sub">
          <div class="purok-filter-title">Filter by Sitio/Purok</div>

          <div class="purok-filter-list">
            <button
              type="button"
              class="purok-filter-btn {{ $selectedPurok === '' ? 'active' : '' }}"
              wire:click="setPurokFilter('ALL')"
            >
              <span>All</span>
              <b>{{ array_sum($purokCounts ?? []) }}</b>
            </button>

            @foreach(($purokCounts ?? []) as $purokName => $purokTotal)
              <button
                type="button"
                class="purok-filter-btn {{ $selectedPurok === $purokName ? 'active' : '' }}"
                wire:click="setPurokFilter(@js($purokName))"
              >
                <span>{{ $purokName }}</span>
                <b>{{ $purokTotal }}</b>
              </button>
            @endforeach
          </div>
        </div>
        </div>

        <div class="results-body">
          @if (count($profiles) === 0)
            <div class="empty">
              No results. Search a barangay (example: <b>Tankulan</b>).
            </div>
          @else
            <div class="cards">
              @foreach($profiles as $p)
                <div class="card">
                  <div class="card-top">
                    <div class="avatar">
                      @if(!empty($p['photo_url']))
                        <img src="{{ $p['photo_url'] }}" alt="Photo">
                      @else
                        <span>{{ $p['initials'] ?? 'NP' }}</span>
                      @endif
                    </div>

                    <div class="person">
                      <div class="name">{{ $p['last_name'] }}, {{ $p['first_name'] }}</div>
                      <div class="age">Age: <b>{{ $p['age'] ?? '—' }}</b></div>
                      <div class="age">Sitio/Purok: <b>{{ $p['sitio_purok'] ?? '—' }}</b></div>
                    </div>
                  </div>

                  <div class="card-mid">
                    <div class="label">Types of Disability</div>
                    <div class="value">{{ $p['disability_types'] }}</div>
                  </div>
                </div>
              @endforeach
            </div>
          @endif
        </div>
      </aside>
    </div>
  </div>
</div>

@push('styles')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <style>
    #map {
      width: 100%;
      min-height: 78vh;
      border-radius: 22px;
      overflow: hidden;
      z-index: 1;
      border: 1px solid rgba(255,255,255,0.32);
      box-shadow:
        0 28px 70px rgba(15, 23, 42, 0.20),
        0 10px 28px rgba(15, 23, 42, 0.10),
        inset 0 1px 0 rgba(255,255,255,0.18);
      background: #dbeafe;
    }

    .map-panel {
      position: relative;
      border-radius: 24px;
      overflow: hidden;
      background:
        linear-gradient(180deg, rgba(255,255,255,0.18), rgba(255,255,255,0.04));
      backdrop-filter: blur(6px);
    }

    #map::after {
      content: "";
      position: absolute;
      inset: 0;
      pointer-events: none;
      background: radial-gradient(circle at center, rgba(255,255,255,0) 55%, rgba(0,0,0,0.12) 100%);
    }

    .hidden,
    .is-hidden {
      display: none !important;
    }

    .hidden-coords-card{
      display:none !important;
      height:0 !important;
      min-height:0 !important;
      margin:0 !important;
      padding:0 !important;
      overflow:hidden !important;
      opacity:0 !important;
      pointer-events:none !important;
    }

    .search-box {
      position: relative;
    }

    .suggestions {
      position: absolute;
      top: calc(100% + 8px);
      left: 0;
      right: 0;
      z-index: 9999;
      background: #fff;
      border: 1px solid rgba(15, 23, 42, .08);
      border-radius: 16px;
      box-shadow: 0 16px 35px rgba(2, 6, 23, .14);
      padding: 8px;
      max-height: 300px;
      overflow-y: auto;
    }

    .sug-item {
      width: 100%;
      display: flex;
      align-items: center;
      gap: 10px;
      border: none;
      background: transparent;
      text-align: left;
      padding: 10px 12px;
      border-radius: 12px;
      cursor: pointer;
    }

    .sug-item:hover {
      background: #f3f4f6;
    }

    .purok-filter-title {
      font-size: 12px;
      font-weight: 800;
      color: #0f172a;
      margin-bottom: 8px;
    }

    .purok-filter-list {
      display: flex;
      gap: 8px;
      overflow-x: auto;
      padding-bottom: 4px;
    }

    .purok-filter-btn {
      border: 1px solid rgba(15,23,42,.10);
      background: #fff;
      color: #0f172a;
      border-radius: 999px;
      padding: 8px 11px;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      cursor: pointer;
      white-space: nowrap;
      font-size: 12px;
      font-weight: 800;
      box-shadow: 0 6px 14px rgba(15,23,42,.06);
    }

    .purok-filter-btn b {
      min-width: 22px;
      height: 22px;
      padding: 0 7px;
      border-radius: 999px;
      background: #ecfdf5;
      color: #16a34a;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    .purok-filter-btn.active {
      background: #16a34a;
      color: #fff;
      border-color: #16a34a;
    }

    .purok-filter-btn.active b {
      background: rgba(255,255,255,.22);
      color: #fff;
    }

    .sug-pin {
      font-size: 14px;
    }

    .sug-name {
      font-weight: 700;
      color: #111827;
      flex: 1;
    }

    .sug-sub {
      font-size: 12px;
      color: #6b7280;
    }

    .results-drawer {
      position: absolute;
      top: 16px;
      right: 16px;
      width: min(360px, calc(100% - 32px));
      max-height: calc(100% - 32px);
      overflow: hidden;
      border-radius: 24px;
      background: rgba(255,255,255,0.96);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(15,23,42,.08);
      box-shadow: 0 18px 45px rgba(15, 23, 42, .18);
      z-index: 900;
      display: flex;
      flex-direction: column;
    }

    .results-head {
      padding: 18px 18px 10px;
      border-bottom: 1px solid rgba(15,23,42,.06);
      background: linear-gradient(180deg, rgba(255,255,255,1), rgba(248,250,252,.95));
    }

    .results-title {
      display: flex;
      justify-content: space-between;
      gap: 12px;
      align-items: flex-start;
    }

    .results-meta {
      margin-top: 6px;
      font-size: 13px;
      color: #64748b;
    }

    .results-meta .dot {
      margin: 0 6px;
    }

    .drawer-close {
      width: 36px;
      height: 36px;
      border: none;
      border-radius: 12px;
      background: #f1f5f9;
      color: #0f172a;
      font-size: 24px;
      line-height: 1;
      cursor: pointer;
    }

    .drawer-close:hover {
      background: #e2e8f0;
    }

    .results-sub {
      margin-top: 10px;
      font-size: 12px;
      color: #64748b;
    }

    .results-body {
      padding: 14px;
      overflow-y: auto;
    }

    .cards {
      display: grid;
      gap: 12px;
    }

    .card {
      background: #fff;
      border: 1px solid rgba(15,23,42,.06);
      border-radius: 18px;
      padding: 14px;
      box-shadow: 0 8px 22px rgba(15,23,42,.06);
    }

    .card-top {
      display: flex;
      gap: 12px;
      align-items: center;
    }

    .avatar {
      width: 54px;
      height: 54px;
      border-radius: 16px;
      overflow: hidden;
      flex: 0 0 54px;
      background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
      display: flex;
      align-items: center;
      justify-content: center;
      color: #0f172a;
      font-weight: 800;
    }

    .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .person .name {
      font-size: 15px;
      font-weight: 800;
      color: #0f172a;
      line-height: 1.25;
    }

    .person .age {
      margin-top: 4px;
      font-size: 13px;
      color: #64748b;
    }

    .card-mid {
      margin-top: 12px;
      padding-top: 12px;
      border-top: 1px solid rgba(15,23,42,.06);
    }

    .card-mid .label {
      font-size: 12px;
      color: #64748b;
      margin-bottom: 4px;
    }

    .card-mid .value {
      font-size: 14px;
      font-weight: 700;
      color: #0f172a;
    }

    .empty {
      padding: 18px;
      border-radius: 18px;
      background: #f8fafc;
      color: #475569;
      border: 1px dashed rgba(15,23,42,.12);
    }

    .pulse {
      animation: pulseGlow .35s ease;
    }

    @keyframes pulseGlow {
      0% { transform: scale(1); opacity: .9; }
      50% { transform: scale(1.02); opacity: 1; }
      100% { transform: scale(1); opacity: 1; }
    }

    .barangay-pin-wrap {
      width: 32px;
      height: 40px;
      display: flex;
      align-items: flex-start;
      justify-content: center;
      position: relative;
    }

    .barangay-pin {
      position: relative;
      width: 24px;
      height: 24px;
      background: linear-gradient(135deg, #ff6b6b, #dc2626);
      border: 2px solid #ffffff;
      border-radius: 50% 50% 50% 0;
      transform: rotate(-45deg);
      box-shadow:
        0 12px 24px rgba(220, 38, 38, 0.35),
        0 4px 10px rgba(0, 0, 0, 0.18);
    }

    .barangay-pin::after {
      content: "";
      position: absolute;
      width: 9px;
      height: 9px;
      background: #fff;
      border-radius: 50%;
      top: 5px;
      left: 5px;
    }

    .barangay-pin-wrap::after {
      content: "";
      position: absolute;
      bottom: 1px;
      width: 18px;
      height: 8px;
      background: rgba(0,0,0,0.22);
      filter: blur(5px);
      border-radius: 999px;
    }

    .profile-marker-wrap {
      width: 42px;
      height: 42px;
      border-radius: 999px;
      background: #fff;
      border: 3px solid #22c55e;
      overflow: hidden;
      box-shadow: 0 10px 24px rgba(0,0,0,.22);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .profile-marker-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
    }

    .profile-marker-fallback {
      width: 100%;
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #22c55e, #16a34a);
      color: #fff;
      font-size: 12px;
      font-weight: 800;
      letter-spacing: .4px;
    }

    .profile-popup {
      min-width: 180px;
    }

    .profile-popup .ttl {
      font-weight: 800;
      margin-bottom: 4px;
      color: #111827;
    }

    .profile-popup .meta {
      font-size: 12px;
      color: #4b5563;
      margin-bottom: 4px;
    }

    .profile-popup .type {
      font-size: 12px;
      color: #111827;
    }

    .leaflet-tooltip.barangay-tooltip-shell,
    .leaflet-tooltip.purok-tooltip-shell {
      background: transparent !important;
      border: none !important;
      box-shadow: none !important;
      padding: 0 !important;
    }

    .leaflet-tooltip.barangay-tooltip-shell::before,
    .leaflet-tooltip.purok-tooltip-shell::before {
      display: none !important;
    }

    .barangay-tooltip-card,
    .purok-tooltip-card {
      min-width: 132px;
      padding: 10px 12px;
      border-radius: 16px;
      color: #fff;
      background: linear-gradient(135deg, rgba(17,24,39,.96), rgba(31,41,55,.96));
      border: 1px solid rgba(255,255,255,.08);
      box-shadow: 0 14px 30px rgba(0,0,0,.26);
      backdrop-filter: blur(8px);
      animation: tooltipIn .18s ease;
      text-align: center;
    }

    .barangay-tooltip-name,
    .purok-tooltip-name {
      font-size: 13px;
      font-weight: 800;
      line-height: 1.2;
      margin-bottom: 4px;
      letter-spacing: .2px;
    }

    .barangay-tooltip-count,
    .purok-tooltip-sub {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      font-size: 12px;
      font-weight: 700;
      color: #d1fae5;
      background: rgba(16, 185, 129, .14);
      border: 1px solid rgba(52, 211, 153, .25);
      border-radius: 999px;
      padding: 5px 10px;
    }

    .barangay-tooltip-dot {
      width: 7px;
      height: 7px;
      border-radius: 999px;
      background: #34d399;
      box-shadow: 0 0 12px rgba(52, 211, 153, .7);
    }

    .purok-legend {
      display: none !important;
      position: absolute;
      left: 16px;
      bottom: 16px;
      width: min(320px, calc(100% - 32px));
      max-height: 220px;
      overflow: hidden;
      border-radius: 22px;
      background: rgba(15,23,42,.86);
      color: #fff;
      border: 1px solid rgba(255,255,255,.08);
      box-shadow: 0 20px 40px rgba(2,6,23,.28);
      z-index: 850;
      backdrop-filter: blur(10px);
    }

    .legend-title {
      padding: 14px 16px 4px;
      font-size: 14px;
      font-weight: 800;
    }

    .legend-sub {
      padding: 0 16px 10px;
      color: #cbd5e1;
      font-size: 12px;
    }

    .legend-list {
      max-height: 140px;
      overflow-y: auto;
      padding: 0 10px 12px;
      display: grid;
      gap: 8px;
    }

    .legend-item {
      border-radius: 14px;
      padding: 10px 12px;
      background: rgba(255,255,255,.06);
      border: 1px solid rgba(255,255,255,.06);
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 10px;
    }

    .legend-item-left {
      display: flex;
      align-items: center;
      gap: 10px;
      min-width: 0;
    }

    .legend-swatch {
      width: 12px;
      height: 12px;
      border-radius: 999px;
      flex: 0 0 12px;
    }

    .legend-name {
      font-size: 13px;
      font-weight: 700;
      color: #fff;
      line-height: 1.2;
    }

    .legend-zone {
      font-size: 11px;
      color: #cbd5e1;
      white-space: nowrap;
    }

    .leaflet-control-attribution {
      display: none !important;
    }

    @keyframes tooltipIn {
      from {
        opacity: 0;
        transform: translateY(7px) scale(.97);
      }
      to {
        opacity: 1;
        transform: translateY(0) scale(1);
      }
    }

    .leaflet-interactive:focus,
    .leaflet-container svg path:focus,
    .leaflet-container .leaflet-popup:focus,
    .leaflet-container .leaflet-popup-content-wrapper:focus,
    .leaflet-container .leaflet-popup-tip-container:focus {
      outline: none !important;
      box-shadow: none !important;
    }

    .leaflet-container a:focus,
    .leaflet-container button:focus,
    .leaflet-container .leaflet-marker-icon:focus,
    .leaflet-container .leaflet-pane svg *:focus {
      outline: none !important;
      box-shadow: none !important;
    }

    @media (max-width: 980px) {
      .results-drawer {
        position: static;
        width: 100%;
        max-height: none;
        margin-top: 14px;
      }

      .map-panel {
        display: grid;
        gap: 14px;
      }

      .purok-legend {
        left: 12px;
        right: 12px;
        width: auto;
        bottom: 12px;
      }
    }
  </style>
@endpush

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script type="application/json" id="barangayCountsJson">@json($barangayCounts ?? [])</script>

  <script>
    function initAdminMap() {
      const mapEl = document.getElementById("map");
      if (!mapEl) return;

      if (window.__adminMapInitialized === true) {
        if (window.__adminMap) {
          setTimeout(() => window.__adminMap.invalidateSize(true), 60);
          setTimeout(() => window.__adminMap.invalidateSize(true), 250);
        }
        return;
      }

      window.__adminMapInitialized = true;

      const barangays = [
        "Agusan Canyon",
        "Alae",
        "Dahilayan",
        "Dalirig",
        "Damilag",
        "Dicklum",
        "Guilang-guilang",
        "Kalugmanan",
        "Lindaban",
        "Lingion",
        "Lunocan",
        "Maluko",
        "Mambatangan",
        "Mampayag",
        "Mantibugao",
        "Minsuro",
        "San Miguel",
        "Sankanan",
        "Santiago",
        "Santo Niño",
        "Tankulan",
        "Ticala"
      ];

      const invalidBoundaryNames = [
        "Guilangguilang VS Impasugong",
        "Guilangguilang VS Malitbog",
        "Santiago VS Impasugong"
      ];

      const defaultLat = 8.3132;
      const defaultLng = 124.8613;

      const coordsEl = document.getElementById("coords");
      const hintEl = document.getElementById("hint");
      const microTip = document.getElementById("microTip");
      const searchInput = document.getElementById("searchInput");
      const searchBtn = document.getElementById("searchBtn");
      const suggestionsEl = document.getElementById("suggestions");
      const legendEl = document.getElementById("purokLegend");
      const legendBarangayEl = document.getElementById("legendBarangay");
      const legendListEl = document.getElementById("legendList");

      let geoJsonLayer = null;
      let activePolygon = null;
      let profileMarkersLayer = L.layerGroup();
      let barangayPointLayer = L.layerGroup();
      let purokLayerGroup = L.layerGroup();
      let polygonLayerMap = {};
      let purokGeoJsonRaw = null;
      let activeBarangayName = "";

      const initialBarangayCounts = JSON.parse(document.getElementById('barangayCountsJson').textContent);
      window.__barangayCounts = {};
      window.__purokCounts = {};

      const map = L.map("map", {
        zoomControl: true,
        scrollWheelZoom: true,
        doubleClickZoom: true,
        boxZoom: true,
        keyboard: true,
        dragging: true,
        zoomSnap: 0.25,
        zoomDelta: 0.25,
        wheelPxPerZoomLevel: 80,
        minZoom: 10,
        maxZoom: 22,
        attributionControl: false
      }).setView([defaultLat, defaultLng], 12);

      window.__adminMap = map;

      const premiumBase = L.tileLayer(
        "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
        {
          maxZoom: 22,
          maxNativeZoom: 18,
          attribution: "Tiles © Esri"
        }
      );

      premiumBase.addTo(map);

      const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);
      profileMarkersLayer.addTo(map);
      barangayPointLayer.addTo(map);
      purokLayerGroup.addTo(map);

      setTimeout(() => map.invalidateSize(true), 60);
      setTimeout(() => map.invalidateSize(true), 250);

      function pulse(el) {
        if (!el) return;
        el.classList.remove("pulse");
        void el.offsetWidth;
        el.classList.add("pulse");
      }

      function escapeHtml(str) {
        return String(str ?? "")
          .replace(/&/g, "&amp;")
          .replace(/</g, "&lt;")
          .replace(/>/g, "&gt;")
          .replace(/"/g, "&quot;")
          .replace(/'/g, "&#039;");
      }

      function setCoords(lat, lng) {
        coordsEl.textContent = `Latitude: ${lat.toFixed(6)} | Longitude: ${lng.toFixed(6)}`;
        pulse(coordsEl);
      }

      function setHint(msg) {
        hintEl.textContent = msg || "";
        if (msg) pulse(hintEl);
      }

      function normalizeBarangayName(name) {
        const raw = (name || "").trim();

        const mapping = {
          "Tankulan (Pob.)": "Tankulan",
          "Tankulan Pob.": "Tankulan",
          "Tankulan Poblacion": "Tankulan",
          "Tankulan (Poblacion)": "Tankulan",
          "Guilangguilang": "Guilang-guilang",
          "Santo Nino": "Santo Niño"
        };

        return mapping[raw] || raw;
      }

      function hydrateCounts(rawCounts) {
        const normalized = {};
        Object.entries(rawCounts || {}).forEach(([key, value]) => {
          const name = normalizeBarangayName(key);
          normalized[name] = Number(value || 0);
        });
        window.__barangayCounts = normalized;
      }

      function getBarangayCount(name) {
        const normalized = normalizeBarangayName(name);
        return Number(window.__barangayCounts?.[normalized] || 0);
      }

      function updateBarangayCount(name, count) {
        const normalized = normalizeBarangayName(name);
        window.__barangayCounts[normalized] = Number(count || 0);
      }

      hydrateCounts(initialBarangayCounts);

      function isValidBarangay(name) {
        return barangays.includes(normalizeBarangayName(name));
      }

      function syncToLivewireInput(value) {
        searchInput.value = value;
        searchInput.dispatchEvent(new Event("input", { bubbles: true }));
        searchInput.dispatchEvent(new Event("change", { bubbles: true }));
      }

      function showSuggestions(items) {
        if (!items.length) {
          suggestionsEl.innerHTML = "";
          suggestionsEl.classList.add("hidden");
          return;
        }

        suggestionsEl.innerHTML = items.map(name => `
          <button type="button" class="sug-item" data-value="${escapeHtml(name)}">
            <span class="sug-pin">📍</span>
            <span class="sug-name">${escapeHtml(name)}</span>
            <span class="sug-sub">Manolo Fortich</span>
          </button>
        `).join("");

        suggestionsEl.classList.remove("hidden");
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

      function getColor(name) {
        const colors = [
          "#22c55e", "#0ea5e9", "#f59e0b", "#ef4444", "#8b5cf6",
          "#14b8a6", "#f97316", "#06b6d4", "#84cc16", "#3b82f6"
        ];

        let hash = 0;
        for (let i = 0; i < name.length; i++) {
          hash = name.charCodeAt(i) + ((hash << 5) - hash);
        }

        return colors[Math.abs(hash) % colors.length];
      }

      function getPurokColor(name) {
        const colors = [
          "#60a5fa", "#34d399", "#fbbf24", "#f87171", "#a78bfa",
          "#f472b6", "#22d3ee", "#fb7185", "#4ade80", "#f59e0b"
        ];

        let hash = 0;
        for (let i = 0; i < name.length; i++) {
          hash = name.charCodeAt(i) + ((hash << 5) - hash);
        }

        return colors[Math.abs(hash) % colors.length];
      }

      function defaultPolygonStyle(feature) {
        const rawName = feature?.properties?.name || "";
        const name = normalizeBarangayName(rawName);

        if (invalidBoundaryNames.includes(rawName)) {
          return {
            color: "#94a3b8",
            weight: 2,
            opacity: 0.55,
            fillOpacity: 0
          };
        }

        const color = getColor(name);

        return {
          color: color,
          weight: 3.5,
          opacity: 0.95,
          fillColor: color,
          fillOpacity: 0
        };
      }

      function hoverPolygonStyle(feature) {
        const rawName = feature?.properties?.name || "";
        const name = normalizeBarangayName(rawName);
        const color = getColor(name);

        return {
          color: "#ffffff",
          weight: 5.5,
          opacity: 1,
          fillColor: color,
          fillOpacity: 0
        };
      }

      function activePolygonStyle(feature) {
        const rawName = feature?.properties?.name || "";
        const name = normalizeBarangayName(rawName);
        const color = getColor(name);

        return {
          color: "#0f172a",
          weight: 6.5,
          opacity: 1,
          fillColor: color,
          fillOpacity: 0
        };
      }

      function purokPolygonStyle(feature) {
        const purokName = feature?.properties?.["Zone Name"] || "Unknown";
        const color = getPurokColor(purokName);

        return {
          color: color,
          weight: 2.4,
          opacity: 0.95,
          fillColor: color,
          fillOpacity: 0.06
        };
      }

      function purokHoverStyle(feature) {
        const purokName = feature?.properties?.["Zone Name"] || "Unknown";
        const color = getPurokColor(purokName);

        return {
          color: "#ffffff",
          weight: 3.6,
          opacity: 1,
          fillColor: color,
          fillOpacity: 0.16
        };
      }

      function getLayerCenter(layer) {
        const barangayName = normalizeBarangayName(layer?.feature?.properties?.name || "");

        const manualCenters = {
          "Dahilayan": L.latLng(8.199722, 124.859659),
          "Maluko": L.latLng(8.385093, 124.947517),
          "Guilang-guilang": L.latLng(8.471948, 124.985790),
          "Dalirig": L.latLng(8.391885, 124.914217),
          "Alae": L.latLng(8.424744, 124.818849),
          "Mambatangan": L.latLng(8.474071, 124.800392),
          "Mantibugao": L.latLng(8.470421, 124.824766),
          "Lunocan": L.latLng(8.442489, 124.842101),
          "Santo Niño": L.latLng(8.436206, 124.869232),
        };

        if (manualCenters[barangayName]) {
          return manualCenters[barangayName];
        }

        try {
          if (typeof layer.getCenter === "function") {
            const c = layer.getCenter();
            if (c && isFinite(c.lat) && isFinite(c.lng)) {
              return c;
            }
          }
        } catch (e) {}

        try {
          const bounds = layer.getBounds();
          if (bounds) {
            const c = bounds.getCenter();
            if (c && isFinite(c.lat) && isFinite(c.lng)) {
              return c;
            }
          }
        } catch (e) {}

        return L.latLng(defaultLat, defaultLng);
      }

      function createProfileIcon(profile) {
        const hasPhoto = !!profile.photo_url;
        const initials = escapeHtml(profile.initials || "NP");

        const html = hasPhoto
          ? `<div class="profile-marker-wrap"><img src="${escapeHtml(profile.photo_url)}" alt="${escapeHtml(profile.full_name || '')}"></div>`
          : `<div class="profile-marker-wrap"><div class="profile-marker-fallback">${initials}</div></div>`;

        return L.divIcon({
          className: "profile-div-icon",
          html,
          iconSize: [42, 42],
          iconAnchor: [21, 21],
          popupAnchor: [0, -18]
        });
      }

      function createProfilePopup(profile, barangay) {
        return `
          <div class="profile-popup">
            <div class="ttl">${escapeHtml(profile.full_name || 'Unknown')}</div>
            <div class="meta">Barangay: <b>${escapeHtml(barangay)}</b></div>
            <div class="meta">Age: <b>${escapeHtml(profile.age ?? '—')}</b></div>
            <div class="type">Disability: ${escapeHtml(profile.disability_types || '—')}</div>
          </div>
        `;
      }

      function createBarangayTooltip(name) {
        const count = getBarangayCount(name);

        return `
          <div class="barangay-tooltip-card">
            <div class="barangay-tooltip-name">${escapeHtml(name)}</div>
            <div class="barangay-tooltip-count">
              <span class="barangay-tooltip-dot"></span>
              ${count} person${count !== 1 ? "s" : ""}
            </div>
          </div>
        `;
      }

      function createPurokTooltip(feature) {
        const purokName = feature?.properties?.["Zone Name"] || "Unknown";
        const barangayName = normalizeBarangayName(feature?.properties?.BarangayNa || "");
        const zoneNo = feature?.properties?.["Zone "] ?? feature?.properties?.Zone ?? "—";

        return `
          <div class="purok-tooltip-card">
            <div class="purok-tooltip-name">${escapeHtml(purokName)}</div>
            <div class="purok-tooltip-sub">${escapeHtml(barangayName)} • Zone ${escapeHtml(zoneNo)}</div>
          </div>
        `;
      }

      function clearProfileMarkers() {
        profileMarkersLayer.clearLayers();
      }

    function clearPurokLayer(forceHideLegend = false) {
      purokLayerGroup.clearLayers();

      if (forceHideLegend) {
        legendBarangayEl.textContent = "Select a barangay first";
        legendListEl.innerHTML = "";
        legendEl.classList.add("is-hidden");
      }
    }

      function renderBarangayProfileMarkers(barangayName, profiles) {
        clearProfileMarkers();

        if (!barangayName || !profiles || !profiles.length) return;

        const normalized = normalizeBarangayName(barangayName);
        const targetLayer = polygonLayerMap[normalized];
        if (!targetLayer) return;

        const center = getLayerCenter(targetLayer);
        const count = profiles.length;

        profiles.forEach((profile, index) => {
          const angle = (index / Math.max(count, 1)) * Math.PI * 2;
          const ring = Math.floor(index / 8);
          const offset = 0.002 + (ring * 0.0009);

          const lat = center.lat + Math.sin(angle) * offset;
          const lng = center.lng + Math.cos(angle) * offset;

          const personMarker = L.marker([lat, lng], {
            icon: createProfileIcon(profile)
          });

          personMarker.bindPopup(createProfilePopup(profile, normalized));
          profileMarkersLayer.addLayer(personMarker);
        });
      }

      function zoomToPolygon(layer, maxZoom = 18) {
        try {
          const bounds = layer.getBounds();
          map.fitBounds(bounds, {
            padding: [20, 20],
            maxZoom
          });

          const center = getLayerCenter(layer);
          marker.setLatLng(center);
          setCoords(center.lat, center.lng);
        } catch (e) {}
      }

      function activatePolygon(layer, feature) {
        if (activePolygon && geoJsonLayer) {
          geoJsonLayer.resetStyle(activePolygon);
        }

        activePolygon = layer;
        layer.setStyle(activePolygonStyle(feature));
        layer.bringToFront();
      }

      function selectBarangayOnMap(name) {
        const normalized = normalizeBarangayName(name);
        const layer = polygonLayerMap[normalized];

        if (!layer) {
          setHint(`Barangay "${normalized}" not found on map.`);
          return false;
        }

        activeBarangayName = normalized;
        activatePolygon(layer, layer.feature);
        zoomToPolygon(layer);
        setHint(`Selected barangay: ${normalized}`);
        return true;
      }

      function renderLegend(barangayName, features) {
        if (!features?.length) {
          clearPurokLayer();
          return;
        }

        legendBarangayEl.textContent = barangayName;
        legendListEl.innerHTML = features.map((feature) => {
          const purokName = feature?.properties?.["Zone Name"] || "Unknown";
          const zoneNo = feature?.properties?.["Zone "] ?? feature?.properties?.Zone ?? "—";
          const color = getPurokColor(purokName);

          return `
            <div class="legend-item">
              <div class="legend-item-left">
                <span class="legend-swatch" style="background:${color}"></span>
                <div class="legend-name">${escapeHtml(purokName)}</div>
              </div>
              <div class="legend-zone">Zone ${escapeHtml(zoneNo)} • ${Number(window.__purokCounts?.[purokName] || 0)} person</div>
            </div>
          `;
        }).join("");

        // legend hidden
      }

      function renderPurokForBarangay(barangayName) {
        clearPurokLayer(false); 

        if (!purokGeoJsonRaw || !barangayName) return;

        const normalizedBarangay = normalizeBarangayName(barangayName);

        const features = (purokGeoJsonRaw.features || []).filter((feature) => {
          const rawBarangay = feature?.properties?.BarangayNa || "";
          return normalizeBarangayName(rawBarangay) === normalizedBarangay;
        });

        if (!features.length) {
          legendBarangayEl.textContent = normalizedBarangay;
          legendListEl.innerHTML = `<div class="legend-item"><div class="legend-name">No zone / purok / sitio found</div></div>`;
          legendEl.classList.remove("is-hidden");
          return;
        }

        const layer = L.geoJSON({
          type: "FeatureCollection",
          features
        }, {
          style: purokPolygonStyle,
          onEachFeature: function(feature, layer) {
            layer.on("mouseover", function(e) {
              layer.setStyle(purokHoverStyle(feature));
              layer.bringToFront();

              layer.bindTooltip(createPurokTooltip(feature), {
                sticky: true,
                direction: "top",
                className: "purok-tooltip-shell",
                opacity: 1
              }).openTooltip(e.latlng);
            });

            layer.on("mouseout", function() {
              layer.setStyle(purokPolygonStyle(feature));
              layer.closeTooltip();
            });

            layer.on("click", function(e) {
              if (e.originalEvent?.target?.blur) {
                e.originalEvent.target.blur();
              }

              try {
                map.fitBounds(layer.getBounds(), {
                  padding: [30, 30],
                  maxZoom: 19
                });
              } catch (_) {}
            });
          }
        });

        purokLayerGroup.addLayer(layer);
        renderLegend(normalizedBarangay, features);
      }

      async function doSearchFlow(v) {
        const value = normalizeBarangayName((v || "").trim());
        if (!value) return;

        if (!isValidBarangay(value)) {
          setHint(`"${value}" is not a searchable barangay.`);
          microTip.textContent = "⚠️ Only official barangays can be searched.";
          pulse(microTip);
          return;
        }

        selectBarangayOnMap(value);
        renderPurokForBarangay(value);
        syncToLivewireInput(value);
        searchBtn?.click();

        microTip.textContent = `✅ Showing records and zone/purok/sitio for: ${value}`;
        pulse(microTip);
      }

      async function loadPurokGeoJson() {
        try {
          const response = await fetch("{{ asset('geojson/purok_boundary.geojson') }}");
          if (!response.ok) throw new Error("Failed to load purok boundary GeoJSON");
          purokGeoJsonRaw = await response.json();
        } catch (error) {
          console.error("Purok GeoJSON load error:", error);
          purokGeoJsonRaw = null;
        }
      }

      function attachGeoJson() {
        fetch("{{ asset('geojson/map.geojson') }}")
          .then(response => {
            if (!response.ok) {
              throw new Error("Failed to load GeoJSON");
            }
            return response.json();
          })
          .then(data => {
            geoJsonLayer = L.geoJSON(data, {
              style: function(feature) {
                return defaultPolygonStyle(feature);
              },
              onEachFeature: function(feature, layer) {
                const rawName = feature?.properties?.name || "Unknown";
                const name = normalizeBarangayName(rawName);
                const isInvalidBoundary = invalidBoundaryNames.includes(rawName) || !isValidBarangay(name);

                if (!isInvalidBoundary) {
                  polygonLayerMap[name] = layer;

                  const center = getLayerCenter(layer);

                  const point = L.marker(center, {
                    icon: L.divIcon({
                      className: "barangay-pin-icon",
                      html: `
                        <div class="barangay-pin-wrap">
                          <div class="barangay-pin"></div>
                        </div>
                      `,
                      iconSize: [32, 40],
                      iconAnchor: [16, 40]
                    })
                  });

                  point.on("mouseover", function() {
                    point.bindTooltip(createBarangayTooltip(name), {
                      permanent: false,
                      direction: "top",
                      className: "barangay-tooltip-shell",
                      offset: [0, -32],
                      opacity: 1
                    }).openTooltip();
                  });

                  point.on("mouseout", function() {
                    point.closeTooltip();
                  });

                  point.on("click", function() {
                    activatePolygon(layer, feature);
                    zoomToPolygon(layer);
                    renderPurokForBarangay(name);
                    hideSuggestions();
                    setHint(`Selected barangay: ${name}`);
                    doSearchFlow(name);
                  });

                  barangayPointLayer.addLayer(point);
                }

                layer.on("mouseover", function(e) {
                  if (activePolygon !== layer) {
                    layer.setStyle(hoverPolygonStyle(feature));
                  }

                  layer.bindTooltip(createBarangayTooltip(name), {
                    sticky: true,
                    direction: "top",
                    className: "barangay-tooltip-shell",
                    opacity: 1
                  }).openTooltip(e.latlng);
                });

                layer.on("mouseout", function() {
                  if (geoJsonLayer && activePolygon !== layer) {
                    geoJsonLayer.resetStyle(layer);
                  }

                  layer.closeTooltip();
                });

                layer.on("click", function(e) {
                  if (e.originalEvent?.target?.blur) {
                    e.originalEvent.target.blur();
                  }

                  if (isInvalidBoundary) {
                    setHint(`"${rawName}" is boundary-only and not searchable.`);
                    microTip.textContent = "⚠️ Please click an official barangay polygon.";
                    pulse(microTip);
                    return;
                  }

                  activatePolygon(layer, feature);
                  zoomToPolygon(layer);
                  renderPurokForBarangay(name);
                  hideSuggestions();
                  setHint(`Selected barangay: ${name}`);
                  doSearchFlow(name);
                });
              }
            }).addTo(map);

            try {
              map.fitBounds(geoJsonLayer.getBounds(), { padding: [20, 20] });
            } catch (e) {}
          })
          .catch(error => {
            console.error("GeoJSON load error:", error);
            setHint("Hindi ma-load ang polygon boundary. Check public/geojson/map.geojson");
          });
      }

      suggestionsEl.addEventListener("click", function(e) {
        const btn = e.target.closest(".sug-item");
        if (!btn) return;

        const v = btn.getAttribute("data-value");
        hideSuggestions();
        doSearchFlow(v);
      });

      document.addEventListener("click", function(e) {
        const isInside = e.target.closest(".search-box") || e.target.closest(".search-mini");
        if (!isInside) hideSuggestions();
      });

      searchInput.addEventListener("focus", handleTyping);
      searchInput.addEventListener("input", handleTyping);

      searchInput.addEventListener("keydown", function(e) {
        if (e.key === "Escape") {
          hideSuggestions();
        }

        if (e.key === "Enter") {
          e.preventDefault();
          hideSuggestions();

          const value = normalizeBarangayName((searchInput.value || "").trim());
          if (!value) return;

          doSearchFlow(value);
        }
      });

      searchBtn.addEventListener("click", function(e) {
        e.preventDefault();

        const v = normalizeBarangayName((searchInput.value || "").trim());

        if (!v) {
          setHint("Type a barangay name first.");
          microTip.textContent = "⚠️ Please enter a barangay to search.";
          pulse(microTip);
          searchInput.focus();
          showSuggestions(barangays.slice(0, 8));
          return;
        }

        if (!isValidBarangay(v)) {
          setHint(`"${v}" is not in the official barangay list.`);
          microTip.textContent = "⚠️ Please choose a valid barangay.";
          pulse(microTip);
          showSuggestions(barangays.slice(0, 8));
          return;
        }

        doSearchFlow(v);
      });

      setCoords(defaultLat, defaultLng);

      map.on("click", function(e) {
        marker.setLatLng(e.latlng);
        setCoords(e.latlng.lat, e.latlng.lng);
        setHint("");
        microTip.textContent = "✅ Coordinates updated from map click.";
        pulse(microTip);
      });

      marker.on("dragend", function() {
        const pos = marker.getLatLng();
        setCoords(pos.lat, pos.lng);
        setHint("");
        microTip.textContent = "✅ Coordinates updated from marker drag.";
        pulse(microTip);
      });

      Promise.all([
        loadPurokGeoJson()
      ]).finally(() => {
        attachGeoJson();
      });

      document.addEventListener("livewire:navigated", function() {
        setTimeout(() => map.invalidateSize(true), 60);
        setTimeout(() => map.invalidateSize(true), 250);
      });

      document.addEventListener("livewire:init", () => {
        Livewire.on("mapProfilesLoaded", (event) => {
          const payload = Array.isArray(event) ? event[0] : event;
          const profiles = payload?.profiles || [];
          const barangay = normalizeBarangayName(payload?.barangay || "");
          window.__purokCounts = payload?.purokCounts || {};

          if (payload?.closeAll) {
            clearPurokLayer(true);
            clearProfileMarkers();
            return;
          }

          if (barangay) {
            updateBarangayCount(barangay, profiles.length);
            selectBarangayOnMap(barangay);
            renderPurokForBarangay(barangay);
            } else {
              clearPurokLayer(true);
            }

          renderBarangayProfileMarkers(barangay, profiles);
        });
      });
    }

    document.addEventListener("DOMContentLoaded", initAdminMap);
    document.addEventListener("livewire:navigated", initAdminMap);
  </script>
@endpush