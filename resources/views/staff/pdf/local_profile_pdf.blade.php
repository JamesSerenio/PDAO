<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Local Profile Form PDF</title>
<style>
  @page {
    size: A4 portrait;
    margin: 6px;
  }

  body {
    font-family: DejaVu Sans, sans-serif;
    font-size: 7px;
    color: #111;
    margin: 0;
    padding: 0;
    line-height: 1.15;
  }

  * {
    box-sizing: border-box;
  }

  .page {
    width: 100%;
  }

  .header-wrap {
    position: relative;
    width: 100%;
    height: 58px;
    margin-bottom: 2px;
  }

  .logo-left,
  .logo-right {
    position: absolute;
    top: 0;
    width: 52px;
    height: 52px;
  }

  .logo-left {
    left: 200px;
  }

  .logo-right {
    right: 200px;
  }

  .logo-left img,
  .logo-right img {
    width: 52px;
    height: 52px;
    display: block;
    object-fit: contain;
  }

  .header-title {
    text-align: center;
    padding-top: 1px;
  }

  .small {
    font-size: 8px;
    line-height: 1.05;
  }

  .title-main {
    font-size: 14px;
    font-weight: bold;
    margin-top: 2px;
    letter-spacing: .3px;
  }

  .instruction {
    font-size: 7.5px;
    font-weight: bold;
    border-top: 1px solid #222;
    border-bottom: 1px solid #222;
    padding: 2px 4px;
    margin: 2px 0 4px;
  }

  table.form {
    width: 100%;
    border-collapse: collapse;
    table-layout: fixed;
  }

  table.form td,
  table.form th {
    border: 1px solid #222;
    padding: 2px 3px;
    vertical-align: top;
    word-wrap: break-word;
    overflow-wrap: break-word;
  }

  .label {
    font-size: 7px;
    font-weight: bold;
    text-transform: uppercase;
    line-height: 1.1;
  }

  .value {
    min-height: 9px;
    margin-top: 1px;
    font-size: 7.5px;
    line-height: 1.15;
  }

  .center {
    text-align: center;
  }

  .muted {
    color: #444;
    font-size: 6.6px;
    line-height: 1.1;
  }

  .photo-box {
    width: 100%;
    height: 62px;
    border: 1px solid #222;
    text-align: center;
    overflow: hidden;
    margin-top: 2px;
  }

  .photo-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .sig-box {
    width: 100%;
    height: 28px;
    border: 1px solid #222;
    text-align: center;
    overflow: hidden;
    margin-top: 2px;
  }

  .sig-box img {
    width: 100%;
    height: 100%;
    object-fit: contain;
  }

  .checkbox-line {
    line-height: 1.18;
    font-size: 7px;
  }

  .checkbox-line div {
    margin: 0 0 1px 0;
  }

  .checkbox-line span {
    display: inline-block;
    margin-right: 6px;
    white-space: nowrap;
  }

  .section-title {
    font-weight: bold;
    font-size: 7px;
    margin-bottom: 1px;
    text-transform: uppercase;
    line-height: 1.1;
  }

  .members td,
  .members th {
    font-size: 6.6px;
    padding: 2px;
    line-height: 1.1;
  }

  .nowrap {
    white-space: nowrap;
  }

  .tight {
    line-height: 1.05;
  }

  .h18 { height: 18px; }
  .h22 { height: 22px; }
  .h26 { height: 26px; }
  .h30 { height: 30px; }
  .h36 { height: 36px; }
  .h42 { height: 42px; }
  .h48 { height: 48px; }
  .h56 { height: 56px; }
