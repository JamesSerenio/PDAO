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

$total = (int) DB::table('local_profiles')->count();

$fullName = function($r){
  $mid = $r->middle_name ? (' ' . $r->middle_name) : '';
  $suf = $r->suffix ? (' ' . $r->suffix) : '';
  return trim($r->last_name . ', ' . $r->first_name . $mid . $suf);
};

// ===== OPEN DETAILS (full data) =====
$open = null;

$openTypes = [];          // names
$openTypeIds = [];        // ids

$openCauses = collect();  // view list
$openCauseIds = [];       // ids for checkbox selected

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
          <input name="q" value="{{ $q }}" placeholder="Name / LDR / PWD ID...">
        </div>

        <div class="reg-field">
          <label>Barangay</label>
          <select name="barangay">
            <option value="">All barangays</option>
            @foreach($barangays as $b)
              <option value="{{ $b }}" {{ $barangay === $b ? 'selected' : '' }}>{{ $b }}</option>
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
                  <img class="reg-photo" src="{{ Storage::url($r->photo_1x1) }}" alt="Photo">
                @else
                  <div class="reg-photo placeholder">No Photo</div>
                @endif
              </td>

              <td>
                <div class="reg-name">{{ $fullName($r) }}</div>
                <div class="reg-mini">ID: <b>#{{ $r->id }}</b></div>
              </td>

              <td><span class="pill">{{ $r->ldr_number ?: '—' }}</span></td>
              <td>{{ $r->sex ?: '—' }}</td>
              <td>{{ $age ? $age.' yrs' : '—' }}</td>
              <td>{{ $r->barangay ?: '—' }}</td>
              <td>{{ $r->disabilities ?: '—' }}</td>

              <td class="reg-mini">
                <div>📱 {{ $r->mobile ?: '—' }}</div>
                <div>✉️ {{ $r->email ?: '—' }}</div>
              </td>

              <td>{{ Carbon::parse($r->created_at)->format('M d, Y h:i A') }}</td>

              <td class="reg-actions-cell">
                <div style="display:flex; gap:8px; flex-wrap:wrap;">
                  @if($isOpen)
                    <a class="reg-btn mini ghost" href="{{ $closeViewUrl }}">Close</a>
                  @else
                    <a class="reg-btn mini" href="{{ $viewUrl }}">View more info</a>
                  @endif

                  <a
                    class="reg-btn mini ghost"
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

              <tr class="reg-details-row">
                <td colspan="10">
                  <div class="reg-details">

                    <div class="reg-details-top">
                      <div>
                        <h3 class="reg-h3">Full Information</h3>
                        <div class="reg-mini">
                          LDR: <b>{{ $open->ldr_number ?: '—' }}</b>
                          <span class="dot">•</span>
                          Profiled: <b>{{ $open->profiling_date ? Carbon::parse($open->profiling_date)->format('M d, Y') : '—' }}</b>
                          <span class="dot">•</span>
                          Age: <b>{{ $openAge ? $openAge.' yrs' : '—' }}</b>
                        </div>

                        <div style="margin-top:10px; display:flex; gap:8px; flex-wrap:wrap;">
                          @if($isEditing)
                            <a class="reg-btn mini ghost" href="{{ $editOffUrl }}">Cancel edit</a>
                          @else
                            <a class="reg-btn mini" href="{{ $editOnUrl }}">Edit</a>
                          @endif
                        </div>
                      </div>

                      <div class="reg-details-photo">
                        @if($open->photo_1x1)
                          <img id="photoPreview" class="reg-photo big" src="{{ Storage::url($open->photo_1x1) }}" alt="Photo">
                        @else
                          <img id="photoPreview" class="reg-photo big" src="" alt="Photo" style="display:none;">
                        @endif
                      </div>
                    </div>

                    <form
                      method="POST"
                      action="{{ route('admin.registered.update', $open->id) }}"
                      enctype="multipart/form-data"
                      class="reg-form"
                    >
                      @csrf
                      @method('PUT')

                      <input type="hidden" name="_redirect" value="{{ $withQuery(['open'=>$openId,'editMode'=>0], []) }}">

                      <div class="reg-grid">

                        {{-- PERSONAL --}}
                        <div class="reg-box">
                          <h4>Personal</h4>

                          <div class="reg-kv" style="border-bottom:none; padding-bottom:0;">
                            <span>Photo (1x1)</span>
                            @if($isEditing)
                              <div style="display:flex; flex-direction:column; gap:6px; align-items:flex-end;">
                                <input class="reg-input" type="file" name="photo_1x1" accept="image/*" onchange="previewPhoto(event)">
                                <small class="reg-muted">Choose new photo (optional)</small>
                              </div>
                            @else
                              <b>{{ $open->photo_1x1 ? 'Uploaded' : '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Signature/Thumbmark</span>
                            @if($isEditing)
                              <div style="display:flex; flex-direction:column; gap:6px; align-items:flex-end;">
                                <input class="reg-input" type="file" name="signature_thumbmark" accept="image/*" onchange="previewSignature(event)">
                                <small class="reg-muted">Choose signature/thumbmark (optional)</small>
                              </div>
                            @else
                              @if($open->signature_thumbmark)
                                <img id="signaturePreview" class="sig-img" src="{{ Storage::url($open->signature_thumbmark) }}" alt="Signature/Thumbmark">
                              @else
                                <b>—</b>
                              @endif
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>LDR Number</span>
                            @if($isEditing)
                              <input class="reg-input" name="ldr_number" value="{{ $val($open->ldr_number) }}">
                            @else
                              <b>{{ $open->ldr_number ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Profiling Date</span>
                            @if($isEditing)
                              <input class="reg-input" type="date" name="profiling_date" value="{{ $val($open->profiling_date) }}">
                            @else
                              <b>{{ $open->profiling_date ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Last Name</span>
                            @if($isEditing)
                              <input class="reg-input" name="last_name" value="{{ $val($open->last_name) }}" required>
                            @else
                              <b>{{ $open->last_name ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>First Name</span>
                            @if($isEditing)
                              <input class="reg-input" name="first_name" value="{{ $val($open->first_name) }}" required>
                            @else
                              <b>{{ $open->first_name ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Middle Name</span>
                            @if($isEditing)
                              <input class="reg-input" name="middle_name" value="{{ $val($open->middle_name) }}">
                            @else
                              <b>{{ $open->middle_name ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Suffix</span>
                            @if($isEditing)
                              <input class="reg-input" name="suffix" value="{{ $val($open->suffix) }}">
                            @else
                              <b>{{ $open->suffix ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Date of Birth</span>
                            @if($isEditing)
                              <input class="reg-input" type="date" name="date_of_birth" value="{{ $val($open->date_of_birth) }}">
                            @else
                              <b>{{ $open->date_of_birth ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Sex</span>
                            @if($isEditing)
                              <select class="reg-input" name="sex">
                                <option value="">—</option>
                                <option value="MALE"   {{ $open->sex === 'MALE' ? 'selected' : '' }}>MALE</option>
                                <option value="FEMALE" {{ $open->sex === 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                              </select>
                            @else
                              <b>{{ $open->sex ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Blood Type</span>
                            @if($isEditing)
                              <select class="reg-input" name="blood_type">
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

                          <div class="reg-kv">
                            <span>Religion</span>
                            @if($isEditing)
                              <input class="reg-input" name="religion" value="{{ $val($open->religion) }}">
                            @else
                              <b>{{ $open->religion ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Ethnic Group</span>
                            @if($isEditing)
                              <input class="reg-input" name="ethnic_group" value="{{ $val($open->ethnic_group) }}">
                            @else
                              <b>{{ $open->ethnic_group ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Civil Status</span>
                            @if($isEditing)
                              <select class="reg-input" name="civil_status">
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

                        {{-- ADDRESS --}}
                        <div class="reg-box">
                          <h4>Address</h4>

                          @foreach([
                            ['House No./Street','house_no_street'],
                            ['Sitio/Purok','sitio_purok'],
                            ['Barangay','barangay'],
                            ['Municipality','municipality'],
                            ['Province','province'],
                            ['Region','region'],
                          ] as [$label,$key])
                            <div class="reg-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="reg-input" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        {{-- CONTACT --}}
                        <div class="reg-box">
                          <h4>Contact</h4>

                          @foreach([
                            ['Landline','landline','text'],
                            ['Mobile','mobile','text'],
                            ['Email','email','email'],
                          ] as [$label,$key,$type])
                            <div class="reg-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="reg-input" type="{{ $type }}" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        {{-- EDUCATION / EMPLOYMENT --}}
                        <div class="reg-box">
                          <h4>Education / Employment</h4>

                          <div class="reg-kv">
                            <span>Education Level</span>
                            @if($isEditing)
                              <select class="reg-input" name="education_level">
                                @php $eds = ['','None','Kindergarten','Elementary','Junior High School','Senior High','College','Vocational','Post Graduate']; @endphp
                                @foreach($eds as $e)
                                  <option value="{{ $e }}" {{ $open->education_level === $e ? 'selected' : '' }}>
                                    {{ $e === '' ? '—' : $e }}
                                  </option>
                                @endforeach
                              </select>
                            @else
                              <b>{{ $open->education_level ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Employment Status</span>
                            @if($isEditing)
                              <select class="reg-input" name="employment_status">
                                @php $es = ['','Employed','Unemployed','Self-employed']; @endphp
                                @foreach($es as $e)
                                  <option value="{{ $e }}" {{ $open->employment_status === $e ? 'selected' : '' }}>
                                    {{ $e === '' ? '—' : $e }}
                                  </option>
                                @endforeach
                              </select>
                            @else
                              <b>{{ $open->employment_status ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Employment Category</span>
                            @if($isEditing)
                              <select class="reg-input" name="employment_category">
                                @php $ec = ['','Government','Private']; @endphp
                                @foreach($ec as $e)
                                  <option value="{{ $e }}" {{ $open->employment_category === $e ? 'selected' : '' }}>
                                    {{ $e === '' ? '—' : $e }}
                                  </option>
                                @endforeach
                              </select>
                            @else
                              <b>{{ $open->employment_category ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Specific Occupation</span>
                            @if($isEditing)
                              <input class="reg-input" name="specific_occupation" value="{{ $val($open->specific_occupation) }}">
                            @else
                              <b>{{ $open->specific_occupation ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Employment Type</span>
                            @if($isEditing)
                              <select class="reg-input" name="employment_type">
                                @php $et = ['','Permanent','Seasonal','Contractual','Job Order','On Call']; @endphp
                                @foreach($et as $e)
                                  <option value="{{ $e }}" {{ $open->employment_type === $e ? 'selected' : '' }}>
                                    {{ $e === '' ? '—' : $e }}
                                  </option>
                                @endforeach
                              </select>
                            @else
                              <b>{{ $open->employment_type ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Registered Voter</span>
                            @if($isEditing)
                              <select class="reg-input" name="registered_voter">
                                <option value="">—</option>
                                <option value="1" {{ (string)$open->registered_voter === '1' ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ (string)$open->registered_voter === '0' ? 'selected' : '' }}>No</option>
                              </select>
                            @else
                              <b>
                                @if(is_null($open->registered_voter)) —
                                @else {{ $open->registered_voter ? 'Yes' : 'No' }}
                                @endif
                              </b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Special Skills</span>
                            @if($isEditing)
                              <textarea class="reg-input" name="special_skills" rows="3">{{ $val($open->special_skills) }}</textarea>
                            @else
                              <b>{{ $open->special_skills ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Sporting Talent</span>
                            @if($isEditing)
                              <textarea class="reg-input" name="sporting_talent" rows="3">{{ $val($open->sporting_talent) }}</textarea>
                            @else
                              <b>{{ $open->sporting_talent ?: '—' }}</b>
                            @endif
                          </div>
                        </div>

                        {{-- ORGANIZATION --}}
                        <div class="reg-box">
                          <h4>Organization</h4>

                          <div class="reg-kv">
                            <span>PWD Organization / Group Name</span>
                            @if($isEditing)
                              <input class="reg-input"
                                     name="pwd_org_affiliated"
                                     value="{{ $val($open->pwd_org_affiliated) }}"
                                     placeholder="e.g. PWD Association Tankulan">
                            @else
                              <b>{{ $open->pwd_org_affiliated ?: '—' }}</b>
                            @endif
                          </div>

                          @foreach([
                            ['Org Contact Person','org_contact_person'],
                            ['Org Office Address','org_office_address'],
                            ['Org Tel/Mobile','org_tel_mobile'],
                          ] as [$label,$key])
                            <div class="reg-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="reg-input" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        {{-- ID NUMBERS --}}
                        <div class="reg-box">
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
                            <div class="reg-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="reg-input" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach
                        </div>

                        {{-- INCOME / INTERVIEW --}}
                        <div class="reg-box">
                          <h4>Income / Interview</h4>

                          <div class="reg-kv">
                            <span>Total Family Income</span>
                            @if($isEditing)
                              <input class="reg-input" type="number" step="0.01" name="total_family_income" value="{{ $val($open->total_family_income) }}">
                            @else
                              <b>{{ is_null($open->total_family_income) ? '—' : number_format((float)$open->total_family_income, 2) }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Interviewee Name</span>
                            @if($isEditing)
                              <input class="reg-input" name="interviewee_name" value="{{ $val($open->interviewee_name) }}">
                            @else
                              <b>{{ $open->interviewee_name ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Interviewee Relationship</span>
                            @if($isEditing)
                              <input class="reg-input" name="interviewee_relationship" value="{{ $val($open->interviewee_relationship) }}">
                            @else
                              <b>{{ $open->interviewee_relationship ?: '—' }}</b>
                            @endif
                          </div>

                          <div class="reg-kv">
                            <span>Interviewee Signature/Thumbmark (Image)</span>
                            @if($isEditing)
                              <input class="reg-input" type="file" name="interviewee_signature_thumbmark" accept="image/*">
                              <small class="reg-muted">Upload (optional)</small>
                            @else
                              @if($open->interviewee_signature_thumbmark)
                                <img class="sig-img" src="{{ Storage::url($open->interviewee_signature_thumbmark) }}" alt="Interviewee Signature">
                              @else
                                <b>—</b>
                              @endif
                            @endif
                          </div>
                        </div>

                        {{-- OFFICE --}}
                        <div class="reg-box">
                          <h4>Office</h4>

                          @foreach([
                            ['Accomplished By (Name)','accomplished_by_name'],
                            ['Accomplished By (Position)','accomplished_by_position'],
                            ['Reporting Unit','reporting_unit_office_section'],
                            ['Approved By','approved_by'],
                          ] as [$label,$key])
                            <div class="reg-kv">
                              <span>{{ $label }}</span>
                              @if($isEditing)
                                <input class="reg-input" name="{{ $key }}" value="{{ $val($open->$key) }}">
                              @else
                                <b>{{ $open->$key ?: '—' }}</b>
                              @endif
                            </div>
                          @endforeach

                          <div class="reg-kv">
                            <span>Approved Signature (Image)</span>
                            @if($isEditing)
                              <input class="reg-input" type="file" name="approved_signature" accept="image/*">
                              <small class="reg-muted">Upload (optional)</small>
                            @else
                              @if($open->approved_signature)
                                <img class="sig-img" src="{{ Storage::url($open->approved_signature) }}" alt="Approved Signature">
                              @else
                                <b>—</b>
                              @endif
                            @endif
                          </div>
                        </div>

                        {{-- DISABILITY TYPES --}}
                        <div class="reg-box full">
                          <h4>Disability Types</h4>

                          @if($isEditing)
                            @php
                              $allTypes = DB::table('disability_types')->orderBy('name')->get();
                            @endphp

                            <div class="reg-check-grid">
                              @foreach($allTypes as $t)
                                <label class="reg-check">
                                  <input
                                    type="checkbox"
                                    name="disability_types[]"
                                    value="{{ $t->id }}"
                                    {{ in_array($t->id, $openTypeIds) ? 'checked' : '' }}
                                  >
                                  <span>{{ $t->name }}</span>
                                </label>
                              @endforeach
                            </div>
                          @else
                            <div class="reg-tags">
                              @forelse($openTypes as $t)
                                <span class="tag">{{ $t }}</span>
                              @empty
                                <span class="reg-muted">—</span>
                              @endforelse
                            </div>
                          @endif
                        </div>

                        {{-- CAUSES OF DISABILITY --}}
                        <div class="reg-box full">
                          <h4>Causes of Disability</h4>

                          @if($isEditing)
                            @php
                              $allCauses = DB::table('disability_causes')
                                ->orderBy('category')
                                ->orderBy('name')
                                ->get();
                            @endphp

                            <div class="reg-check-grid">
                              @foreach($allCauses as $c)
                                <label class="reg-check">
                                  <input
                                    type="checkbox"
                                    name="disability_causes[]"
                                    value="{{ $c->id }}"
                                    {{ in_array($c->id, $openCauseIds) ? 'checked' : '' }}
                                  >
                                  <span>{{ $c->category }} • {{ $c->name }}</span>
                                </label>

                                @if(strtolower($c->name) === 'others' && in_array($c->id, $openCauseIds))
                                  <div class="reg-other">
                                    <input class="reg-input" name="cause_other[{{ $c->id }}]" placeholder="Specify other..." value="{{ optional($openCauses->firstWhere('id',$c->id))->other_specify }}">
                                  </div>
                                @endif
                              @endforeach
                            </div>
                          @else
                            @forelse($openCauses as $c)
                              <div class="reg-mini">
                                <b>{{ $c->category }}</b> • {{ $c->name }}
                                @if($c->other_specify)
                                  <span class="reg-muted">({{ $c->other_specify }})</span>
                                @endif
                              </div>
                            @empty
                              <div class="reg-muted">—</div>
                            @endforelse
                          @endif
                        </div>

                        {{-- HOUSEHOLD MEMBERS --}}
                        <div class="reg-box full">
                          <h4>Household Members</h4>

                          <div class="reg-table-wrap">
                            <table class="reg-table mini-table">
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
                                  @if($isEditing)
                                    <th>Remove</th>
                                  @endif
                                </tr>
                              </thead>

                              <tbody id="membersBody">
                                @forelse($openMembers as $m)
                                  <tr>
                                    @if($isEditing)
                                      <td>
                                        <input type="hidden" name="member_id[]" value="{{ $m->id }}">
                                        <input class="reg-input" name="member_name[]" value="{{ $m->name }}">
                                      </td>
                                      <td><input class="reg-input" type="date" name="member_dob[]" value="{{ $m->date_of_birth }}"></td>
                                      <td><input class="reg-input" name="member_civil_status[]" value="{{ $m->civil_status }}"></td>
                                      <td><input class="reg-input" name="member_education[]" value="{{ $m->educational_attainment }}"></td>
                                      <td><input class="reg-input" name="member_relationship[]" value="{{ $m->relationship_to_pwd }}"></td>
                                      <td><input class="reg-input" name="member_occupation[]" value="{{ $m->occupation }}"></td>
                                      <td><input class="reg-input" name="member_pension[]" value="{{ $m->social_pension_affiliation }}"></td>
                                      <td><input class="reg-input" type="number" step="0.01" name="member_income[]" value="{{ $m->monthly_income }}"></td>
                                      <td>
                                        <button type="button" class="reg-btn mini ghost" onclick="removeRow(this)">X</button>
                                        <input type="hidden" name="member_delete[]" value="0">
                                      </td>
                                    @else
                                      <td>{{ $m->name }}</td>
                                      <td>{{ $m->date_of_birth ?: '—' }}</td>
                                      <td>{{ $m->civil_status ?: '—' }}</td>
                                      <td>{{ $m->educational_attainment ?: '—' }}</td>
                                      <td>{{ $m->relationship_to_pwd ?: '—' }}</td>
                                      <td>{{ $m->occupation ?: '—' }}</td>
                                      <td>{{ $m->social_pension_affiliation ?: '—' }}</td>
                                      <td>{{ is_null($m->monthly_income) ? '—' : number_format((float)$m->monthly_income,2) }}</td>
                                    @endif
                                  </tr>
                                @empty
                                  <tr>
                                    <td colspan="{{ $isEditing ? 9 : 8 }}" class="reg-empty">No household members.</td>
                                  </tr>
                                @endforelse
                              </tbody>
                            </table>
                          </div>

                          @if($isEditing)
                            <div style="margin-top:10px;">
                              <button type="button" class="reg-btn mini" onclick="addMemberRow()">+ Add Member</button>
                              <div class="reg-mini reg-muted" style="margin-top:6px;">
                                (Add member then save to store.)
                              </div>
                            </div>
                          @endif
                        </div>

                      </div>

                      @if($isEditing)
                        <div class="reg-savebar">
                          <button class="reg-btn" type="submit">Save Changes</button>
                          <a class="reg-btn ghost" href="{{ $editOffUrl }}">Cancel</a>
                        </div>
                      @endif
                    </form>

                  </div>
                </td>
              </tr>
            @endif
          @empty
            <tr>
              <td colspan="10" class="reg-empty">No records found.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="reg-foot">
      <div class="reg-pagination">{{ $rows->links() }}</div>
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

    const box = e.target.closest('.reg-kv');
    if(box){
      box.appendChild(img);
    }
  }

  img.style.display = 'block';
  img.src = URL.createObjectURL(file);
}

function addMemberRow(){
  const tbody = document.getElementById('membersBody');
  if(!tbody) return;

  const tr = document.createElement('tr');

  tr.innerHTML = `
    <td>
      <input type="hidden" name="member_id[]" value="">
      <input class="reg-input" name="member_name[]" value="">
    </td>
    <td><input class="reg-input" type="date" name="member_dob[]" value=""></td>
    <td><input class="reg-input" name="member_civil_status[]" value=""></td>
    <td><input class="reg-input" name="member_education[]" value=""></td>
    <td><input class="reg-input" name="member_relationship[]" value=""></td>
    <td><input class="reg-input" name="member_occupation[]" value=""></td>
    <td><input class="reg-input" name="member_pension[]" value=""></td>
    <td><input class="reg-input" type="number" step="0.01" name="member_income[]" value=""></td>
    <td>
      <button type="button" class="reg-btn mini ghost" onclick="removeRow(this)">X</button>
      <input type="hidden" name="member_delete[]" value="0">
    </td>
  `;

  tbody.appendChild(tr);
}

function removeRow(btn){
  const tr = btn.closest('tr');
  if(!tr) return;

  const del = tr.querySelector('input[name="member_delete[]"]');
  if(del) del.value = "1";

  tr.style.display = 'none';
}
</script>