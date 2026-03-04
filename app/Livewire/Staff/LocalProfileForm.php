<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LocalProfileForm extends Component
{
    use WithFileUploads;

    // ---------- main fields ----------
    public $ldr_number, $profiling_date;

    public $last_name, $first_name, $middle_name, $suffix;
    public $date_of_birth;

    public $blood_type, $religion, $ethnic_group, $sex, $civil_status;

    public $house_no_street, $sitio_purok, $barangay, $municipality, $province, $region;
    public $landline, $mobile, $email;

    public $education_level, $employment_status, $employment_category, $specific_occupation, $employment_type, $registered_voter;
    public $special_skills, $sporting_talent;

    public $pwd_org_affiliated, $org_contact_person, $org_office_address, $org_tel_mobile;

    public $pwd_id_no, $id_reference_no, $sss_no, $gsis_no, $pagibig_no, $phn_no, $philhealth_no;

    public $total_family_income;
    public $interviewee_name, $interviewee_relationship;

    public $accomplished_by_name, $accomplished_by_position;
    public $reporting_unit_office_section;
    public $approved_by;

    // ✅ age UI only
    public $age = '';

    // ---------- uploads ----------
    public $photo_1x1;
    public $signature_thumbmark;
    public $interviewee_signature_thumbmark;
    public $approved_signature;

    // ---------- disability checkboxes ----------
    public $disability_types = [];
    public $cause_congenital = [];
    public $cause_acquired = [];
    public $cause_congenital_other = '';
    public $cause_acquired_other = '';

    // ---------- household ----------
    public $household_members = [];

    // ✅ options holders (so blade has data)
    public $disabilityTypeOptions = [];
    public $causeCongenitalOptions = [];
    public $causeAcquiredOptions = [];

    public function mount()
    {
        // init household
        $this->household_members = [$this->blankHouseholdRow()];

        // load options
        $this->disabilityTypeOptions = $this->getDisabilityTypeOptionsProperty();
        $this->causeCongenitalOptions = $this->getCauseCongenitalOptionsProperty();
        $this->causeAcquiredOptions = $this->getCauseAcquiredOptionsProperty();

        // init age
        $this->age = $this->computeAge($this->date_of_birth);
    }

    private function blankHouseholdRow(): array
    {
        return [
            '_key' => (string) Str::uuid(),
            'name' => '',
            'date_of_birth' => null,
            'civil_status' => '',
            'educational_attainment' => '',
            'relationship_to_pwd' => '',
            'occupation' => '',
            'social_pension_affiliation' => '',
            'monthly_income' => null,
        ];
    }

    // ✅ auto compute age
    public function updatedDateOfBirth($value)
    {
        $this->age = $this->computeAge($value);
    }

    private function computeAge($dob)
    {
        if (!$dob) return '';

        try {
            return Carbon::parse($dob)->age;
        } catch (\Throwable $e) {
            return '';
        }
    }

    public function addHouseholdMember()
    {
        $this->household_members[] = $this->blankHouseholdRow();
    }

    public function removeHouseholdMember($index)
    {
        if (!isset($this->household_members[$index])) return;

        unset($this->household_members[$index]);
        $this->household_members = array_values($this->household_members);

        if (count($this->household_members) === 0) {
            $this->household_members[] = $this->blankHouseholdRow();
        }
    }

    public function rules()
    {
        return [
            'ldr_number' => ['nullable','string','max:50', Rule::unique('local_profiles','ldr_number')],
            'profiling_date' => ['nullable','date'],

            'last_name' => ['required','string','max:100'],
            'first_name' => ['required','string','max:100'],
            'middle_name' => ['nullable','string','max:100'],
            'suffix' => ['nullable','string','max:20'],

            'date_of_birth' => ['nullable','date'],
            'blood_type' => ['nullable', Rule::in(['A+','A-','B+','B-','AB+','AB-','O+','O-'])],
            'religion' => ['nullable','string','max:100'],
            'ethnic_group' => ['nullable','string','max:100'],
            'sex' => ['nullable', Rule::in(['MALE','FEMALE'])],
            'civil_status' => ['nullable', Rule::in(['Single','Separated','Cohabitation (Live-in)','Married','Widow','Widower'])],

            'house_no_street' => ['nullable','string','max:200'],
            'sitio_purok' => ['nullable','string','max:100'],
            'barangay' => ['nullable','string','max:100'],
            'municipality' => ['nullable','string','max:100'],
            'province' => ['nullable','string','max:100'],
            'region' => ['nullable','string','max:100'],

            'landline' => ['nullable','string','max:50'],
            'mobile' => ['nullable','string','max:50'],
            'email' => ['nullable','email','max:150'],

            'education_level' => ['nullable', Rule::in(['None','Kindergarten','Elementary','Junior High School','Senior High','College','Vocational','Post Graduate'])],
            'employment_status' => ['nullable', Rule::in(['Employed','Unemployed','Self-employed'])],
            'employment_category' => ['nullable', Rule::in(['Government','Private'])],
            'specific_occupation' => ['nullable','string','max:150'],
            'employment_type' => ['nullable', Rule::in(['Permanent','Seasonal','Contractual','Job Order','On Call'])],
            'registered_voter' => ['nullable', Rule::in(['1','0',1,0])],

            'special_skills' => ['nullable','string'],
            'sporting_talent' => ['nullable','string'],

            'pwd_org_affiliated' => ['nullable', Rule::in(['1','0',1,0])],
            'org_contact_person' => ['nullable','string','max:150'],
            'org_office_address' => ['nullable','string','max:255'],
            'org_tel_mobile' => ['nullable','string','max:80'],

            'pwd_id_no' => ['nullable','string','max:30'],
            'id_reference_no' => ['nullable','string','max:80'],
            'sss_no' => ['nullable','string','max:30'],
            'gsis_no' => ['nullable','string','max:30'],
            'pagibig_no' => ['nullable','string','max:30'],
            'phn_no' => ['nullable','string','max:30'],
            'philhealth_no' => ['nullable','string','max:30'],

            'total_family_income' => ['nullable','numeric','min:0'],

            'interviewee_name' => ['nullable','string','max:150'],
            'interviewee_relationship' => ['nullable','string','max:100'],

            'accomplished_by_name' => ['nullable','string','max:150'],
            'accomplished_by_position' => ['nullable','string','max:100'],
            'reporting_unit_office_section' => ['nullable','string','max:150'],
            'approved_by' => ['nullable','string','max:150'],

            'photo_1x1' => ['nullable','image','max:2048'],
            'signature_thumbmark' => ['nullable','image','max:2048'],
            'interviewee_signature_thumbmark' => ['nullable','image','max:2048'],
            'approved_signature' => ['nullable','image','max:2048'],

            'household_members' => ['array'],
            'household_members.*._key' => ['nullable','string'],
            'household_members.*.name' => ['nullable','string','max:150'],
            'household_members.*.date_of_birth' => ['nullable','date'],
            'household_members.*.civil_status' => ['nullable','string','max:80'],
            'household_members.*.educational_attainment' => ['nullable','string','max:120'],
            'household_members.*.relationship_to_pwd' => ['nullable','string','max:120'],
            'household_members.*.occupation' => ['nullable','string','max:150'],
            'household_members.*.social_pension_affiliation' => ['nullable','string','max:120'],
            'household_members.*.monthly_income' => ['nullable','numeric','min:0'],
        ];
    }

    public function save()
    {
        $this->validate();

        DB::transaction(function () {

            $photoPath    = $this->photo_1x1 ? $this->photo_1x1->store('local_profiles/photos', 'public') : null;
            $signPath     = $this->signature_thumbmark ? $this->signature_thumbmark->store('local_profiles/signatures', 'public') : null;
            $intSignPath  = $this->interviewee_signature_thumbmark ? $this->interviewee_signature_thumbmark->store('local_profiles/interviewee_sign', 'public') : null;
            $apprSignPath = $this->approved_signature ? $this->approved_signature->store('local_profiles/approved_sign', 'public') : null;

            $profileId = DB::table('local_profiles')->insertGetId([
                'ldr_number' => $this->ldr_number,
                'profiling_date' => $this->profiling_date,
                'photo_1x1' => $photoPath,

                'last_name' => $this->last_name,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'suffix' => $this->suffix,

                'date_of_birth' => $this->date_of_birth,
                'blood_type' => $this->blood_type,
                'religion' => $this->religion,
                'ethnic_group' => $this->ethnic_group,
                'sex' => $this->sex,
                'civil_status' => $this->civil_status,

                'signature_thumbmark' => $signPath,

                'house_no_street' => $this->house_no_street,
                'sitio_purok' => $this->sitio_purok,
                'barangay' => $this->barangay,
                'municipality' => $this->municipality,
                'province' => $this->province,
                'region' => $this->region,

                'landline' => $this->landline,
                'mobile' => $this->mobile,
                'email' => $this->email,

                'education_level' => $this->education_level,

                'employment_status' => $this->employment_status,
                'employment_category' => $this->employment_category,
                'specific_occupation' => $this->specific_occupation,
                'employment_type' => $this->employment_type,
                'registered_voter' => ($this->registered_voter === '' || $this->registered_voter === null) ? null : (int) $this->registered_voter,

                'special_skills' => $this->special_skills,
                'sporting_talent' => $this->sporting_talent,

                'pwd_org_affiliated' => ($this->pwd_org_affiliated === '' || $this->pwd_org_affiliated === null) ? null : (int) $this->pwd_org_affiliated,
                'org_contact_person' => $this->org_contact_person,
                'org_office_address' => $this->org_office_address,
                'org_tel_mobile' => $this->org_tel_mobile,

                'pwd_id_no' => $this->pwd_id_no,
                'id_reference_no' => $this->id_reference_no,
                'sss_no' => $this->sss_no,
                'gsis_no' => $this->gsis_no,
                'pagibig_no' => $this->pagibig_no,
                'phn_no' => $this->phn_no,
                'philhealth_no' => $this->philhealth_no,

                'total_family_income' => $this->total_family_income,

                'interviewee_name' => $this->interviewee_name,
                'interviewee_relationship' => $this->interviewee_relationship,
                'interviewee_signature_thumbmark' => $intSignPath,

                'accomplished_by_name' => $this->accomplished_by_name,
                'accomplished_by_position' => $this->accomplished_by_position,
                'reporting_unit_office_section' => $this->reporting_unit_office_section,

                'approved_by' => $this->approved_by,
                'approved_signature' => $apprSignPath,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // disability types pivot
            if (!empty($this->disability_types)) {
                $typeIds = DB::table('disability_types')
                    ->whereIn('name', $this->disability_types)
                    ->pluck('id')
                    ->all();

                $rows = [];
                foreach ($typeIds as $tid) {
                    $rows[] = [
                        'local_profile_id' => $profileId,
                        'disability_type_id' => $tid
                    ];
                }
                if ($rows) DB::table('local_profile_disability_types')->insert($rows);
            }

            // disability causes pivot
            $this->insertCauses($profileId, 'CONGENITAL/INBORN', $this->cause_congenital, $this->cause_congenital_other);
            $this->insertCauses($profileId, 'ACQUIRED', $this->cause_acquired, $this->cause_acquired_other);

            // household members
            $hmRows = [];
            foreach ($this->household_members as $row) {

                $name = trim((string)($row['name'] ?? ''));
                $dob = $row['date_of_birth'] ?? null;
                $civil = trim((string)($row['civil_status'] ?? ''));
                $edu = trim((string)($row['educational_attainment'] ?? ''));
                $rel = trim((string)($row['relationship_to_pwd'] ?? ''));
                $occ = trim((string)($row['occupation'] ?? ''));
                $spa = trim((string)($row['social_pension_affiliation'] ?? ''));
                $income = $row['monthly_income'] ?? null;

                $anyFilled = ($name !== '')
                    || ($dob !== null && $dob !== '')
                    || ($civil !== '')
                    || ($edu !== '')
                    || ($rel !== '')
                    || ($occ !== '')
                    || ($spa !== '')
                    || ($income !== null && $income !== '');

                if (!$anyFilled) continue;

                $hmRows[] = [
                    'local_profile_id' => $profileId,
                    'name' => $name !== '' ? $name : 'N/A',
                    'date_of_birth' => $dob ?: null,
                    'civil_status' => $civil ?: null,
                    'educational_attainment' => $edu ?: null,
                    'relationship_to_pwd' => $rel ?: null,
                    'occupation' => $occ ?: null,
                    'social_pension_affiliation' => $spa ?: null,
                    'monthly_income' => ($income === '' ? null : $income),
                    // ✅ schema mo: household_members has only created_at
                    'created_at' => now(),
                ];
            }

            if ($hmRows) DB::table('household_members')->insert($hmRows);
        });

        session()->flash('success', 'Local Profile Form saved successfully.');

        $this->reset();
        $this->mount();
    }

    private function insertCauses($profileId, $category, $names, $otherText)
    {
        $otherText = trim((string)$otherText);

        if (empty($names) && $otherText === '') return;

        $causeIds = [];
        if (!empty($names)) {
            $causeIds = DB::table('disability_causes')
                ->where('category', $category)
                ->whereIn('name', $names)
                ->pluck('id')
                ->all();
        }

        $rows = [];
        foreach ($causeIds as $cid) {
            $rows[] = [
                'local_profile_id' => $profileId,
                'disability_cause_id' => $cid,
                'other_specify' => null,
            ];
        }

        if ($otherText !== '') {
            $otherId = DB::table('disability_causes')
                ->where('category', $category)
                ->where('name', 'Others')
                ->value('id');

            if ($otherId) {
                $rows[] = [
                    'local_profile_id' => $profileId,
                    'disability_cause_id' => $otherId,
                    'other_specify' => $otherText,
                ];
            }
        }

        if ($rows) DB::table('local_profile_disability_causes')->insert($rows);
    }

    // computed options
    public function getDisabilityTypeOptionsProperty()
    {
        return [
            'Deaf or Hard of Hearing' => 'Deaf or Hard of Hearing',
            'Intellectual Disability' => 'Intellectual Disability',
            'Learning Disability' => 'Learning Disability',
            'Mental Disability' => 'Mental Disability',
            'Physical Disability' => 'Physical Disability',
            'Multiple Disability' => 'Multiple Disability',
            'Psychosocial Disability' => 'Psychosocial Disability',
            'Speech & Language Impairment' => 'Speech & Language Impairment',
            'Visual Disability' => 'Visual Disability',
            'Cancer (RA 11215)' => 'Cancer (RA 11215)',
            'Rare Disease (RA 10747)' => 'Rare Disease (RA 10747)',
        ];
    }

    public function getCauseCongenitalOptionsProperty()
    {
        return [
            'Autism' => 'Autism',
            'ADHD' => 'ADHD',
            'Cerebral Palsy' => 'Cerebral Palsy',
            'Down Syndrome' => 'Down Syndrome',
        ];
    }

    public function getCauseAcquiredOptionsProperty()
    {
        return [
            'Chronic Illness' => 'Chronic Illness',
            'Cerebral Palsy' => 'Cerebral Palsy',
            'Injury' => 'Injury',
        ];
    }

    public function render()
    {
        return view('livewire.staff.local-profile-form', [
            'disabilityTypeOptions'   => $this->disabilityTypeOptions,
            'causeCongenitalOptions'  => $this->causeCongenitalOptions,
            'causeAcquiredOptions'    => $this->causeAcquiredOptions,
        ]);
    }
}