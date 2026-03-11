<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Local Profile Form PDF</title>
  <style>
    @page {
      size: A4 portrait;
      margin: 6mm;
    }

    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 7px;
      color: #111;
      margin: 0;
      padding: 0;
      line-height: 1.08;
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
      table-layout: fixed;
      margin-bottom: 1px;
    }

    .header td {
      border: none;
      padding: 0;
      vertical-align: middle;
    }

    .header-left,
    .header-right {
      width: 90px;
    }

    .header-left {
      text-align: left;
    }

    .header-right {
      text-align: right;
    }

    .header-left img,
    .header-right img {
      width: 68px;
      height: 68px;
      object-fit: contain;
      display: inline-block;
      position: relative;
    }

    .header-left img {
      left: 150px;
    }

    .header-right img {
      right: 150px;
    }

    .header-center {
      text-align: center;
      padding: 0 2px;
    }

    .small {
      font-size: 7.6px;
      line-height: 1.0;
      margin: 0;
    }

    .title-main {
      font-size: 13.5px;
      font-weight: bold;
      margin-top: 1px;
      letter-spacing: .2px;
      line-height: 1;
    }

    .instruction {
      font-size: 7px;
      font-weight: bold;
      border: none;
      padding: 1px 4px;
      margin: 1px 0 3px;
      text-align: left;
      line-height: 1.0;
    }
    .form-wrap {
      width: 100%;
      border-left: 1px solid #222;
      border-right: 1px solid #222;
      border-bottom: 1px solid #222;
    }

    table.form {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      table-layout: fixed;
    }

    table.form td,
    table.form th {
      padding: 2px 3px;
      vertical-align: top;
      word-wrap: break-word;
      overflow-wrap: break-word;
      border-top: 1px solid #222;
      border-right: 1px solid #222;
    }

    table.form tr > td:first-child,
    table.form tr > th:first-child {
      border-left: 0;
    }

    table.form tr > td:last-child,
    table.form tr > th:last-child {
      border-right: 0;
    }

    .label {
      font-size: 6.9px;
      font-weight: bold;
      text-transform: uppercase;
      line-height: 1.05;
    }

    .label.normal-case {
      text-transform: none;
    }

    .value {
      min-height: 8px;
      margin-top: 1px;
      font-size: 7px;
      line-height: 1.08;
    }

    .muted {
      color: #444;
      font-size: 6px;
      line-height: 1.02;
    }

    .photo-box {
      width: 100%;
      height: 72px;
      aspect-ratio: 1 / 1;
      border: 1px solid #222;
      text-align: center;
      overflow: hidden;
      background: #fff;
      position: relative;
    }

    .photo-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;;
    }

    .photo-placeholder {
      width: 100%;
      height: 100%;
      display: table;
      text-align: center;
    }

    .photo-placeholder span {
      display: table-cell;
      vertical-align: middle;
      font-size: 6.2px;
      font-weight: bold;
      line-height: 1.1;
      padding: 2px;
    }

    .sig-box {
      width: 100%;
      height: 26px;
      border: none;
      text-align: center;
      overflow: hidden;
      background: #fff;
    }

    .sig-box img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
    }

    .checkbox-line {
      line-height: 1.1;
      font-size: 6.7px;
    }

    .checkbox-line div {
      margin: 0 0 1px 0;
    }

    .checkbox-line span {
      display: inline-block;
      margin-right: 10px;
      white-space: nowrap;
    }

    .section-title {
      font-weight: bold;
      font-size: 6.9px;
      margin-bottom: 1px;
      text-transform: uppercase;
      line-height: 1.05;
    }

    .members td,
    .members th {
      font-size: 6.1px;
      padding: 2px;
      line-height: 1.05;
    }

    .tight {
      line-height: 1.02;
    }

    .blood-grid {
      font-size: 6.7px;
      line-height: 1.1;
      margin-top: 1px;
    }

    .blood-grid .row {
      white-space: nowrap;
      margin-bottom: 1px;
    }

    .vtop {
      vertical-align: top !important;
    }

    .h34 { height: 34px; }

    /* 14-16 */
    .civil-row {
      font-size: 6.6px;
      line-height: 1.05;
      white-space: nowrap;
    }

    .civil-row span {
      display: inline-block;
      margin-right: 12px;
      white-space: nowrap;
    }

    .sec1516 {
      font-size: 6.45px;
      line-height: 1.06;
    }

    .sec1516 .section-title {
      margin-bottom: 2px;
    }

    .sec1516 .item {
      margin-bottom: 1px;
    }

    .sec1516 .subhead {
      font-weight: bold;
      margin: 2px 0 1px;
    }

    .underline-fill {
      display: inline-block;
      min-width: 78px;
      border-bottom: 1px solid #666;
      height: 8px;
      vertical-align: bottom;
    }

    /* 19-26 */
    .sec1926-wrap {
      width: 100%;
    }

    table.sec1926 {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      table-layout: fixed;
    }

    table.sec1926 td {
      border-top: 1px solid #222;
      border-right: 1px solid #222;
      padding: 2px 3px;
      vertical-align: top;
    }

    table.sec1926 td:last-child {
      border-right: 0;
    }

    .sec1926-row1 {
      height: 56px;
    }

    .sec1926-row2 {
      height: 42px;
    }

    .two-col-checks {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
      margin-top: 1px;
    }

    .no-border {
      border: none !important;
    }
    .two-col-checks td {
      border: none !important;
      padding: 0 6px 0 0 !important;
      vertical-align: top;
      font-size: 6.5px;
      line-height: 1.08;
    }

    .line-fill {
      margin-top: 2px;
    }

    .line-fill .line {
      border-bottom: 1px solid #666;
      height: 9px;
      margin-bottom: 2px;
      position: relative;
    }

    .line-fill .line span {
      position: absolute;
      left: 0;
      bottom: 1px;
      font-size: 6.8px;
      background: #fff;
      padding-right: 2px;
    }

    .members-wrap {
      width: 100%;
    }

    table.members-table {
      width: 100%;
      border-collapse: separate;
      border-spacing: 0;
      table-layout: fixed;
    }

    table.members-table th,
    table.members-table td {
      padding: 2px;
      border-top: 1px solid #222;
      border-right: 1px solid #222;
      vertical-align: top;
      word-wrap: break-word;
      overflow-wrap: break-word;
      font-size: 6.1px;
      line-height: 1.05;
    }

    table.members-table th:last-child,
    table.members-table td:last-child {
      border-right: 0;
    }
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
  $accomplishedSignature = $storageToBase64($open->approved_signature ?? null);

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
  $bloodType = strtoupper(trim((string)($open->blood_type ?? '')));
  $dobValue = trim((string)($open->date_of_birth ?? ''));
