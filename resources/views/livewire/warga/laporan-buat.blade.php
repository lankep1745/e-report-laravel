<div class="max-w-3xl mx-auto">
    <!-- Header -->
    <div class="mb-6 flex items-center justify-between">
        <div>
            <div class="flex items-center gap-2 text-xs text-slate-500 mb-1">
                <a href="{{ route('warga.dashboard') }}" wire:navigate class="hover:text-indigo-600">Dashboard</a>
                <span>/</span>
                <span class="text-slate-700 font-semibold">Buat Pengaduan</span>
            </div>
            <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Form Pengaduan Warga</h1>
            <p class="text-xs text-slate-500 mt-0.5">Sampaikan laporan permasalahan lingkungan dengan data yang akurat dan jelas</p>
        </div>
        <a href="{{ route('warga.laporan') }}" wire:navigate
           class="px-3.5 py-2 rounded-xl text-xs font-semibold text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-all">
            &larr; Riwayat Laporan
        </a>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm">
        <form wire:submit="submit" class="space-y-6">

            <!-- 1. Kategori Berikon -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
                    1. Pilih Kategori Laporan <span class="text-rose-500">*</span>
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-3">
                    @php
                        $icons = [
                            'Infrastruktur & Jalan' => 'M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7',
                            'Kebersihan & Sampah' => 'M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16',
                            'Lampu & Kelistrikan' => 'M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z',
                            'Keamanan & Ketertiban' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                            'Saluran Air & Banjir' => 'M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z',
                            'Lainnya' => 'M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
                        ];
                    @endphp

                    @foreach($categories as $cat)
                        <button type="button" wire:click="selectCategory('{{ $cat }}')"
                                class="p-3.5 rounded-2xl border text-left flex flex-col justify-between transition-all cursor-pointer {{ $category === $cat ? 'border-indigo-600 bg-indigo-50/60 ring-2 ring-indigo-500/20 shadow-xs' : 'border-slate-200 hover:border-slate-300 bg-slate-50/40' }}">
                            <div class="w-8 h-8 rounded-xl flex items-center justify-center mb-2 {{ $category === $cat ? 'bg-indigo-600 text-white' : 'bg-white text-slate-600 border border-slate-200' }}">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icons[$cat] ?? 'M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z' }}"/>
                                </svg>
                            </div>
                            <span class="text-xs font-bold {{ $category === $cat ? 'text-indigo-900' : 'text-slate-800' }}">
                                {{ $cat }}
                            </span>
                        </button>
                    @endforeach
                </div>
                @error('category') <span class="text-xs text-rose-600 mt-1.5 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- 2. Judul Laporan -->
            <div>
                <label for="title" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    2. Judul Singkat Pengaduan <span class="text-rose-500">*</span>
                </label>
                <input type="text" id="title" wire:model="title"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                       placeholder="Contoh: Lampu Penerangan Jalan Padam di Depan Gang Kelinci">
                @error('title') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- 3. Lokasi Kejadian -->
            <div>
                <label for="location" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    3. Lokasi Spesifik / Patokan <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <input type="text" id="location" wire:model="location"
                           class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                           placeholder="Contoh: Jl. Merdeka RT 03/RW 05 (Depan Gapura Hijau)">
                </div>
                @error('location') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- 4. Deskripsi Lengkap -->
            <div>
                <label for="description" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    4. Detail Uraian Masalah <span class="text-rose-500">*</span>
                </label>
                <textarea id="description" wire:model="description" rows="4"
                          class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                          placeholder="Jelaskan secara rinci permasalahan yang terjadi, sudah berapa lama terjadi, dan dampak bagi warga sekitar..."></textarea>
                <p class="text-[11px] text-slate-400 mt-1">Minimal 20 karakter agar verifikasi petugas berlangsung cepat.</p>
                @error('description') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- 5. Upload Foto Bukti dengan Live Preview -->
            <div>
                <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-1.5">
                    5. Foto Bukti Pendukung (Opsional)
                </label>

                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-2xl hover:border-indigo-400 transition-colors bg-slate-50/50">
                    <div class="space-y-2 text-center">
                        @if ($photo)
                            <div class="mb-4">
                                <p class="text-xs font-bold text-indigo-600 mb-2">Pratinjau Foto Terpilih:</p>
                                <img src="{{ $photo->temporaryUrl() }}" class="mx-auto max-h-56 rounded-xl shadow-md border border-slate-200 object-cover">
                            </div>
                        @else
                            <svg class="mx-auto h-12 w-12 text-slate-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        @endif

                        <div class="flex text-sm text-slate-600 justify-center">
                            <label for="photo" class="relative cursor-pointer bg-white rounded-lg font-semibold text-indigo-600 hover:text-indigo-500 focus-within:outline-hidden">
                                <span>{{ $photo ? 'Ganti Foto' : 'Pilih Foto dari Perangkat' }}</span>
                                <input id="photo" wire:model="photo" type="file" accept="image/*" class="sr-only">
                            </label>
                        </div>
                        <p class="text-xs text-slate-400">PNG, JPG, WEBP hingga maksimal 5MB</p>
                    </div>
                </div>

                <!-- Livewire file uploading indicator -->
                <div wire:loading wire:target="photo" class="text-xs text-indigo-600 font-semibold mt-2 flex items-center gap-1.5">
                    <svg class="animate-spin h-3.5 w-3.5 text-indigo-600" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Mengunggah pratinjau gambar...</span>
                </div>
                @error('photo') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Submit Button with 3rd layer loading state -->
            <div class="pt-4 border-t border-slate-100 flex items-center justify-end gap-3">
                <a href="{{ route('warga.dashboard') }}" wire:navigate
                   class="px-5 py-2.5 rounded-xl text-sm font-semibold text-slate-600 hover:bg-slate-100 transition-all">
                    Batal
                </a>

                <button type="submit" 
                        wire:loading.attr="disabled"
                        class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer">
                    <span wire:loading.remove wire:target="submit" class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                        <span>Kirim Tiket Pengaduan</span>
                    </span>

                    <span wire:loading wire:target="submit" class="flex items-center gap-2">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Mengirim Tiket...</span>
                    </span>
                </button>
            </div>
        </form>
    </div>
</div>
