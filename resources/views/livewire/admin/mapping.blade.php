{{-- resources/views/livewire/admin/mapping.blade.php --}}

<div class="map-wrap">

  {{-- TOPBAR --}}
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

  {{-- COORDS CARD --}}
  <div class="coords-card anim-in" style="animation-delay:.06s">
    <div class="coords" id="coords">Click the map to get latitude & longitude.</div>
    <div class="hint" id="hint"></div>
    <div class="micro" id="microTip">Tip: Press Enter to search faster.</div>
  </div>

  {{-- MAP --}}
  <div class="map-shell anim-in" style="animation-delay:.12s">
    <div class="map-panel">
      <div wire:ignore id="map"></div>

      {{-- RESULTS DRAWER --}}
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
                Records: <b>{{ count($profiles) }}</b>
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
            Showing: <code>Photo, Lastname, Firstname, Age, Disability Types</code>
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
      border-radius: 18px;
      overflow: hidden;
      z-index: 1;
    }

    .hidden {
      display: none !important;
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

    .results-drawer.is-hidden {
      display: none;
    }

    .leaflet-popup-content {
      font-size: 13px;
      line-height: 1.4;
    }

    .leaflet-tooltip.barangay-label {
      background: rgba(17, 24, 39, 0.92);
      color: #fff;
      border: none;
      border-radius: 999px;
      padding: 6px 10px;
      font-size: 11px;
      font-weight: 700;
      box-shadow: 0 6px 18px rgba(0,0,0,.18);
    }

    .leaflet-tooltip.barangay-label::before {
      display: none;
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
      width: 28px;
      height: 36px;
      display: flex;
      align-items: flex-start;
      justify-content: center;
    }

    .barangay-pin {
      position: relative;
      width: 22px;
      height: 22px;
      background: #ef4444;
      border: 2px solid #ffffff;
      border-radius: 50% 50% 50% 0;
      transform: rotate(-45deg);
      box-shadow: 0 8px 18px rgba(0, 0, 0, .22);
    }

    .barangay-pin::after {
      content: "";
      position: absolute;
      width: 8px;
      height: 8px;
      background: #fff;
      border-radius: 50%;
      top: 5px;
      left: 5px;
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
  </style>
@endpush

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

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

      let geoJsonLayer = null;
      let activePolygon = null;
      let profileMarkersLayer = L.layerGroup();
      let barangayPointLayer = L.layerGroup();
      let polygonLayerMap = {};

      const map = L.map("map").setView([defaultLat, defaultLng], 12);
      window.__adminMap = map;

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
        attribution: "&copy; OpenStreetMap contributors"
      }).addTo(map);

      const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);
      profileMarkersLayer.addTo(map);
      barangayPointLayer.addTo(map);

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

      function defaultPolygonStyle(feature) {
        const name = normalizeBarangayName(feature?.properties?.name || "");
        const color = getColor(name);

        return {
          color: color,
          weight: 3,
          opacity: 1,
          fillColor: color,
          fillOpacity: 0
        };
      }

      function hoverPolygonStyle(feature) {
        const name = normalizeBarangayName(feature?.properties?.name || "");
        const color = getColor(name);

        return {
          color: color,
          weight: 5,
          opacity: 1,
          fillColor: color,
          fillOpacity: 0
        };
      }

      function activePolygonStyle(feature) {
        const name = normalizeBarangayName(feature?.properties?.name || "");
        const color = getColor(name);

        return {
          color: "#111827",
          weight: 6,
          opacity: 1,
          fillColor: color,
          fillOpacity: 0
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
        "Santo Niño": L.latLng(8.436206 , 124.869232),
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

      function clearProfileMarkers() {
        profileMarkersLayer.clearLayers();
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

      function zoomToPolygon(layer) {
        try {
          const bounds = layer.getBounds();
          map.fitBounds(bounds, { padding: [20, 20] });

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

        activatePolygon(layer, layer.feature);
        zoomToPolygon(layer);
        setHint(`Selected barangay: ${normalized}`);
        return true;
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
        syncToLivewireInput(value);
        searchBtn?.click();

        microTip.textContent = `✅ Showing records for: ${value}`;
        pulse(microTip);
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

                layer.bindPopup(`
                  <div style="min-width:170px;">
                    <strong>${escapeHtml(name)}</strong><br>
                    <small>${isInvalidBoundary ? 'Boundary only (not searchable)' : 'Click polygon to search this barangay'}</small>
                  </div>
                `);

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
                      iconSize: [28, 36],
                      iconAnchor: [14, 36],
                      popupAnchor: [0, -30]
                    })
                  });

                  point.bindTooltip(name, {
                    permanent: false,
                    direction: "top",
                    className: "barangay-label",
                    offset: [0, -30]
                  });

                  point.on("click", function() {
                    activatePolygon(layer, feature);
                    zoomToPolygon(layer);
                    hideSuggestions();
                    setHint(`Selected barangay: ${name}`);
                    doSearchFlow(name);
                  });

                  barangayPointLayer.addLayer(point);
                }

                layer.on("mouseover", function() {
                  if (activePolygon !== layer) {
                    layer.setStyle(hoverPolygonStyle(feature));
                  }
                });

                layer.on("mouseout", function() {
                  if (geoJsonLayer && activePolygon !== layer) {
                    geoJsonLayer.resetStyle(layer);
                  }
                });

                layer.on("click", function() {
                  if (isInvalidBoundary) {
                    setHint(`"${rawName}" is boundary-only and not searchable.`);
                    microTip.textContent = "⚠️ Please click an official barangay polygon.";
                    pulse(microTip);
                    return;
                  }

                  activatePolygon(layer, feature);
                  zoomToPolygon(layer);
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

      attachGeoJson();

      document.addEventListener("livewire:navigated", function() {
        setTimeout(() => map.invalidateSize(true), 60);
        setTimeout(() => map.invalidateSize(true), 250);
      });

      document.addEventListener("livewire:init", () => {
        Livewire.on("mapProfilesLoaded", (event) => {
          const payload = Array.isArray(event) ? event[0] : event;
          const profiles = payload?.profiles || [];
          const barangay = payload?.barangay || "";

          if (barangay) {
            selectBarangayOnMap(barangay);
          }

          renderBarangayProfileMarkers(barangay, profiles);
        });
      });
    }

    document.addEventListener("DOMContentLoaded", initAdminMap);
    document.addEventListener("livewire:navigated", initAdminMap);
  </script>
@endpush