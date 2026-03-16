<div>
  <div class="dash-grid">

    {{-- REGISTERED --}}
    <div class="dash-card dash-card-hover-title">
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
    <div class="dash-card dash-card-hover-title">
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
    <div class="dash-card dash-card-hover-title">
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

    {{-- SYSTEM CLOCK --}}
    <div class="scoreboard-card">
      <span class="scoreboard-live-dot"></span>

      <div class="scoreboard-header">
        <div class="scoreboard-team">
          <div class="scoreboard-team-label">Date</div>
          <div class="scoreboard-team-name">PDAO</div>
        </div>
        <div class="scoreboard-team">
          <div class="scoreboard-team-label">Time</div>
          <div class="scoreboard-team-name">LIVE</div>
        </div>
      </div>

      <div class="scoreboard-main">
        <div class="scoreboard-title">System Clock</div>

        <div class="scoreboard-clock-row">
          <div class="scoreboard-time" id="liveTimeText">{{ now()->format('h:i:s') }}</div>
          <div class="scoreboard-ampm" id="liveAmPm">{{ now()->format('A') }}</div>
        </div>

        <div class="scoreboard-date" id="liveDateText">{{ now()->format('l, F d, Y') }}</div>
        <div class="scoreboard-sub">Real-time dashboard display</div>
      </div>
    </div>

  </div>

  <div class="dash-panels">

    {{-- LINE CHART --}}
    <div class="panel">
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

          <div class="chart-box">
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
    <div class="panel">
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
            <div class="recent-table-wrap">
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
                      <td>{{ $category }}</td>
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
    <div class="panel">
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
            <div class="pie-chart-box pie-chart-box-small">
              <canvas
                id="dashboardGenderPieChart"
                data-labels='@json($sexPieLabels)'
                data-values='@json($sexPieData)'>
              </canvas>
            </div>

            <div class="pie-side-description">
              <div class="pie-desc-card">
                <div class="pie-desc-title">Gender Overview</div>
                <p class="pie-desc-text">
                  This chart presents the distribution of registered individuals by sex for
                  <strong>{{ strtolower($rangeLabel) }}</strong>. It helps identify whether the
                  recorded population is more represented by male or female registrants.
                </p>

                <div class="pie-stat-list">
                  <div class="pie-stat-item">
                    <span class="pie-dot pie-dot-male"></span>
                    <div>
                      <strong>Male</strong>
                      <small>{{ $sexPieData[0] ?? 0 }} registered record(s)</small>
                    </div>
                  </div>

                  <div class="pie-stat-item">
                    <span class="pie-dot pie-dot-female"></span>
                    <div>
                      <strong>Female</strong>
                      <small>{{ $sexPieData[1] ?? 0 }} registered record(s)</small>
                    </div>
                  </div>
                </div>

                <div class="pie-note">
                  This summary makes it easier to monitor gender balance in the profiling data.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- TYPES OF DISABILITY --}}
    <div class="panel">
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
            <div class="pie-chart-box pie-chart-box-small">
              <canvas
                id="dashboardDisabilityPieChart"
                data-labels='@json($disabilityPieLabels)'
                data-values='@json($disabilityPieData)'>
              </canvas>
            </div>

            <div class="pie-side-description">
              <div class="pie-desc-card">
                <div class="pie-desc-title">Disability Summary</div>
                <p class="pie-desc-text">
                  This graph shows the recorded types of disability based on the current
                  <strong>{{ strtolower($rangeLabel) }}</strong> selection. It provides a quick
                  overview of which disability category appears most frequently in the system.
                </p>

                <div class="pie-stat-list pie-stat-list-vertical">
                  @forelse(($disabilityPieLabels ?? []) as $index => $label)
                    @if(($disabilityPieData[$index] ?? 0) > 0)
                      <div class="pie-stat-item">
                        <span class="pie-dot pie-dot-disability"></span>
                        <div>
                          <strong>{{ $label }}</strong>
                          <small>{{ $disabilityPieData[$index] ?? 0 }} record(s)</small>
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
                  This helps the office understand which services and support programs may be
                  most needed by the registered beneficiaries.
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
            backgroundColor: 'rgba(22, 163, 74, 0.12)',
            fill: true,
            tension: 0.35,
            pointRadius: 4,
            pointHoverRadius: 6,
            pointBackgroundColor: '#16a34a',
            pointBorderColor: '#ffffff',
            pointBorderWidth: 2,
            borderWidth: 3
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: { duration: 500 },
          plugins: {
            legend: { display: true },
            tooltip: {
              mode: 'index',
              intersect: false
            }
          },
          interaction: {
            mode: 'nearest',
            intersect: false
          },
          scales: {
            y: {
              beginAtZero: true,
              ticks: { precision: 0 },
              grid: { color: 'rgba(15, 23, 42, 0.08)' }
            },
            x: {
              grid: { display: false }
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

      if (dashboardGenderPieInstance) {
        dashboardGenderPieInstance.destroy();
      }

      dashboardGenderPieInstance = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: labels,
          datasets: [{
            data: values,
            backgroundColor: [
              '#2563eb',
              '#ec4899'
            ],
            borderColor: '#ffffff',
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: { duration: 500 },
          plugins: {
            legend: {
              position: 'bottom'
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

      if (dashboardDisabilityPieInstance) {
        dashboardDisabilityPieInstance.destroy();
      }

      dashboardDisabilityPieInstance = new Chart(ctx, {
        type: 'pie',
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
            borderWidth: 2
          }]
        },
        options: {
          responsive: true,
          maintainAspectRatio: false,
          animation: { duration: 500 },
          plugins: {
            legend: {
              position: 'bottom'
            }
          }
        }
      });
    }

    function renderAllDashboardCharts() {
      renderDashboardLineChart();
      renderGenderPieChart();
      renderDisabilityPieChart();
    }

    document.addEventListener('livewire:initialized', () => {
      if (!dashboardClockStarted) {
        updateDashboardClock();
        setInterval(updateDashboardClock, 1000);
        dashboardClockStarted = true;
      }

      setTimeout(() => {
        renderAllDashboardCharts();
      }, 100);

      Livewire.hook('morph.updated', () => {
        setTimeout(() => {
          renderAllDashboardCharts();
        }, 50);
      });
    });
  </script>
  @endscript
</div>