<!DOCTYPE html>
<html lang="id" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 - Akses Ditolak | E-Report</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full flex items-center justify-center p-6 text-slate-800 antialiased font-sans">
    <div class="max-w-md w-full text-center bg-white p-8 sm:p-10 rounded-3xl shadow-xl shadow-slate-200/50 border border-slate-200">
        <div class="w-20 h-20 mx-auto mb-6 rounded-2xl bg-amber-50 border border-amber-200 flex items-center justify-center text-amber-600 shadow-inner">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
            </svg>
        </div>

        <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-red-50 text-red-700 border border-red-200 mb-3">
            <span class="w-2 h-2 rounded-full bg-red-500 animate-pulse"></span>
            Error 403: Akses Terbatas
        </div>

        <h1 class="text-2xl font-bold tracking-tight text-slate-900 mb-2">Akses Ditolak</h1>
        <p class="text-sm text-slate-600 leading-relaxed mb-8">
            {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses atau izin untuk melihat halaman ini.' }}
        </p>

        <div class="space-y-3">
            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="w-full inline-flex justify-center items-center px-5 py-3 rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all">
                        Kembali ke Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('warga.dashboard') }}" class="w-full inline-flex justify-center items-center px-5 py-3 rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all">
                        Kembali ke Dashboard Warga
                    </a>
                @endif
            @else
                <a href="{{ route('login') }}" class="w-full inline-flex justify-center items-center px-5 py-3 rounded-xl text-sm font-semibold text-white bg-indigo-600 hover:bg-indigo-700 shadow-md shadow-indigo-200 transition-all">
                    Masuk ke Akun Anda
                </a>
            @endauth

            <a href="/" class="w-full inline-flex justify-center items-center px-5 py-2.5 rounded-xl text-sm font-medium text-slate-600 hover:text-slate-900 hover:bg-slate-100 transition-all">
                Halaman Utama
            </a>
        </div>
    </div>
</body>
</html>
