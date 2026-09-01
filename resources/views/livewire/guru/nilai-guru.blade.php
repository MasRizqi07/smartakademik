<div class="flex flex-col gap-6">
    <!-- Header Title -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-brand">Input Nilai Formatif Siswa</h2>
            <p class="text-sm text-text-secondary mt-1">Pencatatan capaian Tujuan Pembelajaran (TP 1-5) dan kalkulasi rata-rata otomatis.</p>
        </div>
    </div>

    <!-- Alert Flash Message -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span class="font-medium text-sm">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Selection Bar Card -->
    <div class="bg-surface p-6 rounded-lg border border-border shadow-card grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block text-xs text-text-secondary mb-1 font-semibold">Kelas &amp; Mata Pelajaran</label>
            @if(count($kombinasiKelasMapel) > 0)
                <select wire:model.live="selectedKombinasi" class="w-full h-touch-target rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent transition-colors">
                    <option value="">-- Pilih Kelas &amp; Mapel --</option>
                    @foreach($kombinasiKelasMapel as $key => $item)
                        <option value="{{ $key }}">
                            {{ $item['kelas_nama'] }} - {{ $item['mapel_nama'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <div class="h-touch-target px-4 bg-status-izin/10 border border-status-izin/30 text-status-izin rounded-lg flex items-center gap-2 text-xs font-semibold">
                    <svg class="w-4 h-4 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
                    <span>Belum ada jadwal mengajar.</span>
                </div>
            @endif
        </div>

        <div>
            <label class="block text-xs text-text-secondary mb-1 font-semibold">Jenis Penilaian</label>
            <select wire:model.live="jenis" class="w-full h-touch-target rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent transition-colors">
                <option value="tugas">Tugas Formatif (TP 1-5)</option>
                <option value="ulangan_harian">Ulangan Harian / Asesmen Sumatif</option>
            </select>
        </div>
        
        <div>
            <label class="block text-xs text-text-secondary mb-1 font-semibold">Tanggal Penilaian</label>
            <div class="relative">
                <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                <input type="date" wire:model.live="tanggal" class="w-full pl-10 pr-4 h-touch-target rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent transition-colors">
            </div>
        </div>
    </div>

    <!-- Student Grades List Form -->
    @if($selectedKombinasi && $tanggal && $jenis && count($siswas) > 0)
        <form wire:submit="save" class="animate-fade-in relative flex flex-col gap-6">
            <div wire:loading wire:target="save" class="absolute inset-0 z-30 bg-surface/80 backdrop-blur-sm rounded-lg flex items-center justify-center">
                <div class="flex items-center gap-3 p-4 bg-surface rounded-lg shadow-card border border-border">
                    <svg class="w-6 h-6 text-brand animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    <span class="text-sm font-semibold text-text-primary">Menyimpan data nilai...</span>
                </div>
            </div>

            <div class="bg-surface rounded-lg border border-border shadow-card p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between pb-4 border-b border-border">
                    <h3 class="text-base font-bold text-text-primary flex items-center gap-2">
                        <svg class="w-5 h-5 text-brand" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        <span>Daftar Nilai Siswa (Skala 0 - 100 &bull; KKM 75)</span>
                    </h3>
                    <span class="text-xs font-bold text-brand bg-brand/10 px-3 py-1 rounded-full">
                        {{ count($siswas) }} Siswa
                    </span>
                </div>

                <div class="flex flex-col gap-3">
                    @foreach($siswas as $index => $siswa)
                        @php
                            $score = (float)($nilaiData[$siswa->id] ?? 0);
                            $isPassed = $score >= 75;
                            $isOutOfRange = $score > 100 || $score < 0;
                        @endphp
                        <div wire:key="nilai-{{ $siswa->id }}" class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-lg border border-border bg-surface hover:bg-slate-50 transition-colors gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-10 h-10 rounded-full bg-brand-surface text-brand font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-medium text-text-primary">{{ $siswa->nama }}</span>
                                    <span class="text-xs text-text-secondary font-mono">NISN: {{ $siswa->nisn }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 w-full sm:w-auto">
                                @if($score > 0)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase {{ $isPassed ? 'bg-status-hadir/10 text-status-hadir' : 'bg-status-alfa/10 text-status-alfa' }}">
                                        {{ $isPassed ? 'Tuntas' : 'Remedial' }}
                                    </span>
                                @endif
                                <div class="w-full sm:w-36 relative">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 font-mono font-bold text-text-secondary text-xs pointer-events-none">/ 100</span>
                                    <input type="number" inputmode="numeric" step="1" min="0" max="100" 
                                           wire:model.defer="nilaiData.{{ $siswa->id }}" 
                                           class="w-full min-h-touch-target pr-10 pl-4 rounded-lg border bg-surface font-bold text-base text-text-primary focus:ring-2 focus:ring-brand focus:border-transparent text-right transition-colors
                                                  {{ $isOutOfRange && $score !== 0 ? 'border-status-alfa' : ($score >= 75 ? 'border-status-hadir' : 'border-border') }}"
                                           placeholder="0">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Bottom Save Action Bar -->
            <div class="sticky bottom-4 z-20 bg-surface/95 backdrop-blur-md p-4 rounded-lg border border-border shadow-xl flex items-center justify-between">
                <span class="text-xs text-text-secondary">
                    Total Siswa Rombel: <span class="font-bold text-text-primary text-sm">{{ count($siswas) }}</span>
                </span>
                <button type="submit" class="min-h-touch-target px-8 bg-brand hover:bg-brand-hover text-white font-semibold text-sm rounded-lg shadow-sm transition-all flex items-center gap-2 shrink-0 active:scale-95">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                    <span>Simpan Nilai Formatif</span>
                </button>
            </div>
        </form>
    @elseif($selectedKombinasi && $tanggal && $jenis && count($siswas) == 0)
        <div class="p-12 text-center bg-surface rounded-lg border border-border shadow-card flex flex-col items-center justify-center gap-3">
            <svg class="w-12 h-12 text-text-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" /></svg>
            <h3 class="text-lg font-bold text-text-primary">Rombel Kosong</h3>
            <p class="text-sm text-text-secondary">Belum ada siswa yang terdaftar di rombel kelas ini.</p>
        </div>
    @endif
</div>
