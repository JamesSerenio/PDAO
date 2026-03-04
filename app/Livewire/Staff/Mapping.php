<?php

namespace App\Livewire\Staff;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Mapping extends Component
{
    public string $searchBarangay = '';
    public array $profiles = [];

    // ✅ NEW: control kung lalabas ang results modal/drawer
    public bool $showResults = false;

    public array $barangays = [
        "Agusan Canyon","Alae","Dahilayan","Dalirig","Damilag","Dicklum",
        "Guilang-guilang","Kalugmanan","Lindaban","Lingion","Lunocan","Maluko",
        "Mambatangan","Mampayag","Mantibugao","Minsuro","San Miguel","Sankanan",
        "Santiago","Santo Niño","Tankulan","Ticala"
    ];

    public function mount(): void
    {
        $this->profiles = [];
        $this->showResults = false; // ✅ hidden on load
    }

    // ✅ Close button handler (X)
    public function closeResults(): void
    {
        $this->showResults = false;
    }

    public function search(): void
    {
        $b = trim($this->searchBarangay);

        // ✅ if empty: clear + hide modal
        if ($b === '') {
            $this->profiles = [];
            $this->showResults = false;
            return;
        }

        // ✅ normalize search (case + trim)
        $bNormalized = mb_strtolower(trim($b));

        $rows = DB::table('local_profiles as lp')
            ->leftJoin('local_profile_disability_types as lpdt', 'lpdt.local_profile_id', '=', 'lp.id')
            ->leftJoin('disability_types as dt', 'dt.id', '=', 'lpdt.disability_type_id')
            // ✅ IMPORTANT: compare normalized values (handles spaces/case)
            ->whereRaw('LOWER(TRIM(lp.barangay)) = ?', [$bNormalized])
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
            // ✅ age
            $age = null;
            if (!empty($p->date_of_birth)) {
                try {
                    $age = Carbon::parse($p->date_of_birth)->age;
                } catch (\Throwable $e) {
                    $age = null;
                }
            }

            // ✅ photo url
            // DB example: local_profiles/photos/xxx.jpg
            // URL should be: http://127.0.0.1:8000/storage/local_profiles/photos/xxx.jpg
            $photoUrl = null;
            if (!empty($p->photo_1x1)) {
                $path = ltrim($p->photo_1x1, '/'); // remove leading slash
                $photoUrl = asset('storage/' . $path);
            }

            return [
                'id' => $p->id,
                'last_name' => $p->last_name,
                'first_name' => $p->first_name,
                'age' => $age,
                'photo_url' => $photoUrl,
                'disability_types' => $p->disability_types ?: '—',
            ];
        })->toArray();

        // ✅ after searching: show modal always (kahit 0 results, lalabas pa rin)
        $this->showResults = true;
    }

    public function render()
    {
        return view('livewire.staff.mapping');
    }
}