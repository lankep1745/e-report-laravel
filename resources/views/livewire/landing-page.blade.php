<div>
    <!-- Hero Section -->
    <section class="relative overflow-hidden pt-12 pb-20 lg:pt-20 lg:pb-28 border-b border-slate-200/70 bg-gradient-to-b from-white via-indigo-50/20 to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7 space-y-6 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full text-xs font-semibold bg-indigo-50 text-indigo-700 border border-indigo-100/80 shadow-xs">
                        <span class="w-2 h-2 rounded-full bg-indigo-600 animate-pulse"></span>
                        Transparansi & Pelayanan Kelurahan 4.0
                    </div>

                    <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-slate-900 leading-[1.15]">
                        Sampaikan Keluhan, <br class="hidden sm:inline">
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-sky-600">
                            Wujudkan Lingkungan
                        </span> Idaman.
                    </h1>

                    <p class="text-base sm:text-lg text-slate-600 max-w-2xl mx-auto lg:mx-0 font-normal leading-relaxed">
                        Platform pelaporan terpadu warga untuk infrastruktur rusak, kebersihan lingkungan, dan ketertiban umum. Terhubung langsung dengan pihak kelurahan secara cepat, transparan, dan dapat dipantau real-time.
                    </p>

                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-3.5 pt-2">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" wire:navigate
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all">
                                    <span>Buka Dashboard Petugas</span>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @else
                                <a href="{{ route('warga.laporan.buat') }}" wire:navigate
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    <span>Laporkan Masalah Sekarang</span>
                                </a>
                                <a href="{{ route('warga.dashboard') }}" wire:navigate
                                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 shadow-xs transition-all">
                                    <span>Dashboard Tiket Saya</span>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('register') }}" wire:navigate
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold text-white bg-indigo-600 hover:bg-indigo-700 shadow-lg shadow-indigo-200 hover:shadow-indigo-300 transition-all">
                                <span>Mulai Buat Laporan</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                            </a>
                            <a href="{{ route('login') }}" wire:navigate
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-200 shadow-xs transition-all">
                                <span>Masuk ke Akun</span>
                            </a>
                        @endauth
                    </div>

                    <!-- Trust factors -->
                    <div class="pt-6 flex flex-wrap items-center justify-center lg:justify-start gap-6 text-xs text-slate-500">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>Respons Maksimal 2x24 Jam</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-600" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>Bukti Foto & Validasi NIK</span>
                        </div>
                    </div>
                </div>

                <!-- Hero Illustration / Interactive preview card -->
                <div class="lg:col-span-5">
                    <div class="relative mx-auto max-w-md bg-white rounded-3xl p-6 shadow-2xl shadow-slate-200/80 border border-slate-200/90">
                        <!-- Header badge -->
                        <div class="flex items-center justify-between pb-4 border-b border-slate-100">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-xs">
                                    ERP
                                </div>
                                <div>
                                    <span class="text-xs font-bold text-slate-800 block">Tiket Terverifikasi</span>
                                    <span class="text-[10px] text-slate-400">ERP-2026-0001</span>
                                </div>
                            </div>
                            <span class="px-2.5 py-1 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200 flex items-center gap-1.5">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                                Selesai Ditangani
                            </span>
                        </div>

                        <!-- Card Body Content -->
                        <div class="py-4 space-y-3">
                            <h3 class="text-sm font-bold text-slate-900 leading-snug">
                                Perbaikan Lampu Penerangan Jalan Umum (PJU) Gapura RW 05
                            </h3>
                            <div class="flex items-center gap-2 text-xs text-slate-500">
                                <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                <span>Jl. Merdeka RT 03/RW 05</span>
                            </div>
                            <div class="p-3 rounded-xl bg-slate-50 border border-slate-100 text-xs text-slate-600 leading-relaxed">
                                <span class="font-bold text-indigo-600">Tanggapan Kelurahan:</span> Tim teknisi telah mengganti bohlam LED 100W dan saklar otomatis. Lampu kini telah menyala terang kembali.
                            </div>
                        </div>

                        <!-- Mini stats in card -->
                        <div class="pt-3 border-t border-slate-100 flex items-center justify-between text-[11px] text-slate-400 font-medium">
                            <span>Pelapor: Lana Khairunnas</span>
                            <span>Status: Tuntas 100%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Real-time Stats Grid -->
    <section class="py-12 bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Stat 1 -->
                <div class="p-6 rounded-2xl bg-slate-50 border border-slate-200/80">
                    <p class="text-xs font-semibold text-slate-500 uppercase tracking-wider">Total Laporan Warga</p>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-slate-900">{{ $totalReports }}</span>
                        <span class="text-xs font-medium text-slate-400">tiket terdaftar</span>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="p-6 rounded-2xl bg-emerald-50/50 border border-emerald-200/60">
                    <p class="text-xs font-semibold text-emerald-700 uppercase tracking-wider">Tuntas / Selesai</p>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-emerald-600">{{ $resolvedReports }}</span>
                        <span class="text-xs font-medium text-emerald-600/70">laporan berhasil</span>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="p-6 rounded-2xl bg-sky-50/50 border border-sky-200/60">
                    <p class="text-xs font-semibold text-sky-700 uppercase tracking-wider">Sedang Diproses</p>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-sky-600">{{ $inProgressReports }}</span>
                        <span class="text-xs font-medium text-sky-600/70">dalam penanganan</span>
                    </div>
                </div>

                <!-- Stat 4 -->
                <div class="p-6 rounded-2xl bg-indigo-50/50 border border-indigo-200/60">
                    <p class="text-xs font-semibold text-indigo-700 uppercase tracking-wider">Warga Terdaftar</p>
                    <div class="mt-2 flex items-baseline gap-2">
                        <span class="text-3xl font-extrabold text-indigo-600">{{ $totalWarga }}</span>
                        <span class="text-xs font-medium text-indigo-600/70">partisipan aktif</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3 Langkah Alur Kerja -->
    <section class="py-16 lg:py-24 bg-slate-50/60 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-16">
                <h2 class="text-xs font-bold uppercase tracking-wider text-indigo-600 mb-2">Alur Pelayanan Mudah</h2>
                <p class="text-3xl font-extrabold text-slate-900 tracking-tight">Bagaimana E-Report Bekerja?</p>
                <p class="text-sm text-slate-500 mt-2">Tiga tahapan sederhana demi transparansi penanganan masalah di lingkungan kita.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Step 1 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm relative group hover:border-indigo-200 hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-indigo-50 border border-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-lg mb-6 group-hover:scale-110 transition-transform">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Tulis & Unggah Foto</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Pilih kategori aduan, jelaskan lokasi secara akurat, sertakan foto pendukung langsung dari perangkat Anda.
                    </p>
                </div>

                <!-- Step 2 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm relative group hover:border-indigo-200 hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-amber-50 border border-amber-100 text-amber-600 flex items-center justify-center font-bold text-lg mb-6 group-hover:scale-110 transition-transform">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Verifikasi & Penugasan</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Aparat kelurahan menelaah tiket pengaduan dan meneruskan instruksi ke dinas atau satgas teknis terkait di lapangan.
                    </p>
                </div>

                <!-- Step 3 -->
                <div class="bg-white p-8 rounded-3xl border border-slate-200 shadow-sm relative group hover:border-indigo-200 hover:shadow-md transition-all">
                    <div class="w-12 h-12 rounded-2xl bg-emerald-50 border border-emerald-100 text-emerald-600 flex items-center justify-center font-bold text-lg mb-6 group-hover:scale-110 transition-transform">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Tindakan & Selesai</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Masalah diperbaiki tuntas. Admin mencatat penjelasan resmi dan status tiket diperbarui menjadi selesai secara transparan.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Feed 3 Laporan Publik Terbaru -->
    <section class="py-16 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 gap-4">
                <div>
                    <h2 class="text-xs font-bold uppercase tracking-wider text-indigo-600 mb-1">Transparansi Publik</h2>
                    <p class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">Laporan Warga Terbaru</p>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">Aspirasi nyata yang telah disampaikan oleh warga kelurahan.</p>
                </div>
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.laporan') : route('warga.laporan') }}" wire:navigate
                       class="text-xs font-bold text-indigo-600 hover:text-indigo-800 flex items-center gap-1">
                        <span>Lihat Semua Laporan</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                @endauth
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @forelse($recentReports as $rep)
                    <div class="bg-slate-50 rounded-3xl p-6 border border-slate-200/80 flex flex-col justify-between hover:border-slate-300 transition-all shadow-xs">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-3">
                                <span class="text-[11px] font-bold text-slate-500 uppercase tracking-wider font-mono">
                                    {{ $rep->ticket_code }}
                                </span>
                                @if($rep->status === 'selesai')
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Selesai
                                    </span>
                                @elseif($rep->status === 'diproses')
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-sky-50 text-sky-700 border border-sky-200">
                                        Diproses
                                    </span>
                                @elseif($rep->status === 'ditolak')
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-rose-50 text-rose-700 border border-rose-200">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Pending
                                    </span>
                                @endif
                            </div>

                            <span class="inline-block text-[11px] font-semibold text-indigo-600 mb-1.5">
                                {{ $rep->category }}
                            </span>

                            <h3 class="text-base font-bold text-slate-900 leading-snug mb-2 line-clamp-2">
                                {{ $rep->title }}
                            </h3>

                            <p class="text-xs text-slate-600 line-clamp-3 leading-relaxed mb-4">
                                {{ $rep->description }}
                            </p>
                        </div>

                        <div class="pt-4 border-t border-slate-200/80 flex items-center justify-between text-xs text-slate-400">
                            <span class="truncate max-w-[140px]">{{ $rep->location }}</span>
                            <span>{{ $rep->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-12 bg-slate-50 rounded-3xl border border-dashed border-slate-200">
                        <p class="text-sm text-slate-500">Belum ada laporan yang diajukan.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
