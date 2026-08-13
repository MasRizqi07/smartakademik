<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-headline-md text-headline-md text-primary font-bold">
                Dashboard Waka Kurikulum
            </h2>
            <span class="font-label-sm text-on-surface-variant bg-surface-container-high px-3 py-1 rounded-full">
                Monitoring Kurikulum
            </span>
        </div>
    </x-slot>

    <!-- Welcome Header -->
    <section class="flex flex-col gap-2">
        <h1 class="font-headline-lg text-headline-lg font-bold text-text-main">
            Selamat Datang, {{ auth()->user()->name }} 👋
        </h1>
        <p class="font-body-default text-body-default text-on-surface-variant">
            Pusat pemantauan kegiatan belajar mengajar, analisis kehadiran, dan laporan capaian formatif madrasah.
        </p>
    </section>

    <!-- Bento Grid Stats -->
    <section class="grid grid-cols-1 md:grid-cols-3 gap-grid-gutter">
        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col gap-2">
            <div class="flex items-center gap-2 text-primary">
                <span class="material-symbols-outlined">calendar_month</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Jadwal Mengajar</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\JadwalPelajaran::count() }} Sesi
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col gap-2">
            <div class="flex items-center gap-2 text-status-hadir">
                <span class="material-symbols-outlined">how_to_reg</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Presensi Siswa</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Absensi::count() }} Record
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col gap-2">
            <div class="flex items-center gap-2 text-status-sakit">
                <span class="material-symbols-outlined">assessment</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Nilai Formatif</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Nilai::count() }} Input
            </div>
        </div>
    </section>

    <!-- Quick Action Cards Grid -->
    <section class="flex flex-col gap-4">
        <h3 class="font-headline-md text-headline-md font-bold text-text-main">
            Modul Monitoring & Laporan Kurikulum
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-grid-gutter">
            <a href="{{ route('waka.jadwal') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-primary-container/10 text-primary flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                    <span class="material-symbols-outlined text-[28px]">calendar_month</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="font-headline-md text-[18px] font-bold text-text-main group-hover:text-primary transition-colors">Monitoring Jadwal</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Kelola jadwal KBM harian kelas dan alokasi pengajar.</p>
                </div>
            </a>

            <a href="{{ route('waka.rekap-absensi') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-status-hadir/10 text-status-hadir flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                    <span class="material-symbols-outlined text-[28px]">how_to_reg</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="font-headline-md text-[18px] font-bold text-text-main group-hover:text-primary transition-colors">Rekap Absensi</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Laporan bulanan persentase kehadiran siswa per rombel.</p>
                </div>
            </a>

            <a href="{{ route('waka.rekap-nilai') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-status-sakit/10 text-status-sakit flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                    <span class="material-symbols-outlined text-[28px]">assessment</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="font-headline-md text-[18px] font-bold text-text-main group-hover:text-primary transition-colors">Rekap Nilai Formatif</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Ringkasan capaian penilaian harian & tugas siswa.</p>
                </div>
            </a>
        </div>
    </section>
</x-app-layout>

