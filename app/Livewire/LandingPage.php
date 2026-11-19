<?php

namespace App\Livewire;

use App\Models\Report;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.guest')]
#[Title('Beranda - Layanan Aspirasi Warga')]
class LandingPage extends Component
{
    public function render()
    {
        $totalReports = Report::count();
        $resolvedReports = Report::where('status', 'selesai')->count();
        $inProgressReports = Report::where('status', 'diproses')->count();
        $totalWarga = User::where('role', 'warga')->count();

        // 3 laporan publik terbaru
        $recentReports = Report::with('user')
            ->latest()
            ->take(3)
            ->get();

        return view('livewire.landing-page', [
            'totalReports' => $totalReports,
            'resolvedReports' => $resolvedReports,
            'inProgressReports' => $inProgressReports,
            'totalWarga' => $totalWarga,
            'recentReports' => $recentReports,
        ]);
    }
}
