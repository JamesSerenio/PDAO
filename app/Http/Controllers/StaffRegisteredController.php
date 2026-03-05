<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffRegisteredController extends Controller
{
    public function update(Request $request, int $id)
    {
        // Basic validation (pwede pa natin i-dagdag later)
        $data = $request->validate([
            'ldr_number' => ['nullable','string','max:50'],
            'profiling_date' => ['nullable','date'],

            'last_name' => ['required','string','max:100'],
            'first_name' => ['required','string','max:100'],
            'middle_name' => ['nullable','string','max:100'],
            'suffix' => ['nullable','string','max:20'],

            'date_of_birth' => ['nullable','date'],
            'sex' => ['nullable','in:MALE,FEMALE'],
            'blood_type' => ['nullable','in:A+,A-,B+,B-,AB+,AB-,O+,O-'],

            'religion' => ['nullable','string','max:100'],
            'ethnic_group' => ['nullable','string','max:100'],
            'civil_status' => ['nullable','string','max:50'],

            'house_no_street' => ['nullable','string','max:200'],
            'sitio_purok' => ['nullable','string','max:100'],
            'barangay' => ['nullable','string','max:100'],
            'municipality' => ['nullable','string','max:100'],
            'province' => ['nullable','string','max:100'],
            'region' => ['nullable','string','max:100'],

            'landline' => ['nullable','string','max:50'],
            'mobile' => ['nullable','string','max:50'],
            'email' => ['nullable','string','max:150'],

            'education_level' => ['nullable','string','max:50'],
            'employment_status' => ['nullable','string','max:50'],
            'employment_category' => ['nullable','string','max:50'],
            'specific_occupation' => ['nullable','string','max:150'],
            'employment_type' => ['nullable','string','max:50'],

            'special_skills' => ['nullable','string'],
            'sporting_talent' => ['nullable','string'],
        ]);

        DB::table('local_profiles')->where('id', $id)->update($data);

        // balik sa view + edit mode para makita nya saved
        return redirect()->to(url('/staff/registered') . '?' . http_build_query([
            'open' => $id,
            'edit_open' => $id,
        ]))->with('success', 'Updated successfully.');
    }
}