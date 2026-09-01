<div class="flex flex-col gap-6">
    <!-- Header Title -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-brand">Input Presensi Siswa</h2>
            <p class="text-sm text-text-secondary mt-1">Pencatatan kehadiran harian siswa per sesi KBM.</p>
        </div>

        @if($selectedJadwalId && count($siswas) > 0)
            <button type="button" wire:click="markAllHadir" class="px-5 min-h-touch-target bg-brand/10 hover:bg-brand text-brand hover:text-white border border-brand/30 rounded-lg font-medium text-sm transition-all flex items-center gap-2 active:scale-95">
                {{-- Heroicon: check-badge --}}
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.745 3.745 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" /></svg>
                <span>Tandai Semua Hadir</span>
            </button>
        @endif
    </div>

    <!-- Alert Flash -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span class="font-medium text-sm">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-status-alfa/10 border border-status-alfa/30 text-status-alfa rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
            <span class="font-medium text-sm">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Selector Filter Card -->
    <div class="bg-surface p-6 rounded-lg border border-border shadow-card grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label class="block text-xs text-text-secondary mb-1 font-semibold">Tanggal Presensi</label>
            <div class="relative">
                <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                <input type="date" wire:model.live="tanggal" class="w-full pl-10 pr-4 h-touch-target rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent transition-colors">
            </div>
        </div>
        
        <div>
            <label class="block text-xs text-text-secondary mb-1 font-semibold">Pilih Sesi Jadwal KBM</label>
            @if(count($jadwals) > 0)
                <select wire:model.live="selectedJadwalId" class="w-full h-touch-target rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent transition-colors">
                    <option value="">-- Pilih Jadwal Pelajaran --</option>
                    @foreach($jadwals as $jadwal)
                        <option value="{{ $jadwal->id }}">
                            Hari {{ $jadwal->hari }} &bull; Jam ke-{{ $jadwal->jam_ke }} ({{ substr($jadwal->waktu_mulai, 0, 5) }}) - Kelas {{ $jadwal->kelas->nama_kelas ?? 'N/A' }} - {{ $jadwal->mapel->nama_mapel ?? 'Mapel' }}
                        </option>
                    @endforeach
                </select>
            @else
                <div class="h-touch-target px-4 bg-status-izin/10 border border-status-izin/30 text-status-izin rounded-lg flex items-center gap-2 text-xs font-semibold">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
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
            <div class="bg-surface p-3.5 rounded-lg border border-border shadow-card flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-status-hadir"></span>
                    <span class="text-xs font-bold text-text-secondary uppercase">Hadir</span>
                </div>
                <span class="text-lg font-bold text-status-hadir">{{ $countHadir }}</span>
            </div>
            <div class="bg-surface p-3.5 rounded-lg border border-border shadow-card flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-status-izin"></span>
                    <span class="text-xs font-bold text-text-secondary uppercase">Izin</span>
                </div>
                <span class="text-lg font-bold text-status-izin">{{ $countIzin }}</span>
            </div>
            <div class="bg-surface p-3.5 rounded-lg border border-border shadow-card flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-status-sakit"></span>
                    <span class="text-xs font-bold text-text-secondary uppercase">Sakit</span>
                </div>
                <span class="text-lg font-bold text-status-sakit">{{ $countSakit }}</span>
            </div>
            <div class="bg-surface p-3.5 rounded-lg border border-border shadow-card flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-status-alfa"></span>
                    <span class="text-xs font-bold text-text-secondary uppercase">Alfa</span>
                </div>
                <span class="text-lg font-bold text-status-alfa">{{ $countAlfa }}</span>
            </div>
        </div>

        <!-- Student Attendance List -->
        <form wire:submit="save" class="animate-fade-in relative flex flex-col gap-6">
            <div wire:loading wire:target="save, markAllHadir" class="absolute inset-0 z-30 bg-surface/80 backdrop-blur-sm rounded-lg flex items-center justify-center">
                <div class="flex items-center gap-3 p-4 bg-surface rounded-lg shadow-card border border-border">
                    <svg class="w-6 h-6 text-brand animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span class="text-sm font-semibold text-text-primary">Memproses data presensi...</span>
                </div>
            </div>

            <div class="bg-surface rounded-lg border border-border shadow-card p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between pb-4 border-b border-border">
                    <h3 class="text-base font-bold text-text-primary flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
                        <span>Daftar Presensi Siswa Rombel</span>
                    </h3>
                    <span class="text-xs font-bold text-brand bg-brand/10 px-3 py-1 rounded-full">
                        {{ $totalCount }} Siswa
                    </span>
                </div>

                <div class="flex flex-col gap-3">
                    @foreach($siswas as $index => $siswa)
                        <div wire:key="siswa-{{ $siswa->id }}" class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-lg border {{ isset($absensiData[$siswa->id]) && $absensiData[$siswa->id] ? 'border-brand/30 bg-brand-surface/30' : 'border-border bg-surface hover:bg-slate-50' }} transition-colors gap-4 relative">
                            {{-- Per-row saving indicator --}}
                            <div wire:loading wire:target="absensiData.{{ $siswa->id }}" class="absolute top-2 right-2">
                                <span class="text-xs text-brand font-medium animate-fade-in">Tersimpan ✓</span>
                            </div>

                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-full bg-brand-surface text-brand font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-text-primary">{{ $siswa->nama }}</span>
                                    <span class="text-xs text-text-secondary font-mono">NISN: {{ $siswa->nisn }}</span>
                                </div>
                            </div>
                            
                            <!-- 44px Touch Target Radio Buttons Group -->
                            <div class="w-full sm:w-auto">
                                <div class="inline-flex w-full sm:w-auto p-1 bg-slate-100 rounded-lg border border-border" role="group">
                                    <!-- Hadir -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="hadir" class="sr-only peer">
                                        <div class="min-w-[72px] min-h-touch-target px-3 flex items-center justify-center rounded-lg text-xs font-semibold text-text-secondary transition-all peer-checked:bg-status-hadir peer-checked:text-white peer-checked:font-bold peer-checked:shadow-sm active:scale-95">
                                            Hadir
                                        </div>
                                    </label>
                                    
                                    <!-- Izin -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="izin" class="sr-only peer">
                                        <div class="min-w-[72px] min-h-touch-target px-3 flex items-center justify-center rounded-lg text-xs font-semibold text-text-secondary transition-all peer-checked:bg-status-izin peer-checked:text-white peer-checked:font-bold peer-checked:shadow-sm active:scale-95">
                                            Izin
                                        </div>
                                    </label>
                                    
                                    <!-- Sakit -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="sakit" class="sr-only peer">
                                        <div class="min-w-[72px] min-h-touch-target px-3 flex items-center justify-center rounded-lg text-xs font-semibold text-text-secondary transition-all peer-checked:bg-status-sakit peer-checked:text-white peer-checked:font-bold peer-checked:shadow-sm active:scale-95">
                                            Sakit
                                        </div>
                                    </label>
                                    
                                    <!-- Alfa -->
                                    <label class="flex-1 sm:flex-none cursor-pointer">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="alfa" class="sr-only peer">
                                        <div class="min-w-[72px] min-h-touch-target px-3 flex items-center justify-center rounded-lg text-xs font-semibold text-text-secondary transition-all peer-checked:bg-status-alfa peer-checked:text-white peer-checked:font-bold peer-checked:shadow-sm active:scale-95">
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
            <div class="sticky bottom-4 z-20 bg-surface/95 backdrop-blur-md p-4 rounded-lg border border-border shadow-xl flex items-center justify-between">
                <div class="text-xs text-text-secondary">
                    Status Terisi: <span class="font-bold text-text-primary text-sm">{{ count(array_filter($absensiData)) }}</span> / <span class="font-bold text-text-primary text-sm">{{ count($siswas) }}</span> Siswa
                </div>
                <button type="submit" class="min-h-touch-target px-8 bg-brand hover:bg-brand-hover text-white font-semibold text-sm rounded-lg shadow-sm transition-all flex items-center gap-2 shrink-0 active:scale-95">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <span>Simpan Presensi Kelas</span>
                </button>
            </div>
        </form>
    @elseif($selectedJadwalId && $tanggal && count($siswas) == 0)
        <div class="p-12 text-center bg-surface rounded-lg border border-border shadow-card flex flex-col items-center justify-center gap-3">
            <svg class="w-12 h-12 text-text-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
            <h3 class="text-lg font-bold text-text-primary">Rombel Kosong</h3>
            <p class="text-sm text-text-secondary">Belum ada siswa yang terdaftar di rombel kelas ini.</p>
        </div>
    @endif
</div>
