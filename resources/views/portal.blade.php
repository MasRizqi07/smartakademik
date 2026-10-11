<x-public-layout title="Pilih Gerbang Portal Masuk">
    <div class="bg-brand-surface min-h-[calc(100vh-5rem)] py-12 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Title Header -->
            <div class="text-center max-w-2xl mx-auto mb-14 space-y-3">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white text-brand-dark text-[10px] font-bold uppercase tracking-wider border border-border">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand"></span>
                    <span>Gerbang Akses Multi-Peran</span>
                </span>
                <h1 class="text-3xl sm:text-4xl font-extrabold text-text-primary tracking-tight font-display">
                    Pilih Ruang Kerja Anda
                </h1>
                <p class="text-sm text-text-secondary leading-relaxed">
                    Silakan pilih jenis akun yang sesuai untuk dialihkan langsung ke formulir autentikasi madrasah.
                </p>
            </div>

            <!-- 3 Role Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-5xl mx-auto">
                <!-- Guru Card -->
                <div class="bg-surface border border-border shadow-card rounded-xl p-8 flex flex-col justify-between transition-shadow hover:shadow-md group relative">
                    <div class="space-y-5">
                        <div class="w-14 h-14 rounded-2xl bg-brand text-white flex items-center justify-center shadow-xs">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-2xl font-bold text-text-primary font-display">Tenaga Pendidik</h3>
                            </div>
                            <p class="text-xs text-text-secondary mt-2 leading-relaxed">
                                Khusus guru mata pelajaran untuk mencatat presensi harian secara instan, mengelola nilai formatif TP 1-5, dan meninjau agenda KBM.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-border space-y-2 text-xs text-text-secondary">
                            <div class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>Presensi Per Jam Mengajar</span>
                            </div>
                            <div class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>Formatif Berbasis KKM 75</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('login', ['role' => 'guru']) }}" class="mt-8 inline-flex items-center justify-between px-5 py-3 bg-brand hover:bg-brand-hover text-white text-xs font-bold rounded-xl shadow-xs transition-colors">
                        <span>Masuk Portal Guru</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>

                <!-- Siswa Card -->
                <div class="bg-surface border border-border shadow-card rounded-xl p-8 flex flex-col justify-between transition-shadow hover:shadow-md group relative">
                    <div class="space-y-5">
                        <div class="w-14 h-14 rounded-2xl bg-status-sakit text-white flex items-center justify-center shadow-xs">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342" /></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-2xl font-bold text-text-primary font-display">Santri / Siswa</h3>
                            </div>
                            <p class="text-xs text-text-secondary mt-2 leading-relaxed">
                                Akses portofolio santri untuk memeriksa jadwal pelajaran harian, memantau rekap presensi mandiri, serta melihat nilai asesmen formatif.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-border space-y-2 text-xs text-text-secondary">
                            <div class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 text-status-sakit" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>Jadwal KBM &amp; Rombel Kelas</span>
                            </div>
                            <div class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 text-status-sakit" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>Rekap Rapor Nilai Formatif</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('login', ['role' => 'siswa']) }}" class="mt-8 inline-flex items-center justify-between px-5 py-3 bg-status-sakit hover:brightness-95 text-white text-xs font-bold rounded-xl shadow-xs transition-colors">
                        <span>Masuk Portal Siswa</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>

                <!-- Admin & Waka Card -->
                <div class="bg-surface border border-border shadow-card rounded-xl p-8 flex flex-col justify-between transition-shadow hover:shadow-md group relative">
                    <div class="space-y-5">
                        <div class="w-14 h-14 rounded-2xl bg-status-izin text-white flex items-center justify-center shadow-xs">
                            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h3 class="text-2xl font-bold text-text-primary font-display">Admin &amp; Waka</h3>
                            </div>
                            <p class="text-xs text-text-secondary mt-2 leading-relaxed">
                                Panel khusus Waka Kurikulum dan Tata Usaha untuk mengelola master siswa, guru, jadwal, event ujian, RBAC peran, dan laporan analitik.
                            </p>
                        </div>

                        <div class="pt-4 border-t border-border space-y-2 text-xs text-text-secondary">
                            <div class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 text-status-izin" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>Deteksi Bentrok Jadwal &amp; Analitik</span>
                            </div>
                            <div class="flex items-center gap-2 font-medium">
                                <svg class="w-4 h-4 text-status-izin" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" /></svg>
                                <span>Manajemen User RBAC &amp; Master Data</span>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('login', ['role' => 'admin']) }}" class="mt-8 inline-flex items-center justify-between px-5 py-3 bg-status-izin hover:brightness-95 text-white text-xs font-bold rounded-xl shadow-xs transition-colors">
                        <span>Masuk Portal Manajemen</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-public-layout>
