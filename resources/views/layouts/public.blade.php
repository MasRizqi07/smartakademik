<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'SmartAkademik' }} - MAN 4 Jombang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface-page text-text-primary font-sans min-h-screen flex flex-col antialiased selection:bg-brand selection:text-white" x-data="{ mobileOpen: false }">
    <!-- Top Announcement Bar (Optional / Subtle) -->
    <div class="bg-brand text-white text-xs font-medium py-2 px-4 text-center tracking-wide flex items-center justify-center gap-2">
        <span class="inline-block w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span>
        <span>Tahun Ajaran 2025/2026 Semester Ganjil — Sistem Presensi & Rapor Formatif Aktif</span>
    </div>

    <!-- Navigation Header -->
    <header class="bg-surface/90 backdrop-blur-md border-b border-border sticky top-0 z-50 transition-all duration-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Brand Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <div class="w-10 h-10 rounded-xl bg-brand flex items-center justify-center text-white font-bold shadow-md group-hover:scale-105 transition-transform duration-200">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                        </svg>
                    </div>
                    <div>
                        <span class="text-base font-bold text-brand block leading-tight">MAN 4 Jombang</span>
                        <span class="text-[10px] text-text-secondary font-medium tracking-wider uppercase">Smart Akademik</span>
                    </div>
                </a>

                <!-- Desktop Navigation Links -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('home') ? 'text-brand font-semibold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('fitur') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('fitur') ? 'text-brand font-semibold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                        Fitur
                    </a>
                    <a href="{{ route('tentang') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('tentang') ? 'text-brand font-semibold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                        Tentang
                    </a>
                    <a href="{{ route('prestasi') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('prestasi') ? 'text-brand font-semibold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                        Prestasi
                    </a>
                    <a href="{{ route('kalender') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('kalender') ? 'text-brand font-semibold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                        Kalender
                    </a>
                    <a href="{{ route('bantuan') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('bantuan') ? 'text-brand font-semibold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                        Bantuan
                    </a>
                    <a href="{{ route('kontak') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition-colors {{ request()->routeIs('kontak') ? 'text-brand font-semibold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                        Kontak
                    </a>
                </nav>

                <!-- Action Button / Portal CTA -->
                <div class="hidden sm:flex items-center gap-3">
                    @auth
                        <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-brand text-white font-semibold text-sm rounded-lg shadow-sm hover:bg-brand-hover transition-all active:scale-95">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('portal') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 text-brand font-semibold text-sm rounded-lg hover:bg-brand-surface transition-colors">
                            Pilih Peran
                        </a>
                        <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-brand text-white font-semibold text-sm rounded-lg shadow-sm hover:bg-brand-hover transition-all active:scale-95">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                            </svg>
                            <span>Masuk Portal</span>
                        </a>
                    @endauth
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="flex lg:hidden items-center gap-2">
                    <button @click="mobileOpen = !mobileOpen" type="button" class="p-2 rounded-lg text-text-secondary hover:text-brand hover:bg-slate-100 transition-colors" aria-label="Menu">
                        <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                        <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer -->
        <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="lg:hidden border-b border-border bg-surface px-4 pt-2 pb-6 space-y-1 shadow-lg">
            <a href="{{ route('home') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('home') ? 'text-brand font-bold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                Beranda
            </a>
            <a href="{{ route('fitur') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('fitur') ? 'text-brand font-bold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                Fitur Platform
            </a>
            <a href="{{ route('tentang') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('tentang') ? 'text-brand font-bold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                Tentang Madrasah
            </a>
            <a href="{{ route('prestasi') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('prestasi') ? 'text-brand font-bold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                Galeri Prestasi
            </a>
            <a href="{{ route('kalender') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('kalender') ? 'text-brand font-bold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                Kalender Akademik
            </a>
            <a href="{{ route('bantuan') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('bantuan') ? 'text-brand font-bold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                Pusat Bantuan
            </a>
            <a href="{{ route('kontak') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium {{ request()->routeIs('kontak') ? 'text-brand font-bold bg-brand-surface' : 'text-text-secondary hover:text-brand hover:bg-slate-50' }}">
                Hubungi Support
            </a>

            <div class="pt-4 border-t border-border flex flex-col gap-2">
                <a href="{{ route('portal') }}" class="w-full text-center py-2.5 border border-border rounded-lg text-sm font-semibold text-text-primary hover:bg-slate-50">
                    Pilih Peran Portal
                </a>
                <a href="{{ route('login') }}" class="w-full text-center py-2.5 bg-brand text-white rounded-lg text-sm font-semibold hover:bg-brand-hover shadow-sm">
                    Masuk Sekarang
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Slot -->
    <main class="flex-grow">
        {{ $slot }}
    </main>

    <!-- Global Public Footer -->
    <footer class="bg-surface border-t border-border pt-16 pb-12 mt-16 text-text-primary">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                <!-- Col 1: Brand Info -->
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-brand flex items-center justify-center text-white font-bold shadow-md">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                        </div>
                        <div>
                            <span class="text-base font-bold text-brand block leading-tight">MAN 4 Jombang</span>
                            <span class="text-xs text-text-secondary">SmartAkademik Portal</span>
                        </div>
                    </div>
                    <p class="text-sm text-text-secondary leading-relaxed">
                        Platform operasional akademik terintegrasi untuk presensi real-time, penilaian formatif Kurikulum Merdeka, dan manajemen madrasah berbasis digital.
                    </p>
                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-brand-surface rounded-full text-xs font-semibold text-brand">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        <span>Terakreditasi A (Unggul)</span>
                    </div>
                </div>

                <!-- Col 2: Navigasi Modul -->
                <div>
                    <h4 class="text-sm font-bold text-text-primary uppercase tracking-wider mb-4">Navigasi Utama</h4>
                    <ul class="space-y-2.5 text-sm text-text-secondary">
                        <li><a href="{{ route('home') }}" class="hover:text-brand transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('fitur') }}" class="hover:text-brand transition-colors">Fitur & Keunggulan</a></li>
                        <li><a href="{{ route('tentang') }}" class="hover:text-brand transition-colors">Profil & Sejarah</a></li>
                        <li><a href="{{ route('prestasi') }}" class="hover:text-brand transition-colors">Galeri Prestasi</a></li>
                        <li><a href="{{ route('kalender') }}" class="hover:text-brand transition-colors">Kalender Akademik</a></li>
                    </ul>
                </div>

                <!-- Col 3: Portal & Bantuan -->
                <div>
                    <h4 class="text-sm font-bold text-text-primary uppercase tracking-wider mb-4">Akses & Bantuan</h4>
                    <ul class="space-y-2.5 text-sm text-text-secondary">
                        <li><a href="{{ route('portal') }}" class="hover:text-brand transition-colors">Gerbang Masuk Peran</a></li>
                        <li><a href="{{ route('login') }}" class="hover:text-brand transition-colors">Login Akun Guru/Siswa</a></li>
                        <li><a href="{{ route('bantuan') }}" class="hover:text-brand transition-colors">Pusat Bantuan & Panduan</a></li>
                        <li><a href="{{ route('kontak') }}" class="hover:text-brand transition-colors">Hubungi Tim IT Support</a></li>
                    </ul>
                </div>

                <!-- Col 4: Informasi Kontak Resmi -->
                <div>
                    <h4 class="text-sm font-bold text-text-primary uppercase tracking-wider mb-4">Kontak Madrasah</h4>
                    <ul class="space-y-3 text-sm text-text-secondary">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-5 h-5 text-brand shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                            </svg>
                            <span>Jl. KH. Bisri Syansuri No. 21, Denanyar, Jombang, Jawa Timur 61419</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-brand shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                            </svg>
                            <span>tu@man4jombang.sch.id</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-5 h-5 text-brand shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 0 0 2.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-.282.376-.769.542-1.21.38a12.035 12.035 0 0 1-7.143-7.143c-.162-.441.004-.928.38-1.21l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 0 0-1.091-.852H4.5A2.25 2.25 0 0 0 2.25 4.5v2.25Z" />
                            </svg>
                            <span>(0321) 861234</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Bottom Copyright -->
            <div class="border-t border-border pt-8 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-text-secondary">
                <p>&copy; {{ date('Y') }} MAN 4 Jombang. All rights reserved. Dikembangkan untuk efisiensi digital madrasah.</p>
                <div class="flex items-center gap-6">
                    <a href="{{ route('bantuan') }}" class="hover:text-brand transition-colors">Kebijakan Privasi</a>
                    <a href="{{ route('bantuan') }}" class="hover:text-brand transition-colors">Syarat Layanan</a>
                    <a href="{{ route('kontak') }}" class="hover:text-brand transition-colors">Status Sistem</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
