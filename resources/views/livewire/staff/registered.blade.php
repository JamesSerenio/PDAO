@php
  // NOTE: okay ni siya for quick viewing (route::view).
  // Best practice is controller/livewire, pero this works now.

  $q = trim((string) request('q', ''));
  $barangay = trim((string) request('barangay', ''));
  $perPage = 12;

  $query = \Illuminate\Support\Facades\DB::table('local_profiles')
    ->select(
      'id',
      'ldr_number',
      'profiling_date',
      'photo_1x1',
      'last_name',
      'first_name',
      'middle_name',
      'suffix',
      'sex',
      'date_of_birth',
      'barangay',
      'mobile',
      'email',
      'created_at'
    );

  if ($q !== '') {
    $query->where(function($w) use ($q) {
      $w->where('last_name', 'like', "%{$q}%")
        ->orWhere('first_name', 'like', "%{$q}%")
        ->orWhere('middle_name', 'like', "%{$q}%")
        ->orWhere('ldr_number', 'like', "%{$q}%")
        ->orWhere('pwd_id_no', 'like', "%{$q}%");
    });
  }

  if ($barangay !== '') {
    $query->where('barangay', $barangay);
  }

  $rows = $query
    ->orderByDesc('created_at')
    ->paginate($perPage)
    ->appends(request()->query());

  $barangays = \Illuminate\Support\Facades\DB::table('local_profiles')
    ->whereNotNull('barangay')
    ->where('barangay', '<>', '')
    ->distinct()
    ->orderBy('barangay')
    ->pluck('barangay')
    ->toArray();

  $total = (int) \Illuminate\Support\Facades\DB::table('local_profiles')->count();

  // tiny helper for full name
  $fullName = function($r){
    $mid = $r->middle_name ? (' ' . $r->middle_name) : '';
    $suf = $r->suffix ? (' ' . $r->suffix) : '';
    return trim($r->last_name . ', ' . $r->first_name . $mid . $suf);
  };
@endphp

<div class="reg-wrap">

  <div class="reg-card">
    <div class="reg-head">
      <div class="reg-title">
        <h2>Registered Persons</h2>
        <p class="reg-sub">
          Total records: <b>{{ number_format($total) }}</b>
          @if($q !== '' || $barangay !== '')
            <span class="reg-muted">• filtered</span>
          @endif
        </p>
      </div>

      <form class="reg-filters" method="GET" action="{{ url()->current() }}">
        <div class="reg-field">
          <label for="q">Search</label>
          <input
            id="q"
            name="q"
            type="text"
            value="{{ $q }}"
            placeholder="Name / LDR / PWD ID..."
            autocomplete="off"
          >
        </div>

        <div class="reg-field">
          <label for="barangay">Barangay</label>
          <select id="barangay" name="barangay">
            <option value="">All barangays</option>
            @foreach($barangays as $b)
              <option value="{{ $b }}" {{ $barangay === $b ? 'selected' : '' }}>
                {{ $b }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="reg-actions">
          <button class="reg-btn" type="submit">Filter</button>
          <a class="reg-btn ghost" href="{{ url()->current() }}">Reset</a>
        </div>
      </form>
    </div>

    <div class="reg-table-wrap">
      <table class="reg-table">
        <thead>
          <tr>
            <th class="col-photo">Photo</th>
            <th class="col-name">Name</th>
            <th class="col-ldr">LDR #</th>
            <th class="col-sex">Sex</th>
            <th class="col-dob">DOB</th>
            <th class="col-brgy">Barangay</th>
            <th class="col-contact">Contact</th>
            <th class="col-date">Registered</th>
          </tr>
        </thead>

        <tbody>
          @forelse($rows as $r)
            <tr>
              <td class="col-photo">
                @if(!empty($r->photo_1x1))
                  <img class="reg-photo" src="{{ asset($r->photo_1x1) }}" alt="Photo">
                @else
                  <div class="reg-photo placeholder">No Photo</div>
                @endif
              </td>

              <td class="col-name">
                <div class="reg-name">{{ $fullName($r) }}</div>
                <div class="reg-mini">
                  ID: <b>#{{ $r->id }}</b>
                  @if(!empty($r->profiling_date))
                    <span class="dot">•</span> Profiled: {{ \Illuminate\Support\Carbon::parse($r->profiling_date)->format('M d, Y') }}
                  @endif
                </div>
              </td>

              <td class="col-ldr">
                <span class="pill">{{ $r->ldr_number ?: '—' }}</span>
              </td>

              <td class="col-sex">
                {{ $r->sex ?: '—' }}
              </td>

              <td class="col-dob">
                @if(!empty($r->date_of_birth))
                  {{ \Illuminate\Support\Carbon::parse($r->date_of_birth)->format('M d, Y') }}
                @else
                  —
                @endif
              </td>

              <td class="col-brgy">
                {{ $r->barangay ?: '—' }}
              </td>

              <td class="col-contact">
                <div class="reg-mini">
                  <div><b>📱</b> {{ $r->mobile ?: '—' }}</div>
                  <div><b>✉️</b> {{ $r->email ?: '—' }}</div>
                </div>
              </td>

              <td class="col-date">
                {{ \Illuminate\Support\Carbon::parse($r->created_at)->format('M d, Y h:i A') }}
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="8" class="reg-empty">
                No records found.
              </td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="reg-foot">
      <div class="reg-pagination">
        {{ $rows->links() }}
      </div>
    </div>
  </div>

</div>