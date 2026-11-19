<?php

namespace App\Livewire\Warga;

use App\Models\Report;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard Warga - E-Report Civic')]
class Dashboard extends Component
{
    public function render()
    {
        $userId = auth()->id();

        $totalReports = Report::where('user_id', $userId)->count();
        $pendingReports = Report::where('user_id', $userId)->where('status', 'pending')->count();
        $inProgressReports = Report::where('user_id', $userId)->where('status', 'diproses')->count();
        $resolvedReports = Report::where('user_id', $userId)->where('status', 'selesai')->count();

        $recentReports = Report::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();

        return view('livewire.warga.dashboard', [
            'totalReports' => $totalReports,
            'pendingReports' => $pendingReports,
            'inProgressReports' => $inProgressReports,
            'resolvedReports' => $resolvedReports,
            'recentReports' => $recentReports,
        ]);
    }
}
