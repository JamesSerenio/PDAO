<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class LocalProfileForm extends Component
{
    use WithFileUploads;

    public $ldr_number, $profiling_date, $last_name, $first_name, $middle_name, $suffix;
    public $date_of_birth, $blood_type, $religion, $ethnic_group, $sex, $civil_status;
    public $photo_1x1, $signature_thumbmark;

    public $house_no_street, $sitio_purok, $barangay, $municipality, $province, $region;
    public $landline, $mobile, $email;

    public $disability_types = [];
    public $cause_congenital = [];
    public $cause_acquired = [];
    public $cause_congenital_other, $cause_acquired_other;

    public $education_level, $employment_status, $employment_category, $specific_occupation, $employment_type;
    public $registered_voter, $special_skills, $sporting_talent;

    public $pwd_org_affiliated, $org_contact_person, $org_office_address, $org_tel_mobile;
    public $pwd_id_no, $id_reference_no, $sss_no, $gsis_no, $pagibig_no, $phn_no, $philhealth_no;

    public $household_members = [];
    public $total_family_income = 0;

    public $interviewee_name, $interviewee_relationship, $interviewee_signature_thumbmark;
    public $accomplished_by_name, $accomplished_by_position, $accomplished_signature;
    public $reporting_unit_office_section, $approved_by, $approved_signature;

    public function mount()
    {
        if (empty($this->household_members)) {
            $this->household_members[] = [
                '_key' => uniqid(),
                'name' => '',
                'date_of_birth' => '',
                'civil_status' => '',
                'educational_attainment' => '',
                'relationship_to_pwd' => '',
                'occupation' => '',
                'social_pension_affiliation' => '',
                'monthly_income' => '',
            ];
        }
    }

    public function getAgeProperty()
    {
        if (!$this->date_of_birth) return null;

        try {
            return Carbon::parse($this->date_of_birth)->age;
        } catch (\Throwable $e) {
            return null;
        }
    }

    public function addHouseholdMember()
    {
        $this->household_members[] = [
            '_key' => uniqid(),
            'name' => '',
            'date_of_birth' => '',
            'civil_status' => '',
            'educational_attainment' => '',
            'relationship_to_pwd' => '',
            'occupation' => '',
            'social_pension_affiliation' => '',
            'monthly_income' => '',
        ];

        $this->recomputeFamilyIncome();
    }

    public function removeHouseholdMember($index)
    {
        unset($this->household_members[$index]);
        $this->household_members = array_values($this->household_members);
        $this->recomputeFamilyIncome();
    }

    public function updatedHouseholdMembers()
    {
        $this->recomputeFamilyIncome();
    }

    public function recomputeFamilyIncome()
    {
        $total = 0;
        foreach ($this->household_members as $member) {
            $total += (float)($member['monthly_income'] ?? 0);
        }
        $this->total_family_income = number_format($total, 2, '.', '');
    }

    public function save()
    {
        $this->validate([
            'last_name' => 'required|string|max:100',
            'first_name' => 'required|string|max:100',
            'date_of_birth' => 'nullable|date',
            'sex' => 'nullable|in:MALE,FEMALE',
            'email' => 'nullable|email',
            'photo_1x1' => 'nullable|image|max:2048',
            'signature_thumbmark' => 'nullable|image|max:2048',
            'interviewee_signature_thumbmark' => 'nullable|image|max:2048',
            'accomplished_signature' => 'nullable|image|max:2048',
            'approved_signature' => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();

        try {
            $photoPath = $this->photo_1x1 ? $this->photo_1x1->store('local_profiles/photos', 'public') : null;
            $sigPath = $this->signature_thumbmark ? $this->signature_thumbmark->store('local_profiles/signatures', 'public') : null;
            $interviewSigPath = $this->interviewee_signature_thumbmark ? $this->interviewee_signature_thumbmark->store('local_profiles/interviewee_signatures', 'public') : null;
            $accomplishedSigPath = $this->accomplished_signature ? $this->accomplished_signature->store('local_profiles/accomplished_signatures', 'public') : null;
            $approvedSigPath = $this->approved_signature ? $this->approved_signature->store('local_profiles/approved_signatures', 'public') : null;

            $localProfileId = DB::table('local_profiles')->insertGetId([
                'ldr_number' => $this->ldr_number,
                'profiling_date' => $this->profiling_date ?: null,
                'last_name' => $this->last_name,
                'first_name' => $this->first_name,
                'middle_name' => $this->middle_name,
                'suffix' => $this->suffix,
                'date_of_birth' => $this->date_of_birth ?: null,
                'blood_type' => $this->blood_type,
                'religion' => $this->religion,
                'ethnic_group' => $this->ethnic_group,
                'sex' => $this->sex,
                'civil_status' => $this->civil_status,
                'photo_1x1' => $photoPath,
                'signature_thumbmark' => $sigPath,

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
                'registered_voter' => $this->registered_voter,
                'special_skills' => $this->special_skills,
                'sporting_talent' => $this->sporting_talent,

                'pwd_org_affiliated' => $this->pwd_org_affiliated,
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

                'total_family_income' => $this->total_family_income ?: 0,

                'interviewee_name' => $this->interviewee_name,
                'interviewee_relationship' => $this->interviewee_relationship,
                'interviewee_signature_thumbmark' => $interviewSigPath,

                'accomplished_by_name' => $this->accomplished_by_name,
                'accomplished_by_position' => $this->accomplished_by_position,
                'accomplished_signature' => $accomplishedSigPath,
                'reporting_unit_office_section' => $this->reporting_unit_office_section,
                'approved_by' => $this->approved_by,
                'approved_signature' => $approvedSigPath,

                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($this->household_members as $member) {
                $hasValue =
                    !empty($member['name']) ||
                    !empty($member['date_of_birth']) ||
                    !empty($member['civil_status']) ||
                    !empty($member['educational_attainment']) ||
                    !empty($member['relationship_to_pwd']) ||
                    !empty($member['occupation']) ||
                    !empty($member['social_pension_affiliation']) ||
                    !empty($member['monthly_income']);

                if (!$hasValue) {
                    continue;
                }

                DB::table('household_members')->insert([
                    'local_profile_id' => $localProfileId,
                    'name' => $member['name'] ?? null,
                    'date_of_birth' => $member['date_of_birth'] ?? null,
                    'civil_status' => $member['civil_status'] ?? null,
                    'educational_attainment' => $member['educational_attainment'] ?? null,
                    'relationship_to_pwd' => $member['relationship_to_pwd'] ?? null,
                    'occupation' => $member['occupation'] ?? null,
                    'social_pension_affiliation' => $member['social_pension_affiliation'] ?? null,
                    'monthly_income' => $member['monthly_income'] !== '' ? $member['monthly_income'] : null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            DB::commit();

            $age = null;
            if ($this->date_of_birth) {
                $age = Carbon::parse($this->date_of_birth)->age;
            }

            // DITO ANG IMPORTANTE
            if ($age !== null && $age >= 60) {
                session()->flash('success', 'Senior citizen record saved successfully.');
                return redirect()->route('admin.senior_citizens');
            }

            session()->flash('success', 'PWD profile saved successfully.');
            return redirect()->route('admin.local_profile_form');

        } catch (\Throwable $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to save profile: ' . $e->getMessage());
            return;
        }
    }

    public function render()
    {
        return view('livewire.admin.local-profile-form', [
            'age' => $this->age,
            'disabilityTypeOptions' => [],
            'causeCongenitalOptions' => [],
            'causeAcquiredOptions' => [],
        ]);
    }
}