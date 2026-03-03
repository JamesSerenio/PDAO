@if (session('success'))
  <div class="lpf-alert lpf-alert-success lpf-animate-in" role="alert">
    <b>{{ session('success') }}</b>
  </div>
@endif

@if ($errors->any())
  <div class="lpf-alert lpf-alert-error lpf-animate-in" role="alert">
    <b>Please fix the errors:</b>
    <ul class="lpf-error-list">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

<div class="lpf-card lpf-animate-in" aria-label="Local Profile Form Card">
  <div class="lpf-card-head">
    <div class="lpf-head-text">
      <h2 class="lpf-title">Local Profile Form</h2>
      <p class="lpf-sub">Provide the details exactly based on the printed form.</p>
    </div>
    <span class="lpf-pill">PWD Profiling</span>
  </div>

  <div class="lpf-card-body">
    <form class="lpf-form" wire:submit.prevent="save" enctype="multipart/form-data">

      {{-- SECTION 1 --}}
      <div class="lpf-section">
        <div class="lpf-section-title">Basic Identification</div>

        <div class="lpf-grid lpf-stagger">
          <div class="lpf-field">
            <label class="lpf-label" for="ldr_number">Local Disability Registry No.</label>
            <input id="ldr_number" class="lpf-input" type="text" wire:model.defer="ldr_number"
                   placeholder="(Filled by office if applicable)">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="profiling_date">Profiling Date</label>
            <input id="profiling_date" class="lpf-input" type="date" wire:model.defer="profiling_date">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="last_name">Last Name</label>
            <input id="last_name" class="lpf-input" type="text" wire:model.defer="last_name" placeholder="DELA CRUZ">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="first_name">First Name</label>
            <input id="first_name" class="lpf-input" type="text" wire:model.defer="first_name" placeholder="JUAN">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="middle_name">Middle Name</label>
            <input id="middle_name" class="lpf-input" type="text" wire:model.defer="middle_name" placeholder="SANTOS">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="suffix">Suffix</label>
            <input id="suffix" class="lpf-input" type="text" wire:model.defer="suffix" placeholder="Jr., Sr., III">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="date_of_birth">Date of Birth</label>
            <input id="date_of_birth" class="lpf-input" type="date" wire:model="date_of_birth">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="age_display">Age (Auto)</label>
            <input id="age_display" class="lpf-input" type="text" value="{{ $age }}" readonly>
            <small class="lpf-help">Auto-calculated from birthday.</small>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="blood_type">Blood Type</label>
            <select id="blood_type" class="lpf-select" wire:model.defer="blood_type">
              <option value="">-- Select --</option>
              <option value="A+">A+</option><option value="A-">A-</option>
              <option value="B+">B+</option><option value="B-">B-</option>
              <option value="AB+">AB+</option><option value="AB-">AB-</option>
              <option value="O+">O+</option><option value="O-">O-</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="religion">Religion</label>
            <input id="religion" class="lpf-input" type="text" wire:model.defer="religion" placeholder="Optional">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="ethnic_group">Ethnic Group</label>
            <input id="ethnic_group" class="lpf-input" type="text" wire:model.defer="ethnic_group" placeholder="Optional">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="sex">Sex</label>
            <select id="sex" class="lpf-select" wire:model.defer="sex">
              <option value="">-- Select --</option>
              <option value="MALE">Male</option>
              <option value="FEMALE">Female</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="civil_status">Civil Status</label>
            <select id="civil_status" class="lpf-select" wire:model.defer="civil_status">
              <option value="">-- Select --</option>
              <option value="Single">Single</option>
              <option value="Separated">Separated</option>
              <option value="Cohabitation (Live-in)">Cohabitation (Live-in)</option>
              <option value="Married">Married</option>
              <option value="Widow">Widow</option>
              <option value="Widower">Widower</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="photo_1x1">1x1 Photo</label>
            <input id="photo_1x1" class="lpf-input" type="file" accept="image/*" wire:model="photo_1x1">
            <small class="lpf-help">Upload image file (jpg/png).</small>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="signature_thumbmark">Signature/Thumbmark</label>
            <input id="signature_thumbmark" class="lpf-input" type="file" accept="image/*" wire:model="signature_thumbmark">
          </div>
        </div>
      </div>

      {{-- SECTION 2 --}}
      <div class="lpf-section">
        <div class="lpf-section-title">Complete Address & Contact</div>

        <div class="lpf-grid lpf-stagger">
          <div class="lpf-field">
            <label class="lpf-label" for="house_no_street">House No. & Street</label>
            <input id="house_no_street" class="lpf-input" type="text" wire:model.defer="house_no_street">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="sitio_purok">Sitio/Purok</label>
            <input id="sitio_purok" class="lpf-input" type="text" wire:model.defer="sitio_purok">
          </div>

          {{-- ✅ UPDATED BARANGAY DROPDOWN --}}
          <div class="lpf-field">
            <label class="lpf-label" for="barangay">Barangay</label>
            <select id="barangay" class="lpf-select" wire:model.defer="barangay">
              <option value="">-- Select Barangay --</option>
              <option value="Agusan Canyon">Agusan Canyon</option>
              <option value="Alae">Alae</option>
              <option value="Dahilayan">Dahilayan</option>
              <option value="Dalirig">Dalirig</option>
              <option value="Damilag">Damilag</option>
              <option value="Diclum">Diclum</option>
              <option value="Guilang-guilang">Guilang-guilang</option>
              <option value="Kalugmanan">Kalugmanan</option>
              <option value="Lindaban">Lindaban</option>
              <option value="Lingion">Lingion</option>
              <option value="Lunocan">Lunocan</option>
              <option value="Maluko">Maluko</option>
              <option value="Mambatangan">Mambatangan</option>
              <option value="Mampayag">Mampayag</option>
              <option value="Mantibugao">Mantibugao</option>
              <option value="Minsuro">Minsuro</option>
              <option value="San Miguel">San Miguel</option>
              <option value="Sankanan">Sankanan</option>
              <option value="Santiago">Santiago</option>
              <option value="Santo Niño">Santo Niño</option>
              <option value="Tankulan">Tankulan</option>
              <option value="Ticala">Ticala</option>
            </select>
            <small class="lpf-help">Choose from the official barangay list.</small>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="municipality">Municipality</label>
            <input id="municipality" class="lpf-input" type="text" wire:model.defer="municipality">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="province">Province</label>
            <input id="province" class="lpf-input" type="text" wire:model.defer="province">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="region">Region</label>
            <input id="region" class="lpf-input" type="text" wire:model.defer="region">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="landline">Landline</label>
            <input id="landline" class="lpf-input" type="text" wire:model.defer="landline">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="mobile">Mobile</label>
            <input id="mobile" class="lpf-input" type="text" wire:model.defer="mobile" placeholder="09xxxxxxxxx">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="email">Email Address</label>
            <input id="email" class="lpf-input" type="email" wire:model.defer="email" placeholder="Optional">
          </div>
        </div>
      </div>

      {{-- SECTION 3 --}}
      <div class="lpf-section">
        <div class="lpf-section-title">Disability Information</div>

        <div class="lpf-two">
          <div class="lpf-box">
            <div class="lpf-box-title">Types of Disability</div>
            <div class="lpf-checkgrid">
              @foreach($disabilityTypeOptions as $label => $value)
                <label class="lpf-check">
                  <input type="checkbox" wire:model.defer="disability_types" value="{{ $value }}">
                  <span>{{ $label }}</span>
                </label>
              @endforeach
            </div>
          </div>

          <div class="lpf-box">
            <div class="lpf-box-title">Causes of Disability</div>

            <div class="lpf-subhead">Congenital/Inborn</div>
            <div class="lpf-checkgrid">
              @foreach($causeCongenitalOptions as $label => $value)
                <label class="lpf-check">
                  <input type="checkbox" wire:model.defer="cause_congenital" value="{{ $value }}">
                  <span>{{ $label }}</span>
                </label>
              @endforeach

              <div class="lpf-field lpf-field-inline">
                <label class="lpf-label">Others, specify</label>
                <input class="lpf-input" type="text" wire:model.defer="cause_congenital_other">
              </div>
            </div>

            <div class="lpf-subhead" style="margin-top:10px;">Acquired</div>
            <div class="lpf-checkgrid">
              @foreach($causeAcquiredOptions as $label => $value)
                <label class="lpf-check">
                  <input type="checkbox" wire:model.defer="cause_acquired" value="{{ $value }}">
                  <span>{{ $label }}</span>
                </label>
              @endforeach

              <div class="lpf-field lpf-field-inline">
                <label class="lpf-label">Others, specify</label>
                <input class="lpf-input" type="text" wire:model.defer="cause_acquired_other">
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- SECTION 4 --}}
      <div class="lpf-section">
        <div class="lpf-section-title">Education & Employment</div>

        <div class="lpf-grid lpf-stagger">
          <div class="lpf-field">
            <label class="lpf-label" for="education_level">Educational Attainment</label>
            <select id="education_level" class="lpf-select" wire:model.defer="education_level">
              <option value="">-- Select --</option>
              <option value="None">None</option>
              <option value="Kindergarten">Kindergarten</option>
              <option value="Elementary">Elementary</option>
              <option value="Junior High School">Junior High School</option>
              <option value="Senior High">Senior High</option>
              <option value="College">College</option>
              <option value="Vocational">Vocational</option>
              <option value="Post Graduate">Post Graduate</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="employment_status">Status of Employment</label>
            <select id="employment_status" class="lpf-select" wire:model.defer="employment_status">
              <option value="">-- Select --</option>
              <option value="Employed">Employed</option>
              <option value="Unemployed">Unemployed</option>
              <option value="Self-employed">Self-employed</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="employment_category">Category of Employment</label>
            <select id="employment_category" class="lpf-select" wire:model.defer="employment_category">
              <option value="">-- Select --</option>
              <option value="Government">Government</option>
              <option value="Private">Private</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="specific_occupation">Specific Occupation</label>
            <input id="specific_occupation" class="lpf-input" type="text" wire:model.defer="specific_occupation">
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="employment_type">Types of Employment</label>
            <select id="employment_type" class="lpf-select" wire:model.defer="employment_type">
              <option value="">-- Select --</option>
              <option value="Permanent">Permanent</option>
              <option value="Seasonal">Seasonal</option>
              <option value="Contractual">Contractual</option>
              <option value="Job Order">Job Order</option>
              <option value="On Call">On Call</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="registered_voter">Registered Voter</label>
            <select id="registered_voter" class="lpf-select" wire:model.defer="registered_voter">
              <option value="">-- Select --</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="special_skills">Special Skills</label>
            <textarea id="special_skills" class="lpf-textarea" rows="3" wire:model.defer="special_skills"></textarea>
          </div>

          <div class="lpf-field">
            <label class="lpf-label" for="sporting_talent">Sporting Talent</label>
            <textarea id="sporting_talent" class="lpf-textarea" rows="3" wire:model.defer="sporting_talent"></textarea>
          </div>
        </div>
      </div>

      {{-- SECTION 5 --}}
      <div class="lpf-section">
        <div class="lpf-section-title">Organization & ID References</div>

        <div class="lpf-grid lpf-stagger">
          <div class="lpf-field">
            <label class="lpf-label">PWD Organization Affiliated?</label>
            <select class="lpf-select" wire:model.defer="pwd_org_affiliated">
              <option value="">-- Select --</option>
              <option value="1">Yes</option>
              <option value="0">No</option>
            </select>
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Contact Person</label>
            <input class="lpf-input" type="text" wire:model.defer="org_contact_person">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Office Address</label>
            <input class="lpf-input" type="text" wire:model.defer="org_office_address">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Tel./Mobile</label>
            <input class="lpf-input" type="text" wire:model.defer="org_tel_mobile">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">PWD ID No.</label>
            <input class="lpf-input" type="text" wire:model.defer="pwd_id_no">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">ID Reference No.</label>
            <input class="lpf-input" type="text" wire:model.defer="id_reference_no">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">SSS No.</label>
            <input class="lpf-input" type="text" wire:model.defer="sss_no">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">GSIS No.</label>
            <input class="lpf-input" type="text" wire:model.defer="gsis_no">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">PAG-IBIG No.</label>
            <input class="lpf-input" type="text" wire:model.defer="pagibig_no">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">PHN No.</label>
            <input class="lpf-input" type="text" wire:model.defer="phn_no">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">PhilHealth No.</label>
            <input class="lpf-input" type="text" wire:model.defer="philhealth_no">
          </div>
        </div>
      </div>

      {{-- SECTION 6 --}}
      <div class="lpf-section">
        <div class="lpf-section-title">Household Membership</div>

        <div class="lpf-tablewrap">
          <table class="lpf-table">
            <thead>
              <tr>
                <th>Name</th>
                <th>DOB</th>
                <th>Civil Status</th>
                <th>Educational Attainment</th>
                <th>Relationship to PWD</th>
                <th>Occupation</th>
                <th>Social Pension Affiliation</th>
                <th>Monthly Income</th>
                <th></th>
              </tr>
            </thead>

            <tbody>
              @foreach($household_members as $i => $row)
                @php $key = $row['_key'] ?? ('row-'.$i); @endphp
                <tr wire:key="household-{{ $key }}">
                  <td><input class="lpf-input lpf-input-sm" type="text" wire:model.defer="household_members.{{ $i }}.name"></td>
                  <td><input class="lpf-input lpf-input-sm" type="date" wire:model.defer="household_members.{{ $i }}.date_of_birth"></td>
                  <td><input class="lpf-input lpf-input-sm" type="text" wire:model.defer="household_members.{{ $i }}.civil_status"></td>
                  <td><input class="lpf-input lpf-input-sm" type="text" wire:model.defer="household_members.{{ $i }}.educational_attainment"></td>
                  <td><input class="lpf-input lpf-input-sm" type="text" wire:model.defer="household_members.{{ $i }}.relationship_to_pwd"></td>
                  <td><input class="lpf-input lpf-input-sm" type="text" wire:model.defer="household_members.{{ $i }}.occupation"></td>
                  <td><input class="lpf-input lpf-input-sm" type="text" wire:model.defer="household_members.{{ $i }}.social_pension_affiliation"></td>
                  <td><input class="lpf-input lpf-input-sm" type="number" step="0.01" wire:model.defer="household_members.{{ $i }}.monthly_income"></td>
                  <td>
                    <button type="button" class="lpf-mini lpf-mini-danger" wire:click="removeHouseholdMember({{ $i }})">
                      Remove
                    </button>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        <div style="margin-top:10px; display:flex; gap:10px; align-items:flex-end;">
          <button type="button" class="lpf-mini" wire:click="addHouseholdMember">
            + Add Member
          </button>

          <div class="lpf-field" style="max-width:260px;">
            <label class="lpf-label">Total Family Income</label>
            <input class="lpf-input" type="number" step="0.01" wire:model.defer="total_family_income">
          </div>
        </div>
      </div>

      {{-- SECTION 7 --}}
      <div class="lpf-section">
        <div class="lpf-section-title">Interview / Accomplishment / Approval</div>

        <div class="lpf-grid lpf-stagger">
          <div class="lpf-field">
            <label class="lpf-label">Name of Interviewee</label>
            <input class="lpf-input" type="text" wire:model.defer="interviewee_name">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Relationship to PWD</label>
            <input class="lpf-input" type="text" wire:model.defer="interviewee_relationship">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Interviewee Signature/Thumbmark (Image)</label>
            <input class="lpf-input" type="file" accept="image/*" wire:model="interviewee_signature_thumbmark">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Accomplished By (Name)</label>
            <input class="lpf-input" type="text" wire:model.defer="accomplished_by_name">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Position</label>
            <input class="lpf-input" type="text" wire:model.defer="accomplished_by_position">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Reporting Unit (Office/Section)</label>
            <input class="lpf-input" type="text" wire:model.defer="reporting_unit_office_section">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Approved By (C/MSWDO/PDAO/MAYOR)</label>
            <input class="lpf-input" type="text" wire:model.defer="approved_by">
          </div>

          <div class="lpf-field">
            <label class="lpf-label">Approved Signature (Image)</label>
            <input class="lpf-input" type="file" accept="image/*" wire:model="approved_signature">
          </div>
        </div>
      </div>

      <div class="lpf-actions">
        <a href="{{ route('staff.dashboard') }}" class="lpf-btn lpf-btn-ghost">Cancel</a>
        <button type="submit" class="lpf-btn lpf-btn-primary">Save Form</button>
      </div>

    </form>
  </div>
</div>