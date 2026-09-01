<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-2.5">
                <span class="font-extrabold text-brand font-display">Kurikulum Madrasah</span>
                <span class="text-slate-300">&bull;</span>
                <span class="text-xs font-semibold bg-brand-surface text-brand px-3 py-1 rounded-full border border-brand/20">Waka Monitoring Hub</span>
            </div>
            <div class="text-xs text-text-secondary font-medium hidden sm:block">
                Semester Ganjil 2026/2027
            </div>
        </div>
    </x-slot>

    <!-- Welcome Hero Banner -->
    <div class="glass-card rounded-2xl p-6 sm:p-8 border border-slate-200/80 relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="space-y-2">
                <div class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full bg-emerald-100 text-emerald-800 text-[10px] font-bold uppercase tracking-wider">
                    <span>Panel Pengawasan Kurikulum</span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-text-primary tracking-tight font-display">
                    Selamat Datang, {{ auth()->user()->name }}
                </h1>
                <p class="text-xs sm:text-sm text-text-secondary max-w-2xl leading-relaxed">
                    Pantau efektivitas pembelajaran madrasah, presensi harian seluruh rombel kelas, dan rekapitulasi capaian formatif secara komprehensif.
                </p>
            </div>
            <div class="flex items-center gap-2.5 shrink-0">
                <a href="{{ route('waka.laporan') }}" wire:navigate class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand text-white font-bold text-xs rounded-xl shadow-sm hover:bg-brand-hover hover:shadow-glow transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                    <span>Laporan Analitik</span>
                </a>
            </div>
        </div>
    </div>

    <!-- 4 KPI Monitoring Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="glass-card rounded-2xl p-5 border border-slate-200/80 hover-lift">
            <div class="text-[11px] font-bold text-text-secondary uppercase">Jadwal Aktif</div>
            <div class="text-2xl sm:text-3xl font-extrabold text-emerald-700 mt-1 font-display">
                {{ \App\Models\JadwalPelajaran::count() }}
            </div>
            <div class="text-[10px] text-text-secondary mt-0.5">Sesi KBM Terdaftar</div>
        </div>

        <div class="glass-card rounded-2xl p-5 border border-slate-200/80 hover-lift">
            <div class="text-[11px] font-bold text-sky-600 uppercase">Presensi Terdata</div>
            <div class="text-2xl sm:text-3xl font-extrabold text-sky-600 mt-1 font-display">
                {{ \App\Models\Absensi::count() }}
            </div>
            <div class="text-[10px] text-text-secondary mt-0.5">Catatan Kehadiran Siswa</div>
        </div>

        <div class="glass-card rounded-2xl p-5 border border-slate-200/80 hover-lift">
            <div class="text-[11px] font-bold text-amber-600 uppercase">Nilai Formatif</div>
            <div class="text-2xl sm:text-3xl font-extrabold text-amber-600 mt-1 font-display">
                {{ \App\Models\NilaiFormatif::count() }}
            </div>
            <div class="text-[10px] text-text-secondary mt-0.5">Capaian TP Terekam</div>
        </div>

        <div class="glass-card rounded-2xl p-5 border border-slate-200/80 hover-lift">
            <div class="text-[11px] font-bold text-purple-600 uppercase">Rombel Kelas</div>
            <div class="text-2xl sm:text-3xl font-extrabold text-purple-600 mt-1 font-display">
                {{ \App\Models\Kelas::count() }}
            </div>
            <div class="text-[10px] text-text-secondary mt-0.5">Tingkat X, XI, XII</div>
        </div>
    </div>

    <!-- Quick Action Cards Grid -->
    <div class="space-y-4">
        <h3 class="text-base font-bold text-text-primary font-display flex items-center gap-2">
            <svg class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            <span>Modul Operasional Kurikulum</span>
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('waka.jadwal') }}" wire:navigate class="glass-card rounded-2xl p-6 border border-slate-200/80 hover-lift flex flex-col justify-between group">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-emerald-100 text-emerald-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                    </div>
                    <h4 class="text-base font-bold text-text-primary group-hover:text-brand transition-colors font-display">Manajemen Jadwal</h4>
                    <p class="text-xs text-text-secondary leading-relaxed">
                        Pengaturan jadwal KBM harian dengan automated conflict detector.
                    </p>
                </div>
                <div class="pt-4 flex items-center gap-1 text-xs font-bold text-brand group-hover:translate-x-1 transition-transform">
                    <span>Buka Modul</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </div>
            </a>

            <a href="{{ route('waka.rekap-absensi') }}" wire:navigate class="glass-card rounded-2xl p-6 border border-slate-200/80 hover-lift flex flex-col justify-between group">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-sky-100 text-sky-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    </div>
                    <h4 class="text-base font-bold text-text-primary group-hover:text-brand transition-colors font-display">Rekap Presensi</h4>
                    <p class="text-xs text-text-secondary leading-relaxed">
                        Laporan persentase kehadiran bulanan santri per rombel kelas &amp; ekspor CSV.
                    </p>
                </div>
                <div class="pt-4 flex items-center gap-1 text-xs font-bold text-brand group-hover:translate-x-1 transition-transform">
                    <span>Buka Modul</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </div>
            </a>

            <a href="{{ route('waka.rekap-nilai') }}" wire:navigate class="glass-card rounded-2xl p-6 border border-slate-200/80 hover-lift flex flex-col justify-between group">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-amber-100 text-amber-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
                    </div>
                    <h4 class="text-base font-bold text-text-primary group-hover:text-brand transition-colors font-display">Laporan Rapor Nilai</h4>
                    <p class="text-xs text-text-secondary leading-relaxed">
                        Rekapitulasi nilai akhir, capaian deskripsi TP, dan kesiapan cetak rapor.
                    </p>
                </div>
                <div class="pt-4 flex items-center gap-1 text-xs font-bold text-brand group-hover:translate-x-1 transition-transform">
                    <span>Buka Modul</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </div>
            </a>

            <a href="{{ route('waka.laporan') }}" wire:navigate class="glass-card rounded-2xl p-6 border border-slate-200/80 hover-lift flex flex-col justify-between group">
                <div class="space-y-3">
                    <div class="w-12 h-12 rounded-xl bg-purple-100 text-purple-700 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                    </div>
                    <h4 class="text-base font-bold text-text-primary group-hover:text-brand transition-colors font-display">Analitik Sekolah</h4>
                    <p class="text-xs text-text-secondary leading-relaxed">
                        Visualisasi metrik kehadiran sekolah dan matriks performa kelas.
                    </p>
                </div>
                <div class="pt-4 flex items-center gap-1 text-xs font-bold text-brand group-hover:translate-x-1 transition-transform">
                    <span>Buka Modul</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </div>
            </a>
        </div>
    </div>
</x-app-layout>
