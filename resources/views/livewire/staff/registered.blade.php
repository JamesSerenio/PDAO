@php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

$q = trim((string) request('q', ''));
$barangay = trim((string) request('barangay', ''));
$openId = (int) request('open', 0);
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

$kv = function($label, $value){
  $v = (string) ($value ?? '');
  if (trim($v) === '') $v = '—';
  return '<div class="reg-kv"><span>'.e($label).'</span><b>'.e($v).'</b></div>';
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
            <th>Open</th>
          </tr>
        </thead>

        <tbody>
          @forelse($rows as $r)
            @php
              $age = $r->date_of_birth ? Carbon::parse($r->date_of_birth)->age : null;

              // keep query params on open link
              $qs = request()->query();
              $qs['open'] = $r->id;
              $openUrl = url()->current() . '?' . http_build_query($qs);

              $isOpen = ($openId === (int)$r->id);
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

              <td>
                <a class="reg-btn mini {{ $isOpen ? 'ghost' : '' }}" href="{{ $openUrl }}">
                  {{ $isOpen ? 'Opened' : 'View' }}
                </a>
              </td>
            </tr>

            {{-- ✅ DETAILS ROW (only for selected) --}}
            @if($isOpen && $open)
              @php
                $openAge = $open->date_of_birth ? Carbon::parse($open->date_of_birth)->age : null;
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

                      <div class="reg-details-photo">
                        @if($open->photo_1x1)
                          <img class="reg-photo big" src="{{ Storage::url($open->photo_1x1) }}" alt="Photo">
                        @endif
                      </div>
                    </div>

                    <div class="reg-grid">

                      <div class="reg-box">
                        <h4>Personal</h4>
                        {!! $kv('Last Name', $open->last_name) !!}
                        {!! $kv('First Name', $open->first_name) !!}
                        {!! $kv('Middle Name', $open->middle_name) !!}
                        {!! $kv('Suffix', $open->suffix) !!}
                        {!! $kv('Date of Birth', $open->date_of_birth) !!}
                        {!! $kv('Sex', $open->sex) !!}
                        {!! $kv('Blood Type', $open->blood_type) !!}
                        {!! $kv('Religion', $open->religion) !!}
                        {!! $kv('Ethnic Group', $open->ethnic_group) !!}
                        {!! $kv('Civil Status', $open->civil_status) !!}
                        {!! $kv('Signature/Thumbmark', $open->signature_thumbmark) !!}
                      </div>

                      <div class="reg-box">
                        <h4>Address</h4>
                        {!! $kv('House No./Street', $open->house_no_street) !!}
                        {!! $kv('Sitio/Purok', $open->sitio_purok) !!}
                        {!! $kv('Barangay', $open->barangay) !!}
                        {!! $kv('Municipality', $open->municipality) !!}
                        {!! $kv('Province', $open->province) !!}
                        {!! $kv('Region', $open->region) !!}
                      </div>

                      <div class="reg-box">
                        <h4>Contact</h4>
                        {!! $kv('Landline', $open->landline) !!}
                        {!! $kv('Mobile', $open->mobile) !!}
                        {!! $kv('Email', $open->email) !!}
                      </div>

                      <div class="reg-box">
                        <h4>Education / Employment</h4>
                        {!! $kv('Education Level', $open->education_level) !!}
                        {!! $kv('Employment Status', $open->employment_status) !!}
                        {!! $kv('Employment Category', $open->employment_category) !!}
                        {!! $kv('Specific Occupation', $open->specific_occupation) !!}
                        {!! $kv('Employment Type', $open->employment_type) !!}
                        {!! $kv('Registered Voter', is_null($open->registered_voter) ? null : ($open->registered_voter ? 'Yes' : 'No')) !!}
                        {!! $kv('Special Skills', $open->special_skills) !!}
                        {!! $kv('Sporting Talent', $open->sporting_talent) !!}
                      </div>

                      <div class="reg-box">
                        <h4>Organization</h4>
                        {!! $kv('PWD Org Affiliated', is_null($open->pwd_org_affiliated) ? null : ($open->pwd_org_affiliated ? 'Yes' : 'No')) !!}
                        {!! $kv('Org Contact Person', $open->org_contact_person) !!}
                        {!! $kv('Org Office Address', $open->org_office_address) !!}
                        {!! $kv('Org Tel/Mobile', $open->org_tel_mobile) !!}
                      </div>

                      <div class="reg-box">
                        <h4>ID Numbers</h4>
                        {!! $kv('ID Reference No', $open->id_reference_no) !!}
                        {!! $kv('SSS No', $open->sss_no) !!}
                        {!! $kv('GSIS No', $open->gsis_no) !!}
                        {!! $kv('Pag-IBIG No', $open->pagibig_no) !!}
                        {!! $kv('PHN No', $open->phn_no) !!}
                        {!! $kv('PhilHealth No', $open->philhealth_no) !!}
                        {!! $kv('PWD ID No', $open->pwd_id_no) !!}
                      </div>

                      <div class="reg-box">
                        <h4>Income / Interview</h4>
                        {!! $kv('Total Family Income', is_null($open->total_family_income) ? null : number_format((float)$open->total_family_income, 2)) !!}
                        {!! $kv('Interviewee Name', $open->interviewee_name) !!}
                        {!! $kv('Interviewee Relationship', $open->interviewee_relationship) !!}
                        {!! $kv('Interviewee Signature', $open->interviewee_signature_thumbmark) !!}
                      </div>

                      <div class="reg-box">
                        <h4>Office</h4>
                        {!! $kv('Accomplished By (Name)', $open->accomplished_by_name) !!}
                        {!! $kv('Accomplished By (Position)', $open->accomplished_by_position) !!}
                        {!! $kv('Reporting Unit', $open->reporting_unit_office_section) !!}
                        {!! $kv('Approved By', $open->approved_by) !!}
                        {!! $kv('Approved Signature', $open->approved_signature) !!}
                      </div>

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

                    </div>{{-- grid --}}
                  </div>{{-- details --}}
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