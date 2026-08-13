<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-headline-md text-headline-md text-primary font-bold">
                Dashboard Admin Tata Usaha
            </h2>
            <span class="font-label-sm text-on-surface-variant bg-surface-container-high px-3 py-1 rounded-full">
                MAN 4 Jombang
            </span>
        </div>
    </x-slot>

    <!-- Welcome Header -->
    <section class="flex flex-col gap-2">
        <h1 class="font-headline-lg text-headline-lg font-bold text-text-main">
            Selamat Datang, {{ auth()->user()->name }} 👋
        </h1>
        <p class="font-body-default text-body-default text-on-surface-variant">
            Ringkasan operasional data akademik dan akses cepat manajemen master data madrasah.
        </p>
    </section>

    <!-- Bento Grid Stats -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-grid-gutter">
        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col gap-2">
            <div class="flex items-center gap-2 text-primary">
                <span class="material-symbols-outlined">class</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Total Kelas</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Kelas::count() }}
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col gap-2">
            <div class="flex items-center gap-2 text-secondary">
                <span class="material-symbols-outlined">groups</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Total Siswa</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Siswa::count() }}
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col gap-2">
            <div class="flex items-center gap-2 text-status-sakit">
                <span class="material-symbols-outlined">badge</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Total Guru</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Guru::count() }}
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col gap-2">
            <div class="flex items-center gap-2 text-status-hadir">
                <span class="material-symbols-outlined">menu_book</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Mata Pelajaran</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Mapel::count() }}
            </div>
        </div>
    </section>

    <!-- Quick Action Cards Grid -->
    <section class="flex flex-col gap-4">
        <h3 class="font-headline-md text-headline-md font-bold text-text-main">
            Modul Manajemen Master Data
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-grid-gutter">
            <a href="{{ route('admin.siswa') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-primary-container/10 text-primary flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                    <span class="material-symbols-outlined text-[28px]">groups</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="font-headline-md text-[18px] font-bold text-text-main group-hover:text-primary transition-colors">Data Siswa</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Kelola identitas siswa, NISN, kelas, dan akun portal.</p>
                </div>
            </a>

            <a href="{{ route('admin.guru') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-secondary-container/30 text-secondary flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                    <span class="material-symbols-outlined text-[28px]">badge</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="font-headline-md text-[18px] font-bold text-text-main group-hover:text-primary transition-colors">Data Guru & Role</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Kelola NIP, daftar pengajar, dan hak akses pengguna.</p>
                </div>
            </a>

            <a href="{{ route('admin.kelas') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-status-izin/10 text-status-izin flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                    <span class="material-symbols-outlined text-[28px]">meeting_room</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="font-headline-md text-[18px] font-bold text-text-main group-hover:text-primary transition-colors">Data Rombel Kelas</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Manajemen nama kelas, tingkat, dan wali kelas.</p>
                </div>
            </a>

            <a href="{{ route('admin.mapel') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-status-sakit/10 text-status-sakit flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                    <span class="material-symbols-outlined text-[28px]">book</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="font-headline-md text-[18px] font-bold text-text-main group-hover:text-primary transition-colors">Mata Pelajaran</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Pengaturan mata pelajaran dan bobot kurikulum.</p>
                </div>
            </a>

            <a href="{{ route('admin.import') }}" wire:navigate class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-start gap-4">
                <div class="w-12 h-12 rounded-lg bg-status-hadir/10 text-status-hadir flex items-center justify-center group-hover:scale-105 transition-transform shrink-0">
                    <span class="material-symbols-outlined text-[28px]">upload_file</span>
                </div>
                <div class="flex flex-col gap-1">
                    <h4 class="font-headline-md text-[18px] font-bold text-text-main group-hover:text-primary transition-colors">Import Data Excel</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Unggah berkas Excel untuk impor masal data siswa & guru.</p>
                </div>
            </a>
        </div>
    </section>
</x-app-layout>

