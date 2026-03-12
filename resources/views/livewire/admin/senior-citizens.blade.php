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

                  <a
                    class="senior-btn mini ghost"
                    href="{{ route('admin.registered.pdf', $r->id) }}"
                    target="_blank"
                  >
                    PDF
                  </a>
                </div>
              </td>
            </tr>

            @if($isOpen && $open)
              @php
                $openAge = $open->date_of_birth ? Carbon::parse($open->date_of_birth)->age : null;
                $editOnUrl  = $withQuery(['open' => $openId, 'editMode' => 1], []);
                $editOffUrl = $withQuery(['open' => $openId, 'editMode' => 0], []);
                $isEditing = ($editMode === 1);
                $val = fn($x) => (string)($x ?? '');
              @endphp

              <tr class="senior-details-row">
                <td colspan="10">
                  <div class="senior-details">

                    <div class="senior-details-top">
                      <div>
                        <h3 class="senior-h3">Full Information</h3>
                        <div class="senior-mini">
                          LDR: <b>{{ $open->ldr_number ?: '—' }}</b>
                          <span class="dot">•</span>
                          Profiled: <b>{{ $open->profiling_date ? Carbon::parse($open->profiling_date)->format('M d, Y') : '—' }}</b>
                          <span class="dot">•</span>
                          Age: <b>{{ $openAge ? $openAge.' yrs' : '—' }}</b>
                        </div>

                        <div style="margin-top:10px; display:flex; gap:8px; flex-wrap:wrap;">
                          @if($isEditing)
                            <a class="senior-btn mini ghost" href="{{ $editOffUrl }}">Cancel edit</a>
                          @else
                            <a class="senior-btn mini" href="{{ $editOnUrl }}">Edit</a>
                          @endif
                        </div>
                      </div>

                      <div class="senior-details-photo">
                        @if($open->photo_1x1)
                          <img id="photoPreview" class="senior-photo big" src="{{ Storage::url($open->photo_1x1) }}" alt="Photo">
                        @else
                          <img id="photoPreview" class="senior-photo big" src="" alt="Photo" style="display:none;">
                        @endif
                      </div>
                    </div>

                    <form
                      method="POST"
                      action="{{ route('admin.registered.update', $open->id) }}"
                      enctype="multipart/form-data"
                      class="senior-form"
                    >
                      @csrf
                      @method('PUT')

                      <input type="hidden" name="_redirect" value="{{ $withQuery(['open'=>$openId,'editMode'=>0], []) }}">

                      <div class="senior-grid">

                        <div class="senior-box">
                          <h4>Personal</h4>

                          <div class="senior-kv" style="border-bottom:none; padding-bottom:0;">
                            <span>Photo (1x1)</span>
                            @if($isEditing)
                              <div style="display:flex; flex-direction:column; gap:6px; align-items:flex-end;">
                                <input class="senior-input" type="file" name="photo_1x1" accept="image/*" onchange="previewPhoto(event)">
                                <small class="senior-muted">Choose new photo (optional)</small>
                              </div>
                            @else
                              <b>{{ $open->photo_1x1 ? 'Uploaded' : '—' }}</b>
                            @endif
                          </div>

                          <div class="senior-kv">
                            <span>Signature/Thumbmark</span>
                            @if($isEditing)
                              <div style="display:flex; flex-direction:column; gap:6px; align-items:flex-end;">
                                <input class="senior-input" type="file" name="signature_thumbmark" accept="image/*" onchange="previewSignature(event)">
                                <small class="senior-muted">Choose signature/thumbmark (optional)</small>
                              </div>
                            @else
                              @if($open->signature_thumbmark)
                                <img id="signaturePreview" class="sig-img" src="{{ Storage::url($open->signature_thumbmark) }}" alt="Signature/Thumbmark">
                              @else
                                <b>—</b>
                              @endif
                            @endif
                          </div>

                          <div class="senior-kv"><span>LDR Number</span>@if($isEditing)<input class="senior-input" name="ldr_number" value="{{ $val($open->ldr_number) }}">@else<b>{{ $open->ldr_number ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Profiling Date</span>@if($isEditing)<input class="senior-input" type="date" name="profiling_date" value="{{ $val($open->profiling_date) }}">@else<b>{{ $open->profiling_date ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Last Name</span>@if($isEditing)<input class="senior-input" name="last_name" value="{{ $val($open->last_name) }}" required>@else<b>{{ $open->last_name ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>First Name</span>@if($isEditing)<input class="senior-input" name="first_name" value="{{ $val($open->first_name) }}" required>@else<b>{{ $open->first_name ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Middle Name</span>@if($isEditing)<input class="senior-input" name="middle_name" value="{{ $val($open->middle_name) }}">@else<b>{{ $open->middle_name ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Suffix</span>@if($isEditing)<input class="senior-input" name="suffix" value="{{ $val($open->suffix) }}">@else<b>{{ $open->suffix ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Date of Birth</span>@if($isEditing)<input class="senior-input" type="date" name="date_of_birth" value="{{ $val($open->date_of_birth) }}">@else<b>{{ $open->date_of_birth ?: '—' }}</b>@endif</div>

                          <div class="senior-kv">
                            <span>Sex</span>
                            @if($isEditing)
                              <select class="senior-input" name="sex">
                                <option value="">—</option>
                                <option value="MALE" {{ $open->sex === 'MALE' ? 'selected' : '' }}>MALE</option>
                                <option value="FEMALE" {{ $open->sex === 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                              </select>
                            @else
                              <b>{{ $open->sex ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="senior-kv">
                            <span>Blood Type</span>
                            @if($isEditing)
                              <select class="senior-input" name="blood_type">
                                @php $bts = ['','A+','A-','B+','B-','AB+','AB-','O+','O-']; @endphp
                                @foreach($bts as $bt)
                                  <option value="{{ $bt }}" {{ $open->blood_type === $bt ? 'selected' : '' }}>
                                    {{ $bt === '' ? '—' : $bt }}
                                  </option>
                                @endforeach
                              </select>
                            @else
                              <b>{{ $open->blood_type ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="senior-kv"><span>Religion</span>@if($isEditing)<input class="senior-input" name="religion" value="{{ $val($open->religion) }}">@else<b>{{ $open->religion ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Ethnic Group</span>@if($isEditing)<input class="senior-input" name="ethnic_group" value="{{ $val($open->ethnic_group) }}">@else<b>{{ $open->ethnic_group ?: '—' }}</b>@endif</div>

                          <div class="senior-kv">
                            <span>Civil Status</span>
                            @if($isEditing)
                              <select class="senior-input" name="civil_status">
                                @php $cs = ['','Single','Separated','Cohabitation (Live-in)','Married','Widow','Widower']; @endphp
                                @foreach($cs as $c)
                                  <option value="{{ $c }}" {{ $open->civil_status === $c ? 'selected' : '' }}>
                                    {{ $c === '' ? '—' : $c }}
                                  </option>
                                @endforeach
                              </select>
                            @else
                              <b>{{ $open->civil_status ?: '—' }}</b>
                            @endif
                          </div>
                        </div>

                        <div class="senior-box">
                          <h4>Address</h4>
                          @foreach([
                            ['House No./Street','house_no_street'],
                            ['Sitio/Purok','sitio_purok'],
                            ['Barangay','barangay'],
                            ['Municipality','municipality'],
                            ['Province','province'],
                            ['Region','region'],
                          ] as [$label,$key])
                            <div class="senior-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="senior-input" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        <div class="senior-box">
                          <h4>Contact</h4>
                          @foreach([
                            ['Landline','landline','text'],
                            ['Mobile','mobile','text'],
                            ['Email','email','email'],
                          ] as [$label,$key,$type])
                            <div class="senior-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="senior-input" type="{{ $type }}" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        <div class="senior-box">
                          <h4>Education / Employment</h4>

                          <div class="senior-kv"><span>Education Level</span>@if($isEditing)<input class="senior-input" name="education_level" value="{{ $val($open->education_level) }}">@else<b>{{ $open->education_level ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Employment Status</span>@if($isEditing)<input class="senior-input" name="employment_status" value="{{ $val($open->employment_status) }}">@else<b>{{ $open->employment_status ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Employment Category</span>@if($isEditing)<input class="senior-input" name="employment_category" value="{{ $val($open->employment_category) }}">@else<b>{{ $open->employment_category ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Specific Occupation</span>@if($isEditing)<input class="senior-input" name="specific_occupation" value="{{ $val($open->specific_occupation) }}">@else<b>{{ $open->specific_occupation ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Employment Type</span>@if($isEditing)<input class="senior-input" name="employment_type" value="{{ $val($open->employment_type) }}">@else<b>{{ $open->employment_type ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Special Skills</span>@if($isEditing)<textarea class="senior-input" name="special_skills" rows="3">{{ $val($open->special_skills) }}</textarea>@else<b>{{ $open->special_skills ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Sporting Talent</span>@if($isEditing)<textarea class="senior-input" name="sporting_talent" rows="3">{{ $val($open->sporting_talent) }}</textarea>@else<b>{{ $open->sporting_talent ?: '—' }}</b>@endif</div>
                        </div>

                        <div class="senior-box">
                          <h4>Organization</h4>
                          @foreach([
                            ['PWD Organization / Group Name','pwd_org_affiliated'],
                            ['Org Contact Person','org_contact_person'],
                            ['Org Office Address','org_office_address'],
                            ['Org Tel/Mobile','org_tel_mobile'],
                          ] as [$label,$key])
                            <div class="senior-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="senior-input" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        <div class="senior-box">
                          <h4>ID Numbers</h4>
                          @foreach([
                            ['ID Reference No','id_reference_no'],
                            ['SSS No','sss_no'],
                            ['GSIS No','gsis_no'],
                            ['Pag-IBIG No','pagibig_no'],
                            ['PHN No','phn_no'],
                            ['PhilHealth No','philhealth_no'],
                            ['PWD ID No','pwd_id_no'],
                          ] as [$label,$key])
                            <div class="senior-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="senior-input" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        <div class="senior-box">
                          <h4>Income / Interview</h4>

                          <div class="senior-kv"><span>Total Family Income</span>@if($isEditing)<input class="senior-input" type="number" step="0.01" name="total_family_income" value="{{ $val($open->total_family_income) }}">@else<b>{{ is_null($open->total_family_income) ? '—' : number_format((float)$open->total_family_income, 2) }}</b>@endif</div>
                          <div class="senior-kv"><span>Interviewee Name</span>@if($isEditing)<input class="senior-input" name="interviewee_name" value="{{ $val($open->interviewee_name) }}">@else<b>{{ $open->interviewee_name ?: '—' }}</b>@endif</div>
                          <div class="senior-kv"><span>Interviewee Relationship</span>@if($isEditing)<input class="senior-input" name="interviewee_relationship" value="{{ $val($open->interviewee_relationship) }}">@else<b>{{ $open->interviewee_relationship ?: '—' }}</b>@endif</div>

                          <div class="senior-kv">
                            <span>Interviewee Signature/Thumbmark</span>
                            @if($isEditing)
                              <input class="senior-input" type="file" name="interviewee_signature_thumbmark" accept="image/*">
                            @else
                              @if($open->interviewee_signature_thumbmark)
                                <img class="sig-img" src="{{ Storage::url($open->interviewee_signature_thumbmark) }}" alt="Interviewee Signature">
                              @else
                                <b>—</b>
                              @endif
                            @endif
                          </div>
                        </div>

                        <div class="senior-box">
                          <h4>Office</h4>
                          @foreach([
                            ['Accomplished By (Name)','accomplished_by_name'],
                            ['Accomplished By (Position)','accomplished_by_position'],
                            ['Reporting Unit','reporting_unit_office_section'],
                            ['Approved By','approved_by'],
                          ] as [$label,$key])
                            <div class="senior-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="senior-input" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        <div class="senior-box full">
                          <h4>Disability Types</h4>
                          <div class="senior-tags">
                            @forelse($openTypes as $t)
                              <span class="tag">{{ $t }}</span>
                            @empty
                              <span class="senior-muted">—</span>
                            @endforelse
                          </div>
                        </div>

                        <div class="senior-box full">
                          <h4>Causes of Disability</h4>
                          @forelse($openCauses as $c)
                            <div class="senior-mini">
                              <b>{{ $c->category }}</b> • {{ $c->name }}
                              @if($c->other_specify)
                                <span class="senior-muted">({{ $c->other_specify }})</span>
                              @endif
                            </div>
                          @empty
                            <div class="senior-muted">—</div>
                          @endforelse
                        </div>

                        <div class="senior-box full">
                          <h4>Household Members</h4>
                          <div class="senior-table-wrap">
                            <table class="senior-table mini-table">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>DOB</th>
                                  <th>Civil Status</th>
                                  <th>Education</th>
                                  <th>Relationship</th>
                                  <th>Occupation</th>
                                  <th>Pension</th>
                                  <th>Income</th>
                                </tr>
                              </thead>
                              <tbody>
                                @forelse($openMembers as $m)
                                  <tr>
                                    <td>{{ $m->name ?: '—' }}</td>
                                    <td>{{ $m->date_of_birth ?: '—' }}</td>
                                    <td>{{ $m->civil_status ?: '—' }}</td>
                                    <td>{{ $m->educational_attainment ?: '—' }}</td>
                                    <td>{{ $m->relationship_to_pwd ?: '—' }}</td>
                                    <td>{{ $m->occupation ?: '—' }}</td>
                                    <td>{{ $m->social_pension_affiliation ?: '—' }}</td>
                                    <td>{{ is_null($m->monthly_income) ? '—' : number_format((float)$m->monthly_income,2) }}</td>
                                  </tr>
                                @empty
                                  <tr>
                                    <td colspan="8" class="senior-empty">No household members.</td>
                                  </tr>
                                @endforelse
                              </tbody>
                            </table>
                          </div>
                        </div>

                      </div>

                      @if($isEditing)
                        <div class="senior-savebar">
                          <button class="senior-btn" type="submit">Save Changes</button>
                          <a class="senior-btn ghost" href="{{ $editOffUrl }}">Cancel</a>
                        </div>
                      @endif
                    </form>

                  </div>
                </td>
              </tr>
            @endif
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

<script>
function previewPhoto(e){
  const file = e.target.files && e.target.files[0];
  if(!file) return;
  const img = document.getElementById('photoPreview');
  if(!img) return;
  img.style.display = 'block';
  img.src = URL.createObjectURL(file);
}

function previewSignature(e){
  const file = e.target.files && e.target.files[0];
  if(!file) return;

  let img = document.getElementById('signaturePreview');

  if(!img){
    img = document.createElement('img');
    img.id = 'signaturePreview';
    img.className = 'sig-img';
    img.alt = 'Signature/Thumbmark Preview';

    const box = e.target.closest('.senior-kv');
    if(box){
      box.appendChild(img);
    }
  }

  img.style.display = 'block';
  img.src = URL.createObjectURL(file);
}
</script>
@endsection