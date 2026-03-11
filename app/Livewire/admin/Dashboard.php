<?php

namespace App\Livewire\admin;

use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        // since your view is in resources/views/components/admin/dashboard.blade.php
        return view('livewire.admin.dashboard');
    }
}