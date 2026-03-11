<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class adminRegisteredController extends Controller
{
    public function update(Request $request, int $id)
    {
        $normalizeDecimal = function ($value) {
            if ($value === null) return null;
            $v = trim((string) $value);
            if ($v === '') return null;
            $v = str_replace(',', '', $v);
            return is_numeric($v) ? $v : null;
        };

        $toNull = function ($value) {
            if ($value === null) return null;
            $v = trim((string) $value);
            return $v === '' ? null : $v;
        };

        $data = $request->validate([
            'ldr_number'     => ['nullable', 'string', 'max:50'],
            'profiling_date' => ['nullable', 'date'],

            'last_name'   => ['required', 'string', 'max:100'],
            'first_name'  => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'suffix'      => ['nullable', 'string', 'max:20'],

            'date_of_birth' => ['nullable', 'date'],
            'sex'           => ['nullable', Rule::in(['MALE', 'FEMALE'])],
            'blood_type'    => ['nullable', Rule::in(['A+','A-','B+','B-','AB+','AB-','O+','O-'])],

            'religion'      => ['nullable', 'string', 'max:100'],
            'ethnic_group'  => ['nullable', 'string', 'max:100'],
            'civil_status'  => ['nullable', 'string', 'max:50'],

            'house_no_street' => ['nullable', 'string', 'max:200'],
            'sitio_purok'     => ['nullable', 'string', 'max:100'],
            'barangay'        => ['nullable', 'string', 'max:100'],
            'municipality'    => ['nullable', 'string', 'max:100'],
            'province'        => ['nullable', 'string', 'max:100'],
            'region'          => ['nullable', 'string', 'max:100'],

            'landline' => ['nullable', 'string', 'max:50'],
            'mobile'   => ['nullable', 'string', 'max:50'],
            'email'    => ['nullable', 'email', 'max:150'],

            'education_level'     => ['nullable', 'string', 'max:50'],
            'employment_status'   => ['nullable', 'string', 'max:50'],
            'employment_category' => ['nullable', 'string', 'max:50'],
            'specific_occupation' => ['nullable', 'string', 'max:150'],
            'employment_type'     => ['nullable', 'string', 'max:50'],

            'registered_voter' => ['nullable', Rule::in(['1', '0', 1, 0])],

            'special_skills'  => ['nullable', 'string'],
            'sporting_talent' => ['nullable', 'string'],

            'pwd_org_affiliated' => ['nullable', 'string', 'max:150'],
            'org_contact_person' => ['nullable', 'string', 'max:150'],
            'org_office_address' => ['nullable', 'string', 'max:255'],
            'org_tel_mobile'     => ['nullable', 'string', 'max:80'],

            'pwd_id_no'       => ['nullable', 'string', 'max:30'],
            'id_reference_no' => ['nullable', 'string', 'max:80'],
            'sss_no'          => ['nullable', 'string', 'max:30'],
            'gsis_no'         => ['nullable', 'string', 'max:30'],
            'pagibig_no'      => ['nullable', 'string', 'max:30'],
            'phn_no'          => ['nullable', 'string', 'max:30'],
            'philhealth_no'   => ['nullable', 'string', 'max:30'],

            'total_family_income'           => ['nullable'],
            'interviewee_name'              => ['nullable', 'string', 'max:150'],
            'interviewee_relationship'      => ['nullable', 'string', 'max:100'],
            'accomplished_by_name'          => ['nullable', 'string', 'max:150'],
            'accomplished_by_position'      => ['nullable', 'string', 'max:100'],
            'reporting_unit_office_section' => ['nullable', 'string', 'max:150'],
            'approved_by'                   => ['nullable', 'string', 'max:150'],

            'photo_1x1'                        => ['nullable', 'image', 'max:2048'],
            'signature_thumbmark'             => ['nullable', 'image', 'max:2048'],
            'interviewee_signature_thumbmark' => ['nullable', 'image', 'max:2048'],
            'approved_signature'              => ['nullable', 'image', 'max:2048'],

            'disability_types'   => ['nullable', 'array'],
            'disability_types.*' => ['integer'],

            'disability_causes'   => ['nullable', 'array'],
            'disability_causes.*' => ['integer'],

            'cause_other' => ['nullable', 'array'],

            'member_id'           => ['nullable', 'array'],
            'member_name'         => ['nullable', 'array'],
            'member_dob'          => ['nullable', 'array'],
            'member_civil_status' => ['nullable', 'array'],
            'member_education'    => ['nullable', 'array'],
            'member_relationship' => ['nullable', 'array'],
            'member_occupation'   => ['nullable', 'array'],
            'member_pension'      => ['nullable', 'array'],
            'member_income'       => ['nullable', 'array'],
            'member_delete'       => ['nullable', 'array'],
        ]);

        $redirectTo = $request->input('_redirect');
        if (!$redirectTo) {
            $redirectTo = url('/admin/registered') . '?' . http_build_query([
                'open' => $id,
                'editMode' => 0,
            ]);
        }

        DB::transaction(function () use ($request, $id, $data, $normalizeDecimal, $toNull) {
            $old = DB::table('local_profiles')->where('id', $id)->first();

            $updates = $data;

            $updates['registered_voter'] = ($request->input('registered_voter') === '' || $request->input('registered_voter') === null)
                ? null
                : (int) $request->input('registered_voter');

            $updates['total_family_income'] = $normalizeDecimal($request->input('total_family_income'));

            foreach ([
                'ldr_number','middle_name','suffix','religion','ethnic_group','civil_status',
                'house_no_street','sitio_purok','barangay','municipality','province','region',
                'landline','mobile','email',
                'education_level','employment_status','employment_category','specific_occupation','employment_type',
                'special_skills','sporting_talent',
                'pwd_org_affiliated','org_contact_person','org_office_address','org_tel_mobile',
                'pwd_id_no','id_reference_no','sss_no','gsis_no','pagibig_no','phn_no','philhealth_no',
                'interviewee_name','interviewee_relationship',
                'accomplished_by_name','accomplished_by_position','reporting_unit_office_section','approved_by',
            ] as $k) {
                if (array_key_exists($k, $updates)) {
                    $updates[$k] = $toNull($updates[$k]);
                }
            }

            if ($request->hasFile('photo_1x1')) {
                $path = $request->file('photo_1x1')->store('local_profiles/photos', 'public');
                $updates['photo_1x1'] = $path;

                if ($old && $old->photo_1x1) {
                    Storage::disk('public')->delete($old->photo_1x1);
                }
            } else {
                unset($updates['photo_1x1']);
            }

            if ($request->hasFile('signature_thumbmark')) {
                $path = $request->file('signature_thumbmark')->store('local_profiles/signatures', 'public');
                $updates['signature_thumbmark'] = $path;

                if ($old && $old->signature_thumbmark) {
                    Storage::disk('public')->delete($old->signature_thumbmark);
                }
            } else {
                unset($updates['signature_thumbmark']);
            }

            if ($request->hasFile('interviewee_signature_thumbmark')) {
                $path = $request->file('interviewee_signature_thumbmark')->store('local_profiles/interviewee_sign', 'public');
                $updates['interviewee_signature_thumbmark'] = $path;

                if ($old && $old->interviewee_signature_thumbmark) {
                    Storage::disk('public')->delete($old->interviewee_signature_thumbmark);
                }
            } else {
                unset($updates['interviewee_signature_thumbmark']);
            }

            if ($request->hasFile('approved_signature')) {
                $path = $request->file('approved_signature')->store('local_profiles/approved_sign', 'public');
                $updates['approved_signature'] = $path;

                if ($old && $old->approved_signature) {
                    Storage::disk('public')->delete($old->approved_signature);
                }
            } else {
                unset($updates['approved_signature']);
            }

            unset(
                $updates['disability_types'],
                $updates['disability_causes'],
                $updates['cause_other'],
                $updates['member_id'],
                $updates['member_name'],
                $updates['member_dob'],
                $updates['member_civil_status'],
                $updates['member_education'],
                $updates['member_relationship'],
                $updates['member_occupation'],
                $updates['member_pension'],
                $updates['member_income'],
                $updates['member_delete']
            );

            $updates['updated_at'] = now();

            DB::table('local_profiles')->where('id', $id)->update($updates);

            if ($request->has('disability_types')) {
                $typeIds = array_values(array_filter(
                    (array) $request->input('disability_types'),
                    fn($v) => is_numeric($v)
                ));

                DB::table('local_profile_disability_types')
                    ->where('local_profile_id', $id)
                    ->delete();

                if (!empty($typeIds)) {
                    $rows = [];
                    foreach ($typeIds as $tid) {
                        $rows[] = [
                            'local_profile_id' => $id,
                            'disability_type_id' => (int) $tid,
                        ];
                    }

                    DB::table('local_profile_disability_types')->insert($rows);
                }
            }

            if ($request->has('disability_causes')) {
                $causeIds = array_values(array_filter(
                    (array) $request->input('disability_causes'),
                    fn($v) => is_numeric($v)
                ));

                $causeOther = (array) $request->input('cause_other', []);

                DB::table('local_profile_disability_causes')
                    ->where('local_profile_id', $id)
                    ->delete();

                if (!empty($causeIds)) {
                    $rows = [];
                    foreach ($causeIds as $cid) {
                        $other = $causeOther[$cid] ?? null;
                        $other = $toNull($other);

                        $rows[] = [
                            'local_profile_id' => $id,
                            'disability_cause_id' => (int) $cid,
                            'other_specify' => $other,
                        ];
                    }

                    DB::table('local_profile_disability_causes')->insert($rows);
                }
            }

            $memberIds = (array) $request->input('member_id', []);
            $names     = (array) $request->input('member_name', []);
            $dobs      = (array) $request->input('member_dob', []);
            $civils    = (array) $request->input('member_civil_status', []);
            $educs     = (array) $request->input('member_education', []);
            $rels      = (array) $request->input('member_relationship', []);
            $occs      = (array) $request->input('member_occupation', []);
            $pens      = (array) $request->input('member_pension', []);
            $incomes   = (array) $request->input('member_income', []);
            $deletes   = (array) $request->input('member_delete', []);

            $count = max(
                count($memberIds),
                count($names),
                count($dobs),
                count($civils),
                count($educs),
                count($rels),
                count($occs),
                count($pens),
                count($incomes),
                count($deletes)
            );

            for ($i = 0; $i < $count; $i++) {
                $mid = $memberIds[$i] ?? '';
                $del = $deletes[$i] ?? '0';

                if ((string) $del === '1') {
                    if ($mid !== '' && is_numeric($mid)) {
                        DB::table('household_members')
                            ->where('id', (int) $mid)
                            ->where('local_profile_id', $id)
                            ->delete();
                    }
                    continue;
                }

                $row = [
                    'local_profile_id' => $id,
                    'name' => $toNull($names[$i] ?? '') ?? 'N/A',
                    'date_of_birth' => $toNull($dobs[$i] ?? null),
                    'civil_status' => $toNull($civils[$i] ?? ''),
                    'educational_attainment' => $toNull($educs[$i] ?? ''),
                    'relationship_to_pwd' => $toNull($rels[$i] ?? ''),
                    'occupation' => $toNull($occs[$i] ?? ''),
                    'social_pension_affiliation' => $toNull($pens[$i] ?? ''),
                    'monthly_income' => $normalizeDecimal($incomes[$i] ?? null),
                ];

                $anyFilled = false;
                foreach ([
                    'name',
                    'date_of_birth',
                    'civil_status',
                    'educational_attainment',
                    'relationship_to_pwd',
                    'occupation',
                    'social_pension_affiliation',
                    'monthly_income'
                ] as $k) {
                    if ($k === 'name') {
                        if (($names[$i] ?? '') !== '') {
                            $anyFilled = true;
                        }
                    } else {
                        if (!is_null($row[$k]) && $row[$k] !== '') {
                            $anyFilled = true;
                        }
                    }
                }

                if (!$anyFilled && ($mid === '' || !is_numeric($mid))) {
                    continue;
                }

                if ($mid !== '' && is_numeric($mid)) {
                    DB::table('household_members')
                        ->where('id', (int) $mid)
                        ->where('local_profile_id', $id)
                        ->update($row);
                } else {
                    $row['created_at'] = now();
                    DB::table('household_members')->insert($row);
                }
            }
        });

        return redirect()->to($redirectTo)->with('success', 'Updated successfully.');
    }

    public function pdf(int $id)
    {
        $open = DB::table('local_profiles')->where('id', $id)->first();

        abort_if(!$open, 404, 'Record not found.');

        $openTypeIds = DB::table('local_profile_disability_types')
            ->where('local_profile_id', $id)
            ->pluck('disability_type_id')
            ->toArray();

        $openTypes = DB::table('local_profile_disability_types as lpdt')
            ->join('disability_types as dt', 'dt.id', '=', 'lpdt.disability_type_id')
            ->where('lpdt.local_profile_id', $id)
            ->orderBy('dt.name')
            ->pluck('dt.name')
            ->toArray();

        $openCauseIds = DB::table('local_profile_disability_causes')
            ->where('local_profile_id', $id)
            ->pluck('disability_cause_id')
            ->toArray();

        $openCauses = DB::table('local_profile_disability_causes as lpdc')
            ->join('disability_causes as dc', 'dc.id', '=', 'lpdc.disability_cause_id')
            ->where('lpdc.local_profile_id', $id)
            ->select('dc.id', 'dc.category', 'dc.name', 'lpdc.other_specify')
            ->orderBy('dc.category')
            ->orderBy('dc.name')
            ->get();

        $openMembers = DB::table('household_members')
            ->where('local_profile_id', $id)
            ->orderBy('id', 'asc')
            ->get();

        $allTypes = DB::table('disability_types')->orderBy('id')->get();
        $allCauses = DB::table('disability_causes')->orderBy('id')->get();

        $pdf = Pdf::loadView('admin.pdf.local_profile_pdf', [
            'open'         => $open,
            'openTypeIds'  => $openTypeIds,
            'openTypes'    => $openTypes,
            'openCauseIds' => $openCauseIds,
            'openCauses'   => $openCauses,
            'openMembers'  => $openMembers,
            'allTypes'     => $allTypes,
            'allCauses'    => $allCauses,
        ])->setPaper('a4', 'portrait');

        return $pdf->stream('local-profile-' . $id . '.pdf');
    }
}