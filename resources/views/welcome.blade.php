<x-public-layout>
    <x-slot:title>Portal Akademik Terpadu - MAN 4 Jombang</x-slot:title>

    <!-- Hero Section -->
    <section class="relative pt-16 pb-24 lg:pt-24 lg:pb-32 overflow-hidden bg-gradient-to-b from-brand-surface/60 via-surface-page to-surface-page">
        <!-- Subtle Glow Background Decoration -->
        <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[350px] bg-brand/10 blur-[100px] rounded-full pointer-events-none -z-10"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <!-- Badge Top -->
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-brand/10 border border-brand/20 text-brand mb-8 shadow-xs">
                <span class="inline-block w-2 h-2 rounded-full bg-brand animate-pulse"></span>
                <span class="text-xs font-bold uppercase tracking-wider">Sistem Informasi Akademik Generasi Baru</span>
            </div>

            <!-- Main Headline -->
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold text-text-primary tracking-tight leading-tight max-w-4xl mx-auto mb-6">
                Transformasi Digital Madrasah <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand via-emerald-600 to-teal-700">Cepat, Akurat & Terpadu</span>
            </h1>

            <!-- Subtitle -->
            <p class="text-base sm:text-lg lg:text-xl text-text-secondary max-w-2xl mx-auto mb-10 leading-relaxed">
                Platform operasional akademik harian MAN 4 Jombang. Pengelolaan presensi kelas real-time, penilaian formatif Kurikulum Merdeka, dan analitik performa madrasah dalam satu genggaman.
            </p>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                <a href="{{ route('portal') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-8 py-3.5 bg-brand text-white font-bold text-base rounded-xl shadow-lg shadow-brand/20 hover:bg-brand-hover hover:shadow-xl hover:shadow-brand/30 transition-all duration-200 active:scale-95">
                    <span>Masuk Portal Sekarang</span>
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>
                </a>
                <a href="{{ route('fitur') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-7 py-3.5 bg-surface text-text-primary font-semibold text-base rounded-xl border border-border hover:border-brand/40 hover:bg-slate-50 transition-all duration-200 shadow-sm">
                    <svg class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                    </svg>
                    <span>Pelajari Fitur Platform</span>
                </a>
            </div>

            <!-- Quick Stats Banner -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto pt-8 border-t border-border/70 text-left">
                <div class="bg-surface rounded-xl p-4 border border-border shadow-xs">
                    <div class="text-2xl lg:text-3xl font-extrabold text-brand mb-1">1.250+</div>
                    <div class="text-xs text-text-secondary font-medium">Siswa Aktif Terdata</div>
                </div>
                <div class="bg-surface rounded-xl p-4 border border-border shadow-xs">
                    <div class="text-2xl lg:text-3xl font-extrabold text-brand mb-1">68</div>
                    <div class="text-xs text-text-secondary font-medium">Tenaga Pendidik & TU</div>
                </div>
                <div class="bg-surface rounded-xl p-4 border border-border shadow-xs">
                    <div class="text-2xl lg:text-3xl font-extrabold text-brand mb-1">100%</div>
                    <div class="text-xs text-text-secondary font-medium">Presensi Digital Harian</div>
                </div>
                <div class="bg-surface rounded-xl p-4 border border-border shadow-xs">
                    <div class="text-2xl lg:text-3xl font-extrabold text-brand mb-1">45+</div>
                    <div class="text-xs text-text-secondary font-medium">Prestasi Madrasah 2025</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bento Features Section -->
    <section class="py-20 bg-surface border-y border-border" id="features">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-xs font-bold uppercase tracking-wider text-brand mb-3">Fitur Unggulan</h2>
                <h3 class="text-3xl sm:text-4xl font-extrabold text-text-primary tracking-tight mb-4">
                    Solusi Lengkap Operasional Pembelajaran
                </h3>
                <p class="text-base text-text-secondary">
                    Dirancang dengan fokus kecepatan, kemudahan antarmuka smartphone, dan integritas data Kurikulum Merdeka.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Presensi Real-Time (Wide) -->
                <div class="md:col-span-2 bg-surface-page rounded-2xl p-8 border border-border hover:border-brand/40 shadow-sm transition-all duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center mb-6 group-hover:bg-brand group-hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-text-primary mb-3">Presensi Harian 1-Klik</h4>
                        <p class="text-sm text-text-secondary leading-relaxed mb-6">
                            Guru dapat mencatat kehadiran 35+ siswa dalam waktu kurang dari 40 detik. Dilengkapi tombol otomatis <em>Tandai Semua Hadir</em>, status Izin/Sakit/Alfa, dan indikator penyimpanan instan tanpa reload halaman.
                        </p>
                    </div>
                    <!-- Micro Preview Card -->
                    <div class="bg-surface rounded-xl p-4 border border-border shadow-xs">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-xs font-bold text-text-primary">X-A — Matematika (Jam 1-2)</span>
                            <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-status-hadir/15 text-status-hadir">97.1% Hadir</span>
                        </div>
                        <div class="w-full bg-slate-100 rounded-full h-2 flex overflow-hidden">
                            <div class="bg-status-hadir h-full" style="width: 85%"></div>
                            <div class="bg-status-izin h-full" style="width: 10%"></div>
                            <div class="bg-status-sakit h-full" style="width: 5%"></div>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Rapor Formatif TP -->
                <div class="bg-surface-page rounded-2xl p-8 border border-border hover:border-brand/40 shadow-sm transition-all duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center mb-6 group-hover:bg-brand group-hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-text-primary mb-3">Penilaian Formatif TP</h4>
                        <p class="text-sm text-text-secondary leading-relaxed mb-6">
                            Penilaian berbasis Tujuan Pembelajaran (TP 1–6). Validasi input angka instan, status ketuntasan otomatis terhadap KKM, dan kalkulasi rerata otomatis.
                        </p>
                    </div>
                    <div class="bg-surface rounded-xl p-3 border border-border flex items-center justify-between text-xs font-semibold">
                        <span class="text-text-secondary">KKM Standar: 75</span>
                        <span class="text-brand">Status: Tuntas ✓</span>
                    </div>
                </div>

                <!-- Card 3: Jadwal Pelajaran Matrix -->
                <div class="bg-surface-page rounded-2xl p-8 border border-border hover:border-brand/40 shadow-sm transition-all duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center mb-6 group-hover:bg-brand group-hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.253M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-text-primary mb-3">Jadwal Pintar Anti-Bentrok</h4>
                        <p class="text-sm text-text-secondary leading-relaxed mb-6">
                            Sistem matriks jadwal dengan deteksi tabrakan otomatis. Waka Kurikulum dapat menyusun jadwal kelas dan guru dengan cepat dan akurat.
                        </p>
                    </div>
                    <div class="bg-surface rounded-xl p-3 border border-border flex items-center justify-between text-xs font-semibold">
                        <span class="text-text-secondary">Total Jam: 48 JP/Minggu</span>
                        <span class="text-emerald-600 font-bold">Bebas Konflik ✓</span>
                    </div>
                </div>

                <!-- Card 4: Analitik Waka Kurikulum (Wide) -->
                <div class="md:col-span-2 bg-surface-page rounded-2xl p-8 border border-border hover:border-brand/40 shadow-sm transition-all duration-200 group flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-xl bg-brand/10 text-brand flex items-center justify-center mb-6 group-hover:bg-brand group-hover:text-white transition-colors duration-200">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>
                        </div>
                        <h4 class="text-xl font-bold text-text-primary mb-3">Laporan & Analitik Komprehensif</h4>
                        <p class="text-sm text-text-secondary leading-relaxed mb-6">
                            Visualisasi capaian pembelajaran, tren absensi bulanan siswa, monitoring guru, dan rekapitulasi nilai seluruh jenjang kelas (X, XI, XII) yang siap diekspor ke Excel dan PDF.
                        </p>
                    </div>
                    <div class="grid grid-cols-3 gap-2 text-center text-xs">
                        <div class="bg-surface p-2.5 rounded-lg border border-border">
                            <div class="font-bold text-brand text-sm">96.4%</div>
                            <div class="text-[10px] text-text-secondary">Rata-rata Presensi</div>
                        </div>
                        <div class="bg-surface p-2.5 rounded-lg border border-border">
                            <div class="font-bold text-brand text-sm">82.1</div>
                            <div class="text-[10px] text-text-secondary">Rata-rata Nilai</div>
                        </div>
                        <div class="bg-surface p-2.5 rounded-lg border border-border">
                            <div class="font-bold text-brand text-sm">100%</div>
                            <div class="text-[10px] text-text-secondary">Rekap Selesai</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Role Gate Teaser Section -->
    <section class="py-20 bg-surface-page">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-brand rounded-3xl p-8 sm:p-12 lg:p-16 text-white shadow-xl relative overflow-hidden flex flex-col lg:flex-row items-center justify-between gap-8">
                <!-- Background pattern -->
                <div class="absolute -right-16 -bottom-16 w-80 h-80 bg-white/10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="max-w-2xl text-left relative z-10">
                    <span class="inline-block px-3.5 py-1 rounded-full bg-white/20 text-xs font-bold uppercase tracking-wider mb-4">Siap Menggunakan Sistem?</span>
                    <h3 class="text-3xl sm:text-4xl font-extrabold tracking-tight mb-4">
                        Masuk ke Portal Peran Anda
                    </h3>
                    <p class="text-white/90 text-base leading-relaxed">
                        Akses khusus telah disesuaikan untuk Guru Pengampu, Siswa Madrasah, serta Tim Tata Usaha & Waka Kurikulum.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto relative z-10 shrink-0">
                    <a href="{{ route('login', ['role' => 'guru']) }}" class="px-6 py-3.5 bg-white text-brand font-bold text-sm rounded-xl text-center hover:bg-slate-100 transition-colors shadow-sm">
                        Portal Guru
                    </a>
                    <a href="{{ route('login', ['role' => 'siswa']) }}" class="px-6 py-3.5 bg-brand-hover text-white border border-white/30 font-bold text-sm rounded-xl text-center hover:bg-white/20 transition-colors">
                        Portal Siswa
                    </a>
                    <a href="{{ route('portal') }}" class="px-6 py-3.5 bg-white/10 text-white border border-white/20 font-bold text-sm rounded-xl text-center hover:bg-white/20 transition-colors">
                        Lihat Semua Peran
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
