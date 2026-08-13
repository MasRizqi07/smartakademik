<div class="flex flex-col gap-6">
    <!-- Header Title -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg font-bold text-text-main">Input Absensi Presensi Kelas</h2>
            <p class="font-body-default text-body-default text-on-surface-variant">Pencatatan kehadiran harian siswa secara cepat dan responsif per sesi KBM.</p>
        </div>
    </div>

    <!-- Alert Flash -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
            <span class="font-label-md">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Selector Filter Card -->
    <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Tanggal Presensi</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">calendar_today</span>
                <input type="date" wire:model.live="tanggal" class="w-full pl-10 pr-4 h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main focus-ring transition-colors">
            </div>
        </div>
        
        <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Pilih Jadwal KBM (Hari Ini)</label>
            @if(count($jadwals) > 0)
                <select wire:model.live="selectedJadwalId" class="w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main focus-ring transition-colors">
                    <option value="">-- Pilih Jadwal Pelajaran --</option>
                    @foreach($jadwals as $jadwal)
                        <option value="{{ $jadwal->id }}">
                            Jam ke-{{ $jadwal->jam_ke }} ({{ substr($jadwal->waktu_mulai, 0, 5) }}) - Kelas {{ $jadwal->kelas->nama_kelas }} - {{ $jadwal->mapel->nama_mapel }}
                        </option>
                    @endforeach
                </select>
            @else
                <div class="h-touch-target px-4 bg-status-izin/10 border border-status-izin/30 text-status-izin rounded-DEFAULT flex items-center gap-2 font-label-sm">
                    <span class="material-symbols-outlined text-[20px]">warning</span>
                    <span>Tidak ada jadwal mengajar pada {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->isoFormat('dddd, D MMMM YYYY') : 'hari ini' }}.</span>
                </div>
            @endif
        </div>
    </div>

    <!-- Student Attendance List -->
    @if($selectedJadwalId && $tanggal && count($siswas) > 0)
        <form wire:submit="save" class="animate-fade-in relative flex flex-col gap-6">
            <div wire:loading wire:target="save" class="absolute inset-0 z-30 bg-surface-container-lowest/80 backdrop-blur-xs rounded-xl flex items-center justify-center">
                <div class="flex items-center gap-3 p-4 bg-surface-container-lowest rounded-xl shadow-card border border-border-default">
                    <span class="material-symbols-outlined text-primary text-[28px] animate-spin">progress_activity</span>
                    <span class="font-label-md text-text-main">Menyimpan data presensi...</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-xl border border-border-default shadow-card p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between pb-4 border-b border-border-default">
                    <h3 class="font-headline-md text-headline-md font-bold text-text-main flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">groups</span>
                        <span>Daftar Presensi Siswa</span>
                    </h3>
                    <span class="font-label-sm text-on-surface-variant bg-surface-container px-3 py-1 rounded-full">
                        Total: {{ count($siswas) }} Siswa
                    </span>
                </div>

                <div class="flex flex-col gap-3">
                    @foreach($siswas as $index => $siswa)
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-xl border {{ isset($absensiData[$siswa->id]) ? 'border-primary/30 bg-primary/5' : 'border-border-default bg-surface-container-lowest hover:bg-surface-container-low' }} transition-colors gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-headline-md text-[16px] font-bold text-text-main">{{ $siswa->nama }}</span>
                                    <span class="font-body-default text-xs text-on-surface-variant font-mono">NISN: {{ $siswa->nisn }}</span>
                                </div>
                            </div>
                            
                            <!-- Touch Target Radio Button Group -->
                            <div class="w-full sm:w-auto">
                                <div class="inline-flex w-full sm:w-auto p-1 bg-surface-container-high rounded-xl border border-border-default" role="group">
                                    <!-- Hadir -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="hadir" class="sr-only peer">
                                        <div class="min-w-[70px] h-touch-target px-3.5 flex items-center justify-center rounded-lg font-label-md text-on-surface-variant transition-all peer-checked:bg-status-hadir peer-checked:text-white peer-checked:font-bold peer-checked:shadow-xs active:scale-95">
                                            Hadir
                                        </div>
                                    </label>
                                    
                                    <!-- Izin -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="izin" class="sr-only peer">
                                        <div class="min-w-[70px] h-touch-target px-3.5 flex items-center justify-center rounded-lg font-label-md text-on-surface-variant transition-all peer-checked:bg-status-izin peer-checked:text-white peer-checked:font-bold peer-checked:shadow-xs active:scale-95">
                                            Izin
                                        </div>
                                    </label>
                                    
                                    <!-- Sakit -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="sakit" class="sr-only peer">
                                        <div class="min-w-[70px] h-touch-target px-3.5 flex items-center justify-center rounded-lg font-label-md text-on-surface-variant transition-all peer-checked:bg-status-sakit peer-checked:text-white peer-checked:font-bold peer-checked:shadow-xs active:scale-95">
                                            Sakit
                                        </div>
                                    </label>
                                    
                                    <!-- Alfa -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="alfa" class="sr-only peer">
                                        <div class="min-w-[70px] h-touch-target px-3.5 flex items-center justify-center rounded-lg font-label-md text-on-surface-variant transition-all peer-checked:bg-status-alfa peer-checked:text-white peer-checked:font-bold peer-checked:shadow-xs active:scale-95">
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
            <div class="sticky bottom-4 z-20 bg-surface-container-lowest/90 backdrop-blur-md p-4 rounded-xl border border-border-default shadow-card flex items-center justify-between">
                <div class="font-body-default text-body-default text-on-surface-variant">
                    Terisi: <span class="font-bold text-text-main">{{ count(array_filter($absensiData)) }}</span> / <span class="font-bold text-text-main">{{ count($siswas) }}</span> Siswa
                </div>
                <button type="submit" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs transition-all flex items-center gap-2 shrink-0 active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span>Simpan Presensi</span>
                </button>
            </div>
        </form>
    @elseif($selectedJadwalId && $tanggal && count($siswas) == 0)
        <div class="p-12 text-center bg-surface-container-lowest rounded-xl border border-border-default shadow-card flex flex-col items-center justify-center gap-3">
            <span class="material-symbols-outlined text-[48px] text-outline">group_off</span>
            <h3 class="font-headline-md text-headline-md font-bold text-text-main">Rombel Kosong</h3>
            <p class="font-body-default text-body-default text-on-surface-variant">Belum ada siswa yang terdaftar di rombel kelas ini.</p>
        </div>
    @endif
</div>

