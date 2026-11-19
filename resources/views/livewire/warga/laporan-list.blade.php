<div>
    <!-- Page Header & Action -->
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Riwayat Pengaduan</h1>
            <p class="text-xs text-slate-500 mt-0.5">Kelola dan pantau seluruh laporan yang telah Anda sampaikan ke kelurahan</p>
        </div>
        <a href="{{ route('warga.laporan.buat') }}" wire:navigate
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm shadow-indigo-200 transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            <span>Buat Laporan Baru</span>
        </a>
    </div>

    <!-- Filters & Search Bar -->
    <div class="bg-white p-4 rounded-2xl border border-slate-200/80 shadow-xs mb-6 flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-3">
        <!-- Search Input -->
        <div class="relative flex-1">
            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            </div>
            <input type="text" wire:model.live.debounce.300ms="search"
                   placeholder="Cari berdasarkan judul, nomor tiket (ERP-...), atau lokasi..."
                   class="w-full pl-9 pr-4 py-2 rounded-xl border border-slate-200 text-xs sm:text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 text-slate-900 placeholder:text-slate-400">
        </div>

        <!-- Status Filter Pills -->
        <div class="flex items-center gap-1.5 overflow-x-auto pb-1 sm:pb-0">
            @php
                $statusTabs = [
                    'all' => 'Semua',
                    'pending' => 'Pending',
                    'diproses' => 'Diproses',
                    'selesai' => 'Selesai',
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

    <!-- Reports Table / Card List -->
    <div class="bg-white rounded-3xl border border-slate-200/90 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs sm:text-sm">
                <thead class="bg-slate-50/80 border-b border-slate-200/80 text-[11px] font-bold text-slate-400 uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-3.5">Tiket & Tanggal</th>
                        <th class="px-6 py-3.5">Judul & Kategori</th>
                        <th class="px-6 py-3.5">Lokasi</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($reports as $rep)
                        <tr class="hover:bg-slate-50/60 transition-colors">
                            <!-- Tiket & Tanggal -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="font-mono font-bold text-slate-900 block text-xs">{{ $rep->ticket_code }}</span>
                                <span class="text-[11px] text-slate-400 block mt-0.5">{{ $rep->created_at->translatedFormat('d M Y, H:i') }}</span>
                            </td>

                            <!-- Judul & Kategori -->
                            <td class="px-6 py-4">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-50 text-indigo-700 mb-1">
                                    {{ $rep->category }}
                                </span>
                                <p class="font-bold text-slate-900 line-clamp-1 max-w-sm text-sm">
                                    {{ $rep->title }}
                                </p>
                            </td>

                            <!-- Lokasi -->
                            <td class="px-6 py-4 text-xs text-slate-600 max-w-[200px] truncate">
                                {{ $rep->location }}
                            </td>

                            <!-- Status -->
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($rep->status === 'selesai')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                        Selesai Ditangani
                                    </span>
                                @elseif($rep->status === 'diproses')
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                        <span class="w-1.5 h-1.5 rounded-full bg-sky-500 animate-pulse"></span>
                                        Sedang Diproses
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
                            <td class="px-6 py-4 whitespace-nowrap text-right space-x-1.5">
                                <!-- Detail Button -->
                                <button type="button" wire:click="openDetail({{ $rep->id }})"
                                        class="inline-flex items-center gap-1 px-3 py-1.5 rounded-lg text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200 transition-colors">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    <span>Detail</span>
                                </button>

                                <!-- Edit & Delete Button (Hanya jika status pending) -->
                                @if($rep->status === 'pending')
                                    <button type="button" wire:click="openEdit({{ $rep->id }})"
                                            title="Ubah Laporan"
                                            class="inline-flex items-center p-1.5 rounded-lg text-xs font-semibold text-amber-700 bg-amber-50 hover:bg-amber-100 border border-amber-200 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>

                                    <button type="button" wire:click="confirmDelete({{ $rep->id }})"
                                            title="Hapus Laporan"
                                            class="inline-flex items-center p-1.5 rounded-lg text-xs font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 border border-rose-200 transition-colors">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-slate-400">
                                <div class="max-w-xs mx-auto text-center">
                                    <svg class="w-10 h-10 mx-auto text-slate-300 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                                    <p class="text-sm font-semibold text-slate-700">Tidak ada laporan yang ditemukan</p>
                                    <p class="text-xs text-slate-400 mt-1">Coba sesuaikan kata kunci pencarian atau filter status tiket Anda.</p>
                                </div>
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

    <!-- MODAL 1: DETAIL LAPORAN & TIMELINE -->
    @if($showDetailModal && $selectedReport)
        <div class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs transition-opacity" wire:click="closeDetail"></div>

                <div class="relative bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full border border-slate-200">
                    <!-- Modal Header -->
                    <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                        <div>
                            <div class="flex items-center gap-2">
                                <span class="font-mono text-xs font-bold text-slate-500 bg-slate-100 px-2 py-0.5 rounded">
                                    {{ $selectedReport->ticket_code }}
                                </span>
                                <span class="text-xs font-bold text-indigo-600">
                                    {{ $selectedReport->category }}
                                </span>
                            </div>
                            <h3 class="text-lg font-bold text-slate-900 mt-1" id="modal-title">
                                {{ $selectedReport->title }}
                            </h3>
                        </div>
                        <button type="button" wire:click="closeDetail" class="p-2 text-slate-400 hover:text-slate-600 rounded-lg hover:bg-slate-100">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </button>
                    </div>

                    <!-- Modal Body -->
                    <div class="p-6 space-y-6 max-h-[75vh] overflow-y-auto">
                        <!-- Lokasi & Waktu -->
                        <div class="grid grid-cols-2 gap-4 text-xs">
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="font-semibold text-slate-400 block mb-1">Lokasi Laporan:</span>
                                <span class="font-medium text-slate-800">{{ $selectedReport->location }}</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100">
                                <span class="font-semibold text-slate-400 block mb-1">Waktu Pelaporan:</span>
                                <span class="font-medium text-slate-800">{{ $selectedReport->created_at->translatedFormat('d F Y, H:i') }} WIB</span>
                            </div>
                        </div>

                        <!-- Uraian Deskripsi -->
                        <div>
                            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Uraian Pengaduan</h4>
                            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs sm:text-sm text-slate-700 leading-relaxed whitespace-pre-line">
                                {{ $selectedReport->description }}
                            </div>
                        </div>

                        <!-- Foto Bukti -->
                        @if($selectedReport->photo_path)
                            <div>
                                <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Lampiran Foto Bukti</h4>
                                <div class="rounded-2xl overflow-hidden border border-slate-200 shadow-xs max-h-72 bg-slate-100 flex items-center justify-center">
                                    <img src="{{ Storage::url($selectedReport->photo_path) }}" alt="Foto Bukti" class="max-h-72 w-full object-contain">
                                </div>
                            </div>
                        @endif

                        <!-- Status & Balasan Resmi Kelurahan (Timeline) -->
                        <div class="pt-4 border-t border-slate-100">
                            <h4 class="text-xs font-bold text-slate-700 uppercase tracking-wider mb-3">Status & Tanggapan Petugas Kelurahan</h4>
                            
                            <div class="p-4 rounded-2xl border {{ $selectedReport->status === 'selesai' ? 'bg-emerald-50/60 border-emerald-200' : ($selectedReport->status === 'diproses' ? 'bg-sky-50/60 border-sky-200' : ($selectedReport->status === 'ditolak' ? 'bg-rose-50/60 border-rose-200' : 'bg-amber-50/60 border-amber-200')) }}">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold uppercase tracking-wider {{ $selectedReport->status === 'selesai' ? 'text-emerald-700' : ($selectedReport->status === 'diproses' ? 'text-sky-700' : ($selectedReport->status === 'ditolak' ? 'text-rose-700' : 'text-amber-700')) }}">
                                        Status: {{ ucfirst($selectedReport->status) }}
                                    </span>
                                    @if($selectedReport->responded_at)
                                        <span class="text-[11px] text-slate-500">
                                            Diverifikasi: {{ $selectedReport->responded_at->translatedFormat('d M Y, H:i') }} WIB
                                        </span>
                                    @endif
                                </div>

                                @if($selectedReport->admin_response)
                                    <div class="text-xs sm:text-sm text-slate-800 leading-relaxed font-normal bg-white p-3.5 rounded-xl border border-slate-200/80 shadow-2xs">
                                        <p class="font-bold text-indigo-700 text-xs mb-1">Catatan Resmi Petugas:</p>
                                        {{ $selectedReport->admin_response }}
                                    </div>
                                    @if($selectedReport->responder)
                                        <p class="text-[10px] text-slate-400 mt-2 text-right">Ditanggapi oleh: {{ $selectedReport->responder->name }} (Aparatur Kelurahan)</p>
                                    @endif
                                @else
                                    <p class="text-xs text-slate-600 italic">
                                        Laporan Anda telah tercatat di sistem kelurahan dan sedang menunggu giliran verifikasi oleh petugas terkait.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                        <button type="button" wire:click="closeDetail"
                                class="px-5 py-2.5 rounded-xl text-xs font-bold text-slate-700 bg-white border border-slate-200 hover:bg-slate-100 transition-all">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- MODAL 2: EDIT LAPORAN PENDING -->
    @if($showEditModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs transition-opacity" wire:click="$set('showEditModal', false)"></div>

                <div class="relative bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-xl sm:w-full border border-slate-200">
                    <form wire:submit="updateReport">
                        <div class="p-6 border-b border-slate-100 flex items-center justify-between">
                            <h3 class="text-lg font-bold text-slate-900">Perbarui Pengaduan Pending</h3>
                            <button type="button" wire:click="$set('showEditModal', false)" class="text-slate-400 hover:text-slate-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>

                        <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                            <!-- Kategori -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Kategori</label>
                                <select wire:model="editCategory" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat }}">{{ $cat }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Judul -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Judul Laporan</label>
                                <input type="text" wire:model="editTitle" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs">
                                @error('editTitle') <span class="text-xs text-rose-600 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <!-- Lokasi -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Lokasi</label>
                                <input type="text" wire:model="editLocation" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs">
                                @error('editLocation') <span class="text-xs text-rose-600 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Deskripsi Masalah</label>
                                <textarea wire:model="editDescription" rows="4" class="w-full px-3 py-2 rounded-xl border border-slate-300 text-xs"></textarea>
                                @error('editDescription') <span class="text-xs text-rose-600 font-medium">{{ $message }}</span> @enderror
                            </div>

                            <!-- Foto Baru (opsional) -->
                            <div>
                                <label class="block text-xs font-bold text-slate-700 mb-1">Perbarui Foto (Opsional)</label>
                                @if($currentPhotoPath && !$editPhoto)
                                    <div class="mb-2">
                                        <p class="text-[11px] text-slate-400 mb-1">Foto saat ini:</p>
                                        <img src="{{ Storage::url($currentPhotoPath) }}" class="h-20 rounded-lg object-cover border border-slate-200">
                                    </div>
                                @endif
                                <input type="file" wire:model="editPhoto" accept="image/*" class="text-xs text-slate-500">
                                @error('editPhoto') <span class="text-xs text-rose-600 font-medium">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="p-4 bg-slate-50 border-t border-slate-100 flex justify-end gap-2">
                            <button type="button" wire:click="$set('showEditModal', false)"
                                    class="px-4 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:bg-slate-200">
                                Batal
                            </button>
                            <button type="submit" wire:loading.attr="disabled"
                                    class="px-4 py-2 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 flex items-center gap-1.5 cursor-pointer">
                                <span wire:loading.remove wire:target="updateReport">Simpan Perubahan</span>
                                <span wire:loading wire:target="updateReport">Menyimpan...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    <!-- MODAL 3: DELETE CONFIRMATION -->
    @if($showDeleteModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" role="dialog" aria-modal="true">
            <div class="flex items-end sm:items-center justify-center min-h-full p-4 text-center sm:p-0">
                <div class="fixed inset-0 bg-slate-900/40 backdrop-blur-xs" wire:click="$set('showDeleteModal', false)"></div>

                <div class="relative bg-white rounded-3xl p-6 text-center max-w-sm w-full mx-auto shadow-2xl border border-slate-200">
                    <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center mx-auto mb-4 border border-rose-100">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <h3 class="text-base font-bold text-slate-900 mb-1">Hapus Pengaduan Ini?</h3>
                    <p class="text-xs text-slate-500 mb-6">Tindakan ini permanen dan tiket laporan ini akan dihapus dari antrean kelurahan.</p>

                    <div class="flex items-center justify-center gap-3">
                        <button type="button" wire:click="$set('showDeleteModal', false)"
                                class="w-full px-4 py-2.5 rounded-xl text-xs font-semibold text-slate-700 bg-slate-100 hover:bg-slate-200">
                            Batal
                        </button>
                        <button type="button" wire:click="deleteReport" wire:loading.attr="disabled"
                                class="w-full px-4 py-2.5 rounded-xl text-xs font-bold text-white bg-rose-600 hover:bg-rose-700 shadow-sm cursor-pointer">
                            <span wire:loading.remove wire:target="deleteReport">Ya, Hapus</span>
                            <span wire:loading wire:target="deleteReport">Menghapus...</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