@endphp

<div class="page">

  <table class="header">
    <tr>
      <td class="header-left">
        @if($logo2)
          <img src="{{ $logo2 }}" alt="Left Logo">
        @endif
      </td>
      <td class="header-center">
        <div class="small">Republic of the Philippines</div>
        <div class="small"><b>PROVINCE OF BUKIDNON</b></div>
        <div class="small">Provincial Capitol</div>
        <div class="title-main">LOCAL PROFILE FORM</div>
      </td>
      <td class="header-right">
        @if($logo1)
          <img src="{{ $logo1 }}" alt="Right Logo">
        @endif
      </td>
    </tr>
  </table>

  <div class="instruction">
    WRITE N/A IF NOT APPLICABLE. WRITE IN CAPITAL LETTERS. USE BLACK BALLPEN. NO ERASURES, KEEP IT NEAT AND CLEAN.
  </div>

  <div class="form-wrap">
    <table class="form">
      <colgroup>
        <col style="width:12%;">
        <col style="width:12%;">
        <col style="width:12%;">
        <col style="width:12%;">
        <col style="width:10%;">
        <col style="width:10%;">
        <col style="width:10%;">
        <col style="width:10%;">
        <col style="width:6%;">
        <col style="width:6%;">
      </colgroup>

      <tr>
        <td colspan="4">
          <div class="label">1. Local Disability Registry Number: <span class="label normal-case">(To be filled up by PGO – PDAD)</span></div>
          <div class="value">{{ $open->ldr_number ?? '' }}</div>
        </td>
        <td colspan="4">
          <div class="label">2. Profiling Date:</div>
          <div class="value">{{ $open->profiling_date ?? '' }}</div>
        </td>
        <td rowspan="2" colspan="2" class="vtop">
          <div class="photo-box">
            @if($photo1x1)
              <img src="{{ $photo1x1 }}" alt="1x1 Photo">
            @else
              <div class="photo-placeholder">
                <span>
                  3. PLACE 1" X 1"<br>
                  6 months - present<br>
                  Photo Here
                </span>
              </div>
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
        <td colspan="2" style="border-right:1px solid #222 !important;">
          <div class="label">7. Suffix:</div>
          <div class="value">{{ $open->suffix ?? '' }}</div>
        </td>
      </tr>

      <tr>
        <td colspan="2" class="h34">
          <div class="label">
            8. Date of Birth:
            @if(!$dobValue)
              <br><span class="muted">(mm/dd/yyyy)</span>
            @endif
          </div>
          <div class="value">{{ $dobValue }}</div>
        </td>

        <td colspan="2" class="h34">
          <div class="label">9. Blood Type: <span class="label normal-case">(if known)</span></div>
          <div class="blood-grid">
            <div class="row">
              {{ $check($bloodType === 'A+') }} A+
              &nbsp;&nbsp;{{ $check($bloodType === 'AB+') }} AB+
              &nbsp;&nbsp;{{ $check($bloodType === 'B+') }} B+
              &nbsp;&nbsp;{{ $check($bloodType === 'O+') }} O+
            </div>
            <div class="row">
              {{ $check($bloodType === 'A-') }} A-
              &nbsp;&nbsp;{{ $check($bloodType === 'AB-') }} AB-
              &nbsp;&nbsp;{{ $check($bloodType === 'B-') }} B-
              &nbsp;&nbsp;{{ $check($bloodType === 'O-') }} O-
            </div>
          </div>
        </td>

        <td>
          <div class="label">10. Religion:</div>
          <div class="value">{{ $open->religion ?? '' }}</div>
        </td>

        <td>
          <div class="label">11. Ethnic Group:</div>
          <div class="value">{{ $open->ethnic_group ?? '' }}</div>
        </td>

        <td colspan="2">
          <div class="label">12. Sex:</div>
          <div class="value tight">
            {{ $check(strtoupper((string)($open->sex ?? '')) === 'MALE') }} Male<br>
            {{ $check(strtoupper((string)($open->sex ?? '')) === 'FEMALE') }} Female
          </div>
        </td>

        <td colspan="2">
          <div class="label">13. Signature / Thumbmark</div>
          <div class="sig-box no-border">
            @if($signatureThumb)
              <img src="{{ $signatureThumb }}" alt="Signature / Thumbmark">
            @endif
          </div>
        </td>
      </tr>

      <!-- 14-16 FIXED -->
      <tr>
        <td colspan="10">
          <div class="label">14. Civil Status:</div>
          <div class="civil-row">
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
        <td colspan="5" class="sec1516">
          <div class="section-title">15. Types of Disability:</div>
          <div class="item">{{ $check($typeChecked('Deaf or Hard of Hearing')) }} DEAF OR HARD OF HEARING</div>
          <div class="item">{{ $check($typeChecked('Intellectual Disability')) }} INTELLECTUAL DISABILITY</div>
          <div class="item">{{ $check($typeChecked('Learning Disability')) }} LEARNING DISABILITY</div>
          <div class="item">{{ $check($typeChecked('Mental Disability')) }} MENTAL DISABILITY</div>
          <div class="item">{{ $check($typeChecked('Physical Disability')) }} PHYSICAL DISABILITY</div>
          <div class="item">{{ $check($typeChecked('Multiple Disability')) }} MULTIPLE DISABILITY</div>
          <div class="item">{{ $check($typeChecked('Psychosocial Disability')) }} PSYCHOSOCIAL DISABILITY</div>
          <div class="item">{{ $check($typeChecked('Speech & Language Impairment')) }} SPEECH &amp; LANGUAGE IMPAIRMENT</div>
          <div class="item">{{ $check($typeChecked('Visual Disability')) }} VISUAL DISABILITY</div>
          <div class="item">{{ $check($typeChecked('Cancer (RA 11215)')) }} CANCER (RA 11215)</div>
          <div class="item">{{ $check($typeChecked('Rare Disease (RA 10747)')) }} RARE DISEASE (RA 10747)</div>
        </td>

        <td colspan="5" class="sec1516">
          <div class="section-title">16. Causes of Disability:</div>

          <div class="subhead">CONGENITAL/INBORN</div>
          <div class="item">{{ $check($causeChecked('Congenital/Inborn', 'Autism')) }} AUTISM</div>
          <div class="item">{{ $check($causeChecked('Congenital/Inborn', 'ADHD')) }} ADHD</div>
          <div class="item">{{ $check($causeChecked('Congenital/Inborn', 'Cerebral Palsy')) }} CEREBRAL PALSY</div>
          <div class="item">{{ $check($causeChecked('Congenital/Inborn', 'Down Syndrome')) }} DOWN SYNDROME</div>
          <div class="item">
            {{ $check($causeChecked('Congenital/Inborn', 'Others')) }} OTHERS, specify:
            <span class="underline-fill">{{ $causeOtherText('Congenital/Inborn') }}</span>
          </div>

          <div class="subhead">ACQUIRED</div>
          <div class="item">{{ $check($causeChecked('Acquired', 'Chronic Illness')) }} CHRONIC ILLNESS</div>
          <div class="item">{{ $check($causeChecked('Acquired', 'Cerebral Palsy')) }} CEREBRAL PALSY</div>
          <div class="item">{{ $check($causeChecked('Acquired', 'Injury')) }} INJURY</div>
          <div class="item">
            {{ $check($causeChecked('Acquired', 'Others')) }} OTHERS, specify:
            <span class="underline-fill">{{ $causeOtherText('Acquired') }}</span>
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
        <td colspan="2">
          <div class="label">&nbsp;</div>
          <div class="muted">Municipality</div>
          <div class="value">{{ $open->municipality ?? '' }}</div>
        </td>
        <td colspan="2">
          <div class="label">&nbsp;</div>
          <div class="muted">Province</div>
          <div class="value">{{ $open->province ?? '' }}</div>
        </td>
        <td colspan="2">
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
        <td colspan="3">
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

      <!-- 19-26 FIXED SECTION -->
      <tr>
        <td colspan="10" style="padding:0;">
          <div class="sec1926-wrap">
            <table class="sec1926">
              <colgroup>
                <col style="width:15%;">
                <col style="width:15%;">
                <col style="width:8%;">
                <col style="width:8%;">
                <col style="width:15%;">
                <col style="width:15%;">
                <col style="width:12%;">
                <col style="width:12%;">
              </colgroup>

              <tr class="sec1926-row1">
                <td colspan="2">
                  <div class="section-title">19. Educational Attainment:</div>
                  <table class="two-col-checks">
                    <tr>
                      <td>
                        <div>{{ $check(($open->education_level ?? '') === 'None') }} NONE</div>
                        <div>{{ $check(($open->education_level ?? '') === 'Kindergarten') }} KINDERGARTEN</div>
                        <div>{{ $check(($open->education_level ?? '') === 'Elementary') }} ELEMENTARY</div>
                        <div>{{ $check(($open->education_level ?? '') === 'Junior High School') }} JUNIOR HIGH SCHOOL</div>
                      </td>
                      <td>
                        <div>{{ $check(($open->education_level ?? '') === 'Senior High') }} SENIOR HIGH</div>
                        <div>{{ $check(($open->education_level ?? '') === 'College') }} COLLEGE</div>
                        <div>{{ $check(($open->education_level ?? '') === 'Vocational') }} VOCATIONAL</div>
                        <div>{{ $check(($open->education_level ?? '') === 'Post Graduate') }} POST GRADUATE</div>
                      </td>
                    </tr>
                  </table>
                </td>

                <td colspan="2">
                  <div class="label">22. Specific Occupation:</div>
                  <div class="value">{{ $open->specific_occupation ?? '' }}</div>
                </td>

                <td colspan="2">
                  <div class="label">25. Special Skills:</div>
                  <div class="line-fill">
                    <div class="line"><span>{{ $open->special_skills ?? '' }}</span></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                  </div>
                </td>
              </tr>

              <tr class="sec1926-row2">
                <td>
                  <div class="section-title">20. Status of Employment:</div>
                  <div class="checkbox-line">
                    <div>{{ $check(($open->employment_status ?? '') === 'Employed') }} Employed</div>
                    <div>{{ $check(($open->employment_status ?? '') === 'Unemployed') }} Unemployed</div>
                    <div>{{ $check(($open->employment_status ?? '') === 'Self-employed') }} Self-employed</div>
                  </div>
                </td>

                <td>
                  <div class="section-title">21. Category of Employment:</div>
                  <div class="checkbox-line">
                    <div>{{ $check(($open->employment_category ?? '') === 'Government') }} Government</div>
                    <div>{{ $check(($open->employment_category ?? '') === 'Private') }} Private</div>
                  </div>
                </td>

                <td>
                  <div class="section-title">23. Types of Employment:</div>
                  <div class="checkbox-line">
                    <div>{{ $check(($open->employment_type ?? '') === 'Permanent') }} Permanent</div>
                    <div>{{ $check(($open->employment_type ?? '') === 'Seasonal') }} Seasonal</div>
                    <div>{{ $check(($open->employment_type ?? '') === 'Contractual') }} Contractual</div>
                    <div>{{ $check(($open->employment_type ?? '') === 'Job Order') }} Job Order</div>
                    <div>{{ $check(($open->employment_type ?? '') === 'On Call') }} On Call</div>
                  </div>
                </td>

                <td>
                  <div class="section-title">24. Registered Voter:</div>
                  <div class="checkbox-line">
                    <div>{{ $check((string)($open->registered_voter ?? '') === '1') }} YES</div>
                    <div>{{ $check((string)($open->registered_voter ?? '') === '0') }} NO</div>
                  </div>
                </td>

                <td colspan="2">
                  <div class="label">26. Sporting Talent:</div>
                  <div class="line-fill">
                    <div class="line"><span>{{ $open->sporting_talent ?? '' }}</span></div>
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                  </div>
                </td>
              </tr>
            </table>
          </div>
        </td>
      </tr>

      <tr>
        <td colspan="10" style="padding:0;">
          <table class="sec1926" style="width:100%;">
            <colgroup>
              <col style="width:22%;">
              <col style="width:18%;">
              <col style="width:34%;">
              <col style="width:26%;">
            </colgroup>
            <tr style="height:30px;">
              <td>
                <div class="label">27. Organization Affiliation:</div>
                <div class="value">{{ $open->pwd_org_affiliated ?? '' }}</div>
              </td>
              <td>
                <div class="label">&nbsp;</div>
                <div class="muted">Contact Person:</div>
                <div class="value">{{ $open->org_contact_person ?? '' }}</div>
              </td>
              <td>
                <div class="label">&nbsp;</div>
                <div class="muted">Office Address:</div>
                <div class="value">{{ $open->org_office_address ?? '' }}</div>
              </td>
              <td style="border-right:0;">
                <div class="label">&nbsp;</div>
                <div class="muted">Tel./Mobile:</div>
                <div class="value">{{ $open->org_tel_mobile ?? '' }}</div>
              </td>
            </tr>
          </table>
        </td>
      </tr>

