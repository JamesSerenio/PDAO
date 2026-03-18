@php
    $sexData = is_array($sexPieData ?? null) ? $sexPieData : [];
    $disabilityData = is_array($disabilityPieData ?? null) ? $disabilityPieData : [];
    $disabilityLabelsSafe = is_array($disabilityPieLabels ?? null) ? $disabilityPieLabels : [];

    $totalGender = array_sum($sexData);
    $totalDisability = array_sum($disabilityData);

    $maleCount = (int) ($sexData[0] ?? 0);
    $femaleCount = (int) ($sexData[1] ?? 0);

    $malePercent = $totalGender > 0 ? round(($maleCount / $totalGender) * 100, 1) : 0;
    $femalePercent = $totalGender > 0 ? round(($femaleCount / $totalGender) * 100, 1) : 0;

    $topDisabilityLabel = 'No data';
    $topDisabilityCount = 0;
    $topDisabilityPercent = 0;

    if (!empty($disabilityLabelsSafe) && !empty($disabilityData)) {
        $maxDisabilityCount = max($disabilityData);
        $topDisabilityIndex = array_search($maxDisabilityCount, $disabilityData, true);

        if ($topDisabilityIndex !== false) {
            $topDisabilityLabel = $disabilityLabelsSafe[$topDisabilityIndex] ?? 'No data';
            $topDisabilityCount = (int) $maxDisabilityCount;
            $topDisabilityPercent = $totalDisability > 0
                ? round(($topDisabilityCount / $totalDisability) * 100, 1)
                : 0;
        }
    }
@endphp

