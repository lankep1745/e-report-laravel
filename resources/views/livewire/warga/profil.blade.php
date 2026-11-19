<div class="max-w-4xl mx-auto space-y-8">
    <!-- Header -->
    <div>
        <h1 class="text-2xl font-extrabold text-slate-900 tracking-tight">Pengaturan Profil & Keamanan</h1>
        <p class="text-xs text-slate-500 mt-0.5">Kelola informasi identitas kependudukan dan kata sandi akun Anda</p>
    </div>

    <!-- Section 1: Profil Warga -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm">
        <div class="flex items-center gap-3 pb-6 border-b border-slate-100">
            <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900">Informasi Kependudukan</h2>
                <p class="text-xs text-slate-400">Pastikan data sesuai dengan kartu tanda penduduk (KTP)</p>
            </div>
        </div>

        <form wire:submit="updateProfile" class="mt-6 space-y-4">
            <!-- Nama -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Nama Lengkap</label>
                <input type="text" wire:model="name" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600">
                @error('name') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- NIK & No HP -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">NIK (16 Digit)</label>
                    <input type="text" wire:model="nik" maxlength="16" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600 font-mono">
                    @error('nik') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">No. Handphone / WA</label>
                    <input type="text" wire:model="phone" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600">
                    @error('phone') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                <input type="email" wire:model="email" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600">
                @error('email') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Lengkap</label>
                <textarea wire:model="address" rows="3" class="w-full px-4 py-2 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600"></textarea>
                @error('address') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" wire:loading.attr="disabled"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-sm transition-all cursor-pointer">
                    <span wire:loading.remove wire:target="updateProfile">Simpan Data Diri</span>
                    <span wire:loading wire:target="updateProfile">Memperbarui...</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Section 2: Ganti Password -->
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200/90 shadow-sm">
        <div class="flex items-center gap-3 pb-6 border-b border-slate-100">
            <div class="w-10 h-10 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
            </div>
            <div>
                <h2 class="text-base font-bold text-slate-900">Keamanan & Kata Sandi</h2>
                <p class="text-xs text-slate-400">Perbarui kata sandi secara berkala untuk menjaga keamanan akun Anda</p>
            </div>
        </div>

        <form wire:submit="updatePassword" class="mt-6 space-y-4 max-w-xl">
            <!-- Current Password -->
            <div>
                <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Saat Ini</label>
                <input type="password" wire:model="current_password" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600">
                @error('current_password') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
            </div>

            <!-- New Password & Confirm -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Kata Sandi Baru</label>
                    <input type="password" wire:model="password" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600">
                    @error('password') <span class="text-xs text-rose-600 mt-1 block">{{ $message }}</span> @enderror
                </div>
                <div>
                    <label class="block text-xs font-semibold text-slate-700 mb-1.5">Konfirmasi Kata Sandi</label>
                    <input type="password" wire:model="password_confirmation" class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-1 focus:ring-indigo-600">
                </div>
            </div>

            <div class="pt-4 flex justify-end">
                <button type="submit" wire:loading.attr="disabled"
                        class="px-5 py-2.5 rounded-xl text-xs font-bold text-white bg-slate-800 hover:bg-slate-900 shadow-sm transition-all cursor-pointer">
                    <span wire:loading.remove wire:target="updatePassword">Ubah Kata Sandi</span>
                    <span wire:loading wire:target="updatePassword">Mengubah...</span>
                </button>
            </div>
        </form>
    </div>
</div>
