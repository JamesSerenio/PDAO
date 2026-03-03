<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminMapController extends Controller
{
    public function index()
    {
        return view('livewire.admin.mapping');
    }
}