<div>
  <div class="dash-grid">

    {{-- REGISTERED --}}
    <div class="dash-card dash-card-hover-title stat-card stat-card-registered">
      <div class="card-hover-shell">
        <div class="card-icon card-icon-registered card-anim-icon">
          <i class="fas fa-id-card"></i>
        </div>

        <div class="hover-title-only card-anim-title">Registered</div>

        <div class="card-value card-anim-value" wire:loading.remove wire:target="range">
          {{ $registeredCount }}
        </div>
        <div class="card-value card-anim-value" wire:loading wire:target="range">
          ...
        </div>

        <div class="card-sub card-anim-sub">{{ $rangeLabel }} records</div>

        <div class="card-filter-form card-anim-filter">
          <select wire:model.live="range" class="card-filter-select">
            <option value="day">This Day</option>
            <option value="week">This Week</option>
            <option value="month">This Month</option>
            <option value="year">This Year</option>
            <option value="overall">Overall</option>
          </select>
        </div>
      </div>
    </div>

    {{-- REGISTERED PWD --}}
    <div class="dash-card dash-card-hover-title stat-card stat-card-pwd">
      <div class="card-hover-shell">
        <div class="card-icon card-icon-pwd card-anim-icon">
          <i class="fas fa-wheelchair"></i>
        </div>

        <div class="hover-title-only card-anim-title">Registered PWD</div>

        <div class="card-value card-anim-value" wire:loading.remove wire:target="range">
          {{ $pwdCount }}
        </div>
        <div class="card-value card-anim-value" wire:loading wire:target="range">
          ...
        </div>

        <div class="card-sub card-anim-sub">{{ $rangeLabel }} registered PWD</div>
      </div>
    </div>

    {{-- SENIOR CITIZENS --}}
    <div class="dash-card dash-card-hover-title stat-card stat-card-senior">
      <div class="card-hover-shell">
        <div class="card-icon card-icon-senior card-anim-icon">
          <i class="fas fa-user-clock"></i>
        </div>

        <div class="hover-title-only card-anim-title">Senior Citizens</div>

        <div class="card-value card-anim-value" wire:loading.remove wire:target="range">
          {{ $seniorCount }}
        </div>
        <div class="card-value card-anim-value" wire:loading wire:target="range">
          ...
        </div>

        <div class="card-sub card-anim-sub">{{ $rangeLabel }} senior citizens</div>
      </div>
    </div>

    {{-- WEATHER + CLOCK COMPACT --}}
    <div class="scoreboard-card weather-compact-card">
      <span class="scoreboard-live-dot"></span>

      <div class="weather-compact-top">
        <div class="weather-compact-widget">
          <div class="weather-compact-left">
            <div class="weather-compact-temp" id="liveTemperatureText">--°</div>

            <div class="weather-compact-range">
              <span id="liveTempHigh">↑ --°</span>
              <span id="liveTempLow">↓ --°</span>
            </div>

            <div class="weather-compact-desc" id="liveWeatherText">Loading...</div>
            <div class="weather-compact-location" id="liveLocationText">Detecting location...</div>
          </div>

          <div class="weather-compact-right">
            <div class="weather-compact-visual">
              <div class="weather-compact-sun"></div>
              <div class="weather-compact-cloud cloud-back"></div>
              <div class="weather-compact-cloud cloud-front"></div>
            </div>
          </div>
        </div>

        <div class="weather-compact-days">
          <div class="weather-mini-day">
            <div class="weather-mini-name" id="dayLabel1">THU</div>
            <div class="weather-mini-icon" id="dayIcon1">⛅</div>
            <div class="weather-mini-temp" id="dayTemp1">--°</div>
          </div>

          <div class="weather-mini-day">
            <div class="weather-mini-name" id="dayLabel2">FRI</div>
            <div class="weather-mini-icon" id="dayIcon2">⛅</div>
            <div class="weather-mini-temp" id="dayTemp2">--°</div>
          </div>

          <div class="weather-mini-day">
            <div class="weather-mini-name" id="dayLabel3">SAT</div>
            <div class="weather-mini-icon" id="dayIcon3">⛅</div>
            <div class="weather-mini-temp" id="dayTemp3">--°</div>
          </div>

          <div class="weather-mini-day">
            <div class="weather-mini-name" id="dayLabel4">SUN</div>
            <div class="weather-mini-icon" id="dayIcon4">⛅</div>
            <div class="weather-mini-temp" id="dayTemp4">--°</div>
          </div>
        </div>
      </div>

      <div class="scoreboard-main weather-clock-box compact-clock-box">
        <div class="scoreboard-title">System Clock</div>

        <div class="scoreboard-clock-row">
          <div class="scoreboard-time" id="liveTimeText">{{ now()->format('h:i:s') }}</div>
          <div class="scoreboard-ampm" id="liveAmPm">{{ now()->format('A') }}</div>
        </div>

        <div class="scoreboard-date" id="liveDateText">{{ now()->format('l, F d, Y') }}</div>
        <div class="scoreboard-sub" id="liveWeatherMetaText">Real-time dashboard display</div>
      </div>
    </div>

      <div class="dash-panels">

    {{-- LINE CHART --}}
    <div class="panel panel-glass">
      <div class="panel-head">
        <h2>Registration Trends</h2>
        <span class="panel-pill">{{ $rangeLabel }}</span>
      </div>

      <div class="panel-body">
        <div wire:loading wire:target="range" class="panel-empty">
          Loading graph...
        </div>

        <div wire:loading.remove wire:target="range">
          <div class="chart-summary">
            <div class="overview-box">
              <strong>Registered</strong>
              <div>{{ $registeredCount }}</div>
            </div>

            <div class="overview-box">
              <strong>PWD</strong>
              <div>{{ $pwdCount }}</div>
            </div>

            <div class="overview-box">
              <strong>Senior Citizens</strong>
              <div>{{ $seniorCount }}</div>
            </div>
          </div>

          <div class="chart-box chart-box-elevated">
            <canvas
              id="dashboardLineChart"
              data-labels='@json($chartLabels)'
              data-values='@json($chartData)'>
            </canvas>
          </div>
        </div>
      </div>
    </div>

    {{-- RECENT REGISTRATIONS --}}
    <div class="panel panel-glass">
      <div class="panel-head">
        <h2>Recent Registrations</h2>
        <span class="panel-pill">Latest 5</span>
      </div>

      <div class="panel-body">
        <div wire:loading wire:target="range" class="panel-empty">
          Loading recent records...
        </div>

        <div wire:loading.remove wire:target="range">
          @if($recentProfiles->count())
            <div class="recent-table-wrap recent-table-modern">
              <table class="recent-table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Barangay</th>
                    <th>Profiling Date</th>
                    <th>Category</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($recentProfiles as $person)
                    @php
                      $age = null;
                      if (!empty($person->date_of_birth)) {
                          $age = \Carbon\Carbon::parse($person->date_of_birth)->age;
                      }
                      $category = $age === null ? '—' : ($age >= 60 ? 'Senior Citizen' : 'PWD');
                    @endphp
                    <tr>
                      <td>{{ $person->last_name }}, {{ $person->first_name }} {{ $person->middle_name }}</td>
                      <td>{{ $person->barangay ?: '—' }}</td>
                      <td>{{ $person->profiling_date ? \Carbon\Carbon::parse($person->profiling_date)->format('M d, Y') : '—' }}</td>
                      <td>
                        <span class="table-badge {{ $category === 'Senior Citizen' ? 'table-badge-senior' : ($category === 'PWD' ? 'table-badge-pwd' : '') }}">
                          {{ $category }}
                        </span>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @else
            <div class="panel-empty">
              No recent records for {{ strtolower($rangeLabel) }}.
            </div>
          @endif
        </div>
      </div>
    </div>

  </div>

  {{-- PIE CHARTS --}}
  <div class="dash-panels dash-panels-two">

    {{-- MALE & FEMALE --}}
    <div class="panel panel-glass">
      <div class="panel-head">
        <h2>Male & Female</h2>
        <span class="panel-pill">{{ $rangeLabel }}</span>
      </div>

      <div class="panel-body">
        <div wire:loading wire:target="range" class="panel-empty">
          Loading gender graph...
        </div>

        <div wire:loading.remove wire:target="range">
          <div class="pie-info-layout">
            <div class="pie-chart-box pie-chart-box-small pie-chart-box-center">
              <canvas
                id="dashboardGenderPieChart"
                data-labels='@json($sexPieLabels)'
                data-values='@json($sexPieData)'
                data-center-title="Gender"
                data-center-value="{{ $totalGender }}">
              </canvas>
            </div>

            <div class="pie-side-description">
              <div class="pie-desc-card">
                <div class="pie-desc-title">Gender Overview</div>
                <p class="pie-desc-text">
                  This chart presents the distribution of registered individuals by sex for
                  <strong>{{ strtolower($rangeLabel) }}</strong>. Out of
                  <strong>{{ $totalGender }}</strong> total gender-recorded registration{{ $totalGender == 1 ? '' : 's' }},
                  <strong>{{ $maleCount }}</strong> are male and <strong>{{ $femaleCount }}</strong> are female.
                </p>

                <div class="pie-stat-list">
                  <div class="pie-stat-item">
                    <span class="pie-dot pie-dot-male"></span>
                    <div class="pie-stat-content">
                      <strong>Male</strong>
                      <small>{{ $maleCount }} out of {{ $totalGender }} total record(s)</small>
                      <div class="pie-percent-row">
                        <span>{{ $malePercent }}%</span>
                        <div class="pie-progress">
                          <div class="pie-progress-bar pie-progress-male" data-width="{{ $malePercent }}"></div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="pie-stat-item">
                    <span class="pie-dot pie-dot-female"></span>
                    <div class="pie-stat-content">
                      <strong>Female</strong>
                      <small>{{ $femaleCount }} out of {{ $totalGender }} total record(s)</small>
                      <div class="pie-percent-row">
                        <span>{{ $femalePercent }}%</span>
                        <div class="pie-progress">
                          <div class="pie-progress-bar pie-progress-female" data-width="{{ $femalePercent }}"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="pie-note">
                  This summary helps the office quickly understand the current gender composition
                  of registered individuals and compare representation within the selected range.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- TYPES OF DISABILITY --}}
    <div class="panel panel-glass">
      <div class="panel-head">
        <h2>Types of Disability</h2>
        <span class="panel-pill">{{ $rangeLabel }}</span>
      </div>

      <div class="panel-body">
        <div wire:loading wire:target="range" class="panel-empty">
          Loading disability graph...
        </div>

        <div wire:loading.remove wire:target="range">
          <div class="pie-info-layout">
            <div class="pie-chart-box pie-chart-box-small pie-chart-box-center">
              <canvas
                id="dashboardDisabilityPieChart"
                data-labels='@json($disabilityPieLabels)'
                data-values='@json($disabilityPieData)'
                data-center-title="Disability"
                data-center-value="{{ $totalDisability }}">
              </canvas>
            </div>

            <div class="pie-side-description">
              <div class="pie-desc-card">
                <div class="pie-desc-title">Disability Summary</div>
                <p class="pie-desc-text">
                  This graph shows the recorded types of disability for
                  <strong>{{ strtolower($rangeLabel) }}</strong>. Out of
                  <strong>{{ $totalDisability }}</strong> total disability-tagged record{{ $totalDisability == 1 ? '' : 's' }},
                  the most recorded category is <strong>{{ $topDisabilityLabel }}</strong>
                  with <strong>{{ $topDisabilityCount }}</strong> {{ $topDisabilityCount == 1 ? 'entry' : 'entries' }}
                  representing <strong>{{ $topDisabilityPercent }}%</strong> of the total.
                </p>

                <div class="pie-stat-list pie-stat-list-vertical">
                  @forelse($disabilityLabelsSafe as $index => $label)
                    @php
                      $count = (int) ($disabilityData[$index] ?? 0);
                      $percent = $totalDisability > 0 ? round(($count / $totalDisability) * 100, 1) : 0;
                    @endphp

                    @if($count > 0)
                      <div class="pie-stat-item">
                        <span class="pie-dot pie-dot-disability"></span>
                        <div class="pie-stat-content">
                          <strong>{{ $label }}</strong>
                          <small>{{ $count }} out of {{ $totalDisability }} total record(s)</small>
                          <div class="pie-percent-row">
                            <span>{{ $percent }}%</span>
                            <div class="pie-progress">
                              <div class="pie-progress-bar pie-progress-disability" data-width="{{ $percent }}"></div>
                            </div>
                          </div>
                        </div>
                      </div>
                    @endif
                  @empty
                    <div class="pie-note">
                      No disability records available for this selected range.
                    </div>
                  @endforelse
                </div>

                <div class="pie-note">
                  This detailed view helps identify priority disability categories and supports
                  better planning for assistance, services, and inclusive programs.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @script
  <script>
    let dashboardChartInstance = null;
    let dashboardGenderPieInstance = null;
    let dashboardDisabilityPieInstance = null;
    let dashboardClockStarted = false;
    let weatherLoaded = false;

    const centerTextPlugin = {
      id: 'centerTextPlugin',
      afterDraw(chart, args, pluginOptions) {
        if (chart.config.type !== 'doughnut') return;

        const meta = chart.getDatasetMeta(0);
        if (!meta || !meta.data || !meta.data.length) return;

        const x = meta.data[0].x;
        const y = meta.data[0].y;
        const ctx = chart.ctx;

        const active = chart.getActiveElements();
        const hovered = active && active.length > 0;

        let title = pluginOptions.title || '';
        let value = pluginOptions.value || '';

        if (hovered) {
          const index = active[0].index;
          const dataset = chart.data.datasets[0];
          const label = chart.data.labels[index];
          const rawValue = Number(dataset.data[index] || 0);
          const total = dataset.data.reduce((a, b) => a + Number(b || 0), 0);
          const percent = total > 0 ? ((rawValue / total) * 100).toFixed(1) : 0;

          title = String(label);
          value = `${rawValue} (${percent}%)`;
        }

        ctx.save();
        ctx.textAlign = 'center';
        ctx.textBaseline = 'middle';

        ctx.fillStyle = hovered ? '#475569' : (pluginOptions.titleColor || '#64748b');
        ctx.font = hovered
          ? '700 12px Inter, Arial, sans-serif'
          : '700 14px Inter, Arial, sans-serif';
        ctx.fillText(title, x, y - 12);

        ctx.fillStyle = pluginOptions.valueColor || '#0f172a';
        ctx.font = hovered
          ? '900 15px Inter, Arial, sans-serif'
          : '900 24px Inter, Arial, sans-serif';
        ctx.fillText(String(value), x, y + 14);

        ctx.restore();
      }
    };

    function updateDashboardClock() {
      const now = new Date();

      const dateOptions = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: '2-digit'
      };

      const liveDateText = document.getElementById('liveDateText');
      const liveTimeText = document.getElementById('liveTimeText');
      const liveAmPm = document.getElementById('liveAmPm');

      let hours = now.getHours();
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      const realAmpm = hours >= 12 ? 'PM' : 'AM';

      hours = hours % 12;
      hours = hours ? hours : 12;

      const formattedTime = `${String(hours).padStart(2, '0')}:${minutes}:${seconds}`;
      const formattedDate = now.toLocaleDateString('en-US', dateOptions);

      if (liveDateText) liveDateText.textContent = formattedDate;
      if (liveTimeText) liveTimeText.textContent = formattedTime;
      if (liveAmPm) liveAmPm.textContent = realAmpm;
    }

    function applyProgressWidths() {
      document.querySelectorAll('.pie-progress-bar[data-width]').forEach((el) => {
        const raw = parseFloat(el.dataset.width || '0');
        const safe = Number.isFinite(raw) ? Math.max(0, Math.min(raw, 100)) : 0;
        el.style.width = safe + '%';
      });
    }

    function getWeatherDescription(code) {
      const map = {
        0: 'Clear',
        1: 'Mainly Clear',
        2: 'Partly Cloudy',
        3: 'Overcast',
        45: 'Fog',
        48: 'Fog',
        51: 'Light Drizzle',
        53: 'Drizzle',
        55: 'Heavy Drizzle',
        56: 'Freezing Drizzle',
        57: 'Freezing Drizzle',
        61: 'Light Rain',
        63: 'Rain',
        65: 'Heavy Rain',
        66: 'Freezing Rain',
        67: 'Freezing Rain',
        71: 'Light Snow',
        73: 'Snow',
        75: 'Heavy Snow',
        77: 'Snow Grains',
        80: 'Rain Showers',
        81: 'Rain Showers',
        82: 'Heavy Showers',
        85: 'Snow Showers',
        86: 'Snow Showers',
        95: 'Thunderstorm',
        96: 'Thunderstorm',
        99: 'Thunderstorm'
      };

      return map[code] || 'Unknown';
    }

    function getWeatherEmoji(code) {
      if ([0, 1].includes(code)) return '☀️';
      if ([2, 3].includes(code)) return '⛅';
      if ([45, 48].includes(code)) return '🌫️';
      if ([51, 53, 55, 56, 57].includes(code)) return '🌦️';
      if ([61, 63, 65, 80, 81, 82].includes(code)) return '🌧️';
      if ([66, 67].includes(code)) return '🌨️';
      if ([71, 73, 75, 77, 85, 86].includes(code)) return '❄️';
      if ([95, 96, 99].includes(code)) return '⛈️';
      return '⛅';
    }

    function formatDayName(dateStr) {
      const date = new Date(dateStr);
      return date.toLocaleDateString('en-US', { weekday: 'short' }).toUpperCase();
    }

    async function reverseGeocode(lat, lon) {
      try {
        const res = await fetch(
          `https://geocoding-api.open-meteo.com/v1/reverse?latitude=${lat}&longitude=${lon}&language=en&format=json`
        );
        const data = await res.json();

        if (data?.results?.length) {
          const place = data.results[0];

          const city =
            place.city ||
            place.town ||
            place.village ||
            place.municipality ||
            place.name ||
            '';

          const province = place.admin1 || place.admin2 || '';
          const country = place.country || '';

          const parts = [city, province, country].filter(Boolean);

          if (parts.length) {
            return parts.join(', ');
          }
        }
      } catch (error) {
        console.error('Reverse geocoding failed:', error);
      }

      return 'Location unavailable';
    }

    function setMiniForecastDay(index, label, icon, temp) {
      const dayLabel = document.getElementById(`dayLabel${index}`);
      const dayIcon = document.getElementById(`dayIcon${index}`);
      const dayTemp = document.getElementById(`dayTemp${index}`);

      if (dayLabel) dayLabel.textContent = label;
      if (dayIcon) dayIcon.textContent = icon;
      if (dayTemp) dayTemp.textContent = temp;
    }

    async function loadWeatherByCoords(lat, lon) {
      const weatherText = document.getElementById('liveWeatherText');
      const tempText = document.getElementById('liveTemperatureText');
      const locationText = document.getElementById('liveLocationText');
      const metaText = document.getElementById('liveWeatherMetaText');
      const highText = document.getElementById('liveTempHigh');
      const lowText = document.getElementById('liveTempLow');

      try {
        const locationName = await reverseGeocode(lat, lon);

        const url = `https://api.open-meteo.com/v1/forecast?latitude=${lat}&longitude=${lon}&current=temperature_2m,apparent_temperature,weather_code,relative_humidity_2m,wind_speed_10m&daily=weather_code,temperature_2m_max,temperature_2m_min&timezone=auto&forecast_days=5`;

        const res = await fetch(url);
        const data = await res.json();

        if (!data || !data.current) {
          throw new Error('Weather data unavailable');
        }

        const current = data.current;
        const daily = data.daily || {};
        const weatherCode = Number(current.weather_code || 0);
        const weatherDesc = getWeatherDescription(weatherCode);
        const temp = Math.round(Number(current.temperature_2m ?? 0));
        const apparent = Math.round(Number(current.apparent_temperature ?? 0));
        const humidity = current.relative_humidity_2m ?? '--';
        const wind = current.wind_speed_10m ?? '--';
        const tempUnit = data.current_units?.temperature_2m || '°C';
        const windUnit = data.current_units?.wind_speed_10m || 'km/h';

        const todayMax = daily.temperature_2m_max?.[0];
        const todayMin = daily.temperature_2m_min?.[0];

        if (weatherText) weatherText.textContent = weatherDesc;
        if (tempText) tempText.textContent = `${temp}°`;
        if (locationText) locationText.textContent = locationName;
        if (metaText) metaText.textContent = `Feels like ${apparent}${tempUnit} • Humidity ${humidity}% • Wind ${wind} ${windUnit}`;
        if (highText) highText.textContent = `↑ ${todayMax !== undefined ? Math.round(todayMax) : '--'}°`;
        if (lowText) lowText.textContent = `↓ ${todayMin !== undefined ? Math.round(todayMin) : '--'}°`;

        const times = daily.time || [];
        const maxTemps = daily.temperature_2m_max || [];
        const codes = daily.weather_code || [];

        for (let i = 1; i <= 4; i++) {
          const label = times[i] ? formatDayName(times[i]) : 'DAY';
          const icon = codes[i] !== undefined ? getWeatherEmoji(Number(codes[i])) : '⛅';
          const forecastTemp = maxTemps[i] !== undefined ? `${Math.round(maxTemps[i])}°` : '--°';
          setMiniForecastDay(i, label, icon, forecastTemp);
        }
      } catch (error) {
        console.error('Weather fetch failed:', error);

        if (weatherText) weatherText.textContent = 'Weather unavailable';
        if (tempText) tempText.textContent = '--°';
        if (locationText) locationText.textContent = 'Unable to detect weather';
        if (metaText) metaText.textContent = 'Check internet or location permission';
        if (highText) highText.textContent = '↑ --°';
        if (lowText) lowText.textContent = '↓ --°';

        for (let i = 1; i <= 4; i++) {
          setMiniForecastDay(i, 'DAY', '⛅', '--°');
        }
      }
    }

    function loadDashboardWeather() {
      const weatherText = document.getElementById('liveWeatherText');
      const tempText = document.getElementById('liveTemperatureText');
      const locationText = document.getElementById('liveLocationText');
      const metaText = document.getElementById('liveWeatherMetaText');
      const highText = document.getElementById('liveTempHigh');
      const lowText = document.getElementById('liveTempLow');

      if (!weatherText || !tempText || !locationText || !metaText) return;

      weatherText.textContent = 'Loading weather...';
      tempText.textContent = '--°';
      locationText.textContent = 'Requesting location...';
      metaText.textContent = 'Please allow location access';
      if (highText) highText.textContent = '↑ --°';
      if (lowText) lowText.textContent = '↓ --°';

      if (!navigator.geolocation) {
        weatherText.textContent = 'Geolocation unsupported';
        locationText.textContent = 'This browser does not support location';
        metaText.textContent = 'Weather cannot be loaded automatically';
        return;
      }

      navigator.geolocation.getCurrentPosition(
        (position) => {
          const lat = position.coords.latitude;
          const lon = position.coords.longitude;
          loadWeatherByCoords(lat, lon);
        },
        (error) => {
          console.error('Geolocation error:', error);

          weatherText.textContent = 'Location denied';
          tempText.textContent = '--°';
          locationText.textContent = 'Permission not granted';
          metaText.textContent = 'Enable location to show live weather';
        },
        {
          enableHighAccuracy: true,
          timeout: 10000,
          maximumAge: 300000
        }
      );
    }

    function renderDashboardLineChart() {
      const canvas = document.getElementById('dashboardLineChart');
      if (!canvas || typeof Chart === 'undefined') return;

      const labels = JSON.parse(canvas.dataset.labels || '[]');
      const values = JSON.parse(canvas.dataset.values || '[]');
      const ctx = canvas.getContext('2d');

      if (dashboardChartInstance) {
        dashboardChartInstance.destroy();
      }

      dashboardChartInstance = new Chart(ctx, {
        type: 'line',
        data: {
          labels: labels,
          datasets: [{
            label: 'Registered Records',
            data: values,
            borderColor: '#16a34a',
            backgroundColor: 'rgba(22, 163, 74, 0.14)',
            fill: true,
            tension: 0.38,
            pointRadius: 4,
            pointHoverRadius: 7,
            pointBackgroundColor: '#16a34a',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            borderWidth: 3
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: { duration: 650 },
          plugins: {
            legend: {
              display: true,
              labels: {
                usePointStyle: true,
                pointStyle: 'circle',
                padding: 18,
                color: '#334155',
                font: {
                  size: 12,
                  weight: '700'
                }
              }
            },
            tooltip: {
              mode: 'index',
              intersect: false,
              backgroundColor: '#0f172a',
              titleColor: '#ffffff',
              bodyColor: '#e2e8f0',
              padding: 12,
              displayColors: true
            }
          },
          interaction: {
            mode: 'nearest',
            intersect: false
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: {
                precision: 0,
                color: '#64748b',
                font: {
                  weight: '600'
                }
              },
              grid: {
                color: 'rgba(15, 23, 42, 0.08)',
                drawBorder: false
              }
            },
            x: {
              ticks: {
                color: '#64748b',
                font: {
                  weight: '600'
                }
              },
              grid: {
                display: false,
                drawBorder: false
              }
            }
          }
        }
      });
    }

    function renderGenderPieChart() {
      const canvas = document.getElementById('dashboardGenderPieChart');
      if (!canvas || typeof Chart === 'undefined') return;

      const labels = JSON.parse(canvas.dataset.labels || '[]');
      const values = JSON.parse(canvas.dataset.values || '[]');
      const ctx = canvas.getContext('2d');
      const total = values.reduce((sum, n) => sum + Number(n || 0), 0);

      if (dashboardGenderPieInstance) {
        dashboardGenderPieInstance.destroy();
      }

      dashboardGenderPieInstance = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: labels,
          datasets: [{
            data: values,
            backgroundColor: [
              '#2563eb',
              '#ec4899'
            ],
            borderColor: '#ffffff',
            borderWidth: 3,
            hoverOffset: 10
          }]
        },
        plugins: [centerTextPlugin],
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '64%',
          animation: { duration: 650 },
          plugins: {
            centerTextPlugin: {
              title: 'Gender',
              value: total,
              titleColor: '#64748b',
              valueColor: '#0f172a'
            },
            legend: {
              position: 'bottom',
              labels: {
                padding: 16,
                usePointStyle: false,
                boxWidth: 36,
                color: '#475569',
                font: {
                  size: 12,
                  weight: '700'
                }
              }
            },
            tooltip: {
              enabled: false,
              backgroundColor: '#0f172a',
              titleColor: '#ffffff',
              bodyColor: '#e2e8f0',
              padding: 12,
              displayColors: true,
              cornerRadius: 10,
              callbacks: {
                label: function(context) {
                  const value = Number(context.raw || 0);
                  const percent = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                  return ` ${context.label}: ${value} (${percent}%)`;
                }
              }
            }
          }
        }
      });
    }

    function renderDisabilityPieChart() {
      const canvas = document.getElementById('dashboardDisabilityPieChart');
      if (!canvas || typeof Chart === 'undefined') return;

      const labels = JSON.parse(canvas.dataset.labels || '[]');
      const values = JSON.parse(canvas.dataset.values || '[]');
      const ctx = canvas.getContext('2d');
      const total = values.reduce((sum, n) => sum + Number(n || 0), 0);

      if (dashboardDisabilityPieInstance) {
        dashboardDisabilityPieInstance.destroy();
      }

      dashboardDisabilityPieInstance = new Chart(ctx, {
        type: 'doughnut',
        data: {
          labels: labels,
          datasets: [{
            data: values,
            backgroundColor: [
              '#16a34a',
              '#22c55e',
              '#84cc16',
              '#eab308',
              '#f59e0b',
              '#f97316',
              '#ef4444',
              '#8b5cf6',
              '#06b6d4',
              '#3b82f6',
              '#14b8a6'
            ],
            borderColor: '#ffffff',
            borderWidth: 3,
            hoverOffset: 10
          }]
        },
        plugins: [centerTextPlugin],
        options: {
          responsive: true,
          maintainAspectRatio: false,
          cutout: '64%',
          animation: { duration: 650 },
          plugins: {
            centerTextPlugin: {
              title: 'Disability',
              value: total,
              titleColor: '#64748b',
              valueColor: '#0f172a'
            },
            legend: {
              position: 'bottom',
              labels: {
                padding: 16,
                usePointStyle: false,
                boxWidth: 36,
                color: '#475569',
                font: {
                  size: 12,
                  weight: '700'
                }
              }
            },
            tooltip: {
              enabled: false,
              backgroundColor: '#0f172a',
              titleColor: '#ffffff',
              bodyColor: '#e2e8f0',
              padding: 12,
              displayColors: true,
              cornerRadius: 10,
              callbacks: {
                label: function(context) {
                  const value = Number(context.raw || 0);
                  const percent = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                  return ` ${context.label}: ${value} (${percent}%)`;
                }
              }
            }
          }
        }
      });
    }

    function renderAllDashboardCharts() {
      renderDashboardLineChart();
      renderGenderPieChart();
      renderDisabilityPieChart();
      applyProgressWidths();
    }

    document.addEventListener('livewire:initialized', () => {
      if (!dashboardClockStarted) {
        updateDashboardClock();
        setInterval(updateDashboardClock, 1000);
        dashboardClockStarted = true;
      }

      if (!weatherLoaded) {
        loadDashboardWeather();
        weatherLoaded = true;

        setInterval(() => {
          loadDashboardWeather();
        }, 600000);
      }

      setTimeout(() => {
        renderAllDashboardCharts();
      }, 100);

      Livewire.hook('morph.updated', () => {
        setTimeout(() => {
          renderAllDashboardCharts();
        }, 80);
      });
    });
  </script>
  @endscript
</div>