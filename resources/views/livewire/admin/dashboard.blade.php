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

    {{-- SYSTEM CLOCK --}}
    <div class="scoreboard-card">
      <span class="scoreboard-live-dot"></span>

      <div class="scoreboard-header weather-header">
        <div class="scoreboard-team weather-team weather-team-main">
          <div class="scoreboard-team-label">Weather</div>
          <div class="scoreboard-team-name" id="liveWeatherText">Loading...</div>
          <div class="scoreboard-team-sub" id="liveLocationText">Detecting location...</div>
        </div>

        <div class="scoreboard-team weather-team weather-team-temp">
          <div class="scoreboard-team-label">Temperature</div>
          <div class="scoreboard-team-name weather-temp-value" id="liveTemperatureText">--°C</div>
          <div class="scoreboard-team-sub" id="liveWeatherMetaText">Please wait</div>
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