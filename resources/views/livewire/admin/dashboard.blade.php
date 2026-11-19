<div class="space-y-8">
    <!-- Header Admin -->
    <div class="p-6 sm:p-8 rounded-3xl bg-white border border-slate-200/90 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100 mb-2">
                <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                Pusat Kendali Pelayanan Warga
            </div>
            <h1 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                Dashboard Aparatur Kelurahan
            </h1>
            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Pantau aduan masuk, koordinasikan petugas lapangan, dan verifikasi penyelesaian laporan warga.
            </p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.laporan', ['status' => 'pending']) }}" wire:navigate
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-amber-600 hover:bg-amber-700 shadow-sm shadow-amber-200 transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                <span>Tinjau Antrean Pending ({{ $pendingReports }})</span>
            </a>
        </div>
    </div>

    <!-- 4 Global Metrics -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        <!-- Total Laporan -->
        <div class="p-6 rounded-2xl bg-white border border-slate-200/80 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-slate-400 uppercase tracking-wider">Semua Aduan</span>
                <div class="w-8 h-8 rounded-xl bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs">
                    ALL
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-slate-900">{{ $totalReports }}</span>
                <span class="text-xs text-slate-400">tiket terdata</span>
            </div>
        </div>

        <!-- Butuh Tindakan Segera (Pending) -->
        <div class="p-6 rounded-2xl bg-white border border-amber-300 shadow-xs ring-1 ring-amber-200/60">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-amber-700 uppercase tracking-wider">Menunggu Respon</span>
                <div class="w-8 h-8 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-amber-600">{{ $pendingReports }}</span>
                <span class="text-xs text-amber-600/70">butuh verifikasi</span>
            </div>
        </div>

        <!-- Sedang Diproses -->
        <div class="p-6 rounded-2xl bg-white border border-sky-200 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-sky-700 uppercase tracking-wider">Tindakan Lapangan</span>
                <div class="w-8 h-8 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-sky-600">{{ $inProgressReports }}</span>
                <span class="text-xs text-sky-600/70">sedang dikerjakan</span>
            </div>
        </div>

        <!-- Tuntas Selesai -->
        <div class="p-6 rounded-2xl bg-white border border-emerald-200 shadow-xs">
            <div class="flex items-center justify-between mb-3">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-wider">Tuntas Diselesaikan</span>
                <div class="w-8 h-8 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                </div>
            </div>
            <div class="flex items-baseline gap-2">
                <span class="text-3xl font-extrabold text-emerald-600">{{ $resolvedReports }}</span>
                <span class="text-xs text-emerald-600/70">terselesaikan</span>
            </div>
        </div>
    </div>

    <!-- Row: Antrean Prioritas Pending & Distribusi Kategori -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Antrean Tiket Pending Butuh Tindakan Cepat (8 Kolom) -->
        <div class="lg:col-span-8 bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-bold text-slate-900 flex items-center gap-2">
                        <span>Antrean Tiket Pending Terlama</span>
                        <span class="px-2 py-0.5 rounded-full text-xs font-bold bg-amber-100 text-amber-800">
                            Prioritas
                        </span>
                    </h2>
                    <p class="text-xs text-slate-400 mt-0.5">Segera verifikasi atau teruskan penanganan ke dinas terkait</p>
                </div>
                <a href="{{ route('admin.laporan') }}" wire:navigate
                   class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                    <span>Semua Laporan</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            <div class="divide-y divide-slate-100">
                @forelse($pendingQueue as $p)
                    <div class="p-6 hover:bg-slate-50/70 transition-colors flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                        <div class="space-y-1.5 max-w-xl">
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-xs font-bold text-slate-700 bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $p->ticket_code }}
                                </span>
                                <span class="text-xs font-semibold text-indigo-600">
                                    {{ $p->category }}
                                </span>
                                <span class="text-slate-300">•</span>
                                <span class="text-xs text-slate-400">
                                    {{ $p->created_at->diffForHumans() }}
                                </span>
                            </div>

                            <h3 class="text-sm font-bold text-slate-900">
                                {{ $p->title }}
                            </h3>

                            <div class="flex items-center gap-4 text-xs text-slate-500">
                                <span>Pelapor: <strong class="text-slate-700">{{ $p->user->name ?? 'Anonim' }}</strong></span>
                                <span>Lokasi: <span class="truncate max-w-[200px] inline-block align-bottom">{{ $p->location }}</span></span>
                            </div>
                        </div>

                        <div class="shrink-0">
                            <a href="{{ route('admin.laporan', ['search' => $p->ticket_code]) }}" wire:navigate
                               class="inline-flex items-center gap-1.5 px-3.5 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-all">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <span>Tindak Lanjuti</span>
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="p-12 text-center text-slate-400">
                        <svg class="w-10 h-10 mx-auto text-emerald-500 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        <p class="text-sm font-bold text-slate-800">Semua Tiket Pending Telah Ditanggapi!</p>
                        <p class="text-xs text-slate-400 mt-1">Tidak ada antrean tertunda saat ini. Kerja bagus tim kelurahan!</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Distribusi Kategori (4 Kolom) -->
        <div class="lg:col-span-4 bg-white rounded-3xl border border-slate-200/90 shadow-sm p-6 flex flex-col justify-between">
            <div>
                <h2 class="text-base font-bold text-slate-900 mb-1">Distribusi Kategori</h2>
                <p class="text-xs text-slate-400 mb-6">Persentase pengaduan berdasarkan bidang masalah</p>

                <div class="space-y-4">
                    @forelse($categoryStats as $cStat)
                        @php
                            $percentage = $totalReports > 0 ? round(($cStat->total / $totalReports) * 100) : 0;
                        @endphp
                        <div>
                            <div class="flex items-center justify-between text-xs font-semibold mb-1">
                                <span class="text-slate-700 truncate max-w-[180px]">{{ $cStat->category }}</span>
                                <span class="text-slate-500 font-mono">{{ $cStat->total }} ({{ $percentage }}%)</span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-2 overflow-hidden">
                                <div class="bg-indigo-600 h-2 rounded-full transition-all duration-500" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-xs text-slate-400 text-center py-6">Belum ada data distribusi kategori</p>
                    @endforelse
                </div>
            </div>

            <!-- Citizen Quick Link Card -->
            <div class="mt-8 p-4 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-between">
                <div>
                    <span class="text-xs font-bold text-slate-700 block">Total Warga Terdaftar</span>
                    <span class="text-lg font-extrabold text-indigo-600">{{ $totalWarga }} Orang</span>
                </div>
                <a href="{{ route('admin.warga') }}" wire:navigate
                   class="px-3 py-1.5 rounded-xl bg-white border border-slate-200 text-xs font-semibold text-slate-700 hover:text-indigo-600 shadow-2xs">
                    Kelola Warga &rarr;
                </a>
            </div>
        </div>
    </div>
</div>
