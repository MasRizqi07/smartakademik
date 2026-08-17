<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pelajari Fitur Platform - MAN 4 Jombang Academic Portal</title>
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
                    <a class="font-label-md text-label-md text-primary font-bold transition-colors" href="{{ url('/fitur') }}">Fitur</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/prestasi') }}">Prestasi</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/kalender') }}">Kalender</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/tentang') }}">Tentang</a>
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
        <!-- Hero Banner -->
        <section class="bg-surface-container-lowest rounded-2xl shadow-sm border border-border-default overflow-hidden p-8 md:p-12">
            <div class="max-w-3xl">
                <span class="text-primary font-label-md text-label-md font-semibold uppercase tracking-wider mb-2 block">Platform Capabilities</span>
                <h1 class="font-headline-lg text-3xl sm:text-4xl font-extrabold text-on-surface mb-4">Solusi Unggulan Operasional Akademik</h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed mb-6">
                    Temukan rangkaian fitur terintegrasi yang dirancang khusus untuk ekosistem MAN 4 Jombang. Mulai dari pencatatan presensi real-time bebas hambatan hingga penilaian formatif komprehensif berstandar Kurikulum Merdeka.
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('login') }}" class="bg-primary text-on-primary font-label-md px-6 py-3 rounded-lg hover:bg-primary-container transition-all flex items-center gap-2 shadow-xs">
                        <span>Coba Langsung di Portal</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                    <a href="{{ url('/portal') }}" class="bg-surface-container text-on-surface font-label-md px-6 py-3 rounded-lg hover:bg-surface-container-high transition-all flex items-center gap-2">
                        <span>Lihat Pilihan Peran</span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Feature Grid (6 Pillars) -->
        <section class="space-y-6">
            <div class="flex flex-col gap-1">
                <h2 class="font-headline-md text-2xl font-bold text-on-surface">6 Pilar Utama Sistem Akademik</h2>
                <p class="font-body-default text-on-surface-variant">Setiap modul dibangun dengan filosofi efisiensi tinggi dan kemudahan pemakaian.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. Presensi 60 Detik -->
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover-lift transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-status-hadir/15 text-status-hadir flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[28px]">fact_check</span>
                        </div>
                        <h3 class="font-headline-md text-[18px] font-bold text-text-main mb-2">Presensi Cepat 60 Detik</h3>
                        <p class="font-body-default text-on-surface-variant text-sm leading-relaxed mb-4">
                            Pencatatan kehadiran Hadir, Izin, Sakit, dan Alfa berbasis touch target 44px dengan tombol "Tandai Semua Hadir" instan dan auto-save tanpa refresh halaman.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-border-default/60 flex items-center justify-between text-xs text-status-hadir font-semibold">
                        <span>Efisiensi Tinggi</span>
                        <span class="material-symbols-outlined text-sm">timer</span>
                    </div>
                </div>

                <!-- 2. Formatif Merdeka -->
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover-lift transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-tertiary-container text-on-tertiary-container flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[28px]">grade</span>
                        </div>
                        <h3 class="font-headline-md text-[18px] font-bold text-text-main mb-2">Penilaian Formatif TP</h3>
                        <p class="font-body-default text-on-surface-variant text-sm leading-relaxed mb-4">
                            Dukungan penilaian per Capaian Tujuan Pembelajaran (TP 1 - 5) dengan auto-kalkulasi rata-rata dan indikator ketuntasan KKM langsung.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-border-default/60 flex items-center justify-between text-xs text-primary font-semibold">
                        <span>Kurikulum Merdeka</span>
                        <span class="material-symbols-outlined text-sm">auto_graph</span>
                    </div>
                </div>

                <!-- 3. Jadwal & Ruangan -->
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover-lift transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[28px]">calendar_month</span>
                        </div>
                        <h3 class="font-headline-md text-[18px] font-bold text-text-main mb-2">Jadwal Pintar Bebas Bentrok</h3>
                        <p class="font-body-default text-on-surface-variant text-sm leading-relaxed mb-4">
                            Validasi otomatis saat input jadwal untuk mencegah bentrok waktu mengajar guru atau penggunaan ruangan kelas.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-border-default/60 flex items-center justify-between text-xs text-secondary font-semibold">
                        <span>Deteksi Konflik</span>
                        <span class="material-symbols-outlined text-sm">event_busy</span>
                    </div>
                </div>

                <!-- 4. Laporan Waka -->
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover-lift transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[28px]">monitoring</span>
                        </div>
                        <h3 class="font-headline-md text-[18px] font-bold text-text-main mb-2">Dashboard Eksekutif Waka</h3>
                        <p class="font-body-default text-on-surface-variant text-sm leading-relaxed mb-4">
                            Pemantauan rekapitulasi kehadiran dan distribusi nilai lintas tingkat/kelas secara komprehensif dengan ekspor Excel dan cetak PDF instan.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-border-default/60 flex items-center justify-between text-xs text-primary font-semibold">
                        <span>Ekspor Excel/PDF</span>
                        <span class="material-symbols-outlined text-sm">download</span>
                    </div>
                </div>

                <!-- 5. Portal Siswa Mandiri -->
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover-lift transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-status-sakit/15 text-status-sakit flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[28px]">face</span>
                        </div>
                        <h3 class="font-headline-md text-[18px] font-bold text-text-main mb-2">Portal Siswa &amp; Profil</h3>
                        <p class="font-body-default text-on-surface-variant text-sm leading-relaxed mb-4">
                            Siswa dapat memantau kehadiran mandiri, melihat nilai tugas formatif harian, dan mengecek jadwal pelajaran langsung dari gawai pribadi.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-border-default/60 flex items-center justify-between text-xs text-status-sakit font-semibold">
                        <span>Akses Transparan</span>
                        <span class="material-symbols-outlined text-sm">verified_user</span>
                    </div>
                </div>

                <!-- 6. Keamanan & RBAC -->
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover-lift transition-all flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-error-container/60 text-error flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-[28px]">admin_panel_settings</span>
                        </div>
                        <h3 class="font-headline-md text-[18px] font-bold text-text-main mb-2">Keamanan Role-Based (RBAC)</h3>
                        <p class="font-body-default text-on-surface-variant text-sm leading-relaxed mb-4">
                            Perlindungan data ketat berbasis Spatie Permissions. Guru hanya dapat mengakses kelasnya, sedangkan Admin TU dan Waka memiliki wewenang master.
                        </p>
                    </div>
                    <div class="pt-4 border-t border-border-default/60 flex items-center justify-between text-xs text-error font-semibold">
                        <span>Standar Terverifikasi</span>
                        <span class="material-symbols-outlined text-sm">lock</span>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="bg-primary text-on-primary rounded-2xl p-8 md:p-10 flex flex-col sm:flex-row items-center justify-between gap-6 shadow-md">
            <div>
                <h3 class="font-headline-md text-2xl font-bold mb-2">Coba Semua Fitur Ini Sekarang</h3>
                <p class="text-on-primary/90 text-sm max-w-xl">Akses sistem dengan akun demo atau kredensial yang diberikan oleh pihak madrasah.</p>
            </div>
            <a href="{{ route('login') }}" class="bg-surface-container-lowest text-primary px-8 py-3 rounded-lg font-bold hover:bg-surface-container transition-all shadow-sm shrink-0 flex items-center gap-2">
                <span>Login ke Portal</span>
                <span class="material-symbols-outlined text-[20px]">arrow_forward</span>
            </a>
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
                <a href="{{ url('/tentang') }}" class="hover:text-primary transition-colors">Tentang</a>
                <span>&bull;</span>
                <a href="{{ url('/kontak') }}" class="hover:text-primary transition-colors">Kontak</a>
            </div>
        </div>
    </footer>
</body>
</html>
