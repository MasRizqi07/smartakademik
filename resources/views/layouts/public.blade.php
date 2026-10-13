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
    <!-- Sticky Main Navigation Header -->
    <header class="sticky top-0 z-40 bg-surface border-b border-border" x-data="{ mobileOpen: false }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16 sm:h-20">
                <!-- Logo & School Brand -->
                <a href="{{ url('/') }}" class="flex items-center gap-3.5 group">
                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-2xl bg-brand text-white font-extrabold text-xl flex items-center justify-center shadow-xs">
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
                    @if(config('features.public_marketing'))
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
                    @endif
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
                        <a href="{{ $targetRoute }}" class="inline-flex items-center gap-2 px-4 py-2 sm:py-2.5 bg-brand text-white text-xs font-bold rounded-xl shadow-xs hover:bg-brand-hover transition-colors">
                            <span>Buka Dashboard</span>
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                        </a>
                    @else
                        <a href="{{ route('portal') }}" class="hidden sm:inline-flex items-center gap-2 px-3.5 py-2 text-xs font-bold text-text-secondary hover:text-brand rounded-xl border border-border hover:bg-brand-surface transition-colors">
                            <span>Pilih Gerbang</span>
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-4 sm:px-5 py-2 sm:py-2.5 bg-brand hover:bg-brand-hover text-white text-xs font-bold rounded-xl shadow-xs transition-colors">
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
        <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-4" class="lg:hidden bg-surface border-b border-border px-4 pt-2 pb-6 space-y-2 shadow-card">
            <a href="{{ url('/') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->is('/') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Beranda</a>
            @if(config('features.public_marketing'))
            <a href="{{ route('tentang') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('tentang') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Tentang Madrasah</a>
            <a href="{{ route('fitur') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('fitur') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Fitur Unggulan</a>
            <a href="{{ route('prestasi') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('prestasi') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Prestasi Santri</a>
            <a href="{{ route('kalender') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('kalender') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Kalender Akademik</a>
            <a href="{{ route('bantuan') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('bantuan') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Pusat Bantuan</a>
            <a href="{{ route('kontak') }}" class="block px-4 py-2.5 rounded-xl text-sm font-bold {{ request()->routeIs('kontak') ? 'text-brand bg-brand-surface' : 'text-text-secondary hover:bg-slate-50' }}">Kontak Support</a>
            @endif
            <div class="pt-3 border-t border-border flex gap-2">
                <a href="{{ route('portal') }}" class="flex-1 text-center py-2.5 rounded-xl text-xs font-bold border border-border text-text-secondary">Pilih Gerbang</a>
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col sm:flex-row items-center justify-between gap-4 text-center sm:text-left">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 rounded-xl bg-brand text-white font-black text-base flex items-center justify-center">
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-white font-bold text-sm">SmartAkademik MAN 4 Jombang</span>
                        <p class="text-[11px] text-slate-400">Jl. KH. Bishri Syansuri No. 79, Denanyar, Jombang, Jawa Timur</p>
                    </div>
                </div>
                <div class="flex items-center gap-4 text-xs">
                    <a href="{{ route('portal') }}" class="hover:text-white transition-colors">Portal</a>
                    <a href="{{ route('login') }}" class="hover:text-white transition-colors">Masuk</a>
                    <span class="text-slate-600">&copy; {{ date('Y') }} MAN 4 Jombang PP. Mamba'ul Ma'arif</span>
                </div>
            </div>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
