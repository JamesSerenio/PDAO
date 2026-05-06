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
    public array $barangayCounts = [];
    public array $purokCounts = [];
    public string $selectedPurok = '';

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

    protected $listeners = ['setBarangay', 'setPurokFilter'];

    public function mount(): void
    {
        $this->profiles = [];
        $this->showResults = false;
        $this->loadBarangayCounts();
    }

    public function closeResults(): void
    {
        $this->profiles = [];
        $this->showResults = false;
        $this->selectedPurok = '';
        $this->purokCounts = [];

        $this->dispatch(
            'mapProfilesLoaded',
            profiles: [],
            barangay: ''
        );
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
            $barangayInput = trim($this->searchBarangay);

            if ($barangayInput === '') {
                $this->profiles = [];
                $this->showResults = false;
                $this->selectedPurok = '';
                $this->purokCounts = [];

                $this->dispatch('mapProfilesLoaded', profiles: [], barangay: '');
                return;
            }

            $normalizedBarangay = $this->normalizeBarangayName($barangayInput);
            $normalizedBarangayLower = mb_strtolower($normalizedBarangay);

            $baseQuery = DB::table('local_profiles as lp')
                ->whereRaw(
                    "LOWER(TRIM(
                        CASE
                            WHEN lp.barangay = 'Tankulan (Pob.)' THEN 'Tankulan'
                            WHEN lp.barangay = 'Tankulan Pob.' THEN 'Tankulan'
                            WHEN lp.barangay = 'Tankulan Poblacion' THEN 'Tankulan'
                            WHEN lp.barangay = 'Tankulan (Poblacion)' THEN 'Tankulan'
                            WHEN lp.barangay = 'Guilangguilang' THEN 'Guilang-guilang'
                            WHEN lp.barangay = 'Santo Nino' THEN 'Santo Niño'
                            ELSE lp.barangay
                        END
                    )) = ?",
                    [$normalizedBarangayLower]
                );

            $countRows = (clone $baseQuery)
                ->selectRaw("COALESCE(NULLIF(TRIM(lp.sitio_purok), ''), 'Unspecified') as purok_name, COUNT(*) as total")
                ->groupByRaw("COALESCE(NULLIF(TRIM(lp.sitio_purok), ''), 'Unspecified')")
                ->orderBy('purok_name')
                ->get();

            $this->purokCounts = $countRows
                ->mapWithKeys(fn($r) => [(string)$r->purok_name => (int)$r->total])
                ->toArray();

            $rowsQuery = DB::table('local_profiles as lp')
                ->leftJoin('local_profile_disability_types as lpdt', 'lpdt.local_profile_id', '=', 'lp.id')
                ->leftJoin('disability_types as dt', 'dt.id', '=', 'lpdt.disability_type_id')
                ->whereRaw(
                    "LOWER(TRIM(
                        CASE
                            WHEN lp.barangay = 'Tankulan (Pob.)' THEN 'Tankulan'
                            WHEN lp.barangay = 'Tankulan Pob.' THEN 'Tankulan'
                            WHEN lp.barangay = 'Tankulan Poblacion' THEN 'Tankulan'
                            WHEN lp.barangay = 'Tankulan (Poblacion)' THEN 'Tankulan'
                            WHEN lp.barangay = 'Guilangguilang' THEN 'Guilang-guilang'
                            WHEN lp.barangay = 'Santo Nino' THEN 'Santo Niño'
                            ELSE lp.barangay
                        END
                    )) = ?",
                    [$normalizedBarangayLower]
                );

            if ($this->selectedPurok !== '') {
                $rowsQuery->whereRaw(
                    "COALESCE(NULLIF(TRIM(lp.sitio_purok), ''), 'Unspecified') = ?",
                    [$this->selectedPurok]
                );
            }

            $rows = $rowsQuery
                ->groupBy(
                    'lp.id',
                    'lp.photo_1x1',
                    'lp.last_name',
                    'lp.first_name',
                    'lp.date_of_birth',
                    'lp.sitio_purok'
                )
                ->orderBy('lp.sitio_purok')
                ->orderBy('lp.last_name')
                ->orderBy('lp.first_name')
                ->select(
                    'lp.id',
                    'lp.photo_1x1',
                    'lp.last_name',
                    'lp.first_name',
                    'lp.date_of_birth',
                    'lp.sitio_purok',
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
                    $path = ltrim(trim((string) $p->photo_1x1), '/');

                    if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                        $photoUrl = $path;
                    } elseif (str_starts_with($path, 'storage/')) {
                        $photoUrl = asset($path);
                    } else {
                        $photoUrl = asset('storage/' . $path);
                    }
                }

                $firstName = trim((string) $p->first_name);
                $lastName = trim((string) $p->last_name);

                $initials = '';
                if ($firstName !== '') $initials .= mb_strtoupper(mb_substr($firstName, 0, 1));
                if ($lastName !== '') $initials .= mb_strtoupper(mb_substr($lastName, 0, 1));

                return [
                    'id' => $p->id,
                    'last_name' => $lastName,
                    'first_name' => $firstName,
                    'full_name' => trim($lastName . ', ' . $firstName, ', '),
                    'age' => $age,
                    'sitio_purok' => trim((string)($p->sitio_purok ?? '')) ?: 'Unspecified',
                    'photo_url' => $photoUrl,
                    'initials' => $initials !== '' ? $initials : 'NP',
                    'disability_types' => $p->disability_types ?: '—',
                ];
            })->values()->toArray();

            $this->showResults = true;

            $this->dispatch(
                'mapProfilesLoaded',
                profiles: $this->profiles,
                barangay: $normalizedBarangay,
                selectedPurok: $this->selectedPurok,
                purokCounts: $this->purokCounts
            );
        }

        public function setPurokFilter($payload = null): void
{
    $purok = '';

    if (is_array($payload) && isset($payload['purok'])) {
        $purok = trim((string) $payload['purok']);
    } elseif (is_string($payload)) {
        $purok = trim($payload);
    }

    $this->selectedPurok = $purok === 'ALL' ? '' : $purok;
    $this->search();
}

    private function loadBarangayCounts(): void
    {
        $rows = DB::table('local_profiles as lp')
            ->selectRaw("
                TRIM(
                    CASE
                        WHEN lp.barangay = 'Tankulan (Pob.)' THEN 'Tankulan'
                        WHEN lp.barangay = 'Tankulan Pob.' THEN 'Tankulan'
                        WHEN lp.barangay = 'Tankulan Poblacion' THEN 'Tankulan'
                        WHEN lp.barangay = 'Tankulan (Poblacion)' THEN 'Tankulan'
                        WHEN lp.barangay = 'Guilangguilang' THEN 'Guilang-guilang'
                        WHEN lp.barangay = 'Santo Nino' THEN 'Santo Niño'
                        ELSE lp.barangay
                    END
                ) as normalized_barangay,
                COUNT(*) as total
            ")
            ->whereNotNull('lp.barangay')
            ->groupByRaw("
                TRIM(
                    CASE
                        WHEN lp.barangay = 'Tankulan (Pob.)' THEN 'Tankulan'
                        WHEN lp.barangay = 'Tankulan Pob.' THEN 'Tankulan'
                        WHEN lp.barangay = 'Tankulan Poblacion' THEN 'Tankulan'
                        WHEN lp.barangay = 'Tankulan (Poblacion)' THEN 'Tankulan'
                        WHEN lp.barangay = 'Guilangguilang' THEN 'Guilang-guilang'
                        WHEN lp.barangay = 'Santo Nino' THEN 'Santo Niño'
                        ELSE lp.barangay
                    END
                )
            ")
            ->get();

        $counts = [];

        foreach ($rows as $row) {
            $name = trim((string) ($row->normalized_barangay ?? ''));
            if ($name !== '') {
                $counts[$name] = (int) ($row->total ?? 0);
            }
        }

        $this->barangayCounts = $counts;
    }

    private function normalizeBarangayName(string $name): string
    {
        $name = trim($name);

        $map = [
            'Tankulan (Pob.)' => 'Tankulan',
            'Tankulan Pob.' => 'Tankulan',
            'Tankulan Poblacion' => 'Tankulan',
            'Tankulan (Poblacion)' => 'Tankulan',
            'Guilangguilang' => 'Guilang-guilang',
            'Santo Nino' => 'Santo Niño',
        ];

        return $map[$name] ?? $name;
    }

    public function render()
    {
        return view('livewire.admin.mapping', [
            'barangayCounts' => $this->barangayCounts,
            'purokCounts' => $this->purokCounts,
            'selectedPurok' => $this->selectedPurok,
        ]);
    }
}