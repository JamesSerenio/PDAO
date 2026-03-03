{{-- resources/views/pages/staff/mapping.blade.php --}}
@extends('layouts.staff_shell')

@section('title', 'Staff Mapping')
@section('page_title', 'Mapping')
@section('page_subtitle', 'Search location and get coordinates')

@section('body_class', 'staffmapping')

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/staffmapping.css') }}?v={{ filemtime(public_path('css/staffmapping.css')) }}">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
@endpush

@section('content')
  <div class="map-wrap">

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
      <div class="micro" id="microTip">Tip: Use Enter to search faster.</div>
    </div>

    <div class="panel map-panel anim-in" style="animation-delay:.12s">
      <div id="map"></div>
    </div>

  </div>
@endsection

@push('scripts')
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <script>
    function initStaffMap() {
      const mapEl = document.getElementById("map");
      if (!mapEl) return;

      // ✅ prevent re-initialization when navigating back and forth
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

      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        maxZoom: 19,
      }).addTo(map);

      const marker = L.marker([defaultLat, defaultLng], { draggable: true }).addTo(map);

      // ✅ IMPORTANT: make map visible immediately after navigate
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

      function hideSuggestions() {
        suggestionsEl.classList.add("hidden");
      }

      function handleTyping() {
        const q = (searchInput.value || "").trim().toLowerCase();

        if (!q) return showSuggestions(barangays.slice(0, 8));

        const matches = barangays
          .filter(b => b.toLowerCase().includes(q))
          .slice(0, 8);

        showSuggestions(matches);
      }

      suggestionsEl.addEventListener("click", (e) => {
        const btn = e.target.closest(".sug-item");
        if (!btn) return;
        searchInput.value = btn.getAttribute("data-value");
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
        if (e.key === "Enter") { hideSuggestions(); searchPlace(); }
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

          setTimeout(() => map.invalidateSize(true), 120);

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
    }

    // ✅ Normal full refresh
    document.addEventListener("DOMContentLoaded", initStaffMap);

    // ✅ Livewire Navigate (sidebar click / SPA navigation)
    document.addEventListener("livewire:navigated", initStaffMap);
  </script>
@endpush