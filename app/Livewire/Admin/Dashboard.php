<?php

namespace App\Livewire\Admin;

use App\Models\Report;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Dashboard Admin - E-Report Kelurahan')]
class Dashboard extends Component
{
    public function render()
    {
        // 1. Statistik Global Seluruh Laporan
        $totalReports = Report::count();
        $pendingReports = Report::where('status', 'pending')->count();
        $inProgressReports = Report::where('status', 'diproses')->count();
        $resolvedReports = Report::where('status', 'selesai')->count();
        $rejectedReports = Report::where('status', 'ditolak')->count();
        $totalWarga = User::where('role', 'warga')->count();

        // 2. Distribusi Kategori
        $categoryStats = Report::select('category', DB::raw('count(*) as total'))
            ->groupBy('category')
            ->get();

        // 3. Antrean Tiket Pending yang butuh tindakan cepat
        $pendingQueue = Report::with('user')
            ->where('status', 'pending')
            ->oldest()
            ->take(6)
            ->get();

        return view('livewire.admin.dashboard', [
            'totalReports' => $totalReports,
            'pendingReports' => $pendingReports,
            'inProgressReports' => $inProgressReports,
            'resolvedReports' => $resolvedReports,
            'rejectedReports' => $rejectedReports,
            'totalWarga' => $totalWarga,
            'categoryStats' => $categoryStats,
            'pendingQueue' => $pendingQueue,
        ]);
    }
}
