<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-headline-md text-headline-md text-primary font-bold">
                Dashboard Portal Guru
            </h2>
            <span class="font-label-sm text-on-surface-variant bg-surface-container-high px-3 py-1 rounded-full">
                Tenaga Pendidik
            </span>
        </div>
    </x-slot>

    <!-- Welcome Header -->
    <section class="flex flex-col gap-2">
        <h1 class="font-headline-lg text-headline-lg font-bold text-text-main">
            Selamat Datang, {{ auth()->user()->name }} 👨‍🏫
        </h1>
        <p class="font-body-default text-body-default text-on-surface-variant">
            Pencatatan presensi kehadiran siswa harian dan input nilai formatif tugas/ulangan harian.
        </p>
    </section>

    <!-- Action Cards Grid -->
    <section class="grid grid-cols-1 sm:grid-cols-2 gap-grid-gutter">
        <!-- Absensi Widget Card -->
        <a href="{{ route('guru.absensi') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
            <div class="w-14 h-14 rounded-xl bg-status-hadir/10 text-status-hadir flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                <span class="material-symbols-outlined text-[32px]">how_to_reg</span>
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="font-headline-md text-headline-md font-bold text-text-main group-hover:text-primary transition-colors">Input Presensi Siswa</h3>
                <p class="font-body-default text-body-default text-on-surface-variant">Catat kehadiran harian siswa per jam KBM yang Anda ajar.</p>
            </div>
        </a>

        <!-- Nilai Widget Card -->
        <a href="{{ route('guru.nilai') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
            <div class="w-14 h-14 rounded-xl bg-status-sakit/10 text-status-sakit flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                <span class="material-symbols-outlined text-[32px]">edit_note</span>
            </div>
            <div class="flex flex-col gap-1">
                <h3 class="font-headline-md text-headline-md font-bold text-text-main group-hover:text-primary transition-colors">Input Nilai Formatif</h3>
                <p class="font-body-default text-body-default text-on-surface-variant">Kelola capaian nilai tugas harian dan ulangan harian (UH).</p>
            </div>
        </a>
    </section>
</x-app-layout>

