<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Input Absensi Harian</h2>
            <p class="text-slate-500">Catat kehadiran siswa di kelas yang Anda ajar hari ini.</p>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 flex items-center gap-3 animate-slide-up">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    <x-modern-card>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Absensi</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <input type="date" wire:model.live="tanggal" class="pl-10 block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 text-slate-700 font-medium transition-colors">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-2">Jadwal Pelajaran (Hari Ini)</label>
                @if(count($jadwals) > 0)
                    <div class="relative">
                        <select wire:model.live="selectedJadwalId" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 text-slate-700 font-medium transition-colors appearance-none bg-white">
                            <option value="">-- Pilih Jadwal Kelas --</option>
                            @foreach($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}">
                                    Jam ke-{{ $jadwal->jam_ke }} ({{ substr($jadwal->waktu_mulai, 0, 5) }}) - Kelas {{ $jadwal->kelas->nama_kelas }} - {{ $jadwal->mapel->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @else
                    <div class="text-sm text-amber-700 bg-amber-50 border border-amber-200 rounded-xl p-3 flex items-start gap-2">
                        <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                        <span>Tidak ada jadwal mengajar pada hari {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->isoFormat('dddd') : 'ini' }}.</span>
                    </div>
                @endif
            </div>
        </div>
    </x-modern-card>

    @if($selectedJadwalId && $tanggal && count($siswas) > 0)
        <form wire:submit="save" class="animate-fade-in relative min-h-[300px]">
            <!-- Loading overlay when processing -->
            <div wire:loading wire:target="save" class="absolute inset-0 z-20 bg-white/60 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                <div class="flex flex-col items-center gap-3 bg-white p-6 rounded-2xl shadow-xl border border-slate-100">
                    <svg class="animate-spin h-8 w-8 text-brand-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span class="font-semibold text-slate-700">Menyimpan data absensi...</span>
                </div>
            </div>

            <x-modern-card title="Daftar Siswa" icon="<svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'></path></svg>">
                <div class="space-y-4">
                    @foreach($siswas as $index => $siswa)
                        <div class="flex flex-col md:flex-row items-center justify-between p-4 rounded-xl border {{ isset($absensiData[$siswa->id]) ? 'border-brand-200 bg-brand-50/30' : 'border-slate-200 bg-white hover:border-slate-300 hover:shadow-sm' }} transition-all duration-300">
                            <div class="flex items-center gap-4 w-full md:w-auto mb-4 md:mb-0">
                                <div class="w-10 h-10 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-slate-800 text-lg">{{ $siswa->nama }}</h4>
                                    <p class="text-sm text-slate-500 font-medium">NISN: {{ $siswa->nisn }}</p>
                                </div>
                            </div>
                            
                            <div class="w-full md:w-auto">
                                <div class="inline-flex w-full md:w-auto p-1 bg-slate-100 rounded-xl" role="group">
                                    <!-- Hadir -->
                                    <label class="flex-1 md:flex-none relative text-center">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="hadir" class="sr-only peer">
                                        <div class="px-4 py-2 text-sm font-bold rounded-lg cursor-pointer transition-all duration-200 peer-checked:bg-emerald-500 peer-checked:text-white peer-checked:shadow-md text-slate-500 hover:text-slate-700">
                                            Hadir
                                        </div>
                                    </label>
                                    
                                    <!-- Izin -->
                                    <label class="flex-1 md:flex-none relative text-center">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="izin" class="sr-only peer">
                                        <div class="px-4 py-2 text-sm font-bold rounded-lg cursor-pointer transition-all duration-200 peer-checked:bg-blue-500 peer-checked:text-white peer-checked:shadow-md text-slate-500 hover:text-slate-700">
                                            Izin
                                        </div>
                                    </label>
                                    
                                    <!-- Sakit -->
                                    <label class="flex-1 md:flex-none relative text-center">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="sakit" class="sr-only peer">
                                        <div class="px-4 py-2 text-sm font-bold rounded-lg cursor-pointer transition-all duration-200 peer-checked:bg-amber-500 peer-checked:text-white peer-checked:shadow-md text-slate-500 hover:text-slate-700">
                                            Sakit
                                        </div>
                                    </label>
                                    
                                    <!-- Alfa -->
                                    <label class="flex-1 md:flex-none relative text-center">
                                        <input type="radio" wire:model.live="absensiData.{{ $siswa->id }}" value="alfa" class="sr-only peer">
                                        <div class="px-4 py-2 text-sm font-bold rounded-lg cursor-pointer transition-all duration-200 peer-checked:bg-rose-500 peer-checked:text-white peer-checked:shadow-md text-slate-500 hover:text-slate-700">
                                            Alfa
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-8 flex items-center justify-between border-t border-slate-100 pt-6">
                    <div class="text-sm text-slate-500">
                        <span class="font-bold text-slate-700">{{ count($absensiData) }}</span> dari <span class="font-bold text-slate-700">{{ count($siswas) }}</span> siswa ditandai
                    </div>
                    <x-animated-button type="submit" variant="primary" icon="<svg fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'></path></svg>">
                        Simpan Absensi
                    </x-animated-button>
                </div>
            </x-modern-card>
        </form>
    @elseif($selectedJadwalId && $tanggal && count($siswas) == 0)
        <div class="text-center py-12 text-slate-500 bg-white rounded-2xl border border-slate-200 shadow-sm animate-fade-in">
            <svg class="w-16 h-16 mx-auto text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
            <h3 class="text-xl font-bold text-slate-700">Kelas Kosong</h3>
            <p>Tidak ada siswa yang terdaftar di kelas ini.</p>
        </div>
    @endif
</div>
