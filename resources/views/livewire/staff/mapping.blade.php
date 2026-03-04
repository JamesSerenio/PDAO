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
          <input
            id="searchInput"
            class="search-input"
            type="text"
            placeholder="Search barangay..."
            autocomplete="off"
          />
          <div id="suggestions" class="suggestions hidden"></div>
        </div>

        <button id="searchBtn" class="btn" type="button">
          <span class="btn-txt">Search</span>
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

  {{-- ✅ RESULTS --}}
  <div class="panel anim-in" style="animation-delay:.16s; margin-top:14px;">
    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; flex-wrap:wrap;">
      <div>
        <h3 style="margin:0; font-size:16px;">Results</h3>
        <div style="opacity:.75; font-size:12px;">
          Barangay: <b>{{ $searchBarangay ?: '—' }}</b> |
          Records: <b>{{ count($profiles) }}</b>
        </div>
      </div>

      <div style="opacity:.75; font-size:12px;">
        Note: This uses <code>local_profiles.barangay</code>.
      </div>
    </div>

    <div style="overflow:auto; margin-top:12px;">
      <table style="width:100%; border-collapse:collapse;">
        <thead>
          <tr style="text-align:left; border-bottom:1px solid rgba(255,255,255,.12);">
            <th style="padding:10px 8px;">Name</th>
            <th style="padding:10px 8px;">Sex</th>
            <th style="padding:10px 8px;">DOB</th>
            <th style="padding:10px 8px;">Contact</th>
            <th style="padding:10px 8px;">Barangay</th>
          </tr>
        </thead>

        <tbody>
          @forelse($profiles as $p)
            @php
              $fullName = trim(
                ($p->last_name ?? '') . ', ' .
                ($p->first_name ?? '') . ' ' .
                (($p->middle_name ?? '') ? substr($p->middle_name, 0, 1).'.' : '') . ' ' .
                ($p->suffix ?? '')
              );
              $contact = $p->mobile ?: ($p->email ?: '—');
            @endphp

            <tr style="border-bottom:1px solid rgba(255,255,255,.08);">
              <td style="padding:10px 8px; white-space:nowrap;">
                <b>{{ $fullName }}</b>
                <div style="font-size:12px; opacity:.75;">
                  ID: {{ $p->id }}
                </div>
              </td>

              <td style="padding:10px 8px;">{{ $p->sex ?? '—' }}</td>
              <td style="padding:10px 8px;">
                {{ $p->date_of_birth ? \Carbon\Carbon::parse($p->date_of_birth)->format('M d, Y') : '—' }}
              </td>
              <td style="padding:10px 8px;">{{ $contact }}</td>
              <td style="padding:10px 8px;">{{ $p->barangay ?? '—' }}</td>
            </tr>
          @empty
            <tr>
              <td colspan="5" style="padding:14px 8px; opacity:.75;">
                No results. Search a barangay (example: <b>Tankulan</b>).
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

</div>

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    function initStaffMap() {
      const mapEl = document.getElementById("map");
      if (!mapEl) return;

      // ✅ prevent re-initialization
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

      // ✅ Optional: center points (approx OK)
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

      // ✅ keep lat/lng UI (front-end only)
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

      function livewireSearchBarangay(value) {
        const root = mapEl.closest('[wire\\:id]');
        if (!root) return;

        const id = root.getAttribute('wire:id');
        const cmp = Livewire.find(id);
        if (!cmp) return;

        cmp.set('searchBarangay', value);
        cmp.call('search');
      }

      async function moveMapToBarangay(value) {
        // If may predefined center → use it
        if (barangayCenters[value]) {
          const [lat, lng] = barangayCenters[value];
          map.setView([lat, lng], 14, { animate: true });
          marker.setLatLng([lat, lng]);
          setCoords(lat, lng);
          setHint("");
          return;
        }

        // else fallback to nominatim search (barangay location)
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

      async function setAndSearchBarangay(value) {
        const v = (value || '').trim();
        if (!v) return;

        searchInput.value = v;

        // ✅ DB search
        livewireSearchBarangay(v);

        // ✅ Move map (front-end)
        await moveMapToBarangay(v);

        microTip.textContent = `✅ Showing records for: ${v}`;
        pulse(microTip);
      }

      suggestionsEl.addEventListener("click", (e) => {
        const btn = e.target.closest(".sug-item");
        if (!btn) return;
        const v = btn.getAttribute("data-value");
        hideSuggestions();
        setAndSearchBarangay(v);
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
          const v = (searchInput.value || '').trim();
          if (!v) return;
          setAndSearchBarangay(v);
        }
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

      // ✅ Button search (barangay)
      searchBtn.addEventListener("click", () => {
        hideSuggestions();
        const v = (searchInput.value || '').trim();
        if (!v) {
          setHint("Type a barangay name first.");
          microTip.textContent = "⚠️ Please enter a barangay to search.";
          pulse(microTip);
          searchInput.focus();
          showSuggestions(barangays.slice(0, 8));
          return;
        }
        setAndSearchBarangay(v);
      });

      // ✅ SPA navigation support
      document.addEventListener("livewire:navigated", () => {
        setTimeout(() => map.invalidateSize(true), 60);
        setTimeout(() => map.invalidateSize(true), 250);
      });
    }

    document.addEventListener("DOMContentLoaded", initStaffMap);
    document.addEventListener("livewire:navigated", initStaffMap);
  </script>
@endpush