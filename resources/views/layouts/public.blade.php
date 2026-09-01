<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Portal Akademik Terpadu' }} — SmartAkademik MAN 4 Jombang</title>
    <meta name="description" content="Sistem Informasi & Manajemen Akademik Digital MAN 4 Jombang. Presensi presisi, rapor kurikulum merdeka, dan transparansi pembelajaran terpadu.">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:500,600,700,800&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-surface-page text-text-primary min-h-screen flex flex-col selection:bg-brand selection:text-white relative overflow-x-hidden">
    <!-- Subtle Background Glows -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute -top-40 -right-40 w-96 h-96 bg-brand/10 rounded-full blur-3xl animate-pulse-subtle"></div>
        <div class="absolute top-1/3 -left-40 w-96 h-96 bg-amber-400/10 rounded-full blur-3xl animate-float-delayed"></div>
        <div class="absolute -bottom-40 right-1/4 w-96 h-96 bg-sky-400/10 rounded-full blur-3xl"></div>
    </div>

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-teal-900 text-white text-xs font-medium py-2 px-4 relative z-50 border-b border-emerald-700/50">
        <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2 text-center sm:text-left">
            <div class="flex items-center gap-2">
                <span class="inline-flex items-center gap-1.5 px-2 py-0.5 rounded-full bg-emerald-500/20 text-emerald-300 text-[10px] font-bold uppercase tracking-wider border border-emerald-400/30">
                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-ping"></span>
                    <span>Live Akademik</span>
                </span>
                <span class="text-[11px] sm:text-xs text-emerald-100/90 font-medium">
                    Tahun Pelajaran <strong class="text-amber-300">2026/2027</strong> Semester Ganjil • Kurikulum Berbasis Pesantren Terpadu
                </span>
            </div>
            <div class="hidden md:flex items-center gap-4 text-[11px] text-emerald-200">
                <span class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5 text-amber-300" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <span>Pelayanan: 07:00 - 15:30 WIB</span>
                </span>
                <span>•</span>
                <a href="{{ route('kontak') }}" class="hover:text-white transition-colors underline decoration-dotted">Bantuan Helpdesk</a>
            </div>
        </div>
    </div>

    <!-- Sticky Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-white/90 backdrop-blur-md border-b border-slate-200/80 shadow-xs transition-all" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo & School Brand -->
                <a href="{{ url('/') }}" class="flex items-center gap-3.5 group">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-gradient-to-tr from-emerald-800 to-emerald-600 text-white font-extrabold text-xl flex items-center justify-center shadow-md group-hover:scale-105 transition-all">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                        </svg>
                    </div>
                    <div class="flex flex-col">
                        <span class="text-base sm:text-lg font-black tracking-tight text-text-primary leading-tight font-display group-hover:text-brand transition-colors">
                            SmartAkademik
                        </span>
                        <span class="text-[10px] sm:text-[11px] font-semibold text-text-secondary uppercase tracking-wider">
                            MAN 4 Jombang &bull; Denanyar
                        </span>
                    </div>
                </a>

                <!-- Desktop Nav Links -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    <a href="{{ url('/') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all relative {{ request()->is('/') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:text-text-primary hover:bg-slate-100/70' }}">
                        Beranda
                    </a>
                    <a href="{{ route('tentang') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('tentang') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:text-text-primary hover:bg-slate-100/70' }}">
                        Tentang
                    </a>
                    <a href="{{ route('fitur') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('fitur') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:text-text-primary hover:bg-slate-100/70' }}">
                        Fitur Unggulan
                    </a>
                    <a href="{{ route('prestasi') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('prestasi') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:text-text-primary hover:bg-slate-100/70' }}">
                        Prestasi Santri
                    </a>
                    <a href="{{ route('kalender') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('kalender') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:text-text-primary hover:bg-slate-100/70' }}">
                        Kalender Akademik
                    </a>
                    <a href="{{ route('bantuan') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('bantuan') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:text-text-primary hover:bg-slate-100/70' }}">
                        Bantuan
                    </a>
                    <a href="{{ route('kontak') }}" class="px-3.5 py-2 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('kontak') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:text-text-primary hover:bg-slate-100/70' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Action Button & Mobile Trigger -->
                <div class="flex items-center gap-3">
                    @auth
                        @php
                            $user = auth()->user();
                            $targetRoute = route('guru.dashboard');
                            if($user->hasRole('admin_tu')) $targetRoute = route('admin.dashboard');
                            elseif($user->hasRole('waka_kurikulum')) $targetRoute = route('waka.dashboard');
                            elseif($user->hasRole('siswa')) $targetRoute = route('siswa.dashboard');
                        @endphp
                        <a href="{{ $targetRoute }}" class="inline-flex items-center gap-2 px-4 py-2 sm:py-2.5 bg-brand text-white text-xs font-bold rounded-xl shadow-sm hover:bg-brand-hover hover:shadow-glow transition-all active:scale-95">
                            <span>Buka Dashboard</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                        </a>
                    @else
                        <a href="{{ route('portal') }}" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 text-xs font-bold text-text-secondary hover:text-brand rounded-xl border border-slate-200 hover:bg-brand-surface transition-all">
                            <span>Pilih Gerbang</span>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 bg-gradient-to-r from-emerald-700 to-emerald-600 hover:from-emerald-800 hover:to-emerald-700 text-white text-xs font-bold rounded-xl shadow-sm hover:shadow-glow transition-all active:scale-95">
                            <span>Masuk Portal</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                        </a>
                    @endauth

                    <!-- Mobile Drawer Toggle -->
                    <button @click="mobileOpen = !mobileOpen" type="button" class="lg:hidden p-2 rounded-xl text-text-secondary hover:text-text-primary hover:bg-slate-100 transition-colors">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <svg x-show="mobileOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Navigation -->
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="lg:hidden bg-white/95 backdrop-blur-xl border-b border-slate-200 px-4 pt-2 pb-6 space-y-2 shadow-xl">
            <a href="{{ url('/') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->is('/') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Beranda</a>
            <a href="{{ route('tentang') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('tentang') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Tentang Madrasah</a>
            <a href="{{ route('fitur') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('fitur') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Fitur Unggulan</a>
            <a href="{{ route('prestasi') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('prestasi') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Prestasi Santri</a>
            <a href="{{ route('kalender') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('kalender') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Kalender Akademik</a>
            <a href="{{ route('bantuan') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('bantuan') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Pusat Bantuan</a>
            <a href="{{ route('kontak') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('kontak') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Kontak Support</a>
            <div class="pt-3 border-t border-slate-100 flex gap-2">
                <a href="{{ route('portal') }}" class="flex-1 text-center py-2.5 rounded-xl text-xs font-bold border border-slate-200 text-text-secondary">Pilih Gerbang</a>
                <a href="{{ route('login') }}" class="flex-1 text-center py-2.5 rounded-xl text-xs font-bold bg-brand text-white shadow-xs">Masuk Portal</a>
            </div>
        </div>
    </header>

    <!-- Main Dynamic Content Slot -->
    <main class="flex-1 relative z-10">
        {{ $slot }}
    </main>

    <!-- Master Footer -->
    <footer class="bg-slate-900 text-slate-400 text-xs border-t border-slate-800 relative z-10 mt-16 sm:mt-24">
        <!-- Main Footer Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-12">
                <!-- Col 1: Madrasah Profile (2 Cols) -->
                <div class="lg:col-span-2 space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-emerald-600 to-emerald-500 text-white font-black text-xl flex items-center justify-center shadow-md">
                            4
                        </div>
                        <div>
                            <span class="text-white font-extrabold text-lg tracking-tight font-display">SmartAkademik</span>
                            <p class="text-[11px] text-slate-400 font-semibold">MAN 4 Jombang PP. Mamba'ul Ma'arif</p>
                        </div>
                    </div>
                    <p class="text-xs text-slate-400 leading-relaxed max-w-sm">
                        Transformasi digital pendidikan madrasah terpadu untuk mewujudkan generasi santri unggul berakhlakul karimah, mandiri, dan adaptif di era digital.
                    </p>
                    <div class="pt-2 text-[11px] text-slate-500 space-y-1">
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" /></svg>
                            <span>Jl. KH. Bishri Syansuri No. 79, Denanyar, Jombang, Jawa Timur</span>
                        </p>
                        <p class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" /></svg>
                            <span>(0321) 861234 &bull; WhatsApp Support: +62 812-3456-7890</span>
                        </p>
                    </div>
                </div>

                <!-- Col 2: Akses Cepat -->
                <div class="space-y-3">
                    <h4 class="text-white text-xs font-extrabold uppercase tracking-wider font-display">Akses Pintas</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ url('/') }}" class="hover:text-emerald-400 transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('fitur') }}" class="hover:text-emerald-400 transition-colors">Fitur &amp; Kemampuan</a></li>
                        <li><a href="{{ route('prestasi') }}" class="hover:text-emerald-400 transition-colors">Galeri Prestasi</a></li>
                        <li><a href="{{ route('kalender') }}" class="hover:text-emerald-400 transition-colors">Kalender Akademik</a></li>
                        <li><a href="{{ route('portal') }}" class="hover:text-emerald-400 transition-colors">Gerbang Peran</a></li>
                    </ul>
                </div>

                <!-- Col 3: Portal Peran -->
                <div class="space-y-3">
                    <h4 class="text-white text-xs font-extrabold uppercase tracking-wider font-display">Portal Pengguna</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('login', ['role' => 'guru']) }}" class="hover:text-emerald-400 transition-colors">Portal Guru Pengampu</a></li>
                        <li><a href="{{ route('login', ['role' => 'siswa']) }}" class="hover:text-emerald-400 transition-colors">Portal Santri / Siswa</a></li>
                        <li><a href="{{ route('login', ['role' => 'waka']) }}" class="hover:text-emerald-400 transition-colors">Portal Waka Kurikulum</a></li>
                        <li><a href="{{ route('login', ['role' => 'admin']) }}" class="hover:text-emerald-400 transition-colors">Portal Tata Usaha</a></li>
                        <li><a href="{{ route('bantuan') }}" class="hover:text-emerald-400 transition-colors">Panduan &amp; FAQ</a></li>
                    </ul>
                </div>

                <!-- Col 4: Layanan Madrasah -->
                <div class="space-y-3">
                    <h4 class="text-white text-xs font-extrabold uppercase tracking-wider font-display">Bantuan &amp; Legalitas</h4>
                    <ul class="space-y-2 text-xs">
                        <li><a href="{{ route('bantuan') }}" class="hover:text-emerald-400 transition-colors">Pusat Bantuan</a></li>
                        <li><a href="{{ route('kontak') }}" class="hover:text-emerald-400 transition-colors">Buat Tiket Dukungan</a></li>
                        <li><span class="text-slate-500">NPSN: 20580054</span></li>
                        <li><span class="text-slate-500">Akreditasi: A (Unggul)</span></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Bottom Copyright Bar -->
        <div class="border-t border-slate-800 bg-slate-950 py-5 px-4 text-center text-[11px] text-slate-500">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3">
                <p>&copy; {{ date('Y') }} <strong>SmartAkademik</strong> — MAN 4 Jombang PP. Mamba'ul Ma'arif Denanyar. Hak Cipta Dilindungi.</p>
                <p class="text-[10px] text-slate-600">Built with Precision for Madrasah Digital Excellence</p>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
