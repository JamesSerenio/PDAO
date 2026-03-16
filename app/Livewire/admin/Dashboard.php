<?php

namespace App\Livewire\Admin;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public string $range = 'month';

    public function mount(): void
    {
        $this->range = request('range', 'month');
    }

    public function updatedRange(): void
    {
        $this->dispatch('$refresh');
    }

    public function setRange(string $value): void
    {
        $allowed = ['day', 'week', 'month', 'year', 'overall'];

        if (in_array($value, $allowed, true)) {
            $this->range = $value;
        }
    }

    protected function getRegisteredQuery()
    {
        $query = DB::table('local_profiles');

        if ($this->range === 'day') {
            $query->whereDate('created_at', Carbon::today());
        } elseif ($this->range === 'week') {
            $query->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek(),
            ]);
        } elseif ($this->range === 'month') {
            $query->whereYear('created_at', Carbon::now()->year)
                  ->whereMonth('created_at', Carbon::now()->month);
        } elseif ($this->range === 'year') {
            $query->whereYear('created_at', Carbon::now()->year);
        }

        return $query;
    }

    public function getRangeLabelProperty(): string
    {
        return match ($this->range) {
            'day' => 'This Day',
            'week' => 'This Week',
            'month' => 'This Month',
            'year' => 'This Year',
            default => 'Overall',
        };
    }

    public function render()
    {
        $registeredQuery = $this->getRegisteredQuery();

        $registeredCount = (clone $registeredQuery)->count();

        $pwdCount = DB::table('local_profiles')->count();

        $seniorCount = DB::table('local_profiles')
            ->whereNotNull('date_of_birth')
            ->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60')
            ->count();

        $recentProfiles = DB::table('local_profiles')
            ->select(
                'id',
                'first_name',
                'middle_name',
                'last_name',
                'barangay',
                'profiling_date',
                'date_of_birth',
                'created_at'
            )
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();

        return view('livewire.admin.dashboard', [
            'registeredCount' => $registeredCount,
            'pwdCount' => $pwdCount,
            'seniorCount' => $seniorCount,
            'recentProfiles' => $recentProfiles,
            'rangeLabel' => $this->rangeLabel,
        ]);
    }
}