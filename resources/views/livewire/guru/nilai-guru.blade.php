<div class="flex flex-col gap-6">
    <!-- Header Title -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg font-bold text-text-main">Input Nilai Formatif Siswa</h2>
            <p class="font-body-default text-body-default text-on-surface-variant">Pencatatan capaian tugas harian dan ulangan harian siswa madrasah.</p>
        </div>
    </div>

    <!-- Alert Flash Message -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
            <span class="font-label-md">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Selection Bar Card -->
    <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card grid grid-cols-1 md:grid-cols-3 gap-6">
        <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Kelas & Mata Pelajaran</label>
            @if(count($kombinasiKelasMapel) > 0)
                <select wire:model.live="selectedKombinasi" class="w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main focus-ring transition-colors">
                    <option value="">-- Pilih Kelas & Mapel --</option>
                    @foreach($kombinasiKelasMapel as $key => $item)
                        <option value="{{ $key }}">
                            {{ $item['kelas_nama'] }} - {{ $item['mapel_nama'] }}
                        </option>
                    @endforeach
                </select>
            @else
                <div class="h-touch-target px-4 bg-status-izin/10 border border-status-izin/30 text-status-izin rounded-DEFAULT flex items-center gap-2 font-label-sm">
                    <span class="material-symbols-outlined text-[20px]">warning</span>
                    <span>Belum ada jadwal mengajar.</span>
                </div>
            @endif
        </div>

        <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Jenis Penilaian</label>
            <select wire:model.live="jenis" class="w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main focus-ring transition-colors">
                <option value="tugas">Tugas Harian</option>
                <option value="ulangan_harian">Ulangan Harian (UH)</option>
            </select>
        </div>
        
        <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Tanggal Penilaian</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">event</span>
                <input type="date" wire:model.live="tanggal" class="w-full pl-10 pr-4 h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main focus-ring transition-colors">
            </div>
        </div>
    </div>

    <!-- Student Grades List Form -->
    @if($selectedKombinasi && $tanggal && $jenis && count($siswas) > 0)
        <form wire:submit="save" class="animate-fade-in relative flex flex-col gap-6">
            <div wire:loading wire:target="save" class="absolute inset-0 z-30 bg-surface-container-lowest/80 backdrop-blur-xs rounded-xl flex items-center justify-center">
                <div class="flex items-center gap-3 p-4 bg-surface-container-lowest rounded-xl shadow-card border border-border-default">
                    <span class="material-symbols-outlined text-primary text-[28px] animate-spin">progress_activity</span>
                    <span class="font-label-md text-text-main">Menyimpan data nilai...</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-xl border border-border-default shadow-card p-6 flex flex-col gap-4">
                <div class="flex items-center justify-between pb-4 border-b border-border-default">
                    <h3 class="font-headline-md text-headline-md font-bold text-text-main flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">edit_note</span>
                        <span>Daftar Nilai Siswa (Skala 0 - 100)</span>
                    </h3>
                    <span class="font-label-sm text-on-surface-variant bg-surface-container px-3 py-1 rounded-full">
                        Total: {{ count($siswas) }} Siswa
                    </span>
                </div>

                <div class="flex flex-col gap-3">
                    @foreach($siswas as $index => $siswa)
                        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between p-4 rounded-xl border border-border-default bg-surface-container-lowest hover:bg-surface-container-low transition-colors gap-4">
                            <div class="flex items-center gap-3.5">
                                <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container font-bold text-xs flex items-center justify-center shrink-0">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-headline-md text-[16px] font-bold text-text-main">{{ $siswa->nama }}</span>
                                    <span class="font-body-default text-xs text-on-surface-variant font-mono">NISN: {{ $siswa->nisn }}</span>
                                </div>
                            </div>
                            
                            <div class="w-full sm:w-40 relative">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 font-mono font-bold text-outline text-xs pointer-events-none">/ 100</span>
                                <input type="number" inputmode="numeric" step="0.01" min="0" max="100" 
                                       wire:model.defer="nilaiData.{{ $siswa->id }}" 
                                       class="w-full h-touch-target pr-10 pl-4 rounded-DEFAULT border border-border-default bg-surface-bright font-headline-md font-bold text-headline-md text-text-main focus-ring text-right transition-colors"
                                       placeholder="0.00">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Bottom Save Action Bar -->
            <div class="sticky bottom-4 z-20 bg-surface-container-lowest/90 backdrop-blur-md p-4 rounded-xl border border-border-default shadow-card flex items-center justify-between">
                <span class="font-body-default text-body-default text-on-surface-variant">
                    Jumlah siswa: <span class="font-bold text-text-main">{{ count($siswas) }}</span>
                </span>
                <button type="submit" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs transition-all flex items-center gap-2 shrink-0 active:scale-95">
                    <span class="material-symbols-outlined text-[18px]">save</span>
                    <span>Simpan Nilai</span>
                </button>
            </div>
        </form>
    @elseif($selectedKombinasi && $tanggal && $jenis && count($siswas) == 0)
        <div class="p-12 text-center bg-surface-container-lowest rounded-xl border border-border-default shadow-card flex flex-col items-center justify-center gap-3">
            <span class="material-symbols-outlined text-[48px] text-outline">group_off</span>
            <h3 class="font-headline-md text-headline-md font-bold text-text-main">Rombel Kosong</h3>
            <p class="font-body-default text-body-default text-on-surface-variant">Belum ada siswa yang terdaftar di rombel kelas ini.</p>
        </div>
    @endif
</div>

