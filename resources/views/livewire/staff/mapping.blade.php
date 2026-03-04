{{-- resources/views/livewire/staff/mapping.blade.php --}}

<div class="map-wrap">

  <div class="map-topbar anim-in">
    <div class="left">
      <h2 class="welcome">Welcome, {{ auth()->user()->name }}</h2>
      <p>Search barangay then view PWD profiles under that barangay.</p>
    </div>

    <div class="right">
      <div class="search-mini">
        <div class="search-box">
          {{-- ✅ FIX: DEFER binding (hindi mag network/search habang nagta-type) --}}
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

        {{-- ✅ Livewire click (dito lang magse-search) --}}
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

  <div class="coords-card anim-in" style="animation-delay:.06s">
    <div class="coords" id="coords">Click the map to get latitude & longitude.</div>
    <div class="hint" id="hint"></div>
    <div class="micro" id="microTip">Tip: Press Enter to search faster.</div>
  </div>

  <div class="panel map-panel anim-in" style="animation-delay:.12s">
    <div wire:ignore id="map"></div>
  </div>

  {{-- ✅ RESULTS (cards) --}}
  <div class="panel anim-in" style="animation-delay:.16s; margin-top:14px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
      <div>
        <h3 style="margin:0; font-size:16px;">Results</h3>
        <div style="opacity:.75; font-size:12px;">
          Barangay: <b>{{ $searchBarangay ?: '—' }}</b> |
          Records: <b>{{ count($profiles) }}</b>
          <span wire:loading style="margin-left:8px; opacity:.75;">(Loading...)</span>
        </div>
      </div>

      <div style="opacity:.75; font-size:12px;">
        Showing: <code>Photo, Lastname, Firstname, Age, Disability Types</code>
      </div>
    </div>

    <div style="margin-top:12px;">
      @if (count($profiles) === 0)
        <div style="padding:14px 10px; opacity:.75;">
          No results. Search a barangay (example: <b>Tankulan</b>).
        </div>
      @else
        <div style="display:grid; grid-template-columns: repeat(auto-fill, minmax(260px, 1fr)); gap:12px;">
          @foreach($profiles as $p)
            <div style="border:1px solid rgba(255,255,255,.10); border-radius:16px; padding:12px; background: rgba(255,255,255,.03);">
              <div style="display:flex; gap:12px; align-items:center;">
                <div style="width:64px; height:64px; border-radius:14px; overflow:hidden; border:1px solid rgba(255,255,255,.12); flex:0 0 auto; background: rgba(255,255,255,.06); display:flex; align-items:center; justify-content:center;">
                  @if(!empty($p['photo_url']))
                    <img src="{{ $p['photo_url'] }}" alt="Photo" style="width:100%; height:100%; object-fit:cover;">
                  @else
                    <span style="opacity:.6; font-size:12px;">No Photo</span>
                  @endif
                </div>

                <div style="min-width:0;">
                  <div style="font-weight:800; font-size:14px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    {{ $p['last_name'] }}, {{ $p['first_name'] }}
                  </div>
                  <div style="font-size:12px; opacity:.75;">
                    Age: <b>{{ $p['age'] ?? '—' }}</b>
                  </div>
                </div>
              </div>

              <div style="margin-top:10px; font-size:12px; opacity:.85; line-height:1.35;">
                <div style="opacity:.7; font-size:11px; margin-bottom:4px;">Types of Disability</div>
                <div style="font-weight:600;">
                  {{ $p['disability_types'] }}
                </div>
              </div>
            </div>
          @endforeach
        </div>
      @endif
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
        // ✅ With wire:model.defer, this will NOT send request while typing.
        // It will only be sent on the next Livewire action (wire:click search).
        searchInput.value = value;
        searchInput.dispatchEvent(new Event('input', { bubbles: true }));
        searchInput.dispatchEvent(new Event('change', { bubbles: true }));
      }

      async function moveMapToBarangay(value) {
        if (barangayCenters[value]) {
          const [lat, lng] = barangayCenters[value];
          map.setView([lat, lng], 14, { animate: true });
          marker.setLatLng([lat, lng]);
          setCoords(lat, lng);
          setHint("");
          return;
        }

        try {
          const query = `${value}, Manolo Fortich, Bukidnon, Philippines`;
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

        // ✅ Update input + Livewire deferred value
        syncToLivewireInput(value);

        // ✅ Only now trigger the real Livewire search
        searchBtn?.click();

        // ✅ Move map after triggering search
        await moveMapToBarangay(value);

        microTip.textContent = `✅ Showing records for: ${value}`;
        pulse(microTip);
      }

      // Suggestions click (dito lang magse-search)
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

      // Typing: suggestions only (NO search)
      searchInput.addEventListener("focus", handleTyping);
      searchInput.addEventListener("input", handleTyping);

      // Enter: search (YES)
      searchInput.addEventListener("keydown", (e) => {
        if (e.key === "Escape") hideSuggestions();
        if (e.key === "Enter") {
          e.preventDefault();
          hideSuggestions();
          doSearchFlow(searchInput.value);
        }
      });

      // Button click: let Livewire run search; we just move map too
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
        // NOTE: Livewire search happens via wire:click on the button.
        // Here we only move the map + keep UI updated.
        moveMapToBarangay(v);
      });

      // initial coords
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