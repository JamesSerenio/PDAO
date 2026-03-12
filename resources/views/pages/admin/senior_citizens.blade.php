@extends('layouts.admin_shell')

@section('title', 'Senior Citizens')
@section('page_title', 'Senior Citizens')
@section('page_subtitle', 'Registered persons aged 60 years old and above')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/admin_senior_citizens.css') }}">
@endpush

@section('content')
@php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

$q = trim((string) request('q', ''));
$barangay = trim((string) request('barangay', ''));

// view open
$openId = (int) request('open', 0);

// edit mode (inside view)
$editMode = (int) request('editMode', 0);

$perPage = 12;

// ===== LIST QUERY (summary) =====
$query = DB::table('local_profiles as lp')
  ->whereNotNull('lp.date_of_birth')
  ->whereRaw('TIMESTAMPDIFF(YEAR, lp.date_of_birth, CURDATE()) >= 60')
  ->leftJoin('local_profile_disability_types as lpdt', 'lp.id', '=', 'lpdt.local_profile_id')
  ->leftJoin('disability_types as dt', 'lpdt.disability_type_id', '=', 'dt.id')
  ->select(
    'lp.id',
    'lp.ldr_number',
    'lp.profiling_date',
    'lp.photo_1x1',
    'lp.last_name',
    'lp.first_name',
    'lp.middle_name',
    'lp.suffix',
    'lp.sex',
    'lp.date_of_birth',
    'lp.barangay',
    'lp.mobile',
    'lp.email',
    'lp.created_at',
    DB::raw('GROUP_CONCAT(dt.name SEPARATOR ", ") as disabilities')
  )
  ->groupBy(
    'lp.id',
    'lp.ldr_number',
    'lp.profiling_date',
    'lp.photo_1x1',
    'lp.last_name',
    'lp.first_name',
    'lp.middle_name',
    'lp.suffix',
    'lp.sex',
    'lp.date_of_birth',
    'lp.barangay',
    'lp.mobile',
    'lp.email',
    'lp.created_at'
  );

if ($q !== '') {
  $query->where(function($w) use ($q) {
    $w->where('lp.last_name', 'like', "%{$q}%")
      ->orWhere('lp.first_name', 'like', "%{$q}%")
      ->orWhere('lp.middle_name', 'like', "%{$q}%")
      ->orWhere('lp.ldr_number', 'like', "%{$q}%")
      ->orWhere('lp.pwd_id_no', 'like', "%{$q}%");
  });
}

if ($barangay !== '') {
  $query->where('lp.barangay', $barangay);
}

$rows = $query->orderByDesc('lp.created_at')->paginate($perPage)->appends(request()->query());

$barangays = DB::table('local_profiles')
  ->whereNotNull('barangay')
  ->where('barangay','<>','')
  ->distinct()
  ->orderBy('barangay')
  ->pluck('barangay')
  ->toArray();

$total = (int) DB::table('local_profiles')
  ->whereNotNull('date_of_birth')
  ->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60')
  ->count();

$fullName = function($r){
  $mid = $r->middle_name ? (' ' . $r->middle_name) : '';
  $suf = $r->suffix ? (' ' . $r->suffix) : '';
  return trim($r->last_name . ', ' . $r->first_name . $mid . $suf);
};

// ===== OPEN DETAILS (full data) =====
$open = null;
$openTypes = [];
$openTypeIds = [];
$openCauses = collect();
$openCauseIds = [];
$openMembers = collect();

if ($openId > 0) {
  $open = DB::table('local_profiles')->where('id', $openId)->first();

  if ($open) {
    $openTypeIds = DB::table('local_profile_disability_types')
      ->where('local_profile_id', $openId)
      ->pluck('disability_type_id')
      ->toArray();

    $openTypes = DB::table('local_profile_disability_types as lpdt')
      ->join('disability_types as dt', 'dt.id', '=', 'lpdt.disability_type_id')
      ->where('lpdt.local_profile_id', $openId)
      ->orderBy('dt.name')
      ->pluck('dt.name')
      ->toArray();

    $openCauseIds = DB::table('local_profile_disability_causes')
      ->where('local_profile_id', $openId)
      ->pluck('disability_cause_id')
      ->toArray();

    $openCauses = DB::table('local_profile_disability_causes as lpdc')
      ->join('disability_causes as dc', 'dc.id', '=', 'lpdc.disability_cause_id')
      ->where('lpdc.local_profile_id', $openId)
      ->select('dc.id','dc.category', 'dc.name', 'lpdc.other_specify')
      ->orderBy('dc.category')
      ->orderBy('dc.name')
      ->get();

    $openMembers = DB::table('household_members')
      ->where('local_profile_id', $openId)
      ->orderBy('id', 'desc')
      ->get();
  }
}

