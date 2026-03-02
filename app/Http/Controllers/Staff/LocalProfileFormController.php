<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LocalProfileFormController extends Controller
{
    public function index()
    {
        return view('pages.staff.Local_Profile_Form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'full_name'      => 'required|string|max:120',
            'contact_number' => 'required|string|max:30',
            'address'        => 'required|string|max:255',
            'dob'            => 'required|date',
            'gender'         => 'required|string|max:20',
            'pwd_id_no'      => 'nullable|string|max:60',
            'remarks'        => 'nullable|string|max:1000',
        ]);

        return back()->with('success', 'Local Profile Form saved successfully!');
    }
}