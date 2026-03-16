<div>
  <div class="dash-grid">

    <div class="dash-card">
      <div class="card-top-row">
        <div>
          <div class="card-title">Registered</div>
          <div class="card-value" wire:loading.remove wire:target="range">
            {{ $registeredCount }}
          </div>
          <div class="card-value" wire:loading wire:target="range">
            ...
          </div>
          <div class="card-sub">{{ $rangeLabel }} records</div>
        </div>

        <div class="card-filter-form">
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

    <div class="dash-card">
      <div class="card-title">Registered PWD</div>
      <div class="card-value" wire:loading.remove wire:target="range">
        {{ $pwdCount }}
      </div>
      <div class="card-value" wire:loading wire:target="range">
        ...
      </div>
      <div class="card-sub">{{ $rangeLabel }} registered PWD</div>
    </div>

    <div class="dash-card">
      <div class="card-title">Senior Citizens</div>
      <div class="card-value" wire:loading.remove wire:target="range">
        {{ $seniorCount }}
      </div>
      <div class="card-value" wire:loading wire:target="range">
        ...
      </div>
      <div class="card-sub">{{ $rangeLabel }} senior citizens</div>
    </div>

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
                      <td>
                        {{ $person->last_name }},
                        {{ $person->first_name }}
                        {{ $person->middle_name }}
                      </td>
                      <td>{{ $person->barangay ?: '—' }}</td>
                      <td>
                        {{ $person->profiling_date
                            ? \Carbon\Carbon::parse($person->profiling_date)->format('M d, Y')
                            : '—' }}
                      </td>
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

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  @script
  <script>
    let dashboardChartInstance = null;

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
          animation: {
            duration: 500
          },
          plugins: {
            legend: {
              display: true
            },
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
              ticks: {
                precision: 0
              },
              grid: {
                color: 'rgba(15, 23, 42, 0.08)'
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          }
        }
      });
    }

    document.addEventListener('livewire:initialized', () => {
      updateDashboardClock();
      setInterval(updateDashboardClock, 1000);

      setTimeout(() => {
        renderDashboardLineChart();
      }, 100);

      Livewire.hook('morph.updated', () => {
        setTimeout(() => {
          renderDashboardLineChart();
        }, 50);
      });
    });
  </script>
  @endscript
</div>