<tr>
  <td colspan="10" style="padding:0;">
    <table style="width:100%; border-collapse:separate; border-spacing:0; table-layout:fixed;">
      <colgroup>
        <col style="width:13%;">
        <col style="width:13%;">
        <col style="width:11%;">
        <col style="width:13%;">
        <col style="width:11%;">
        <col style="width:13%;">
        <col style="width:26%;">
      </colgroup>
      <tr>
        <td style="border-top:1px solid #222; border-right:1px solid #222; padding:2px 3px; vertical-align:top;">
          <div class="label">28. ID REFERENCE NO.</div>
          <div class="value">{{ $open->id_reference_no ?? '' }}</div>
        </td>
        <td style="border-top:1px solid #222; border-right:1px solid #222; padding:2px 3px; vertical-align:top;">
          <div class="label">SSS NO.:</div>
          <div class="value">{{ $open->sss_no ?? '' }}</div>
        </td>
        <td style="border-top:1px solid #222; border-right:1px solid #222; padding:2px 3px; vertical-align:top;">
          <div class="label">GSIS NO.:</div>
          <div class="value">{{ $open->gsis_no ?? '' }}</div>
        </td>
        <td style="border-top:1px solid #222; border-right:1px solid #222; padding:2px 3px; vertical-align:top;">
          <div class="label">PAG-IBIG NO.:</div>
          <div class="value">{{ $open->pagibig_no ?? '' }}</div>
        </td>
        <td style="border-top:1px solid #222; border-right:1px solid #222; padding:2px 3px; vertical-align:top;">
          <div class="label">PHN NO.:</div>
          <div class="value">{{ $open->phn_no ?? '' }}</div>
        </td>
        <td style="border-top:1px solid #222; border-right:1px solid #222; padding:2px 3px; vertical-align:top;">
          <div class="label">PHILHEALTH NO.:</div>
          <div class="value">{{ $open->philhealth_no ?? '' }}</div>
        </td>
        <td style="border-top:1px solid #222; padding:2px 3px; vertical-align:top;">
          <div class="label">PWD ID NO.:</div>
          <div class="value">{{ $open->pwd_id_no ?? '' }}</div>
        </td>
      </tr>

      <tr>
        <td colspan="10" style="padding:0;">
          <div class="members-wrap">
            <table class="members-table">
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
          </div>
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
        <td colspan="4">
          <div class="label">32. Relationship to PWD:</div>
          <div class="value">{{ $open->interviewee_relationship ?? '' }}</div>
        </td>
      </tr>

      <tr>
        <td colspan="10">
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
        <td colspan="4">
          <div class="label">&nbsp;</div>
          <div class="muted">Signature</div>
          <div class="sig-box" style="height:22px;">
            @if($accomplishedSignature)
              <img src="{{ $accomplishedSignature }}" alt="Accomplished Signature">
            @endif
          </div>
        </td>
      </tr>

      <tr>
        <td colspan="6">
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
</div>
</body>
</html>