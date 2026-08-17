<div class="flex flex-col gap-6">
    <!-- Header Title -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Input Nilai Formatif Siswa</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Pencatatan capaian Tujuan Pembelajaran (TP 1-5) dan kalkulasi rata-rata otomatis.</p>
        </div>
    </div>

    <!-- Alert Flash Message -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
            <span class="font-label-md text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Selection Bar Card -->
    <div class="bg-surface-container-lowest p-6 rounded-2xl border border-border-default shadow-card grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Kelas &amp; Mata Pelajaran</label>
            @if(count($kombinasiKelasMapel) > 0)
                <select wire:model.live="selectedKombinasi" class="w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                    <option value="">-- Pilih Kelas &amp; Mapel --</option>
                    @foreach($kombinasiKelasMapel as $key => $item)
                        <option value="{{ $key }}">
                            {{ $item['kelas_nama'] }} - {{ $item['mapel_nama'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <div class="h-touch-target px-4 bg-status-izin/10 border border-status-izin/30 text-status-izin rounded-lg flex items-center gap-2 font-label-sm text-xs font-semibold">
                    <span class="material-symbols-outlined text-[18px]">warning</span>
                    <span>Belum ada jadwal mengajar.</span>
                </div>
            @endif
        </div>

        <div>
            <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Jenis Penilaian</label>
            <select wire:model.live="jenis" class="w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                <option value="tugas">Tugas Formatif (TP 1-5)</option>
                <option value="ulangan_harian">Ulangan Harian / Asesmen Sumatif</option>
            </select>
        </div>
        
        <div>
            <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Tanggal Penilaian</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">event</span>
                <input type="date" wire:model.live="tanggal" class="w-full pl-10 pr-4 h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
            </div>
        </div>
    </div>

    <!-- Student Grades List Form -->
    @if($selectedKombinasi && $tanggal && $jenis && count($siswas) > 0)
        <form wire:submit="save" class="animate-fade-in relative flex flex-col gap-6">
            <div wire:loading wire:target="save" class="absolute inset-0 z-30 bg-surface-container-lowest/80 backdrop-blur-xs rounded-xl flex items-center justify-center">
                <div class="flex items-center gap-3 p-4 bg-surface-container-lowest rounded-xl shadow-card border border-border-default">
                    <span class="material-symbols-outlined text-primary text-[28px] animate-spin">progress_activity</span>
                    <span class="font-label-md text-sm font-semibold text-text-main">Menyimpan data nilai...</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl border border-border-default shadow-card p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between pb-4 border-b border-border-default">
                    <h3 class="font-headline-md text-base font-bold text-text-main flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_note</span>
                        <span>Daftar Nilai Siswa (Skala 0 - 100 &bull; KKM 75)</span>
                    </h3>
                    <span class="font-label-sm text-xs font-bold text-primary bg-primary/10 px-3 py-1 rounded-full">
                        {{ count($siswas) }} Siswa
                    </span>
                </div>

                <div class="flex flex-col gap-3">
                    @foreach($siswas as $index => $siswa)
                        @php
                            $score = (float)($nilaiData[$siswa->id] ?? 0);
                            $isPassed = $score >= 75;
                        @endphp
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-xl border border-border-default bg-surface-container-lowest hover:bg-surface transition-colors gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-headline-md text-sm font-bold text-text-main">{{ $siswa->nama }}</span>
                                    <span class="font-body-default text-xs text-on-surface-variant font-mono">NISN: {{ $siswa->nisn }}</span>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-3 w-full sm:w-auto">
                                @if($score > 0)
                                    <span class="px-2.5 py-1 rounded-full text-xs font-bold uppercase {{ $isPassed ? 'bg-status-hadir/15 text-status-hadir border border-status-hadir/30' : 'bg-status-alfa/15 text-status-alfa border border-status-alfa/30' }}">
                                        {{ $isPassed ? 'Tuntas' : 'Remedial' }}
                                    </span>
                                @endif
                                <div class="w-full sm:w-36 relative">
                                    <span class="absolute right-3 top-1/2 -translate-y-1/2 font-mono font-bold text-outline text-xs pointer-events-none">/ 100</span>
                                    <input type="number" inputmode="numeric" step="1" min="0" max="100" 
                                           wire:model.defer="nilaiData.{{ $siswa->id }}" 
                                           class="w-full h-touch-target pr-10 pl-4 rounded-lg border border-border-default bg-surface font-headline-md font-bold text-base text-text-main focus:ring-2 focus:ring-primary focus:border-transparent text-right transition-colors"
                                           placeholder="0">
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Bottom Save Action Bar -->
            <div class="sticky bottom-4 z-20 bg-surface-container-lowest/95 backdrop-blur-md p-4 rounded-2xl border border-border-default shadow-xl flex items-center justify-between">
                <span class="font-body-default text-xs text-on-surface-variant">
                    Total Siswa Rombel: <span class="font-bold text-text-main text-sm">{{ count($siswas) }}</span>
                </span>
                <button type="submit" class="h-touch-target px-8 bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-sm transition-all flex items-center gap-2 shrink-0 active:scale-95">
                    <span class="material-symbols-outlined text-[20px]">save</span>
                    <span>Simpan Nilai Formatif</span>
                </button>
            </div>
        </form>
    @elseif($selectedKombinasi && $tanggal && $jenis && count($siswas) == 0)
        <div class="p-12 text-center bg-surface-container-lowest rounded-2xl border border-border-default shadow-card flex flex-col items-center justify-center gap-3">
            <span class="material-symbols-outlined text-[48px] text-outline">group_off</span>
            <h3 class="font-headline-md text-lg font-bold text-text-main">Rombel Kosong</h3>
            <p class="font-body-default text-sm text-on-surface-variant">Belum ada siswa yang terdaftar di rombel kelas ini.</p>
        </div>
    @endif
</div>
