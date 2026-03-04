<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Mapping extends Component
{
    public string $searchBarangay = '';
    public array $profiles = [];

    public array $barangays = [
        "Agusan Canyon","Alae","Dahilayan","Dalirig","Damilag","Diclum",
        "Guilang-guilang","Kalugmanan","Lindaban","Lingion","Lunocan","Maluko",
        "Mambatangan","Mampayag","Mantibugao","Minsuro","San Miguel","Sankanan",
        "Santiago","Santo Niño","Tankulan","Ticala"
    ];

    public function mount()
    {
        // optional: default load none
        $this->profiles = [];
    }

    public function search()
    {
        $b = trim($this->searchBarangay);

        if ($b === '') {
            $this->profiles = [];
            return;
        }

        // ✅ Pull only the important fields for display
        $this->profiles = DB::table('local_profiles')
            ->select(
                'id',
                'last_name',
                'first_name',
                'middle_name',
                'suffix',
                'sex',
                'date_of_birth',
                'mobile',
                'email',
                'barangay',
                'municipality',
                'province'
            )
            ->where('barangay', $b)
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get()
            ->toArray();
    }

    public function render()
    {
        return view('livewire.staff.mapping');
    }
}