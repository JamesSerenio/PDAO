<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

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
        $this->profiles = [];
    }

    public function search()
    {
        $b = trim((string) $this->searchBarangay);

        if ($b === '') {
            $this->profiles = [];
            return;
        }

        // ✅ TRIM + LOWER: para kahit may extra spaces / different casing sa DB
        $rows = DB::table('local_profiles as lp')
            ->leftJoin('local_profile_disability_types as lpdt', 'lpdt.local_profile_id', '=', 'lp.id')
            ->leftJoin('disability_types as dt', 'dt.id', '=', 'lpdt.disability_type_id')
            ->whereRaw('LOWER(TRIM(lp.barangay)) = LOWER(?)', [$b])
            ->groupBy('lp.id', 'lp.photo_1x1', 'lp.last_name', 'lp.first_name', 'lp.date_of_birth')
            ->orderBy('lp.last_name')
            ->orderBy('lp.first_name')
            ->select(
                'lp.id',
                'lp.photo_1x1',
                'lp.last_name',
                'lp.first_name',
                'lp.date_of_birth',
                DB::raw("GROUP_CONCAT(DISTINCT dt.name ORDER BY dt.name SEPARATOR ', ') as disability_types")
            )
            ->get();

        $this->profiles = $rows->map(function ($p) {
            // ✅ Age compute
            $age = '—';
            if (!empty($p->date_of_birth)) {
                try {
                    $age = Carbon::parse($p->date_of_birth)->age;
                } catch (\Throwable $e) {
                    $age = '—';
                }
            }

            // ✅ Photo URL (requires: php artisan storage:link)
            $photoUrl = null;
            if (!empty($p->photo_1x1)) {
                $photoUrl = asset('storage/' . ltrim($p->photo_1x1, '/'));
            }

            return [
                'id' => $p->id,
                'last_name' => $p->last_name ?? '',
                'first_name' => $p->first_name ?? '',
                'age' => $age,
                'photo_url' => $photoUrl,
                'disability_types' => !empty($p->disability_types) ? $p->disability_types : '—',
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.staff.mapping');
    }
}