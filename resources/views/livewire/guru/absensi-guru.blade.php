<div class="flex flex-col gap-6">
    <!-- Header Title -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Input Presensi Siswa</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Pencatatan kehadiran harian siswa per sesi KBM dengan touch target 44px dan auto sinkronisasi.</p>
        </div>

        @if($selectedJadwalId && count($siswas) > 0)
            <button type="button" wire:click="markAllHadir" class="px-5 h-touch-target bg-primary/10 hover:bg-primary text-primary hover:text-on-primary border border-primary/30 rounded-xl font-label-md text-sm font-semibold transition-all flex items-center gap-2 active:scale-95 shadow-xs">
                <span class="material-symbols-outlined text-[20px]">done_all</span>
                <span>Tandai Semua Hadir</span>
            </button>
        @endif
    </div>

    <!-- Alert Flash -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
            <span class="font-label-md font-semibold text-sm">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-status-alfa/10 border border-status-alfa/30 text-status-alfa rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <span class="material-symbols-outlined text-[24px]">error</span>
            <span class="font-label-md font-semibold text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Selector Filter Card -->
    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-border-default shadow-card grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Tanggal Presensi</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">calendar_today</span>
                <input type="date" wire:model.live="tanggal" class="w-full pl-10 pr-4 h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
            </div>
        </div>
        
        <div>
            <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Pilih Sesi Jadwal KBM</label>
            @if(count($jadwals) > 0)
                <select wire:model.live="selectedJadwalId" class="w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                    <option value="">-- Pilih Jadwal Pelajaran --</option>
                    @foreach($jadwals as $jadwal)
                        <option value="{{ $jadwal->id }}">
                            Hari {{ $jadwal->hari }} &bull; Jam ke-{{ $jadwal->jam_ke }} ({{ substr($jadwal->waktu_mulai, 0, 5) }}) - Kelas {{ $jadwal->kelas->nama_kelas ?? 'N/A' }} - {{ $jadwal->mapel->nama_mapel ?? 'Mapel' }}
                        </option>
                    @endforeach
                </select>
            @else
                <div class="h-touch-target px-4 bg-status-izin/10 border border-status-izin/30 text-status-izin rounded-lg flex items-center gap-2 font-label-sm text-xs font-semibold">
                    <span class="material-symbols-outlined text-[18px]">warning</span>
                    <span>Tidak ada jadwal mengajar yang ditemukan untuk akun ini.</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Live Counter Bar -->
    @if($selectedJadwalId && count($siswas) > 0)
        @php
            $countHadir = count(array_filter($absensiData, fn($v) => $v === 'hadir'));
            $countIzin  = count(array_filter($absensiData, fn($v) => $v === 'izin'));
            $countSakit = count(array_filter($absensiData, fn($v) => $v === 'sakit'));
            $countAlfa  = count(array_filter($absensiData, fn($v) => $v === 'alfa'));
            $totalCount = count($siswas);
        @endphp

        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="bg-surface-container-lowest p-3.5 rounded-xl border border-border-default shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-status-hadir"></span>
                    <span class="text-xs font-bold text-on-surface-variant uppercase">Hadir</span>
                </div>
                <span class="text-lg font-bold text-status-hadir">{{ $countHadir }}</span>
            </div>
            <div class="bg-surface-container-lowest p-3.5 rounded-xl border border-border-default shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-status-izin"></span>
                    <span class="text-xs font-bold text-on-surface-variant uppercase">Izin</span>
                </div>
                <span class="text-lg font-bold text-status-izin">{{ $countIzin }}</span>
            </div>
            <div class="bg-surface-container-lowest p-3.5 rounded-xl border border-border-default shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-status-sakit"></span>
                    <span class="text-xs font-bold text-on-surface-variant uppercase">Sakit</span>
                </div>
                <span class="text-lg font-bold text-status-sakit">{{ $countSakit }}</span>
            </div>
            <div class="bg-surface-container-lowest p-3.5 rounded-xl border border-border-default shadow-xs flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-status-alfa"></span>
                    <span class="text-xs font-bold text-on-surface-variant uppercase">Alfa</span>
                </div>
                <span class="text-lg font-bold text-status-alfa">{{ $countAlfa }}</span>
            </div>
        </div>

        <!-- Student Attendance List -->
        <form wire:submit="save" class="animate-fade-in relative flex flex-col gap-6">
            <div wire:loading wire:target="save, markAllHadir" class="absolute inset-0 z-30 bg-surface-container-lowest/80 backdrop-blur-xs rounded-xl flex items-center justify-center">
                <div class="flex items-center gap-3 p-4 bg-surface-container-lowest rounded-xl shadow-card border border-border-default">
                    <span class="material-symbols-outlined text-primary text-[28px] animate-spin">progress_activity</span>
                    <span class="font-label-md text-sm font-semibold text-text-main">Memproses data presensi...</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl border border-border-default shadow-card p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between pb-4 border-b border-border-default">
                    <h3 class="font-headline-md text-base font-bold text-text-main flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">groups</span>
                        <span>Daftar Presensi Siswa Rombel</span>
                    </h3>
                    <span class="font-label-sm text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full">
                        {{ $totalCount }} Siswa
                    </span>
                </div>

                <div class="flex flex-col gap-3">
                    @foreach($siswas as $index => $siswa)
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-xl border {{ isset($absensiData[$siswa->id]) && $absensiData[$siswa->id] ? 'border-primary/30 bg-surface' : 'border-border-default bg-surface-container-lowest hover:bg-surface' }} transition-colors gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-headline-md text-sm font-bold text-text-main">{{ $siswa->nama }}</span>
                                    <span class="font-body-default text-xs text-on-surface-variant font-mono">NISN: {{ $siswa->nisn }}</span>
                                </div>
                            </div>
                            
                            <!-- 44px Touch Target Radio Buttons Group -->
                            <div class="w-full sm:w-auto">
                                <div class="inline-flex w-full sm:w-auto p-1 bg-surface rounded-xl border border-border-default shadow-xs" role="group">
                                    <!-- Hadir -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="hadir" class="sr-only peer">
                                        <div class="min-w-[72px] h-touch-target px-3 flex items-center justify-center rounded-lg font-label-md text-xs font-semibold text-on-surface-variant transition-all peer-checked:bg-status-hadir peer-checked:text-white peer-checked:font-bold peer-checked:shadow-xs active:scale-95">
                                            Hadir
                                        </div>
                                    </label>
                                    
                                    <!-- Izin -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="izin" class="sr-only peer">
                                        <div class="min-w-[72px] h-touch-target px-3 flex items-center justify-center rounded-lg font-label-md text-xs font-semibold text-on-surface-variant transition-all peer-checked:bg-status-izin peer-checked:text-white peer-checked:font-bold peer-checked:shadow-xs active:scale-95">
                                            Izin
                                        </div>
                                    </label>
                                    
                                    <!-- Sakit -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="sakit" class="sr-only peer">
                                        <div class="min-w-[72px] h-touch-target px-3 flex items-center justify-center rounded-lg font-label-md text-xs font-semibold text-on-surface-variant transition-all peer-checked:bg-status-sakit peer-checked:text-white peer-checked:font-bold peer-checked:shadow-xs active:scale-95">
                                            Sakit
                                        </div>
                                    </label>
                                    
                                    <!-- Alfa -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="alfa" class="sr-only peer">
                                        <div class="min-w-[72px] h-touch-target px-3 flex items-center justify-center rounded-lg font-label-md text-xs font-semibold text-on-surface-variant transition-all peer-checked:bg-status-alfa peer-checked:text-white peer-checked:font-bold peer-checked:shadow-xs active:scale-95">
                                            Alfa
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Sticky Bottom Bar -->
            <div class="sticky bottom-4 z-20 bg-surface-container-lowest/95 backdrop-blur-md p-4 rounded-2xl border border-border-default shadow-xl flex items-center justify-between">
                <div class="font-body-default text-xs text-on-surface-variant">
                    Status Terisi: <span class="font-bold text-text-main text-sm">{{ count(array_filter($absensiData)) }}</span> / <span class="font-bold text-text-main text-sm">{{ count($siswas) }}</span> Siswa
                </div>
                <button type="submit" class="h-touch-target px-8 bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-sm transition-all flex items-center gap-2 shrink-0 active:scale-95">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    <span>Simpan Presensi Kelas</span>
                </button>
            </div>
        </form>
    @elseif($selectedJadwalId && $tanggal && count($siswas) == 0)
        <div class="p-12 text-center bg-surface-container-lowest rounded-2xl border border-border-default shadow-card flex flex-col items-center justify-center gap-3">
            <span class="material-symbols-outlined text-[48px] text-outline">group_off</span>
            <h3 class="font-headline-md text-lg font-bold text-text-main">Rombel Kosong</h3>
            <p class="font-body-default text-sm text-on-surface-variant">Belum ada siswa yang terdaftar di rombel kelas ini.</p>
        </div>
    @endif
</div>
