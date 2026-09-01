<x-public-layout title="Sistem Informasi & Manajemen Akademik Digital">
    <!-- Hero Section -->
    <section class="relative pt-12 pb-20 sm:pt-20 sm:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto space-y-6">
                <!-- Pill Badge -->
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-50 border border-emerald-200/80 text-emerald-800 text-xs font-bold shadow-xs hover:scale-105 transition-all">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                    <span>Transformasi Digital Madrasah Unggul</span>
                    <span class="text-emerald-400">&bull;</span>
                    <span class="text-emerald-700">MAN 4 Jombang</span>
                </div>

                <!-- Headline -->
                <h1 class="text-3xl sm:text-5xl lg:text-6xl font-black text-text-primary tracking-tight font-display leading-[1.15]">
                    Pusat Informasi &amp; Manajemen Akademik <span class="text-gradient-emerald">Terpadu &amp; Presisi</span>
                </h1>

                <!-- Subtitle -->
                <p class="text-base sm:text-lg text-text-secondary leading-relaxed max-w-2xl mx-auto font-medium">
                    Ekosistem digital resmi madrasah untuk pencatatan presensi real-time, pengelolaan nilai formatif berbasis capaian TP, serta transparansi proses belajar santri.
                </p>

                <!-- CTA Actions -->
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5 pt-2">
                    <a href="{{ route('portal') }}" class="w-full sm:w-auto px-7 py-3.5 bg-gradient-to-r from-emerald-700 to-emerald-600 hover:from-emerald-800 hover:to-emerald-700 text-white font-extrabold text-sm rounded-xl shadow-lg hover:shadow-glow transition-all flex items-center justify-center gap-2.5 active:scale-95">
                        <span>Pilih Gerbang Portal</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </a>
                    <a href="{{ route('fitur') }}" class="w-full sm:w-auto px-6 py-3.5 bg-white text-text-primary hover:text-brand font-bold text-sm rounded-xl border border-slate-200 hover:border-brand/40 shadow-xs hover:shadow-sm transition-all flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Jelajahi Fitur</span>
                    </a>
                </div>
            </div>

            <!-- Floating Interactive Hero Stats Ribbon -->
            <div class="mt-14 sm:mt-20 grid grid-cols-2 md:grid-cols-4 gap-4 max-w-5xl mx-auto">
                <div class="glass-card rounded-2xl p-5 border border-slate-200/80 text-center hover-lift">
                    <div class="text-2xl sm:text-3xl font-extrabold text-emerald-700 font-display">1.250+</div>
                    <div class="text-xs font-semibold text-text-secondary mt-1">Santri &amp; Siswa Aktif</div>
                </div>
                <div class="glass-card rounded-2xl p-5 border border-slate-200/80 text-center hover-lift">
                    <div class="text-2xl sm:text-3xl font-extrabold text-emerald-700 font-display">78</div>
                    <div class="text-xs font-semibold text-text-secondary mt-1">Tenaga Pendidik</div>
                </div>
                <div class="glass-card rounded-2xl p-5 border border-slate-200/80 text-center hover-lift">
                    <div class="text-2xl sm:text-3xl font-extrabold text-emerald-700 font-display">34</div>
                    <div class="text-xs font-semibold text-text-secondary mt-1">Rombel Kelas Digital</div>
                </div>
                <div class="glass-card rounded-2xl p-5 border border-slate-200/80 text-center hover-lift">
                    <div class="text-2xl sm:text-3xl font-extrabold text-amber-600 font-display">A (Unggul)</div>
                    <div class="text-xs font-semibold text-text-secondary mt-1">Akreditasi Madrasah</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3 Role Entry Cards Section -->
    <section class="py-16 bg-white border-y border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <h2 class="text-xs font-extrabold uppercase tracking-widest text-brand">Akses Cepat Pengguna</h2>
                <h3 class="text-2xl sm:text-3xl font-extrabold text-text-primary mt-1 font-display">Masuk Berdasarkan Peran Anda</h3>
                <p class="text-sm text-text-secondary mt-2">Pilih ruang kerja yang sesuai untuk mulai mengelola aktivitas pembelajaran.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Card 1: Guru -->
                <div class="bg-surface-page rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-card hover-lift flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 text-emerald-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                        </div>
                        <h4 class="text-xl font-bold text-text-primary font-display">Guru Pengampu</h4>
                        <p class="text-xs text-text-secondary leading-relaxed">
                            Input presensi kelas instan, rekam nilai asesmen formatif (TP 1-5), dan kelola jadwal mengajar harian Anda.
                        </p>
                    </div>
                    <a href="{{ route('login', ['role' => 'guru']) }}" class="mt-6 inline-flex items-center justify-between px-4 py-2.5 bg-white text-emerald-700 text-xs font-bold rounded-xl border border-emerald-200 hover:bg-brand hover:text-white transition-all shadow-xs">
                        <span>Masuk Portal Guru</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>

                <!-- Card 2: Siswa / Santri -->
                <div class="bg-surface-page rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-card hover-lift flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-sky-100 text-sky-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" /></svg>
                        </div>
                        <h4 class="text-xl font-bold text-text-primary font-display">Siswa &amp; Santri</h4>
                        <p class="text-xs text-text-secondary leading-relaxed">
                            Cek jadwal KBM kelas, pantau rekap kehadiran mandiri, dan lihat capaian nilai formatif berkala secara transparan.
                        </p>
                    </div>
                    <a href="{{ route('login', ['role' => 'siswa']) }}" class="mt-6 inline-flex items-center justify-between px-4 py-2.5 bg-white text-sky-700 text-xs font-bold rounded-xl border border-sky-200 hover:bg-sky-600 hover:text-white transition-all shadow-xs">
                        <span>Masuk Portal Siswa</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>

                <!-- Card 3: Admin & Waka -->
                <div class="bg-surface-page rounded-2xl p-6 sm:p-8 border border-slate-200 shadow-card hover-lift flex flex-col justify-between group">
                    <div class="space-y-4">
                        <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" /></svg>
                        </div>
                        <h4 class="text-xl font-bold text-text-primary font-display">Waka &amp; Tata Usaha</h4>
                        <p class="text-xs text-text-secondary leading-relaxed">
                            Akses analitik kehadiran, deteksi bentrok jadwal, manajemen master data madrasah, dan laporan rapor digital.
                        </p>
                    </div>
                    <a href="{{ route('login', ['role' => 'admin']) }}" class="mt-6 inline-flex items-center justify-between px-4 py-2.5 bg-white text-amber-800 text-xs font-bold rounded-xl border border-amber-200 hover:bg-amber-600 hover:text-white transition-all shadow-xs">
                        <span>Masuk Portal Manajemen</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Bento Grid Features Section -->
    <section class="py-20 sm:py-28">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <h2 class="text-xs font-extrabold uppercase tracking-widest text-brand">Keunggulan Ekosistem</h2>
                <h3 class="text-2xl sm:text-4xl font-extrabold text-text-primary mt-1 font-display">Solusi Terpadu Kebutuhan Akademik</h3>
                <p class="text-sm text-text-secondary mt-2">Didesain khusus menyesuaikan ritme pembelajaran madrasah berbasis pesantren.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Bento 1: Presensi Instan (2 Cols) -->
                <div class="md:col-span-2 glass-card rounded-3xl p-8 border border-slate-200 relative overflow-hidden flex flex-col justify-between hover-lift">
                    <div class="space-y-3 relative z-10 max-w-lg">
                        <span class="inline-flex px-3 py-1 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider">Presensi Real-Time</span>
                        <h4 class="text-2xl font-bold text-text-primary font-display">Pencatatan Kehadiran Cepat Tanpa Kertas</h4>
                        <p class="text-xs text-text-secondary leading-relaxed">
                            Guru menandai presensi santri langsung per jam pelajaran dengan satu ketukan. Terintegrasi langsung dengan rekapitulasi kehadiran madrasah dan catatan khusus santri.
                        </p>
                    </div>
                    <div class="pt-6 grid grid-cols-3 gap-3">
                        <div class="bg-white/90 p-3.5 rounded-xl border border-slate-200/80 text-center">
                            <span class="text-xs font-bold text-emerald-600">Auto-Save</span>
                            <p class="text-[10px] text-text-secondary mt-0.5">Tersimpan Seketika</p>
                        </div>
                        <div class="bg-white/90 p-3.5 rounded-xl border border-slate-200/80 text-center">
                            <span class="text-xs font-bold text-sky-600">Catatan Khusus</span>
                            <p class="text-[10px] text-text-secondary mt-0.5">Lampiran Izin/Sakit</p>
                        </div>
                        <div class="bg-white/90 p-3.5 rounded-xl border border-slate-200/80 text-center">
                            <span class="text-xs font-bold text-amber-600">Ekspor CSV</span>
                            <p class="text-[10px] text-text-secondary mt-0.5">Siap Cetak Rekap</p>
                        </div>
                    </div>
                </div>

                <!-- Bento 2: Kurikulum Merdeka (1 Col) -->
                <div class="glass-card rounded-3xl p-8 border border-slate-200 flex flex-col justify-between hover-lift">
                    <div class="space-y-3">
                        <span class="inline-flex px-3 py-1 rounded-full bg-amber-100 text-amber-800 text-[10px] font-bold uppercase tracking-wider">Asesmen TP</span>
                        <h4 class="text-xl font-bold text-text-primary font-display">Penilaian Formatif Berkelanjutan</h4>
                        <p class="text-xs text-text-secondary leading-relaxed">
                            Pencatatan capaian Tujuan Pembelajaran (TP 1-5) dengan kalkulasi otomatis status tuntas remedial sesuai KKM dinamis.
                        </p>
                    </div>
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between text-xs text-brand font-bold">
                        <span>Standar Kurikulum Merdeka</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>

                <!-- Bento 3: Conflict Detector (1 Col) -->
                <div class="glass-card rounded-3xl p-8 border border-slate-200 flex flex-col justify-between hover-lift">
                    <div class="space-y-3">
                        <span class="inline-flex px-3 py-1 rounded-full bg-sky-100 text-sky-800 text-[10px] font-bold uppercase tracking-wider">Manajemen Jadwal</span>
                        <h4 class="text-xl font-bold text-text-primary font-display">Deteksi Bentrok Jadwal Otomatis</h4>
                        <p class="text-xs text-text-secondary leading-relaxed">
                            Sistem secara cerdas mendeteksi jika ada guru atau kelas yang memiliki tabrakan jadwal pada hari dan jam yang sama.
                        </p>
                    </div>
                    <div class="pt-6 border-t border-slate-100 flex items-center justify-between text-xs text-sky-700 font-bold">
                        <span>Nol Konflik Mengajar</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                </div>

                <!-- Bento 4: Analitik Terpadu (2 Cols) -->
                <div class="md:col-span-2 glass-card rounded-3xl p-8 border border-slate-200 relative overflow-hidden flex flex-col justify-between hover-lift">
                    <div class="space-y-3 relative z-10 max-w-lg">
                        <span class="inline-flex px-3 py-1 rounded-full bg-purple-100 text-purple-800 text-[10px] font-bold uppercase tracking-wider">Laporan &amp; Analitik</span>
                        <h4 class="text-2xl font-bold text-text-primary font-display">Dashboard Monitoring Kepala &amp; Waka</h4>
                        <p class="text-xs text-text-secondary leading-relaxed">
                            Pantau metrik kehadiran madrasah harian, distribusi per tingkatan rombel (X, XI, XII), dan kesiapan rapor semester dalam satu panel terpadu.
                        </p>
                    </div>
                    <div class="pt-6 flex flex-wrap gap-4 items-center">
                        <a href="{{ route('login', ['role' => 'waka']) }}" class="px-5 py-2.5 bg-brand text-white text-xs font-bold rounded-xl shadow-xs hover:bg-brand-hover transition-all">
                            Lihat Demo Analitik
                        </a>
                        <span class="text-xs text-text-secondary font-medium">Data diperbarui secara real-time dari seluruh kelas</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom CTA Banner -->
    <section class="py-16 sm:py-20 bg-gradient-to-tr from-emerald-950 via-emerald-900 to-teal-950 text-white relative overflow-hidden">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center space-y-6 relative z-10">
            <h3 class="text-2xl sm:text-4xl font-extrabold font-display tracking-tight">
                Mulai Digitalisasi Akademik Madrasah Sekarang
            </h3>
            <p class="text-sm sm:text-base text-emerald-200/90 max-w-xl mx-auto font-medium leading-relaxed">
                Akses seluruh informasi, presensi harian, dan capaian belajar santri dalam satu platform terintegrasi.
            </p>
            <div class="pt-2 flex flex-col sm:flex-row items-center justify-center gap-3">
                <a href="{{ route('portal') }}" class="w-full sm:w-auto px-8 py-3.5 bg-amber-400 hover:bg-amber-300 text-slate-900 font-extrabold text-sm rounded-xl shadow-lg transition-all active:scale-95">
                    Buka Portal Pengguna
                </a>
                <a href="{{ route('bantuan') }}" class="w-full sm:w-auto px-6 py-3.5 bg-emerald-800/80 hover:bg-emerald-800 text-white font-bold text-sm rounded-xl border border-emerald-700 transition-all">
                    Pusat Panduan &amp; FAQ
                </a>
            </div>
        </div>
    </section>
</x-public-layout>
