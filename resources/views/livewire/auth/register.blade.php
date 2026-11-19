<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-xl mx-auto">
    <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center mx-auto mb-3 shadow-md shadow-indigo-200 font-bold text-lg">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Pendaftaran Warga</h1>
            <p class="text-xs text-slate-500 mt-1">Lengkapi data diri Anda untuk menyampaikan aspirasi dan pengaduan</p>
        </div>

        <form wire:submit="register" class="space-y-4">
            <!-- Nama Lengkap -->
            <div>
                <label for="name" class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap (Sesuai KTP)</label>
                <input type="text" id="name" wire:model="name"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                       placeholder="Contoh: Lana Khairunnas">
                @error('name') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- NIK (16 Digit) & No HP Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="nik" class="block text-xs font-semibold text-slate-700 mb-1.5">Nomor Induk Kependudukan (NIK)</label>
                    <input type="text" id="nik" wire:model="nik" maxlength="16"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400 font-mono"
                           placeholder="16 digit angka">
                    @error('nik') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="phone" class="block text-xs font-semibold text-slate-700 mb-1.5">No. Handphone / WhatsApp</label>
                    <input type="text" id="phone" wire:model="phone"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                           placeholder="08123456789">
                    @error('phone') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email Aktif</label>
                <input type="email" id="email" wire:model="email"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                       placeholder="nama@email.com">
                @error('email') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Alamat Domisili -->
            <div>
                <label for="address" class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Domisili Lengkap (RT/RW)</label>
                <textarea id="address" wire:model="address" rows="2"
                          class="w-full px-4 py-2 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                          placeholder="Jl. Merdeka No. 12, RT 03/RW 05"></textarea>
                @error('address') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Password & Konfirmasi Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi</label>
                    <input type="password" id="password" wire:model="password"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                           placeholder="Minimal 8 karakter">
                    @error('password') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-xs font-semibold text-slate-700 mb-1.5">Ulangi Kata Sandi</label>
                    <input type="password" id="password_confirmation" wire:model="password_confirmation"
                           class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                           placeholder="Ulangi kata sandi">
                </div>
            </div>

            <!-- Submit Button with loading state -->
            <div class="pt-2">
                <button type="submit" 
                        wire:loading.attr="disabled"
                        class="w-full flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer">
                    <span wire:loading.remove wire:target="register" class="flex items-center gap-2">
                        <span>Daftarkan Akun & Lanjut</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                    </span>

                    <span wire:loading wire:target="register" class="flex items-center gap-2">
                        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <span>Mendaftarkan Data Anda...</span>
                    </span>
                </button>
            </div>
        </form>

        <div class="mt-6 pt-6 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-500">
                Sudah memiliki akun warga? 
                <a href="{{ route('login') }}" wire:navigate class="font-bold text-indigo-600 hover:text-indigo-800 ml-1">
                    Masuk di Sini
                </a>
            </p>
        </div>
    </div>
</div>
