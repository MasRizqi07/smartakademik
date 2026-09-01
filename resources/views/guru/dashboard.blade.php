<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between w-full">
            <div class="flex items-center gap-3">
                <span class="font-headline-md text-headline-md text-primary font-extrabold">Teacher Dashboard</span>
                <span class="text-border-default hidden sm:inline">&bull;</span>
                <span class="text-xs font-semibold bg-primary/10 text-primary px-3 py-1 rounded-full hidden sm:inline">Tenaga Pendidik</span>
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
            Pusat operasional mengajar, pencatatan presensi kelas harian, dan pengelolaan penilaian formatif.
        </p>
    </section>

    <!-- Quick Stats Bento Grid -->
    <section class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <!-- Presensi Terisi -->
        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-card border border-border-default flex flex-col justify-between hover-lift transition-all">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span class="text-[10px] font-bold text-primary bg-primary/10 px-2 py-0.5 rounded-full uppercase">Hari Ini</span>
            </div>
            <div>
                <p class="font-headline-lg text-2xl font-bold text-text-main">3 / 4</p>
                <p class="text-xs text-on-surface-variant mt-0.5">Presensi Terisi</p>
            </div>
        </div>

        <!-- Tugas / Nilai Pending -->
        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-card border border-border-default flex flex-col justify-between hover-lift transition-all">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span class="text-[10px] font-bold text-status-izin bg-status-izin/15 px-2 py-0.5 rounded-full uppercase">Formatif</span>
            </div>
            <div>
                <p class="font-headline-lg text-2xl font-bold text-text-main">12</p>
                <p class="text-xs text-on-surface-variant mt-0.5">Siswa Belum Formatif</p>
            </div>
        </div>

        <!-- Kelas Diampu -->
        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-card border border-border-default flex flex-col justify-between hover-lift transition-all">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span class="text-[10px] font-bold text-status-hadir bg-status-hadir/15 px-2 py-0.5 rounded-full uppercase">Aktif</span>
            </div>
            <div>
                <p class="font-headline-lg text-2xl font-bold text-text-main">{{ \App\Models\Kelas::count() }} Kelas</p>
                <p class="text-xs text-on-surface-variant mt-0.5">Rombel Mengajar</p>
            </div>
        </div>

        <!-- Jam Mengajar Mingguan -->
        <div class="bg-surface-container-lowest p-4 rounded-xl shadow-card border border-border-default flex flex-col justify-between hover-lift transition-all">
            <div class="flex items-center justify-between mb-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span class="text-[10px] font-bold text-status-sakit bg-status-sakit/15 px-2 py-0.5 rounded-full uppercase">Beban</span>
            </div>
            <div>
                <p class="font-headline-lg text-2xl font-bold text-text-main">24 Jam</p>
                <p class="text-xs text-on-surface-variant mt-0.5">KBM per Minggu</p>
            </div>
        </div>
    </section>

    <!-- Jadwal Hari Ini Section -->
    <section class="space-y-4">
        <div class="flex justify-between items-end">
            <div>
                <h3 class="font-headline-md text-lg font-bold text-text-main flex items-center gap-2">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    <span>Jadwal Mengajar Hari Ini</span>
                </h3>
                <p class="text-xs text-on-surface-variant">Klik "Isi Presensi" untuk mencatat kehadiran siswa langsung di kelas.</p>
            </div>
            <a href="{{ route('guru.absensi') }}" wire:navigate class="text-xs font-semibold text-primary hover:underline flex items-center gap-1">
                <span>Input Presensi</span>
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </a>
        </div>

        <div class="flex flex-col gap-3">
            @php
                $userGuru = \App\Models\Guru::where('user_id', auth()->id())->first();
                $guruSchedules = $userGuru 
                    ? \App\Models\JadwalPelajaran::with(['kelas', 'mapel'])->where('guru_id', $userGuru->id)->get()
                    : \App\Models\JadwalPelajaran::with(['kelas', 'mapel'])->take(3)->get();
            @endphp

            @forelse($guruSchedules as $idx => $sched)
                <div class="bg-surface-container-lowest p-4 md:p-5 rounded-xl shadow-card border border-border-default flex flex-col md:flex-row md:items-center justify-between gap-4 hover-lift transition-all {{ $idx === 0 ? 'border-primary/60 ring-1 ring-primary/20' : '' }}">
                    <div class="flex items-start gap-4">
                        <div class="{{ $idx === 0 ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant' }} rounded-xl p-3 flex flex-col items-center justify-center min-w-[70px] shadow-xs">
                            <span class="font-bold text-xs uppercase font-mono">{{ $sched->waktu_mulai ?? '07:00' }}</span>
                            <span class="text-[10px] opacity-80 font-mono">{{ $sched->waktu_selesai ?? '08:30' }}</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="font-label-md text-base font-bold text-text-main">{{ $sched->mapel->nama_mapel ?? 'Matematika' }}</h4>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $idx === 0 ? 'bg-primary/10 text-primary border border-primary/20' : 'bg-surface-container text-on-surface-variant' }}">
                                    {{ $idx === 0 ? 'Jam Sekarang' : 'Mendatang' }}
                                </span>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-0.5">Kelas {{ $sched->kelas->nama_kelas ?? 'X-A' }} &bull; Hari {{ $sched->hari ?? 'Senin' }}</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-2">
                        <a href="{{ route('guru.absensi') }}" wire:navigate class="w-full md:w-auto px-5 h-touch-target bg-primary hover:bg-primary-container text-on-primary rounded-lg font-label-md text-xs font-semibold shadow-xs flex items-center justify-center gap-1.5 active:scale-95 transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                            <span>Isi Presensi</span>
                        </a>
                        <a href="{{ route('guru.nilai') }}" wire:navigate class="w-full md:w-auto px-4 h-touch-target bg-surface hover:bg-surface-container text-text-main border border-border-default rounded-lg font-label-md text-xs font-semibold flex items-center justify-center gap-1.5 transition-all">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                            <span>Input Nilai</span>
                        </a>
                    </div>
                </div>
            @empty
                <div class="bg-surface-container-lowest p-4 md:p-5 rounded-xl shadow-card border border-border-default flex flex-col md:flex-row md:items-center justify-between gap-4">
                    <div class="flex items-start gap-4">
                        <div class="bg-primary text-on-primary rounded-xl p-3 flex flex-col items-center justify-center min-w-[70px]">
                            <span class="font-bold text-xs font-mono">07:00</span>
                            <span class="text-[10px] opacity-80 font-mono">08:30</span>
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <h4 class="font-label-md text-base font-bold text-text-main">Fisika / Matematika</h4>
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold bg-primary/10 text-primary border border-primary/20 uppercase">Jam Sekarang</span>
                            </div>
                            <p class="text-xs text-on-surface-variant mt-0.5">Kelas XI-A &bull; Ruang 101</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('guru.absensi') }}" wire:navigate class="px-5 h-touch-target bg-primary hover:bg-primary-container text-on-primary rounded-lg font-label-md text-xs font-semibold shadow-xs flex items-center justify-center gap-1.5">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                            <span>Isi Presensi</span>
                        </a>
                    </div>
                </div>
            @endforelse
        </div>
    </section>

    <!-- Quick Shortcuts -->
    <section class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
        <a href="{{ route('guru.absensi') }}" wire:navigate class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card hover:border-primary transition-all flex items-center gap-4 group hover-lift">
            <div class="w-12 h-12 rounded-xl bg-status-hadir/15 text-status-hadir flex items-center justify-center group-hover:bg-status-hadir group-hover:text-white transition-colors shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </div>
            <div>
                <h4 class="font-headline-md text-base font-bold text-text-main group-hover:text-primary transition-colors">Presensi Kelas Cepat</h4>
                <p class="text-xs text-on-surface-variant mt-0.5">Pencatatan kehadiran Hadir/Izin/Sakit/Alfa touch target 44px</p>
            </div>
        </a>

        <a href="{{ route('guru.nilai') }}" wire:navigate class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card hover:border-primary transition-all flex items-center gap-4 group hover-lift">
            <div class="w-12 h-12 rounded-xl bg-status-sakit/15 text-status-sakit flex items-center justify-center group-hover:bg-status-sakit group-hover:text-white transition-colors shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </div>
            <div>
                <h4 class="font-headline-md text-base font-bold text-text-main group-hover:text-primary transition-colors">Penilaian Formatif TP</h4>
                <p class="text-xs text-on-surface-variant mt-0.5">Input capaian tujuan pembelajaran TP 1-5 dan kalkulasi otomatis</p>
            </div>
        </a>
    </section>
</x-app-layout>
