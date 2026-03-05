@php
$q = trim((string) request('q', ''));
$barangay = trim((string) request('barangay', ''));
$perPage = 12;

$query = \Illuminate\Support\Facades\DB::table('local_profiles as lp')
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
    \Illuminate\Support\Facades\DB::raw('GROUP_CONCAT(dt.name SEPARATOR ", ") as disabilities')
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

$rows = $query
  ->orderByDesc('lp.created_at')
  ->paginate($perPage)
  ->appends(request()->query());

$barangays = \Illuminate\Support\Facades\DB::table('local_profiles')
  ->whereNotNull('barangay')
  ->where('barangay','<>','')
  ->distinct()
  ->orderBy('barangay')
  ->pluck('barangay')
  ->toArray();

$total = (int) \Illuminate\Support\Facades\DB::table('local_profiles')->count();

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


<form class="reg-filters" method="GET">

<div class="reg-field">
<label>Search</label>

<input
name="q"
value="{{ $q }}"
placeholder="Name / LDR / PWD ID..."
>
</div>


<div class="reg-field">
<label>Barangay</label>

<select name="barangay">

<option value="">All barangays</option>

@foreach($barangays as $b)
<option value="{{ $b }}" {{ $barangay === $b ? 'selected' : '' }}>
{{ $b }}
</option>
@endforeach

</select>
</div>


<div class="reg-actions">
<button class="reg-btn">Filter</button>
<a class="reg-btn ghost" href="{{ url()->current() }}">Reset</a>
</div>

</form>

</div>



<div class="reg-table-wrap">

<table class="reg-table">

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

</tr>
</thead>


<tbody>

@forelse($rows as $r)

@php
$age = null;

if($r->date_of_birth){
$age = \Carbon\Carbon::parse($r->date_of_birth)->age;
}
@endphp

<tr>

<td>
@if($r->photo_1x1)
<img class="reg-photo" src="{{ Storage::url($r->photo_1x1) }}">
@else
<div class="reg-photo placeholder">No Photo</div>
@endif
</td>


<td>

<div class="reg-name">
{{ $fullName($r) }}
</div>

<div class="reg-mini">

ID: <b>#{{ $r->id }}</b>

@if($r->profiling_date)
<span class="dot">•</span>

Profiled:
{{ \Carbon\Carbon::parse($r->profiling_date)->format('M d, Y') }}
@endif

</div>

</td>


<td>
<span class="pill">
{{ $r->ldr_number ?: '—' }}
</span>
</td>


<td>
{{ $r->sex ?: '—' }}
</td>


<td>

@if($age)
{{ $age }} yrs
@else
—
@endif

</td>


<td>
{{ $r->barangay ?: '—' }}
</td>


<td>

@if($r->disabilities)
{{ $r->disabilities }}
@else
—
@endif

</td>


<td>

<div class="reg-mini">

<div>📱 {{ $r->mobile ?: '—' }}</div>
<div>✉️ {{ $r->email ?: '—' }}</div>

</div>

</td>


<td>
{{ \Carbon\Carbon::parse($r->created_at)->format('M d, Y h:i A') }}
</td>


</tr>

@empty

<tr>
<td colspan="9" class="reg-empty">
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