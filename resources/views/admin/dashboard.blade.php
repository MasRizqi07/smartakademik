<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-3">
                <span class="font-headline-md text-headline-md text-primary font-extrabold">Academic Portal</span>
                <span class="text-border-default hidden sm:inline">&bull;</span>
                <span class="text-xs font-semibold bg-primary/10 text-primary px-3 py-1 rounded-full hidden sm:inline">Admin TU &amp; Overview</span>
            </div>
            <div class="flex items-center gap-2">
                <span class="text-xs text-on-surface-variant font-medium">{{ date('l, d F Y') }}</span>
            </div>
        </div>
    </x-slot>

    <!-- Welcome Header -->
    <section class="flex flex-col gap-1">
        <h1 class="font-headline-lg text-2xl md:text-3xl font-bold text-text-main">
            Selamat Datang, {{ auth()->user()->name }}
        </h1>
        <p class="font-body-default text-body-default text-on-surface-variant">
            Berikut adalah ringkasan operasional dan aktivitas akademik madrasah hari ini.
        </p>
    </section>

    <!-- Bento Grid Stats -->
    <section class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Active Classes -->
        <div class="bg-surface-container-lowest p-5 rounded-xl shadow-card border border-border-default flex flex-col gap-2 hover-lift transition-all">
            <div class="flex items-center gap-2 text-primary">
                <span class="material-symbols-outlined text-[22px]">class</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Kelas Aktif</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Kelas::count() }}
            </div>
            <span class="text-[11px] text-on-surface-variant">Tingkat X, XI, dan XII</span>
        </div>

        <!-- Total Students -->
        <div class="bg-surface-container-lowest p-5 rounded-xl shadow-card border border-border-default flex flex-col gap-2 hover-lift transition-all">
            <div class="flex items-center gap-2 text-secondary">
                <span class="material-symbols-outlined text-[22px]">groups</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Total Siswa</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Siswa::count() }}
            </div>
            <span class="text-[11px] text-status-hadir font-medium">Terdaftar Aktif di Dapodik/EMIS</span>
        </div>

        <!-- Attendance Rate -->
        <div class="bg-surface-container-lowest p-5 rounded-xl shadow-card border border-border-default flex flex-col gap-2 hover-lift transition-all">
            <div class="flex items-center gap-2 text-status-hadir">
                <span class="material-symbols-outlined text-[22px]">check_circle</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Rata-rata Kehadiran</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                96.8%
            </div>
            <span class="text-[11px] text-status-hadir font-medium">+1.2% dari minggu lalu</span>
        </div>

        <!-- Pending Tasks / Grades -->
        <div class="bg-surface-container-lowest p-5 rounded-xl shadow-card border border-border-default flex flex-col gap-2 hover-lift transition-all">
            <div class="flex items-center gap-2 text-status-izin">
                <span class="material-symbols-outlined text-[22px]">pending_actions</span>
                <span class="font-label-sm uppercase tracking-wider text-on-surface-variant">Input Formatif</span>
            </div>
            <div class="font-headline-lg text-3xl font-bold text-text-main mt-1">
                {{ \App\Models\Mapel::count() }} Mapel
            </div>
            <span class="text-[11px] text-on-surface-variant">Tujuan Pembelajaran Aktif</span>
        </div>
    </section>

    <!-- Main Layout: Today's Schedule Table + Recent Activity Panel -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Schedule Table (2 Cols) -->
        <section class="lg:col-span-2 bg-surface-container-lowest rounded-xl shadow-card border border-border-default flex flex-col overflow-hidden">
            <div class="p-5 border-b border-border-default bg-surface flex justify-between items-center">
                <h3 class="font-headline-md text-base font-bold text-text-main flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    <span>Jadwal Mengajar Hari Ini</span>
                </h3>
                <a href="{{ route('admin.kelas') }}" wire:navigate class="text-primary font-label-md text-xs font-semibold hover:underline flex items-center gap-1">
                    <span>Lihat Semua</span>
                    <span class="material-symbols-outlined text-sm">arrow_forward</span>
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-surface-container-low text-on-surface-variant font-label-sm text-xs uppercase border-b border-border-default">
                            <th class="py-3 px-5 font-semibold">Waktu</th>
                            <th class="py-3 px-5 font-semibold">Mata Pelajaran</th>
                            <th class="py-3 px-5 font-semibold">Kelas</th>
                            <th class="py-3 px-5 font-semibold">Pengajar</th>
                            <th class="py-3 px-5 font-semibold text-right">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-default">
                        @php
                            $schedules = \App\Models\JadwalPelajaran::with(['kelas', 'mapel', 'guru'])->take(5)->get();
                        @endphp

                        @forelse($schedules as $j)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-5 text-on-surface-variant font-mono text-xs">{{ $j->waktu_mulai ?? '07:00' }} - {{ $j->waktu_selesai ?? '08:30' }}</td>
                                <td class="py-3 px-5 font-semibold text-text-main">{{ $j->mapel->nama_mapel ?? 'Matematika Wajib' }}</td>
                                <td class="py-3 px-5">{{ $j->kelas->nama_kelas ?? 'X-A' }}</td>
                                <td class="py-3 px-5 text-on-surface-variant text-xs">{{ $j->guru->nama ?? 'Budi Santoso' }}</td>
                                <td class="py-3 px-5 text-right">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-primary/10 text-primary uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                                        Aktif
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-5 text-on-surface-variant font-mono text-xs">07:00 - 08:30</td>
                                <td class="py-3 px-5 font-semibold text-text-main">Matematika Wajib</td>
                                <td class="py-3 px-5">XII IPA 1</td>
                                <td class="py-3 px-5 text-on-surface-variant text-xs">Budi Santoso, S.Pd.</td>
                                <td class="py-3 px-5 text-right">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-primary/10 text-primary uppercase">
                                        <span class="w-1.5 h-1.5 rounded-full bg-primary animate-pulse"></span>
                                        Berlangsung
                                    </span>
                                </td>
                            </tr>
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="py-3 px-5 text-on-surface-variant font-mono text-xs">08:30 - 10:00</td>
                                <td class="py-3 px-5 font-semibold text-text-main">Fisika Lanjut</td>
                                <td class="py-3 px-5">XI IPA 2</td>
                                <td class="py-3 px-5 text-on-surface-variant text-xs">Siti Aminah, M.Pd.</td>
                                <td class="py-3 px-5 text-right">
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-[11px] font-bold bg-surface-container text-on-surface-variant uppercase">
                                        Mendatang
                                    </span>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

        <!-- Recent Activity Feed (1 Col) -->
        <section class="bg-surface-container-lowest rounded-xl shadow-card border border-border-default flex flex-col h-full overflow-hidden">
            <div class="p-5 border-b border-border-default bg-surface">
                <h3 class="font-headline-md text-base font-bold text-text-main flex items-center gap-2">
                    <span class="material-symbols-outlined text-secondary">history</span>
                    <span>Aktivitas Terkini</span>
                </h3>
            </div>
            <div class="p-5 flex-1 overflow-y-auto">
                <ul class="flex flex-col gap-4 relative">
                    <div class="absolute left-[11px] top-2 bottom-2 w-px bg-border-default -z-10"></div>
                    <li class="flex gap-3 text-xs">
                        <div class="w-6 h-6 rounded-full bg-status-hadir/15 text-status-hadir flex items-center justify-center shrink-0 border border-status-hadir/30">
                            <span class="material-symbols-outlined text-[14px]">check</span>
                        </div>
                        <div class="flex flex-col">
                            <p class="font-body-default text-text-main"><span class="font-semibold">Presensi XII IPA 1</span> telah terekam (28 Hadir, 1 Izin, 1 Sakit)</p>
                            <span class="text-[11px] text-on-surface-variant mt-0.5">10 menit yang lalu</span>
                        </div>
                    </li>
                    <li class="flex gap-3 text-xs">
                        <div class="w-6 h-6 rounded-full bg-primary/15 text-primary flex items-center justify-center shrink-0 border border-primary/30">
                            <span class="material-symbols-outlined text-[14px]">edit_note</span>
                        </div>
                        <div class="flex flex-col">
                            <p class="font-body-default text-text-main"><span class="font-semibold">Nilai Formatif TP 2</span> Matematika diinput oleh Budi Santoso</p>
                            <span class="text-[11px] text-on-surface-variant mt-0.5">45 menit yang lalu</span>
                        </div>
                    </li>
                    <li class="flex gap-3 text-xs">
                        <div class="w-6 h-6 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center shrink-0 border border-border-default">
                            <span class="material-symbols-outlined text-[14px]">person_add</span>
                        </div>
                        <div class="flex flex-col">
                            <p class="font-body-default text-text-main">Akun portal siswa baru digenerate secara otomatis</p>
                            <span class="text-[11px] text-on-surface-variant mt-0.5">Hari ini, 08:15 WIB</span>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
    </div>

    <!-- Master Data Management Cards -->
    <section class="flex flex-col gap-4 pt-2">
        <h3 class="font-headline-md text-lg font-bold text-text-main flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">widgets</span>
            <span>Akses Cepat Modul Master Data</span>
        </h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <a href="{{ route('admin.siswa') }}" wire:navigate class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-center gap-3.5 hover-lift">
                <div class="w-11 h-11 rounded-lg bg-primary-container/10 text-primary flex items-center justify-center group-hover:bg-primary group-hover:text-on-primary transition-colors shrink-0">
                    <span class="material-symbols-outlined text-[24px]">groups</span>
                </div>
                <div>
                    <h4 class="font-headline-md text-sm font-bold text-text-main group-hover:text-primary transition-colors">Data Siswa</h4>
                    <p class="text-xs text-on-surface-variant">NISN &amp; Profil Siswa</p>
                </div>
            </a>

            <a href="{{ route('admin.guru') }}" wire:navigate class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-center gap-3.5 hover-lift">
                <div class="w-11 h-11 rounded-lg bg-secondary-container text-on-secondary-container flex items-center justify-center group-hover:bg-secondary group-hover:text-on-secondary transition-colors shrink-0">
                    <span class="material-symbols-outlined text-[24px]">badge</span>
                </div>
                <div>
                    <h4 class="font-headline-md text-sm font-bold text-text-main group-hover:text-primary transition-colors">Guru &amp; User</h4>
                    <p class="text-xs text-on-surface-variant">NIP &amp; Hak Akses</p>
                </div>
            </a>

            <a href="{{ route('admin.kelas') }}" wire:navigate class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-center gap-3.5 hover-lift">
                <div class="w-11 h-11 rounded-lg bg-status-izin/10 text-status-izin flex items-center justify-center group-hover:bg-status-izin group-hover:text-white transition-colors shrink-0">
                    <span class="material-symbols-outlined text-[24px]">meeting_room</span>
                </div>
                <div>
                    <h4 class="font-headline-md text-sm font-bold text-text-main group-hover:text-primary transition-colors">Rombel Kelas</h4>
                    <p class="text-xs text-on-surface-variant">Tingkat &amp; Wali Kelas</p>
                </div>
            </a>

            <a href="{{ route('admin.mapel') }}" wire:navigate class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card hover:border-primary transition-all group flex items-center gap-3.5 hover-lift">
                <div class="w-11 h-11 rounded-lg bg-status-sakit/10 text-status-sakit flex items-center justify-center group-hover:bg-status-sakit group-hover:text-white transition-colors shrink-0">
                    <span class="material-symbols-outlined text-[24px]">book</span>
                </div>
                <div>
                    <h4 class="font-headline-md text-sm font-bold text-text-main group-hover:text-primary transition-colors">Mata Pelajaran</h4>
                    <p class="text-xs text-on-surface-variant">Kode &amp; Bobot Jam</p>
                </div>
            </a>
        </div>
    </section>
</x-app-layout>
