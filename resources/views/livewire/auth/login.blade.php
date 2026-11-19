<div class="py-12 px-4 sm:px-6 lg:px-8 max-w-md mx-auto">
    <div class="bg-white p-8 sm:p-10 rounded-3xl shadow-xl shadow-slate-200/60 border border-slate-200">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-12 h-12 rounded-2xl bg-indigo-600 text-white flex items-center justify-center mx-auto mb-3 shadow-md shadow-indigo-200 font-bold text-lg">
                ERP
            </div>
            <h1 class="text-2xl font-bold tracking-tight text-slate-900">Masuk ke E-Report</h1>
            <p class="text-xs text-slate-500 mt-1">Masukkan kredensial akun Anda untuk melanjutkan</p>
        </div>

        <!-- Quick Demo Pill Selector -->
        <div class="mb-6 p-3 rounded-2xl bg-slate-50 border border-slate-200/80 text-xs">
            <p class="font-semibold text-slate-700 mb-2 flex items-center gap-1.5">
                <span class="w-2 h-2 rounded-full bg-indigo-500"></span>
                Akses Demo Cepat:
            </p>
            <div class="grid grid-cols-2 gap-2">
                <button type="button" wire:click="fillAdminCredentials"
                        class="px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 font-medium text-slate-700 hover:border-indigo-500 hover:text-indigo-600 shadow-2xs transition-all text-left">
                    <span class="block font-bold">Admin Demo</span>
                    <span class="text-[10px] text-slate-400 block truncate">admin@ereport.test</span>
                </button>
                <button type="button" wire:click="fillWargaCredentials"
                        class="px-2.5 py-1.5 rounded-xl bg-white border border-slate-200 font-medium text-slate-700 hover:border-emerald-500 hover:text-emerald-600 shadow-2xs transition-all text-left">
                    <span class="block font-bold">Warga Demo</span>
                    <span class="text-[10px] text-slate-400 block truncate">lana@ereport.test</span>
                </button>
            </div>
        </div>

        <!-- Form -->
        <form wire:submit="login" class="space-y-4">
            <!-- Email -->
            <div>
                <label for="email" class="block text-xs font-semibold text-slate-700 mb-1.5">Alamat Email</label>
                <input type="email" id="email" wire:model="email" 
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                       placeholder="nama@email.com" autocomplete="email">
                @error('email') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Password -->
            <div>
                <div class="flex items-center justify-between mb-1.5">
                    <label for="password" class="block text-xs font-semibold text-slate-700">Kata Sandi</label>
                </div>
                <input type="password" id="password" wire:model="password"
                       class="w-full px-4 py-2.5 rounded-xl border border-slate-300 text-sm focus:border-indigo-600 focus:ring-2 focus:ring-indigo-100 transition-all text-slate-900 placeholder:text-slate-400"
                       placeholder="••••••••" autocomplete="current-password">
                @error('password') <span class="text-xs text-rose-600 mt-1 block font-medium">{{ $message }}</span> @enderror
            </div>

            <!-- Remember me -->
            <div class="flex items-center justify-between py-1">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" wire:model="remember" class="w-4 h-4 rounded text-indigo-600 border-slate-300 focus:ring-indigo-500">
                    <span class="text-xs text-slate-600">Ingat sesi saya</span>
                </label>
            </div>

            <!-- Submit Button with 3rd layer loading state -->
            <button type="submit" 
                    wire:loading.attr="disabled"
                    class="w-full flex items-center justify-center gap-2 px-5 py-3 rounded-xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all disabled:opacity-70 disabled:cursor-not-allowed cursor-pointer">
                <!-- Idle State Icon -->
                <span wire:loading.remove wire:target="login" class="flex items-center gap-2">
                    <span>Masuk ke Dashboard</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </span>

                <!-- Action Loading State Spinner -->
                <span wire:loading wire:target="login" class="flex items-center gap-2">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Memverifikasi Kredensial...</span>
                </span>
            </button>
        </form>

        <!-- Footer link -->
        <div class="mt-6 pt-6 border-t border-slate-100 text-center">
            <p class="text-xs text-slate-500">
                Warga baru di kelurahan? 
                <a href="{{ route('register') }}" wire:navigate class="font-bold text-indigo-600 hover:text-indigo-800 ml-1">
                    Daftar Akun Sekarang
                </a>
            </p>
        </div>
    </div>
</div>
