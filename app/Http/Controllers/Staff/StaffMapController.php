<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;

class StaffMapController extends Controller
{
    public function index()
    {
        return view('livewire.staff.mapping');
    }
}