<div>
    <!-- Page Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Data Warga Terdaftar</h1>
            <p class="text-xs text-slate-500 mt-0.5">Daftar seluruh masyarakat kelurahan yang memiliki akun pada sistem aspirasi E-Report</p>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs mb-6">
        <div class="relative">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari berdasarkan nama warga, NIK 16 digit, no handphone, atau alamat domisili..."
                   class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 text-slate-900 placeholder:text-slate-400">
        </div>
    </div>

    <!-- Warga Table -->
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5">Nama & NIK</th>
                        <th class="px-6 py-3.5">Kontak</th>
                        <th class="px-6 py-3.5">Alamat Domisili</th>
                        <th class="px-6 py-3.5 text-center">Jumlah Laporan</th>
                        <th class="px-6 py-3.5">Tanggal Registrasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($wargaList as $warga)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <!-- Nama & NIK -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-xl bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold text-xs">
                                        {{ strtoupper(substr($warga->name, 0, 2)) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-900">{{ $warga->name }}</p>
                                        <p class="text-[11px] text-slate-400 font-mono">NIK: {{ $warga->nik ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>

                            <!-- Kontak -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <p class="text-xs text-slate-800 font-medium">{{ $warga->email }}</p>
                                <p class="text-[11px] text-slate-400">{{ $warga->phone ?? '-' }}</p>
                            </td>

                            <!-- Alamat -->
                            <td class="px-6 py-4 text-xs text-slate-600 max-w-xs truncate">
                                {{ $warga->address ?? 'Belum dilengkapi' }}
                            </td>

                            <!-- Jumlah Laporan -->
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <span class="inline-flex items-center justify-center px-3 py-1 rounded-full text-xs font-extrabold {{ $warga->reports_count > 0 ? 'bg-indigo-50 text-indigo-700 border border-indigo-200' : 'bg-slate-100 text-slate-500' }}">
                                    {{ $warga->reports_count }} Tiket
                                </span>
                            </td>

                            <!-- Tanggal Registrasi -->
                            <td class="px-6 py-4 whitespace-nowrap text-xs text-slate-400">
                                {{ $warga->created_at->translatedFormat('d F Y') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold text-slate-700">Tidak ada akun warga yang cocok dengan pencarian.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($wargaList->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $wargaList->links() }}
            </div>
        @endif
    </div>
</div>
