<div>
    <!-- Page Header -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Pengaduan Warga</h1>
            <p class="text-xs text-slate-500 mt-0.5">Verifikasi laporan masuk, beri tanggapan resmi, dan perbarui status penanganan masalah</p>
        </div>
    </div>

    <!-- Filters & Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs mb-6 space-y-3">
        <div class="flex flex-col md:flex-row items-stretch md:items-center gap-3">
            <!-- Search Input -->
            <div class="relative flex-1">
                <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>
                <input type="text" wire:model.live.debounce.300ms="search"
                       placeholder="Cari judul, tiket, nama pelapor, NIK, atau lokasi..."
                       class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 text-slate-900 placeholder:text-slate-400">
            </div>

            <!-- Kategori Dropdown -->
            <div class="w-full md:w-56 shrink-0">
                <select wire:model.live="categoryFilter"
                        class="w-full px-3 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm text-slate-700 focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Status Filter Tabs -->
        <div class="flex items-center gap-1.5 overflow-x-auto pt-1 border-t border-slate-100">
            @php
                $statusTabs = [
                    'all' => 'Semua Status',
                    'pending' => 'Pending (Menunggu)',
                    'diproses' => 'Sedang Diproses',
                    'selesai' => 'Selesai Ditangani',
                    'ditolak' => 'Ditolak',
                ];
            @endphp
            @foreach($statusTabs as $val => $label)
                <button type="button" wire:click="$set('statusFilter', '{{ $val }}')"
                        class="px-3 py-1.5 rounded-lg text-xs font-semibold whitespace-nowrap transition-all cursor-pointer {{ $statusFilter === $val ? 'bg-indigo-600 text-white shadow-xs' : 'bg-slate-100 text-slate-600 hover:bg-slate-200' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>
    </div>

    <!-- Table of Reports -->
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5">Kode Tiket</th>
                        <th class="px-6 py-3.5">Pelapor & Waktu</th>
                        <th class="px-6 py-3.5">Judul & Kategori</th>
                        <th class="px-6 py-3.5">Lokasi</th>
                        <th class="px-6 py-3.5">Status Saat Ini</th>
                        <th class="px-6 py-3.5 text-right">Tindakan Admin</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reports as $rep)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <!-- Kode Tiket -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-slate-900 block text-xs">{{ $rep->ticket_code }}</span>
                            </td>

                            <!-- Pelapor & Waktu -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-bold text-slate-900 block text-xs">{{ $rep->user->name ?? 'Warga' }}</span>
                                <span class="text-[11px] text-slate-400 block">{{ $rep->created_at->translatedFormat('d M Y, H:i') }}</span>
                            </td>

                            <!-- Judul & Kategori -->
                            <td class="px-6 py-4 max-w-sm">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 mb-1">
                                    {{ $rep->category }}
                                </span>
                                <p class="font-bold text-slate-900 line-clamp-1 text-sm">
                                    {{ $rep->title }}
                                </p>
                            </td>

                            <!-- Lokasi -->
                            <td class="px-6 py-4 text-xs text-slate-600 max-w-[180px] truncate">
                                {{ $rep->location }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($rep->status === 'selesai')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Selesai
                                    </span>
                                @elseif($rep->status === 'diproses')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                                        Diproses
                                    </span>
                                @elseif($rep->status === 'ditolak')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-rose-500"></span>
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                        Pending
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                <button type="button" wire:click="openVerifyModal({{ $rep->id }})"
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-xs cursor-pointer transition-all">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    <span>Tinjau & Tanggapi</span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                <p class="text-sm font-semibold text-slate-700">Tidak ada laporan pengaduan yang sesuai kriteria</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($reports->hasPages())
            <div class="p-4 border-t border-slate-100">
                {{ $reports->links() }}
            </div>
        @endif
    </div>

    <!-- MODAL VERIFIKASI & BALASAN RESMI KELURAHAN -->
    @if($showVerifyModal && $targetReport)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs transition-opacity" wire:click="closeVerifyModal"></div>

                <div class="relative bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full border border-slate-200">
                    <form wire:submit="saveVerification">
                        <!-- Header Modal -->
                        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                            <div>
                                <span class="font-mono text-xs font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $targetReport->ticket_code }}
                                </span>
                                <h3 class="text-lg font-bold text-slate-900 mt-1">Verifikasi & Tanggapan Petugas</h3>
                            </div>
                            <button type="button" wire:click="closeVerifyModal" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <!-- Body Modal -->
                        <div class="p-6 space-y-5 max-h-[75vh] overflow-y-auto">
                            <!-- Informasi Laporan Masuk -->
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 space-y-2">
                                <div class="flex items-center justify-between text-xs text-slate-500">
                                    <span>Pelapor: <strong class="text-slate-800">{{ $targetReport->user->name }}</strong> (NIK: {{ $targetReport->user->nik ?? '-' }})</span>
                                    <span>Kategori: <strong class="text-indigo-600">{{ $targetReport->category }}</strong></span>
                                </div>
                                <h4 class="text-sm font-bold text-slate-900">{{ $targetReport->title }}</h4>
                                <p class="text-xs text-slate-600 leading-relaxed whitespace-pre-line">{{ $targetReport->description }}</p>
                                <p class="text-xs text-slate-500 pt-1"><strong>Lokasi:</strong> {{ $targetReport->location }}</p>

                                @if($targetReport->photo_path)
                                    <div class="pt-2">
                                        <p class="text-[11px] font-bold text-slate-400 mb-1">Lampiran Foto Bukti:</p>
                                        <img src="{{ Storage::url($targetReport->photo_path) }}" alt="Bukti" class="h-32 rounded-xl object-cover border border-slate-200">
                                    </div>
                                @endif
                            </div>

                            <!-- Pilih Status Baru -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                                    1. Ubah Status Tindak Lanjut
                                </label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="flex items-center gap-2 p-3 rounded-xl border cursor-pointer {{ $newStatus === 'diproses' ? 'border-sky-500 bg-sky-50 text-sky-900 ring-1 ring-sky-500' : 'border-slate-200 text-slate-700' }}">
                                        <input type="radio" wire:model="newStatus" value="diproses" class="text-sky-600 focus:ring-sky-500">
                                        <span class="text-xs font-bold">Diproses</span>
                                    </label>

                                    <label class="flex items-center gap-2 p-3 rounded-xl border cursor-pointer {{ $newStatus === 'selesai' ? 'border-emerald-500 bg-emerald-50 text-emerald-900 ring-1 ring-emerald-500' : 'border-slate-200 text-slate-700' }}">
                                        <input type="radio" wire:model="newStatus" value="selesai" class="text-emerald-600 focus:ring-emerald-500">
                                        <span class="text-xs font-bold">Selesai</span>
                                    </label>

                                    <label class="flex items-center gap-2 p-3 rounded-xl border cursor-pointer {{ $newStatus === 'ditolak' ? 'border-rose-500 bg-rose-50 text-rose-900 ring-1 ring-rose-500' : 'border-slate-200 text-slate-700' }}">
                                        <input type="radio" wire:model="newStatus" value="ditolak" class="text-rose-600 focus:ring-rose-500">
                                        <span class="text-xs font-bold">Ditolak</span>
                                    </label>
                                </div>
                                @error('newStatus') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>

                            <!-- Formulir Tanggapan Resmi -->
                            <div>
                                <label for="adminResponse" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                                    2. Catatan & Tanggapan Resmi Kelurahan <span class="text-rose-500">*</span>
                                </label>
                                <textarea id="adminResponse" wire:model="adminResponse" rows="4"
                                          placeholder="Tuliskan tindakan yang telah/sedang diambil oleh dinas terkait, tanggal penyelesaian, atau alasan penolakan jika tidak valid..."
                                          class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-xs sm:text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 text-slate-900 placeholder:text-slate-400"></textarea>
                                <p class="text-[11px] text-slate-400 mt-1">Catatan ini akan langsung terlihat oleh warga pelapor secara transparan pada timeline tiket.</p>
                                @error('adminResponse') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Footer Modal with 3rd layer loading state -->
                        <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-2">
                            <button type="button" wire:click="closeVerifyModal"
                                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-200">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled"
                                    class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm flex items-center gap-1.5 cursor-pointer">
                                <span wire:loading.remove wire:target="saveVerification">Simpan & Terbitkan Tanggapan</span>
                                <span wire:loading wire:target="saveVerification" class="flex items-center gap-1.5">
                                    <svg class="animate-spin h-3.5 w-3.5 text-white" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                                    <span>Menyimpan Tanggapan...</span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