</style>
</head>
<body>
@php
  use Carbon\Carbon;

  $check = fn($condition) => $condition ? '☑' : '☐';

  $imgToBase64 = function ($path) {
      if (!$path || !file_exists($path)) return null;

      $type = strtolower(pathinfo($path, PATHINFO_EXTENSION));
      $mime = match ($type) {
          'jpg', 'jpeg' => 'image/jpeg',
          'png' => 'image/png',
          'gif' => 'image/gif',
          'webp' => 'image/webp',
          default => 'image/png',
      };

      $data = file_get_contents($path);
      return 'data:' . $mime . ';base64,' . base64_encode($data);
  };

  $storageToBase64 = function ($storagePath) use ($imgToBase64) {
      if (!$storagePath) return null;

      $cleanPath = ltrim(str_replace('public/', '', $storagePath), '/');
      $fullPath = storage_path('app/public/' . $cleanPath);

      if (!file_exists($fullPath)) return null;

      return $imgToBase64($fullPath);
  };

  $logo1 = $imgToBase64(public_path('img/logopdf1.png'));
  $logo2 = $imgToBase64(public_path('img/logopdf2.png'));

  $photo1x1 = $storageToBase64($open->photo_1x1 ?? null);
  $signatureThumb = $storageToBase64($open->signature_thumbmark ?? null);
  $intervieweeSignature = $storageToBase64($open->interviewee_signature_thumbmark ?? null);
  $approvedSignature = $storageToBase64($open->approved_signature ?? null);

  $typeChecked = function($typeName) use ($openTypes) {
      return in_array($typeName, $openTypes);
  };

  $causeChecked = function($category, $name) use ($openCauses) {
      return $openCauses->contains(function($item) use ($category, $name) {
          return strtolower(trim($item->category)) === strtolower(trim($category))
              && strtolower(trim($item->name)) === strtolower(trim($name));
      });
  };

  $causeOtherText = function($category) use ($openCauses) {
      $row = $openCauses->first(function($item) use ($category) {
          return strtolower(trim($item->category)) === strtolower(trim($category))
              && strtolower(trim($item->name)) === 'others';
      });

      return $row?->other_specify ?? '';
  };

  $memberCount = max(count($openMembers), 4);
@endphp

