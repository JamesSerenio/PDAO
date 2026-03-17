<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Mapping extends Component
{
    public string $searchBarangay = '';
    public array $profiles = [];
    public bool $showResults = false;

    public array $barangays = [
        "Agusan Canyon",
        "Alae",
        "Dahilayan",
        "Dalirig",
        "Damilag",
        "Dicklum",
        "Guilang-guilang",
        "Kalugmanan",
        "Lindaban",
        "Lingion",
        "Lunocan",
        "Maluko",
        "Mambatangan",
        "Mampayag",
        "Mantibugao",
        "Minsuro",
        "San Miguel",
        "Sankanan",
        "Santiago",
        "Santo Niño",
        "Tankulan",
        "Ticala",
    ];

    protected $listeners = ['setBarangay'];

    public function mount(): void
    {
        $this->profiles = [];
        $this->showResults = false;
    }

    public function closeResults(): void
    {
        $this->showResults = false;

        $this->dispatch('mapProfilesLoaded', profiles: [], barangay: '');
    }

    public function setBarangay($payload = null): void
    {
        $name = '';

        if (is_array($payload) && isset($payload['name'])) {
            $name = trim((string) $payload['name']);
        } elseif (is_string($payload)) {
            $name = trim($payload);
        }

        if ($name === '') {
            return;
        }

        $this->searchBarangay = $this->normalizeBarangayName($name);
        $this->search();
    }

    public function search(): void
    {
        $b = trim($this->searchBarangay);

        if ($b === '') {
            $this->profiles = [];
            $this->showResults = false;
            $this->dispatch('mapProfilesLoaded', profiles: [], barangay: '');
            return;
        }

        $normalizedBarangay = mb_strtolower($this->normalizeBarangayName($b));

        $rows = DB::table('local_profiles as lp')
            ->leftJoin('local_profile_disability_types as lpdt', 'lpdt.local_profile_id', '=', 'lp.id')
            ->leftJoin('disability_types as dt', 'dt.id', '=', 'lpdt.disability_type_id')
            ->whereRaw(
                "LOWER(TRIM(
                    CASE
                        WHEN lp.barangay = 'Tankulan (Pob.)' THEN 'Tankulan'
                        WHEN lp.barangay = 'Guilangguilang' THEN 'Guilang-guilang'
                        ELSE lp.barangay
                    END
                )) = ?",
                [$normalizedBarangay]
            )
            ->groupBy(
                'lp.id',
                'lp.photo_1x1',
                'lp.last_name',
                'lp.first_name',
                'lp.date_of_birth'
            )
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
            $age = null;

            if (!empty($p->date_of_birth)) {
                try {
                    $age = Carbon::parse($p->date_of_birth)->age;
                } catch (\Throwable $e) {
                    $age = null;
                }
            }

            $photoUrl = null;

            if (!empty($p->photo_1x1)) {
                $path = ltrim((string) $p->photo_1x1, '/');

                if (str_starts_with($path, 'storage/')) {
                    $photoUrl = asset($path);
                } else {
                    $photoUrl = asset('storage/' . $path);
                }
            }

            $firstName = trim((string) $p->first_name);
            $lastName  = trim((string) $p->last_name);

            $initials = '';
            if ($firstName !== '') {
                $initials .= mb_strtoupper(mb_substr($firstName, 0, 1));
            }
            if ($lastName !== '') {
                $initials .= mb_strtoupper(mb_substr($lastName, 0, 1));
            }

            return [
                'id' => $p->id,
                'last_name' => $lastName,
                'first_name' => $firstName,
                'full_name' => trim($lastName . ', ' . $firstName, ', '),
                'age' => $age,
                'photo_url' => $photoUrl,
                'initials' => $initials !== '' ? $initials : 'NP',
                'disability_types' => $p->disability_types ?: '—',
            ];
        })->toArray();

        $this->showResults = true;

        $this->dispatch(
            'mapProfilesLoaded',
            profiles: $this->profiles,
            barangay: $this->normalizeBarangayName($b)
        );
    }

    private function normalizeBarangayName(string $name): string
    {
        $name = trim($name);

        $map = [
            'Tankulan (Pob.)' => 'Tankulan',
            'Tankulan Pob.' => 'Tankulan',
            'Tankulan Poblacion' => 'Tankulan',
            'Guilangguilang' => 'Guilang-guilang',
            'Santo Nino' => 'Santo Niño',
        ];

        return $map[$name] ?? $name;
    }

    public function render()
    {
        return view('livewire.admin.mapping');
    }
}