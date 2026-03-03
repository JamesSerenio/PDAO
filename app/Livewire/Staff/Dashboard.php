<?php

namespace App\Livewire\Staff;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // since your view is in resources/views/components/staff/dashboard.blade.php
        return view('livewire.staff.dashboard');
    }
}