<div>
    <!-- Welcome Header Card -->
    <div class="mb-8 p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm relative overflow-hidden">
        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100 mb-2">
                    <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                    Akun Warga Terverifikasi
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Halo, {{ auth()->user()->name }}! 👋
                </h1>
                <p class="text-sm text-slate-500 mt-1 max-w-xl">
                    Pantau status tindak lanjut pengaduan Anda atau laporkan kendala fasilitas umum baru di sekitar tempat tinggal Anda.
                </p>
            </div>
            <div class="shrink-0">
                <a href="{{ route('warga.laporan.buat') }}" wire:navigate
                   class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 hover:shadow-indigo-300 transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <span>Buat Pengaduan Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Stat Metric Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        <!-- Total -->
        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Total Laporan</span>
                <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-slate-900">{{ $totalReports }}</span>
                <span class="text-xs text-slate-400">tiket saya</span>
            </div>
        </div>

        <!-- Pending -->
        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-amber-200/70 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider">Menunggu</span>
                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-amber-600">{{ $pendingReports }}</span>
                <span class="text-xs text-amber-600/70">pending</span>
            </div>
        </div>

        <!-- Diproses -->
        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-sky-200/70 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-sky-700 uppercase tracking-wider">Diproses</span>
                <div class="w-8 h-8 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-sky-600">{{ $inProgressReports }}</span>
                <span class="text-xs text-sky-600/70">di lapangan</span>
            </div>
        </div>

        <!-- Selesai -->
        <div class="p-5 sm:p-6 rounded-2xl bg-white border border-emerald-200/70 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Tuntas</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-2xl sm:text-3xl font-extrabold text-emerald-600">{{ $resolvedReports }}</span>
                <span class="text-xs text-emerald-600/70">selesai</span>
            </div>
        </div>
    </div>

    <!-- 5 Laporan Terbaru Milik Warga -->
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900">Aktivitas Laporan Terkini</h2>
                <p class="text-xs text-slate-400 mt-0.5">5 laporan pengaduan terakhir yang Anda sampaikan</p>
            </div>
            <a href="{{ route('warga.laporan') }}" wire:navigate
               class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                <span>Lihat Semua Riwayat</span>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
        </div>

        <div class="divide-y divide-slate-100">
            @forelse($recentReports as $report)
                <div class="p-6 hover:bg-slate-50/70 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="space-y-1.5 max-w-2xl">
                        <div class="flex flex-wrap items-center gap-2">
                            <span class="font-mono text-xs font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded">
                                {{ $report->ticket_code }}
                            </span>
                            <span class="text-xs font-semibold text-indigo-600">
                                {{ $report->category }}
                            </span>
                            <span class="text-slate-300">•</span>
                            <span class="text-xs text-slate-400 flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                {{ $report->created_at->translatedFormat('d M Y, H:i') }}
                            </span>
                        </div>

                        <h3 class="text-sm font-bold text-slate-900">
                            {{ $report->title }}
                        </h3>

                        <p class="text-xs text-slate-500 line-clamp-2">
                            {{ $report->description }}
                        </p>
                    </div>

                    <div class="flex items-center gap-3 shrink-0">
                        @if($report->status === 'selesai')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                Selesai
                            </span>
                        @elseif($report->status === 'diproses')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                Diproses
                            </span>
                        @elseif($report->status === 'ditolak')
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                Ditolak
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                Menunggu Verifikasi
                            </span>
                        @endif

                        <a href="{{ route('warga.laporan', ['search' => $report->ticket_code]) }}" wire:navigate
                           class="p-2 rounded-xl text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="p-12 text-center">
                    <div class="w-12 h-12 mx-auto mb-3 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <p class="text-sm font-semibold text-slate-800">Belum ada pengaduan yang diajukan</p>
                    <p class="text-xs text-slate-400 mt-1 max-w-sm mx-auto">Ada fasilitas lingkungan yang rusak atau sampah menumpuk? Buat pengaduan pertama Anda sekarang.</p>
                    <a href="{{ route('warga.laporan.buat') }}" wire:navigate
                       class="mt-4 inline-flex items-center gap-1.5 px-4 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 transition-all">
                        <span>Buat Pengaduan Sekarang</span>
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>
