{{-- resources/views/livewire/staff/mapping.blade.php --}}

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
          {{-- ✅ DEFER = hindi magse-search habang nagta-type --}}
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

        {{-- ✅ Livewire search --}}
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

      {{-- ✅ RESULTS DRAWER (overlay) - Livewire controlled --}}
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

            {{-- ✅ Close button (Livewire) --}}
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

        {{-- ✅ SCROLL CONTAINER (max 3 cards visible) --}}
        <div class="results-body results-body-scroll">
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
                        <span>No Photo</span>
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

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    function initStaffMap() {
      const mapEl = document.getElementById("map");
      if (!mapEl) return;

      // prevent re-init
      if (mapEl.dataset.inited === "1") {
        if (window.__staffMap) {
          setTimeout(() => window.__staffMap.invalidateSize(true), 60);
          setTimeout(() => window.__staffMap.invalidateSize(true), 250);
        }
        return;
      }
      mapEl.dataset.inited = "1";

      // ✅ keep names consistent (Title Case) for centers lookup
      const barangays = [
        "Agusan Canyon","Alae","Dahilayan","Dalirig","Damilag","Diclum",
        "Guilang-guilang","Kalugmanan","Lindaban","Lingion","Lunocan","Maluko",
        "Mambatangan","Mampayag","Mantibugao","Minsuro","San Miguel","Sankanan",
        "Santiago","Santo Niño","Tankulan","Ticala"
      ];

      const barangayCenters = {
        "Tankulan": [8.3280, 124.8630],
        "Alae": [8.2640, 124.8710],
        "Dahilayan": [8.2140, 125.0160],
      };

      const defaultLat = 8.3132;
      const defaultLng = 124.8613;

      const coordsEl = document.getElementById("coords");
      const hintEl = document.getElementById("hint");
      const microTip = document.getElementById("microTip");
      const searchInput = document.getElementById("searchInput");
      const searchBtn = document.getElementById("searchBtn");
      const suggestionsEl = document.getElementById("suggestions");

      const map = L.map("map").setView([defaultLat, defaultLng], 12);
      window.__staffMap = map;

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", { maxZoom: 19 }).addTo(map);
      const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

      setTimeout(() => map.invalidateSize(true), 60);
      setTimeout(() => map.invalidateSize(true), 250);

      function pulse(el) {
        if (!el) return;
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

      function hideSuggestions() { suggestionsEl.classList.add("hidden"); }

      function handleTyping() {
        const q = (searchInput.value || "").trim().toLowerCase();
        if (!q) return showSuggestions(barangays.slice(0, 8));
        const matches = barangays.filter(b => b.toLowerCase().includes(q)).slice(0, 8);
        showSuggestions(matches);
      }

      function syncToLivewireInput(value) {
        searchInput.value = value;
        searchInput.dispatchEvent(new Event('input', { bubbles: true }));
        searchInput.dispatchEvent(new Event('change', { bubbles: true }));
      }

      async function moveMapToBarangay(value) {
        const key = (value || "").trim();

        // prefer manual centers
        if (barangayCenters[key]) {
          const [lat, lng] = barangayCenters[key];
          map.setView([lat, lng], 14, { animate: true });
          marker.setLatLng([lat, lng]);
          setCoords(lat, lng);
          setHint(`Centered on ${key}`);
          return;
        }

        // fallback search (still works)
        try {
          const query = `Barangay ${key}, Manolo Fortich, Bukidnon, Philippines`;
          const url = `https://nominatim.openstreetmap.org/search?format=json&limit=1&q=${encodeURIComponent(query)}`;
          const res = await fetch(url, { headers: { "Accept": "application/json" } });
          if (!res.ok) throw new Error("Search failed");

          const data = await res.json();
          if (!data || data.length === 0) {
            setHint("No location found. Try another barangay.");
            return;
          }

          const lat = parseFloat(data[0].lat);
          const lng = parseFloat(data[0].lon);

          map.setView([lat, lng], 15, { animate: true });
          marker.setLatLng([lat, lng]);
          setCoords(lat, lng);
          setHint(data[0].display_name || "Found!");
        } catch (e) {
          setHint("Search error. Check internet connection.");
        }
      }

      async function doSearchFlow(v) {
        const value = (v || "").trim();
        if (!value) return;

        syncToLivewireInput(value);
        searchBtn?.click();
        await moveMapToBarangay(value);

        microTip.textContent = `✅ Showing records for: ${value}`;
        pulse(microTip);
      }

      suggestionsEl.addEventListener("click", (e) => {
        const btn = e.target.closest(".sug-item");
        if (!btn) return;
        const v = btn.getAttribute("data-value");
        hideSuggestions();
        doSearchFlow(v);
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
          e.preventDefault();
          hideSuggestions();
          doSearchFlow(searchInput.value);
        }
      });

      searchBtn.addEventListener("click", () => {
        const v = (searchInput.value || "").trim();
        if (!v) {
          setHint("Type a barangay name first.");
          microTip.textContent = "⚠️ Please enter a barangay to search.";
          pulse(microTip);
          searchInput.focus();
          showSuggestions(barangays.slice(0, 8));
          return;
        }
        moveMapToBarangay(v);
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

      document.addEventListener("livewire:navigated", () => {
        setTimeout(() => map.invalidateSize(true), 60);
        setTimeout(() => map.invalidateSize(true), 250);
      });
    }

    document.addEventListener("DOMContentLoaded", initStaffMap);
    document.addEventListener("livewire:navigated", initStaffMap);
  </script>
@endpush