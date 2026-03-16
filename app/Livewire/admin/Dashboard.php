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
        $allowed = ['day', 'week', 'month', 'year', 'overall'];
        $requestedRange = request('range', 'month');

        $this->range = in_array($requestedRange, $allowed, true)
            ? $requestedRange
            : 'month';
    }

    public function updatedRange(): void
    {
        // Livewire will re-render automatically
    }

    public function setRange(string $value): void
    {
        $allowed = ['day', 'week', 'month', 'year', 'overall'];

        if (in_array($value, $allowed, true)) {
            $this->range = $value;
        }
    }

    protected function applyRangeFilter($query)
    {
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

    protected function getRegisteredQuery()
    {
        $query = DB::table('local_profiles');
        return $this->applyRangeFilter($query);
    }

    protected function getPwdQuery()
    {
        $query = DB::table('local_profiles')
            ->whereNotNull('date_of_birth')
            ->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) < 60');

        return $this->applyRangeFilter($query);
    }

    protected function getSeniorQuery()
    {
        $query = DB::table('local_profiles')
            ->whereNotNull('date_of_birth')
            ->whereRaw('TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 60');

        return $this->applyRangeFilter($query);
    }

    protected function getRecentProfilesQuery()
    {
        $query = DB::table('local_profiles')
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
            ->orderByDesc('created_at');

        return $this->applyRangeFilter($query);
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
        $registeredCount = $this->getRegisteredQuery()->count();

        $pwdCount = $this->getPwdQuery()->count();

        $seniorCount = $this->getSeniorQuery()->count();

        $recentProfiles = $this->getRecentProfilesQuery()
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