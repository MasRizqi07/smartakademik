<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAN 4 Jombang - Academic Portal</title>
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
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/tentang') }}">Tentang</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/bantuan') }}">Bantuan</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/kontak') }}">Kontak</a>
                </nav>

                <div class="flex items-center gap-3">
                    <a href="{{ url('/portal') }}" class="hidden sm:inline-flex bg-surface-container text-on-surface font-label-md text-label-md px-4 py-2 rounded-lg hover:bg-surface-container-high transition-colors h-touch-target items-center justify-center">
                        Gerbang Portal
                    </a>

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

    <!-- Hero Section -->
    <main class="flex-grow">
        <section class="relative pt-20 pb-28 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-secondary-container text-on-secondary-container mb-8">
                    <span class="material-symbols-outlined text-[18px]">school</span>
                    <span class="font-label-sm text-label-sm uppercase tracking-wider font-semibold">Portal Akademik Resmi</span>
                </div>

                <h1 class="font-headline-lg text-[36px] sm:text-[48px] md:text-[56px] leading-tight font-extrabold text-on-surface mb-6 max-w-4xl mx-auto">
                    Manajemen Akademik <br class="hidden md:block"/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary via-primary-container to-inverse-primary">Cepat &amp; Terintegrasi</span>
                </h1>

                <p class="font-body-lg text-body-lg text-on-surface-variant max-w-2xl mx-auto mb-10 leading-relaxed">
                    Sistem informasi akademik MAN 4 Jombang. Dirancang khusus untuk efisiensi guru dan kemudahan pemantauan siswa dalam satu platform modern berkecepatan tinggi.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a class="w-full sm:w-auto bg-primary text-on-primary font-label-md text-label-md px-8 rounded-lg hover:bg-primary-container transition-colors shadow-sm h-touch-target flex items-center justify-center gap-2 active:scale-95" href="{{ route('login') }}">
                        <span>Masuk Portal</span>
                        <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
                    </a>
                    <a class="w-full sm:w-auto bg-surface-container text-on-surface font-label-md text-label-md px-8 rounded-lg hover:bg-surface-container-high transition-colors h-touch-target flex items-center justify-center gap-2" href="{{ url('/fitur') }}">
                        <span>Pelajari Fitur</span>
                        <span class="material-symbols-outlined text-[20px]">explore</span>
                    </a>
                    <a class="w-full sm:w-auto bg-surface-container-lowest border border-border-default text-primary font-label-md text-label-md px-6 rounded-lg hover:bg-surface-container-low transition-colors h-touch-target flex items-center justify-center gap-2" href="{{ url('/portal') }}">
                        <span>Pilih Peran</span>
                        <span class="material-symbols-outlined text-[20px]">group</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Features Bento Grid -->
        <section class="py-24 bg-surface-container-lowest border-y border-border-default" id="features">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="font-headline-md text-[28px] md:text-[32px] font-bold text-on-surface mb-4">Solusi Lengkap Operasional Sekolah</h2>
                    <p class="font-body-default text-body-default text-on-surface-variant max-w-2xl mx-auto">Fitur utama yang dirancang untuk mempercepat proses administratif sehingga guru dapat fokus penuh pada pengajaran bermakna.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Feature 1: Presensi Real-time -->
                    <div class="col-span-1 md:col-span-2 bg-surface rounded-xl p-8 border border-border-default hover:shadow-md hover-lift transition-all">
                        <div class="h-12 w-12 rounded-lg bg-secondary-container flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-on-secondary-container text-[26px]">how_to_reg</span>
                        </div>
                        <h3 class="font-headline-md text-[20px] font-semibold text-on-surface mb-3">Presensi Real-time Kurang dari 60 Detik</h3>
                        <p class="font-body-default text-body-default text-on-surface-variant mb-6">Catat kehadiran siswa kurang dari 60 detik. Antarmuka yang dioptimalkan untuk mobile dengan touch-target 44px memudahkan bapak/ibu guru langsung di dalam kelas.</p>
                        
                        <!-- Mini Preview Interactive -->
                        <div class="bg-surface-container-lowest border border-border-default rounded-lg p-4 max-w-md shadow-xs">
                            <div class="flex justify-between items-center mb-3">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-status-hadir animate-pulse"></span>
                                    <span class="font-label-md text-label-md font-semibold">XII IPA 1 - Matematika Wajib</span>
                                </div>
                                <span class="text-[11px] bg-status-hadir/15 text-status-hadir px-2.5 py-0.5 rounded-full font-bold">28 / 30 HADIR (93.3%)</span>
                            </div>
                            <div class="flex gap-2 mb-2">
                                <div class="h-2.5 bg-status-hadir rounded-full flex-grow" title="28 Hadir"></div>
                                <div class="h-2.5 bg-status-izin rounded-full w-8" title="1 Izin"></div>
                                <div class="h-2.5 bg-status-sakit rounded-full w-4" title="1 Sakit"></div>
                            </div>
                            <div class="flex items-center justify-between text-[11px] text-on-surface-variant pt-1 border-t border-border-default/50">
                                <span>Tersinkronisasi otomatis</span>
                                <span class="text-primary font-medium">Auto-saved 14:02 WIB</span>
                            </div>
                        </div>
                    </div>

                    <!-- Feature 2: Nilai Formatif -->
                    <div class="col-span-1 bg-surface rounded-xl p-8 border border-border-default hover:shadow-md hover-lift transition-all flex flex-col">
                        <div class="h-12 w-12 rounded-lg bg-tertiary-container flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-on-tertiary-container text-[24px]">grade</span>
                        </div>
                        <h3 class="font-headline-md text-[20px] font-semibold text-on-surface mb-3">Nilai Formatif Kurikulum Merdeka</h3>
                        <p class="font-body-default text-body-default text-on-surface-variant flex-grow">Input nilai capaian tujuan pembelajaran (TP1 - TP5) dengan kalkulasi rata-rata otomatis dan indikator KKM langsung.</p>
                        <div class="mt-4 pt-4 border-t border-border-default/60 flex items-center justify-between text-label-sm text-primary font-semibold">
                            <span>Kalkulasi Otomatis</span>
                            <span class="material-symbols-outlined text-[18px]">verified</span>
                        </div>
                    </div>

                    <!-- Feature 3: Jadwal Pintar -->
                    <div class="col-span-1 bg-surface rounded-xl p-8 border border-border-default hover:shadow-md hover-lift transition-all">
                        <div class="h-12 w-12 rounded-lg bg-surface-container-high flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-primary text-[24px]">calendar_month</span>
                        </div>
                        <h3 class="font-headline-md text-[20px] font-semibold text-on-surface mb-3">Jadwal Pintar &amp; Ruangan</h3>
                        <p class="font-body-default text-body-default text-on-surface-variant">Manajemen jadwal mengajar terintegrasi tanpa bentrok jam atau ruang, lengkap dengan filter hari dan notifikasi waktu.</p>
                    </div>

                    <!-- Feature 4: Laporan Waka Kurikulum -->
                    <div class="col-span-1 md:col-span-2 bg-surface rounded-xl p-8 border border-border-default hover:shadow-md hover-lift transition-all">
                        <div class="h-12 w-12 rounded-lg bg-secondary-container flex items-center justify-center mb-6">
                            <span class="material-symbols-outlined text-on-secondary-container text-[24px]">assessment</span>
                        </div>
                        <h3 class="font-headline-md text-[20px] font-semibold text-on-surface mb-3">Laporan &amp; Analitik Kurikulum</h3>
                        <p class="font-body-default text-body-default text-on-surface-variant">Dashboard analitik komprehensif bagi Waka Kurikulum dan Kepala Madrasah untuk memantau performa kelas, kehadiran guru, dan rekapitulasi nilai seluruh sekolah dalam satu tampilan.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Quick Access Section -->
        <section class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-r from-primary/10 via-primary-container/5 to-secondary-container/20 border border-primary/20 rounded-2xl p-8 md:p-12 flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="max-w-2xl">
                    <h3 class="font-headline-lg text-[26px] md:text-[32px] font-bold text-on-surface mb-3">Siap Memulai Efisiensi Akademik?</h3>
                    <p class="font-body-lg text-on-surface-variant">Masuk ke portal dengan akun terdaftar Anda atau kunjungi gerbang masuk portal untuk panduan login per role.</p>
                </div>
                <div class="flex flex-wrap gap-4 shrink-0">
                    <a href="{{ url('/portal') }}" class="bg-surface-container-lowest text-primary border border-primary/30 px-6 py-3 rounded-lg font-label-md hover:bg-primary/5 transition-all shadow-xs flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">door_front</span>
                        <span>Gerbang Portal</span>
                    </a>
                    <a href="{{ route('login') }}" class="bg-primary text-on-primary px-8 py-3 rounded-lg font-label-md hover:bg-primary-container transition-all shadow-sm flex items-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">login</span>
                        <span>Masuk Sekarang</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-surface border-t border-border-default pt-16 pb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-12">
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-on-primary font-bold">
                            <span class="material-symbols-outlined text-[20px]">school</span>
                        </div>
                        <span class="font-headline-md text-[18px] font-bold text-primary">MAN 4 Jombang</span>
                    </div>
                    <p class="font-body-default text-body-default text-on-surface-variant mb-4 max-w-sm leading-relaxed">
                        Portal akademik terintegrasi Madrasah Aliyah Negeri 4 Jombang untuk mendukung proses belajar mengajar yang efektif, akuntabel, dan transparan.
                    </p>
                    <div class="flex items-center gap-3 text-on-surface-variant text-sm">
                        <span class="inline-flex items-center gap-1"><span class="w-2 h-2 rounded-full bg-status-hadir"></span> Sistem Aktif</span>
                        <span>&bull;</span>
                        <span>T.A. 2026/2027 Semester Ganjil</span>
                    </div>
                </div>

                <div>
                    <h4 class="font-label-md text-label-md font-bold text-on-surface mb-4">Navigasi Utama</h4>
                    <ul class="space-y-3">
                        <li><a class="font-body-default text-body-default text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/portal') }}">Gerbang Portal</a></li>
                        <li><a class="font-body-default text-body-default text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/fitur') }}">Fitur Lengkap</a></li>
                        <li><a class="font-body-default text-body-default text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/prestasi') }}">Galeri Prestasi</a></li>
                        <li><a class="font-body-default text-body-default text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/kalender') }}">Kalender Akademik</a></li>
                        <li><a class="font-body-default text-body-default text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/tentang') }}">Tentang Sekolah</a></li>
                        <li><a class="font-body-default text-body-default text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/bantuan') }}">Pusat Bantuan &amp; FAQ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-label-md text-label-md font-bold text-on-surface mb-4">Kontak Madrasah</h4>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-2 text-on-surface-variant font-body-default text-body-default">
                            <span class="material-symbols-outlined text-[18px] text-primary shrink-0 mt-0.5">location_on</span>
                            <span>Jl. Raya Jombang - Surabaya No. 45, Peterongan, Jombang, Jawa Timur</span>
                        </li>
                        <li class="flex items-center gap-2 text-on-surface-variant font-body-default text-body-default">
                            <span class="material-symbols-outlined text-[18px] text-primary shrink-0">mail</span>
                            <span>info@man4jombang.sch.id</span>
                        </li>
                        <li class="flex items-center gap-2 text-on-surface-variant font-body-default text-body-default">
                            <span class="material-symbols-outlined text-[18px] text-primary shrink-0">call</span>
                            <span>(0321) 861234</span>
                        </li>
                        <li>
                            <a href="{{ url('/kontak') }}" class="inline-flex items-center gap-1.5 text-primary font-label-sm font-semibold hover:underline mt-2">
                                <span>Hubungi Tim Support</span>
                                <span class="material-symbols-outlined text-[16px]">arrow_forward</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-border-default pt-8 text-center flex flex-col sm:flex-row justify-between items-center gap-4">
                <p class="font-label-sm text-label-sm text-on-surface-variant">
                    &copy; {{ date('Y') }} MAN 4 Jombang. All rights reserved.
                </p>
                <div class="flex items-center gap-4 text-label-sm text-on-surface-variant">
                    <a href="{{ url('/tentang') }}" class="hover:text-primary transition-colors">Privasi</a>
                    <span>&bull;</span>
                    <a href="{{ url('/bantuan') }}" class="hover:text-primary transition-colors">Syarat &amp; Ketentuan</a>
                    <span>&bull;</span>
                    <a href="{{ url('/kontak') }}" class="hover:text-primary transition-colors">Bantuan IT</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
