@php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

$q = trim((string) request('q', ''));
$barangay = trim((string) request('barangay', ''));

// view open
$openId = (int) request('open', 0);

// edit mode inside view
$editOpenId = (int) request('edit_open', 0);

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
$openTypes = [];
$openCauses = collect();
$openMembers = collect();

if ($openId > 0) {
  $open = DB::table('local_profiles')->where('id', $openId)->first();

  if ($open) {
    $openTypes = DB::table('local_profile_disability_types as lpdt')
      ->join('disability_types as dt', 'dt.id', '=', 'lpdt.disability_type_id')
      ->where('lpdt.local_profile_id', $openId)
      ->orderBy('dt.name')
      ->pluck('dt.name')
      ->toArray();

    $openCauses = DB::table('local_profile_disability_causes as lpdc')
      ->join('disability_causes as dc', 'dc.id', '=', 'lpdc.disability_cause_id')
      ->where('lpdc.local_profile_id', $openId)
      ->select('dc.category', 'dc.name', 'lpdc.other_specify')
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

$closeViewUrl = $withQuery([], ['open','edit_open']);
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
              $isViewOpen = ($openId === (int)$r->id);

              $viewUrl = $withQuery(['open' => $r->id], ['edit_open']); // open view, remove edit_open
            @endphp

            <tr class="{{ $isViewOpen ? 'is-open' : '' }}">
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
                @if($isViewOpen)
                  <a class="reg-btn mini ghost" href="{{ $closeViewUrl }}">Close</a>
                @else
                  <a class="reg-btn mini" href="{{ $viewUrl }}">View more info</a>
                @endif
              </td>
            </tr>

            {{-- ✅ DETAILS ROW --}}
            @if($isViewOpen && $open)
              @php
                $isEditMode = ($editOpenId === (int)$openId);

                $openAge = $open->date_of_birth ? Carbon::parse($open->date_of_birth)->age : null;

                // edit url (inside view)
                $startEditUrl = $withQuery(['edit_open' => $openId], []);
                $cancelEditUrl = $withQuery([], ['edit_open']);
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
                      </div>

                      <div class="reg-details-actions">
                        @if(!$isEditMode)
                          <a class="reg-btn mini edit" href="{{ $startEditUrl }}">Edit</a>
                        @else
                          <a class="reg-btn mini ghost" href="{{ $cancelEditUrl }}">Cancel</a>
                        @endif
                      </div>
                    </div>

                    @if($open->photo_1x1)
                      <div class="reg-details-photo">
                        <img class="reg-photo big" src="{{ Storage::url($open->photo_1x1) }}" alt="Photo">
                      </div>
                    @endif

                    {{-- ✅ FORM ONLY WHEN EDIT MODE --}}
                    @if($isEditMode)
                      <form method="POST" action="{{ route('staff.registered.update', $open->id) }}" class="reg-form">
                        @csrf
                        @method('PUT')
                    @endif

                    <div class="reg-grid">

                      {{-- PERSONAL --}}
                      <div class="reg-box">
                        <h4>Personal</h4>

                        <div class="reg-kv">
                          <span>LDR Number</span>
                          @if($isEditMode)
                            <input class="reg-input" name="ldr_number" value="{{ old('ldr_number', $open->ldr_number) }}">
                          @else
                            <b>{{ $open->ldr_number ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Profiling Date</span>
                          @if($isEditMode)
                            <input class="reg-input" type="date" name="profiling_date" value="{{ old('profiling_date', $open->profiling_date) }}">
                          @else
                            <b>{{ $open->profiling_date ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Last Name</span>
                          @if($isEditMode)
                            <input class="reg-input" name="last_name" value="{{ old('last_name', $open->last_name) }}">
                          @else
                            <b>{{ $open->last_name ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>First Name</span>
                          @if($isEditMode)
                            <input class="reg-input" name="first_name" value="{{ old('first_name', $open->first_name) }}">
                          @else
                            <b>{{ $open->first_name ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Middle Name</span>
                          @if($isEditMode)
                            <input class="reg-input" name="middle_name" value="{{ old('middle_name', $open->middle_name) }}">
                          @else
                            <b>{{ $open->middle_name ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Suffix</span>
                          @if($isEditMode)
                            <input class="reg-input" name="suffix" value="{{ old('suffix', $open->suffix) }}">
                          @else
                            <b>{{ $open->suffix ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Date of Birth</span>
                          @if($isEditMode)
                            <input class="reg-input" type="date" name="date_of_birth" value="{{ old('date_of_birth', $open->date_of_birth) }}">
                          @else
                            <b>{{ $open->date_of_birth ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Sex</span>
                          @if($isEditMode)
                            <select class="reg-input" name="sex">
                              @php $sexVal = old('sex', $open->sex); @endphp
                              <option value="">—</option>
                              <option value="MALE" {{ $sexVal === 'MALE' ? 'selected' : '' }}>MALE</option>
                              <option value="FEMALE" {{ $sexVal === 'FEMALE' ? 'selected' : '' }}>FEMALE</option>
                            </select>
                          @else
                            <b>{{ $open->sex ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Blood Type</span>
                          @if($isEditMode)
                            @php $bt = old('blood_type', $open->blood_type); @endphp
                            <select class="reg-input" name="blood_type">
                              <option value="">—</option>
                              @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $x)
                                <option value="{{ $x }}" {{ $bt === $x ? 'selected' : '' }}>{{ $x }}</option>
                              @endforeach
                            </select>
                          @else
                            <b>{{ $open->blood_type ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Religion</span>
                          @if($isEditMode)
                            <input class="reg-input" name="religion" value="{{ old('religion', $open->religion) }}">
                          @else
                            <b>{{ $open->religion ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Ethnic Group</span>
                          @if($isEditMode)
                            <input class="reg-input" name="ethnic_group" value="{{ old('ethnic_group', $open->ethnic_group) }}">
                          @else
                            <b>{{ $open->ethnic_group ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Civil Status</span>
                          @if($isEditMode)
                            @php $cs = old('civil_status', $open->civil_status); @endphp
                            <select class="reg-input" name="civil_status">
                              <option value="">—</option>
                              @foreach(['Single','Separated','Cohabitation (Live-in)','Married','Widow','Widower'] as $x)
                                <option value="{{ $x }}" {{ $cs === $x ? 'selected' : '' }}>{{ $x }}</option>
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
                        ] as $f)
                          <div class="reg-kv">
                            <span>{{ $f[0] }}</span>
                            @if($isEditMode)
                              <input class="reg-input" name="{{ $f[1] }}" value="{{ old($f[1], $open->{$f[1]}) }}">
                            @else
                              <b>{{ $open->{$f[1]} ?: '—' }}</b>
                            @endif
                          </div>
                        @endforeach
                      </div>

                      {{-- CONTACT --}}
                      <div class="reg-box">
                        <h4>Contact</h4>

                        @foreach([
                          ['Landline','landline'],
                          ['Mobile','mobile'],
                          ['Email','email'],
                        ] as $f)
                          <div class="reg-kv">
                            <span>{{ $f[0] }}</span>
                            @if($isEditMode)
                              <input class="reg-input" name="{{ $f[1] }}" value="{{ old($f[1], $open->{$f[1]}) }}">
                            @else
                              <b>{{ $open->{$f[1]} ?: '—' }}</b>
                            @endif
                          </div>
                        @endforeach
                      </div>

                      {{-- Education / Employment --}}
                      <div class="reg-box">
                        <h4>Education / Employment</h4>

                        <div class="reg-kv">
                          <span>Education Level</span>
                          @if($isEditMode)
                            @php $ed = old('education_level', $open->education_level); @endphp
                            <select class="reg-input" name="education_level">
                              <option value="">—</option>
                              @foreach(['None','Kindergarten','Elementary','Junior High School','Senior High','College','Vocational','Post Graduate'] as $x)
                                <option value="{{ $x }}" {{ $ed === $x ? 'selected' : '' }}>{{ $x }}</option>
                              @endforeach
                            </select>
                          @else
                            <b>{{ $open->education_level ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Employment Status</span>
                          @if($isEditMode)
                            @php $es = old('employment_status', $open->employment_status); @endphp
                            <select class="reg-input" name="employment_status">
                              <option value="">—</option>
                              @foreach(['Employed','Unemployed','Self-employed'] as $x)
                                <option value="{{ $x }}" {{ $es === $x ? 'selected' : '' }}>{{ $x }}</option>
                              @endforeach
                            </select>
                          @else
                            <b>{{ $open->employment_status ?: '—' }}</b>
                          @endif
                        </div>

                        <div class="reg-kv">
                          <span>Employment Category</span>
                          @if($isEditMode)
                            @php $ec = old('employment_category', $open->employment_category); @endphp
                            <select class="reg-input" name="employment_category">
                              <option value="">—</option>
                              @foreach(['Government','Private'] as $x)
                                <option value="{{ $x }}" {{ $ec === $x ? 'selected' : '' }}>{{ $x }}</option>
                              @endforeach
                            </select>
                          @else
                            <b>{{ $open->employment_category ?: '—' }}</b>
                          @endif
                        </div>

                        @foreach([
                          ['Specific Occupation','specific_occupation'],
                          ['Employment Type','employment_type'],
                          ['Special Skills','special_skills','textarea'],
                          ['Sporting Talent','sporting_talent','textarea'],
                        ] as $f)
                          <div class="reg-kv">
                            <span>{{ $f[0] }}</span>
                            @if($isEditMode)
                              @if(($f[2] ?? '') === 'textarea')
                                <textarea class="reg-input" name="{{ $f[1] }}" rows="3">{{ old($f[1], $open->{$f[1]}) }}</textarea>
                              @else
                                <input class="reg-input" name="{{ $f[1] }}" value="{{ old($f[1], $open->{$f[1]}) }}">
                              @endif
                            @else
                              <b>{{ $open->{$f[1]} ?: '—' }}</b>
                            @endif
                          </div>
                        @endforeach

                      </div>

                      {{-- NOTE: For now, hindi ko ginawang editable dito ang disability types/causes/household members
                           kasi pivot tables yan. Next step natin yan separately. --}}

                      <div class="reg-box full">
                        <h4>Disability Types</h4>
                        <div class="reg-tags">
                          @forelse($openTypes as $t)
                            <span class="tag">{{ $t }}</span>
                          @empty
                            <span class="reg-muted">—</span>
                          @endforelse
                        </div>
                      </div>

                      <div class="reg-box full">
                        <h4>Causes of Disability</h4>
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
                      </div>

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
                              </tr>
                            </thead>
                            <tbody>
                              @forelse($openMembers as $m)
                                <tr>
                                  <td>{{ $m->name }}</td>
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
                                  <td colspan="8" class="reg-empty">No household members.</td>
                                </tr>
                              @endforelse
                            </tbody>
                          </table>
                        </div>
                      </div>

                    </div>

                    {{-- ✅ SAVE BAR --}}
                    @if($isEditMode)
                      <div class="reg-savebar">
                        <button class="reg-btn" type="submit">Save Changes</button>
                        <a class="reg-btn ghost" href="{{ $cancelEditUrl }}">Cancel</a>
                      </div>
                      </form>
                    @endif

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