<div>
  <div class="dash-grid">

    <div class="dash-card">
      <div class="card-top-row">
        <div>
          <div class="card-title">Registered</div>
          <div class="card-value">{{ $registeredCount }}</div>
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
      <div class="card-value">{{ $pwdCount }}</div>
      <div class="card-sub">Total registered persons</div>
    </div>

    <div class="dash-card">
      <div class="card-title">Senior Citizens</div>
      <div class="card-value">{{ $seniorCount }}</div>
      <div class="card-sub">Age 60 years old and above</div>
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
        <h2>Overview</h2>
        <span class="panel-pill">{{ $rangeLabel }}</span>
      </div>

      <div class="panel-body">
        <div class="overview-stack">
          <div class="overview-box">
            <strong>Filtered Registered:</strong> {{ $registeredCount }}
          </div>

          <div class="overview-box">
            <strong>Total Registered PWD:</strong> {{ $pwdCount }}
          </div>

          <div class="overview-box">
            <strong>Total Senior Citizens:</strong> {{ $seniorCount }}
          </div>

          <div class="overview-box">
            <strong>Current Date & Time:</strong>
            <span id="overviewLiveDateTime">{{ now()->format('F d, Y h:i:s A') }}</span>
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
                    $category = ($age !== null && $age >= 60) ? 'Senior Citizen' : 'PWD';
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
            No recent records.
          </div>
        @endif
      </div>
    </div>
  </div>

  @script
  <script>
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
      const overviewLiveDateTime = document.getElementById('overviewLiveDateTime');

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
      if (overviewLiveDateTime) overviewLiveDateTime.textContent = `${formattedDate} ${formattedTime} ${realAmpm}`;
    }

    setInterval(updateDashboardClock, 1000);
    updateDashboardClock();
  </script>
  @endscript
</div>