// helper: build url with query
$withQuery = function(array $extra = [], array $remove = []) {
  $qs = request()->query();
  foreach($remove as $k){ unset($qs[$k]); }
  foreach($extra as $k => $v){ $qs[$k] = $v; }
  $u = url()->current();
  if(count($qs)) $u .= '?' . http_build_query($qs);
  return $u;
};

$closeViewUrl = $withQuery([], ['open','editMode']);
@endphp

<div class="senior-wrap">
  <div class="senior-card">
    <div class="senior-head">
      <div class="senior-title">
        <h2>Senior Citizens</h2>
        <p class="senior-sub">
          Total senior records: <b>{{ number_format($total) }}</b>
          @if($q !== '' || $barangay !== '')
            <span class="senior-muted">• filtered</span>
          @endif
        </p>
      </div>

      <form class="senior-filters" method="GET">
        <div class="senior-field">
          <label>Search</label>
          <input name="q" value="{{ $q }}" placeholder="Name / LDR / PWD ID...">
        </div>

        <div class="senior-field">
          <label>Barangay</label>
          <select name="barangay">
            <option value="">All barangays</option>
            @foreach($barangays as $b)
              <option value="{{ $b }}" {{ $barangay === $b ? 'selected' : '' }}>{{ $b }}</option>
            @endforeach
          </select>
        </div>

        <div class="senior-actions">
          <button class="senior-btn" type="submit">Filter</button>
          <a class="senior-btn ghost" href="{{ url()->current() }}">Reset</a>
        </div>
      </form>
    </div>

    <div class="senior-table-wrap">
      <table class="senior-table">
        <thead>
          <tr>
            <th>Photo</th>
            <th>Name</th>
            <th>LDR #</th>
            <th>Sex</th>
            <th>Age</th>
            <th>Barangay</th>
            <th>Types of Disability</th>
            <th>Contact</th>
            <th>Registered</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          @forelse($rows as $r)
            @php
              $age = $r->date_of_birth ? Carbon::parse($r->date_of_birth)->age : null;
              $isOpen = ($openId === (int)$r->id);
              $viewUrl = $withQuery(['open' => $r->id, 'editMode' => 0], []);
            @endphp

            <tr class="{{ $isOpen ? 'is-open' : '' }}">
              <td>
                @if($r->photo_1x1)
                  <img class="senior-photo" src="{{ Storage::url($r->photo_1x1) }}" alt="Photo">
                @else
                  <div class="senior-photo placeholder">No Photo</div>
                @endif
              </td>

              <td>
                <div class="senior-name">{{ $fullName($r) }}</div>
                <div class="senior-mini">ID: <b>#{{ $r->id }}</b></div>
              </td>

              <td><span class="pill">{{ $r->ldr_number ?: '—' }}</span></td>
              <td>{{ $r->sex ?: '—' }}</td>
              <td>{{ $age ? $age.' yrs' : '—' }}</td>
              <td>{{ $r->barangay ?: '—' }}</td>
              <td>{{ $r->disabilities ?: '—' }}</td>

              <td class="senior-mini">
                <div>📱 {{ $r->mobile ?: '—' }}</div>
                <div>✉️ {{ $r->email ?: '—' }}</div>
              </td>

              <td>{{ Carbon::parse($r->created_at)->format('M d, Y h:i A') }}</td>

              <td class="senior-actions-cell">
                <div style="display:flex; gap:8px; flex-wrap:wrap;">
                  @if($isOpen)
                    <a class="senior-btn mini ghost" href="{{ $closeViewUrl }}">Close</a>
                  @else
                    <a class="senior-btn mini" href="{{ $viewUrl }}">View more info</a>
                  @endif

                  <a class="senior-btn mini ghost" href="{{ route('admin.registered.pdf', $r->id) }}" target="_blank">
                    PDF
                  </a>
                </div>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="10" class="senior-empty">No senior citizen records found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="senior-foot">
      <div class="senior-pagination">{{ $rows->links() }}</div>
    </div>
  </div>
</div>
@endsection