<div class="page">

  <div class="header-wrap">
    <div class="logo-left">
      @if($logo2)
        <img src="{{ $logo2 }}" alt="Logo Left">
      @endif
    </div>

    <div class="logo-right">
      @if($logo1)
        <img src="{{ $logo1 }}" alt="Logo Right">
      @endif
    </div>

    <div class="header-title">
      <div class="small">Republic of the Philippines</div>
      <div class="small"><b>PROVINCE OF BUKIDNON</b></div>
      <div class="small">Provincial Capitol</div>
      <div class="title-main">LOCAL PROFILE FORM</div>
    </div>
  </div>

  <div class="instruction">
    WRITE N/A IF NOT APPLICABLE. WRITE IN CAPITAL LETTERS. USE BLACK BALLPEN. NO ERASURES, KEEP IT NEAT AND CLEAN.
  </div>

  <table class="form">
    <colgroup>
      <col style="width:11%;">
      <col style="width:11%;">
      <col style="width:11%;">
      <col style="width:11%;">
      <col style="width:8%;">
      <col style="width:8%;">
      <col style="width:8%;">
      <col style="width:16%;">
      <col style="width:16%;">
    </colgroup>

    <tr>
      <td colspan="4">
        <div class="label">1. Local Disability Registry Number:</div>
        <div class="value">{{ $open->ldr_number ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">2. Profiling Date:</div>
        <div class="value">{{ $open->profiling_date ?? '' }}</div>
      </td>
      <td rowspan="3" colspan="2">
        <div class="label center">3. Place 1" x 1"<br>6 months - present<br>Photo Here</div>
        <div class="photo-box">
          @if($photo1x1)
            <img src="{{ $photo1x1 }}" alt="1x1 Photo">
          @endif
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <div class="label">4. Last Name:</div>
        <div class="value">{{ $open->last_name ?? '' }}</div>
      </td>
      <td colspan="2">
        <div class="label">5. First Name:</div>
        <div class="value">{{ $open->first_name ?? '' }}</div>
      </td>
      <td colspan="2">
        <div class="label">6. Middle Name:</div>
        <div class="value">{{ $open->middle_name ?? '' }}</div>
      </td>
      <td>
        <div class="label">7. Suffix:</div>
        <div class="value">{{ $open->suffix ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="2" class="h22">
        <div class="label">8. Date of Birth:</div>
        <div class="value">{{ $open->date_of_birth ?? '' }}</div>
      </td>
      <td colspan="2">
        <div class="label">9. Blood Type:</div>
        <div class="value">{{ $open->blood_type ?? '' }}</div>
      </td>
      <td>
        <div class="label">10. Religion:</div>
        <div class="value">{{ $open->religion ?? '' }}</div>
      </td>
      <td>
        <div class="label">11. Ethnic Group:</div>
        <div class="value">{{ $open->ethnic_group ?? '' }}</div>
      </td>
      <td>
        <div class="label">12. Sex:</div>
        <div class="value tight">
          {{ $check(($open->sex ?? '') === 'MALE') }} Male<br>
          {{ $check(($open->sex ?? '') === 'FEMALE') }} Female
        </div>
      </td>
      <td>
        <div class="label">13. Signature / Thumbmark</div>
        <div class="sig-box">
          @if($signatureThumb)
            <img src="{{ $signatureThumb }}" alt="Signature">
          @endif
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="9">
        <div class="label">14. Civil Status:</div>
        <div class="checkbox-line">
          <span>{{ $check(($open->civil_status ?? '') === 'Single') }} Single</span>
          <span>{{ $check(($open->civil_status ?? '') === 'Separated') }} Separated</span>
          <span>{{ $check(($open->civil_status ?? '') === 'Cohabitation (Live-in)') }} Cohabitation (Live-in)</span>
          <span>{{ $check(($open->civil_status ?? '') === 'Married') }} Married</span>
          <span>{{ $check(($open->civil_status ?? '') === 'Widow') }} Widow</span>
          <span>{{ $check(($open->civil_status ?? '') === 'Widower') }} Widower</span>
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="4" class="h56">
        <div class="section-title">15. Types of Disability:</div>
        <div class="checkbox-line">
          <div>{{ $check($typeChecked('Deaf or Hard of Hearing')) }} DEAF OR HARD OF HEARING</div>
          <div>{{ $check($typeChecked('Intellectual Disability')) }} INTELLECTUAL DISABILITY</div>
          <div>{{ $check($typeChecked('Learning Disability')) }} LEARNING DISABILITY</div>
          <div>{{ $check($typeChecked('Mental Disability')) }} MENTAL DISABILITY</div>
          <div>{{ $check($typeChecked('Physical Disability')) }} PHYSICAL DISABILITY</div>
          <div>{{ $check($typeChecked('Multiple Disability')) }} MULTIPLE DISABILITY</div>
          <div>{{ $check($typeChecked('Psychosocial Disability')) }} PSYCHOSOCIAL DISABILITY</div>
          <div>{{ $check($typeChecked('Speech & Language Impairment')) }} SPEECH &amp; LANGUAGE IMPAIRMENT</div>
          <div>{{ $check($typeChecked('Visual Disability')) }} VISUAL DISABILITY</div>
          <div>{{ $check($typeChecked('Cancer (RA 11215)')) }} CANCER (RA 11215)</div>
          <div>{{ $check($typeChecked('Rare Disease (RA 10747)')) }} RARE DISEASE (RA 10747)</div>
        </div>
      </td>

      <td colspan="5" class="h56">
        <div class="section-title">16. Causes of Disability:</div>
        <div class="checkbox-line">
          <b>CONGENITAL / INBORN</b><br>
          {{ $check($causeChecked('Congenital/Inborn', 'Autism')) }} AUTISM<br>
          {{ $check($causeChecked('Congenital/Inborn', 'ADHD')) }} ADHD<br>
          {{ $check($causeChecked('Congenital/Inborn', 'Cerebral Palsy')) }} CEREBRAL PALSY<br>
          {{ $check($causeChecked('Congenital/Inborn', 'Down Syndrome')) }} DOWN SYNDROME<br>
          {{ $check($causeChecked('Congenital/Inborn', 'Others')) }} OTHERS: {{ $causeOtherText('Congenital/Inborn') }}<br><br>

          <b>ACQUIRED</b><br>
          {{ $check($causeChecked('Acquired', 'Chronic Illness')) }} CHRONIC ILLNESS<br>
          {{ $check($causeChecked('Acquired', 'Cerebral Palsy')) }} CEREBRAL PALSY<br>
          {{ $check($causeChecked('Acquired', 'Injury')) }} INJURY<br>
          {{ $check($causeChecked('Acquired', 'Others')) }} OTHERS: {{ $causeOtherText('Acquired') }}
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <div class="label">17. Complete Address:</div>
        <div class="muted">House No. and Street</div>
        <div class="value">{{ $open->house_no_street ?? '' }}</div>
      </td>
      <td>
        <div class="label">&nbsp;</div>
        <div class="muted">Sitio/Purok</div>
        <div class="value">{{ $open->sitio_purok ?? '' }}</div>
      </td>
      <td>
        <div class="label">&nbsp;</div>
        <div class="muted">Barangay</div>
        <div class="value">{{ $open->barangay ?? '' }}</div>
      </td>
      <td>
        <div class="label">&nbsp;</div>
        <div class="muted">Municipality</div>
        <div class="value">{{ $open->municipality ?? '' }}</div>
      </td>
      <td>
        <div class="label">&nbsp;</div>
        <div class="muted">Province</div>
        <div class="value">{{ $open->province ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">&nbsp;</div>
        <div class="muted">Region</div>
        <div class="value">{{ $open->region ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="3">
        <div class="label">18. Contact Details:</div>
        <div class="muted">Landline (If applicable)</div>
        <div class="value">{{ $open->landline ?? '' }}</div>
      </td>
      <td colspan="2">
        <div class="label">&nbsp;</div>
        <div class="muted">Mobile</div>
        <div class="value">{{ $open->mobile ?? '' }}</div>
      </td>
      <td colspan="4">
        <div class="label">&nbsp;</div>
        <div class="muted">E-mail Address</div>
        <div class="value">{{ $open->email ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="3" class="h48">
        <div class="section-title">19. Educational Attainment</div>
        <div class="checkbox-line">
          <div>{{ $check(($open->education_level ?? '') === 'None') }} NONE</div>
          <div>{{ $check(($open->education_level ?? '') === 'Kindergarten') }} KINDERGARTEN</div>
          <div>{{ $check(($open->education_level ?? '') === 'Elementary') }} ELEMENTARY</div>
          <div>{{ $check(($open->education_level ?? '') === 'Junior High School') }} JUNIOR HIGH SCHOOL</div>
          <div>{{ $check(($open->education_level ?? '') === 'Senior High') }} SENIOR HIGH</div>
          <div>{{ $check(($open->education_level ?? '') === 'College') }} COLLEGE</div>
          <div>{{ $check(($open->education_level ?? '') === 'Vocational') }} VOCATIONAL</div>
          <div>{{ $check(($open->education_level ?? '') === 'Post Graduate') }} POST GRADUATE</div>
        </div>
      </td>

      <td class="h48">
        <div class="section-title">20. Status of Employment</div>
        <div class="checkbox-line">
          <div>{{ $check(($open->employment_status ?? '') === 'Employed') }} EMPLOYED</div>
          <div>{{ $check(($open->employment_status ?? '') === 'Unemployed') }} UNEMPLOYED</div>
          <div>{{ $check(($open->employment_status ?? '') === 'Self-employed') }} SELF-EMPLOYED</div>
        </div>
      </td>

      <td class="h48">
        <div class="section-title">21. Category of Employment</div>
        <div class="checkbox-line">
          <div>{{ $check(($open->employment_category ?? '') === 'Government') }} GOVERNMENT</div>
          <div>{{ $check(($open->employment_category ?? '') === 'Private') }} PRIVATE</div>
        </div>
      </td>

      <td class="h48">
        <div class="label">22. Specific Occupation:</div>
        <div class="value">{{ $open->specific_occupation ?? '' }}</div>
      </td>

      <td class="h48">
        <div class="section-title">23. Types of Employment</div>
        <div class="checkbox-line">
          <div>{{ $check(($open->employment_type ?? '') === 'Permanent') }} PERMANENT</div>
          <div>{{ $check(($open->employment_type ?? '') === 'Seasonal') }} SEASONAL</div>
          <div>{{ $check(($open->employment_type ?? '') === 'Contractual') }} CONTRACTUAL</div>
          <div>{{ $check(($open->employment_type ?? '') === 'Job Order') }} JOB ORDER</div>
          <div>{{ $check(($open->employment_type ?? '') === 'On Call') }} ON CALL</div>
        </div>
      </td>

      <td class="h48">
        <div class="section-title">24. Registered Voter</div>
        <div class="checkbox-line">
          <div>{{ $check((string)($open->registered_voter ?? '') === '1') }} YES</div>
          <div>{{ $check((string)($open->registered_voter ?? '') === '0') }} NO</div>
        </div>
      </td>

      <td class="h48">
        <div class="label">25. Special Skills:</div>
        <div class="value">{{ $open->special_skills ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="7" class="h26">
        <div class="label">26. Sporting Talent:</div>
        <div class="value">{{ $open->sporting_talent ?? '' }}</div>
      </td>
      <td colspan="2" class="h26">
        <div class="label">27. Organization Affiliation:</div>
        <div class="value">{{ $open->pwd_org_affiliated ?? '' }}</div>
        <div class="muted">Contact Person: {{ $open->org_contact_person ?? '' }}</div>
        <div class="muted">Office Address: {{ $open->org_office_address ?? '' }}</div>
        <div class="muted">Tel./Mobile: {{ $open->org_tel_mobile ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td>
        <div class="label">28. ID Reference No.</div>
        <div class="value">{{ $open->id_reference_no ?? '' }}</div>
      </td>
      <td>
        <div class="label">SSS No.</div>
        <div class="value">{{ $open->sss_no ?? '' }}</div>
      </td>
      <td>
        <div class="label">GSIS No.</div>
        <div class="value">{{ $open->gsis_no ?? '' }}</div>
      </td>
      <td>
        <div class="label">PAG-IBIG No.</div>
        <div class="value">{{ $open->pagibig_no ?? '' }}</div>
      </td>
      <td>
        <div class="label">PHN No.</div>
        <div class="value">{{ $open->phn_no ?? '' }}</div>
      </td>
      <td>
        <div class="label">PHILHEALTH No.</div>
        <div class="value">{{ $open->philhealth_no ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">PWD ID No.</div>
        <div class="value">{{ $open->pwd_id_no ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="9" style="padding:0;">
        <table class="form members" style="border:none; width:100%; table-layout:fixed;">
          <tr>
            <th colspan="8" style="text-align:left;">29. HOUSEHOLD MEMBERSHIP: (Fill in with all members of the house)</th>
          </tr>
          <tr>
            <th>Name<br><span class="muted">(Include PWD Member)<br>(Start with head of the family)</span></th>
            <th>Date of Birth</th>
            <th>Civil Status</th>
            <th>Educational Attainment</th>
            <th>Relationship to PWD</th>
            <th>Occupation</th>
            <th>Social Pension Affiliation<br><span class="muted">(SSS, GSIS, UCT, Local Pension)</span></th>
            <th>Monthly Income</th>
          </tr>

          @for($i = 0; $i < $memberCount; $i++)
            @php $m = $openMembers[$i] ?? null; @endphp
            <tr>
              <td>{{ $m->name ?? '' }}</td>
              <td>{{ $m->date_of_birth ?? '' }}</td>
              <td>{{ $m->civil_status ?? '' }}</td>
              <td>{{ $m->educational_attainment ?? '' }}</td>
              <td>{{ $m->relationship_to_pwd ?? '' }}</td>
              <td>{{ $m->occupation ?? '' }}</td>
              <td>{{ $m->social_pension_affiliation ?? '' }}</td>
              <td>{{ isset($m->monthly_income) ? $m->monthly_income : '' }}</td>
            </tr>
          @endfor
        </table>
      </td>
    </tr>

    <tr>
      <td colspan="3">
        <div class="label">30. Total Family Income:</div>
        <div class="value">{{ $open->total_family_income ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">31. Name of Interviewee:</div>
        <div class="value">{{ $open->interviewee_name ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">32. Relationship to PWD:</div>
        <div class="value">{{ $open->interviewee_relationship ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="9">
        <div class="label">33. Signature/Thumbmark of Interviewee (Other than PWD):</div>
        <div class="sig-box" style="height:24px;">
          @if($intervieweeSignature)
            <img src="{{ $intervieweeSignature }}" alt="Interviewee Signature">
          @endif
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="3">
        <div class="label">34. Accomplished By:</div>
        <div class="muted">Name</div>
        <div class="value">{{ $open->accomplished_by_name ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">&nbsp;</div>
        <div class="muted">Position</div>
        <div class="value">{{ $open->accomplished_by_position ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">&nbsp;</div>
        <div class="muted">Signature</div>
        <div class="sig-box" style="height:22px;">
          @if($approvedSignature)
            <img src="{{ $approvedSignature }}" alt="Approved Signature">
          @endif
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="5">
        <div class="label">35. Name of Reporting Unit (Office/Section):</div>
        <div class="value">{{ $open->reporting_unit_office_section ?? '' }}</div>
      </td>
      <td colspan="4">
        <div class="label">36. Approved By:</div>
        <div class="value">{{ $open->approved_by ?? '' }}</div>
      </td>
    </tr>
  </table>
</div>
</body>
</html>
