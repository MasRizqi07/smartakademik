<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Platform - MAN 4 Jombang Academic Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-body-default min-h-screen flex flex-col antialiased">
    <!-- Ambient Background -->
    <div class="fixed inset-0 z-[-1] pointer-events-none opacity-20 shader-bg"></div>

    <!-- Navigation Header -->
    <header class="bg-surface/80 backdrop-blur-md border-b border-border-default sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary flex items-center justify-center text-on-primary font-bold shadow-xs">
                        <span class="material-symbols-outlined text-[22px]">school</span>
                    </div>
                    <span class="font-headline-md text-headline-md font-bold text-primary">MAN 4 Jombang</span>
                </a>

                <nav class="hidden md:flex items-center gap-8">
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/fitur') }}">Fitur</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/prestasi') }}">Prestasi</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/kalender') }}">Kalender</a>
                    <a class="font-label-md text-label-md text-primary font-bold transition-colors" href="{{ url('/tentang') }}">Tentang</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/bantuan') }}">Bantuan</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/kontak') }}">Kontak</a>
                </nav>

                <div class="flex items-center gap-3">
                    @auth
                        <a class="bg-primary text-on-primary font-label-md text-label-md px-5 py-2 rounded-lg hover:bg-primary-container transition-colors shadow-sm h-touch-target flex items-center gap-2" href="{{ route('dashboard') }}">
                            <span>Dashboard</span>
                            <span class="material-symbols-outlined text-[18px]">dashboard</span>
                        </a>
                    @else
                        <a class="bg-primary text-on-primary font-label-md text-label-md px-6 py-2 rounded-lg hover:bg-primary-container transition-colors shadow-sm h-touch-target flex items-center gap-2" href="{{ route('login') }}">
                            <span>Masuk Portal</span>
                            <span class="material-symbols-outlined text-[18px]">login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl mx-auto w-full p-6 lg:p-8 space-y-12">
        <!-- Hero Section -->
        <section class="rounded-2xl overflow-hidden shadow-sm bg-surface-container-lowest border border-border-default">
            <div class="grid md:grid-cols-2 gap-0 items-center">
                <div class="p-8 lg:p-12 flex flex-col justify-center">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm w-max mb-4">
                        <span class="material-symbols-outlined text-[16px]">verified</span>
                        <span>Profil &amp; Transformasi Digital</span>
                    </div>
                    <h1 class="font-headline-lg text-3xl lg:text-[36px] lg:leading-[44px] text-primary mb-4 font-extrabold">Digital Transformation at MAN 4 Jombang</h1>
                    <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-6">Empowering educators with high-performance tools for academic excellence. Our platform is designed to streamline operations, reduce administrative burden, and focus entirely on student success.</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ url('/fitur') }}" class="bg-primary text-on-primary px-6 py-2.5 rounded-lg font-label-md hover:bg-primary-container transition-colors inline-flex items-center gap-2">
                            <span>Jelajahi Fitur</span>
                            <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                        </a>
                        <a href="{{ url('/kontak') }}" class="bg-surface-container text-on-surface px-6 py-2.5 rounded-lg font-label-md hover:bg-surface-container-high transition-colors inline-flex items-center gap-2">
                            <span>Hubungi Kami</span>
                        </a>
                    </div>
                </div>
                <div class="h-72 md:h-full bg-primary/10 flex items-center justify-center p-8 border-t md:border-t-0 md:border-l border-border-default">
                    <div class="flex flex-col items-center text-center max-w-sm">
                        <div class="w-24 h-24 rounded-2xl bg-primary flex items-center justify-center text-on-primary shadow-lg mb-4">
                            <span class="material-symbols-outlined text-[52px]">school</span>
                        </div>
                        <h3 class="font-headline-md text-[22px] font-bold text-text-main">MAN 4 Jombang</h3>
                        <p class="font-body-default text-on-surface-variant mt-1 text-sm">Madrasah Unggul, Berkarakter Islami, Berwawasan Global dan Berprestasi.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Vision & Mission -->
        <section class="grid md:grid-cols-2 gap-6">
            <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-border-default hover-lift transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">visibility</span>
                    </div>
                    <div>
                        <h2 class="font-headline-md text-[20px] font-bold text-primary">Visi Platform</h2>
                        <p class="font-label-sm text-on-surface-variant">Arah Masa Depan Digitalisasi</p>
                    </div>
                </div>
                <p class="font-body-default text-body-default text-on-surface-variant leading-relaxed">
                    Menjadi pionir platform manajemen akademik yang andal, cepat, dan intuitif, memfasilitasi lingkungan belajar mengajar yang efisien dan terstruktur di MAN 4 Jombang. Kami berkomitmen untuk menyediakan infrastruktur digital kelas satu untuk mendukung pendidik.
                </p>
            </div>

            <div class="bg-surface-container-lowest p-8 rounded-xl shadow-sm border border-border-default hover-lift transition-all">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                        <span class="material-symbols-outlined text-[26px]">flag</span>
                    </div>
                    <div>
                        <h2 class="font-headline-md text-[20px] font-bold text-primary">Misi Kami</h2>
                        <p class="font-label-sm text-on-surface-variant">Komitmen Pelaksanaan</p>
                    </div>
                </div>
                <ul class="font-body-default text-body-default text-on-surface-variant space-y-3">
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                        <span>Mendukung guru dengan alat pencatatan kehadiran kurang dari 60 detik.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                        <span>Menyediakan dasbor analitik real-time bagi Waka Kurikulum dan Pimpinan.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="material-symbols-outlined text-primary text-[20px] shrink-0 mt-0.5">check_circle</span>
                        <span>Mengurangi beban administratif melalui otomatisasi kalkulasi nilai dan pelaporan.</span>
                    </li>
                </ul>
            </div>
        </section>

        <!-- Benefits Bento Grid -->
        <section>
            <div class="flex items-center justify-between mb-6 border-b border-border-default pb-3">
                <div>
                    <h2 class="font-headline-md text-[24px] font-bold text-on-surface">Manfaat Transformasi Digital</h2>
                    <p class="font-body-default text-sm text-on-surface-variant">Peningkatan performa operasional pendidikan berbasis teknologi.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1 -->
                <div class="col-span-1 md:col-span-2 bg-surface-container-lowest rounded-xl p-8 shadow-sm border border-border-default flex flex-col justify-between relative overflow-hidden group">
                    <div class="relative z-10">
                        <div class="w-12 h-12 rounded-lg bg-primary/10 text-primary flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[28px]">speed</span>
                        </div>
                        <h3 class="font-headline-md text-[18px] font-bold text-on-surface mb-2">Efisiensi Maksimal</h3>
                        <p class="font-body-default text-body-default text-on-surface-variant max-w-xl leading-relaxed">Desain antarmuka difokuskan pada kecepatan. Interaksi dioptimalkan untuk penggunaan satu tangan di perangkat seluler (touch target 44px), memungkinkan guru menyelesaikan tugas rutin dengan cepat di tengah kesibukan kelas.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-primary text-on-primary rounded-xl p-8 shadow-sm flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-lg bg-white/20 text-white flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[28px]">security</span>
                        </div>
                        <h3 class="font-headline-md text-[18px] font-bold mb-2">Integritas Data</h3>
                        <p class="font-body-default text-on-primary opacity-90 leading-relaxed">Sistem terpusat memastikan setiap data absensi dan nilai tersimpan dengan aman, konsisten, dan akurat, mengurangi risiko kesalahan manusia.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-default flex gap-4 items-center">
                    <div class="w-12 h-12 rounded-xl bg-secondary-container flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-on-secondary-container text-[24px]">insights</span>
                    </div>
                    <div>
                        <h3 class="font-label-md text-label-md font-bold text-on-surface">Pelaporan Otomatis</h3>
                        <p class="font-body-default text-body-default text-on-surface-variant text-sm mt-0.5">Generasi laporan kehadiran harian dan capaian formatif secara instan.</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-surface-container-lowest rounded-xl p-6 shadow-sm border border-border-default flex gap-4 items-center md:col-span-2">
                    <div class="w-12 h-12 rounded-xl bg-tertiary-container flex items-center justify-center shrink-0">
                        <span class="material-symbols-outlined text-on-tertiary-container text-[24px]">phonelink</span>
                    </div>
                    <div>
                        <h3 class="font-label-md text-label-md font-bold text-on-surface">Aksesibilitas Multi-Perangkat</h3>
                        <p class="font-body-default text-body-default text-on-surface-variant text-sm mt-0.5">Responsif penuh dari layar ponsel pintar guru hingga monitor desktop administrasi, memberikan pengalaman mulus.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-surface border-t border-border-default py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="font-label-sm text-label-sm text-on-surface-variant">
                &copy; {{ date('Y') }} MAN 4 Jombang Academic Portal. All rights reserved.
            </p>
            <div class="flex items-center gap-4 text-label-sm text-on-surface-variant">
                <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Beranda</a>
                <span>&bull;</span>
                <a href="{{ url('/fitur') }}" class="hover:text-primary transition-colors">Fitur</a>
                <span>&bull;</span>
                <a href="{{ url('/kontak') }}" class="hover:text-primary transition-colors">Kontak</a>
            </div>
        </div>
    </footer>
</body>
</html>
