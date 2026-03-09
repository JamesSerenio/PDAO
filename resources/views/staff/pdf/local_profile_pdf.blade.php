<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Local Profile Form PDF</title>
  <style>
    @page {
      margin: 18px 18px 20px 18px;
    }

    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 10px;
      color: #111;
      margin: 0;
      padding: 0;
    }

    * {
      box-sizing: border-box;
    }

    .page {
      width: 100%;
    }

    .header {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 4px;
    }

    .header td {
      vertical-align: top;
    }

    .logo-cell {
      width: 90px;
      text-align: center;
    }

    .logo {
      width: 68px;
      height: 68px;
      object-fit: contain;
    }

    .title-cell {
      text-align: center;
      padding-top: 4px;
    }

    .small {
      font-size: 10px;
    }

    .title-main {
      font-size: 18px;
      font-weight: bold;
      margin-top: 4px;
      letter-spacing: .5px;
    }

    .instruction {
      font-size: 10px;
      font-weight: bold;
      margin: 8px 0 6px;
      border-top: 1px solid #222;
      border-bottom: 1px solid #222;
      padding: 4px 6px;
    }

    table.form {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
    }

    table.form td, table.form th {
      border: 1px solid #222;
      padding: 3px 4px;
      vertical-align: top;
      word-wrap: break-word;
    }

    .label {
      font-size: 9px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .value {
      min-height: 14px;
      margin-top: 2px;
      font-size: 10px;
    }

    .center {
      text-align: center;
    }

    .right {
      text-align: right;
    }

    .muted {
      color: #555;
      font-size: 9px;
    }

    .photo-box {
      width: 100%;
      height: 82px;
      border: 1px solid #222;
      text-align: center;
      overflow: hidden;
    }

    .photo-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .sig-box {
      width: 100%;
      height: 48px;
      border: 1px solid #222;
      text-align: center;
      overflow: hidden;
    }

    .sig-box img {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .checkbox-line {
      line-height: 1.45;
      font-size: 9.5px;
    }

    .checkbox-line span {
      display: inline-block;
      margin-right: 10px;
      white-space: nowrap;
    }

    .section-title {
      font-weight: bold;
      font-size: 10px;
      margin-bottom: 2px;
      text-transform: uppercase;
    }

    .line-space {
      height: 18px;
    }

    .members td, .members th {
      font-size: 9px;
      padding: 3px;
    }

    .nowrap {
      white-space: nowrap;
    }
  </style>
</head>
<body>
@php
  use Illuminate\Support\Facades\Storage;
  use Carbon\Carbon;

  $check = fn($condition) => $condition ? '☑' : '☐';

  $imgToBase64 = function ($path) {
      if (!$path || !file_exists($path)) return null;
      $type = pathinfo($path, PATHINFO_EXTENSION);
      $data = file_get_contents($path);
      return 'data:image/' . $type . ';base64,' . base64_encode($data);
  };

  $storageToBase64 = function ($storagePath) {
      if (!$storagePath) return null;

      $fullPath = storage_path('app/public/' . ltrim(str_replace('public/', '', $storagePath), '/'));
      if (!file_exists($fullPath)) return null;

      $type = pathinfo($fullPath, PATHINFO_EXTENSION);
      $data = file_get_contents($fullPath);
      return 'data:image/' . $type . ';base64,' . base64_encode($data);
  };

  $logo1 = $imgToBase64(public_path('img/logopdf1.png'));
  $logo2 = $imgToBase64(public_path('img/logopdf2.png'));

  $photo1x1 = $storageToBase64($open->photo_1x1 ?? null);
  $signatureThumb = $storageToBase64($open->signature_thumbmark ?? null);
  $intervieweeSignature = $storageToBase64($open->interviewee_signature_thumbmark ?? null);
  $approvedSignature = $storageToBase64($open->approved_signature ?? null);

  $age = !empty($open->date_of_birth) ? Carbon::parse($open->date_of_birth)->age : null;

  $typeNames = collect($allTypes)->pluck('name', 'id')->toArray();
  $causeRows = collect($allCauses);

  $causeLookup = collect($openCauses)->keyBy('id');

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
@endphp

<div class="page">
  <table class="header">
    <tr>
      <td class="logo-cell">
        @if($logo1)
          <img src="{{ $logo1 }}" class="logo" alt="Logo 1">
        @endif
      </td>
      <td class="title-cell">
        <div class="small">Republic of the Philippines</div>
        <div class="small"><b>PROVINCE OF BUKIDNON</b></div>
        <div class="small">Provincial Capitol</div>
        <div class="title-main">LOCAL PROFILE FORM</div>
      </td>
      <td class="logo-cell">
        @if($logo2)
          <img src="{{ $logo2 }}" class="logo" alt="Logo 2">
        @endif
      </td>
    </tr>
  </table>

  <div class="instruction">
    WRITE N/A IF NOT APPLICABLE. WRITE IN CAPITAL LETTERS. USE BLACK BALLPEN. NO ERASURES, KEEP IT NEAT AND CLEAN.
  </div>

  <table class="form">
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
        <div class="label center">3. Place 1" x 1" 6 months - present Photo Here</div>
        <div class="photo-box" style="margin-top:4px;">
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
      <td colspan="2">
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
        <div class="value">
          {{ $check(($open->sex ?? '') === 'MALE') }} Male
          &nbsp;&nbsp;
          {{ $check(($open->sex ?? '') === 'FEMALE') }} Female
        </div>
      </td>
      <td>
        <div class="label">13. Signature / Thumbmark</div>
        <div class="sig-box" style="margin-top:4px;">
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
      <td colspan="4">
        <div class="section-title">15. Types of Disability:</div>
        <div class="checkbox-line">
          <div>{{ $check($typeChecked('Deaf or Hard of Hearing')) }} Deaf or Hard of Hearing</div>
          <div>{{ $check($typeChecked('Intellectual Disability')) }} Intellectual Disability</div>
          <div>{{ $check($typeChecked('Learning Disability')) }} Learning Disability</div>
          <div>{{ $check($typeChecked('Mental Disability')) }} Mental Disability</div>
          <div>{{ $check($typeChecked('Physical Disability')) }} Physical Disability</div>
          <div>{{ $check($typeChecked('Multiple Disability')) }} Multiple Disability</div>
          <div>{{ $check($typeChecked('Psychosocial Disability')) }} Psychosocial Disability</div>
          <div>{{ $check($typeChecked('Speech & Language Impairment')) }} Speech &amp; Language Impairment</div>
          <div>{{ $check($typeChecked('Visual Disability')) }} Visual Disability</div>
          <div>{{ $check($typeChecked('Cancer (RA 11215)')) }} Cancer (RA 11215)</div>
          <div>{{ $check($typeChecked('Rare Disease (RA 10747)')) }} Rare Disease (RA 10747)</div>
        </div>
      </td>

      <td colspan="5">
        <div class="section-title">16. Causes of Disability:</div>
        <div class="checkbox-line">
          <b>Congenital / Inborn</b><br>
          {{ $check($causeChecked('Congenital/Inborn', 'Autism')) }} Autism<br>
          {{ $check($causeChecked('Congenital/Inborn', 'ADHD')) }} ADHD<br>
          {{ $check($causeChecked('Congenital/Inborn', 'Cerebral Palsy')) }} Cerebral Palsy<br>
          {{ $check($causeChecked('Congenital/Inborn', 'Down Syndrome')) }} Down Syndrome<br>
          {{ $check($causeChecked('Congenital/Inborn', 'Others')) }} Others:
          {{ $causeOtherText('Congenital/Inborn') }}<br><br>

          <b>Acquired</b><br>
          {{ $check($causeChecked('Acquired', 'Chronic Illness')) }} Chronic Illness<br>
          {{ $check($causeChecked('Acquired', 'Cerebral Palsy')) }} Cerebral Palsy<br>
          {{ $check($causeChecked('Acquired', 'Injury')) }} Injury<br>
          {{ $check($causeChecked('Acquired', 'Others')) }} Others:
          {{ $causeOtherText('Acquired') }}
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="2">
        <div class="label">17. Complete Address - House No. and Street:</div>
        <div class="value">{{ $open->house_no_street ?? '' }}</div>
      </td>
      <td>
        <div class="label">Sitio/Purok:</div>
        <div class="value">{{ $open->sitio_purok ?? '' }}</div>
      </td>
      <td>
        <div class="label">Barangay:</div>
        <div class="value">{{ $open->barangay ?? '' }}</div>
      </td>
      <td>
        <div class="label">Municipality:</div>
        <div class="value">{{ $open->municipality ?? '' }}</div>
      </td>
      <td>
        <div class="label">Province:</div>
        <div class="value">{{ $open->province ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">Region:</div>
        <div class="value">{{ $open->region ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="3">
        <div class="label">18. Contact Details - Landline:</div>
        <div class="value">{{ $open->landline ?? '' }}</div>
      </td>
      <td colspan="2">
        <div class="label">Mobile:</div>
        <div class="value">{{ $open->mobile ?? '' }}</div>
      </td>
      <td colspan="4">
        <div class="label">E-mail Address:</div>
        <div class="value">{{ $open->email ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="3">
        <div class="section-title">19. Educational Attainment</div>
        <div class="checkbox-line">
          <div>{{ $check(($open->education_level ?? '') === 'None') }} None</div>
          <div>{{ $check(($open->education_level ?? '') === 'Kindergarten') }} Kindergarten</div>
          <div>{{ $check(($open->education_level ?? '') === 'Elementary') }} Elementary</div>
          <div>{{ $check(($open->education_level ?? '') === 'Junior High School') }} Junior High School</div>
          <div>{{ $check(($open->education_level ?? '') === 'Senior High') }} Senior High</div>
          <div>{{ $check(($open->education_level ?? '') === 'College') }} College</div>
          <div>{{ $check(($open->education_level ?? '') === 'Vocational') }} Vocational</div>
          <div>{{ $check(($open->education_level ?? '') === 'Post Graduate') }} Post Graduate</div>
        </div>
      </td>

      <td>
        <div class="section-title">20. Status of Employment</div>
        <div class="checkbox-line">
          <div>{{ $check(($open->employment_status ?? '') === 'Employed') }} Employed</div>
          <div>{{ $check(($open->employment_status ?? '') === 'Unemployed') }} Unemployed</div>
          <div>{{ $check(($open->employment_status ?? '') === 'Self-employed') }} Self-employed</div>
        </div>
      </td>

      <td>
        <div class="section-title">21. Category of Employment</div>
        <div class="checkbox-line">
          <div>{{ $check(($open->employment_category ?? '') === 'Government') }} Government</div>
          <div>{{ $check(($open->employment_category ?? '') === 'Private') }} Private</div>
        </div>
      </td>

      <td>
        <div class="label">22. Specific Occupation:</div>
        <div class="value">{{ $open->specific_occupation ?? '' }}</div>
      </td>

      <td>
        <div class="section-title">23. Types of Employment</div>
        <div class="checkbox-line">
          <div>{{ $check(($open->employment_type ?? '') === 'Permanent') }} Permanent</div>
          <div>{{ $check(($open->employment_type ?? '') === 'Seasonal') }} Seasonal</div>
          <div>{{ $check(($open->employment_type ?? '') === 'Contractual') }} Contractual</div>
          <div>{{ $check(($open->employment_type ?? '') === 'Job Order') }} Job Order</div>
          <div>{{ $check(($open->employment_type ?? '') === 'On Call') }} On Call</div>
        </div>
      </td>

      <td>
        <div class="section-title">24. Registered Voter</div>
        <div class="checkbox-line">
          <div>{{ $check((string)($open->registered_voter ?? '') === '1') }} Yes</div>
          <div>{{ $check((string)($open->registered_voter ?? '') === '0') }} No</div>
        </div>
      </td>

      <td>
        <div class="label">25. Special Skills:</div>
        <div class="value">{{ $open->special_skills ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td colspan="7">
        <div class="label">26. Sporting Talent:</div>
        <div class="value">{{ $open->sporting_talent ?? '' }}</div>
      </td>
      <td colspan="2">
        <div class="label">27. Organization Affiliation:</div>
        <div class="value">{{ $open->pwd_org_affiliated ?? '' }}</div>
        <div class="muted">Contact Person: {{ $open->org_contact_person ?? '' }}</div>
        <div class="muted">Office Address: {{ $open->org_office_address ?? '' }}</div>
        <div class="muted">Tel./Mobile: {{ $open->org_tel_mobile ?? '' }}</div>
      </td>
    </tr>

    <tr>
      <td>
        <div class="label">28. ID Ref. No.</div>
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
        <table class="form members" style="border:none; border-collapse:collapse; width:100%;">
          <tr>
            <th colspan="8" style="text-align:left;">29. HOUSEHOLD MEMBERSHIP: (Fill in with all members of the house)</th>
          </tr>
          <tr>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Civil Status</th>
            <th>Educational Attainment</th>
            <th>Relationship to PWD</th>
            <th>Occupation</th>
            <th>Social Pension Affiliation</th>
            <th>Monthly Income</th>
          </tr>

          @php
            $memberCount = max(count($openMembers), 4);
          @endphp

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
        <div class="sig-box" style="margin-top:4px; height:42px;">
          @if($intervieweeSignature)
            <img src="{{ $intervieweeSignature }}" alt="Interviewee Signature">
          @endif
        </div>
      </td>
    </tr>

    <tr>
      <td colspan="3">
        <div class="label">34. Accomplished By - Name:</div>
        <div class="value">{{ $open->accomplished_by_name ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">Position:</div>
        <div class="value">{{ $open->accomplished_by_position ?? '' }}</div>
      </td>
      <td colspan="3">
        <div class="label">Signature:</div>
        <div class="sig-box" style="margin-top:4px; height:34px;">
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