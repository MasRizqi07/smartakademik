<div class="space-y-6">
    <!-- Header & Action Controls -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-text-primary tracking-tight">Presensi Kelas Harian</h1>
            <p class="text-sm text-text-secondary mt-1">Pilih jadwal mengajar dan tandai status kehadiran siswa secara real-time.</p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <button wire:click="markAllHadir" type="button" class="inline-flex items-center gap-1.5 px-4 py-2 bg-brand text-white font-semibold text-xs rounded-lg shadow-sm hover:bg-brand-hover transition-all active:scale-95">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                <span>Tandai Semua Hadir</span>
            </button>
            <button wire:click="resetAll" wire:confirm="Yakin ingin mereset seluruh status presensi kelas ini?" type="button" class="inline-flex items-center gap-1.5 px-3 py-2 bg-surface text-text-secondary border border-border font-semibold text-xs rounded-lg hover:bg-slate-50 transition-all">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0 3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1 13.803-3.7l3.181 3.182m0-4.991v4.99" /></svg>
                <span>Reset</span>
            </button>
        </div>
    </div>

    <!-- Alert / Messages -->
    @if (session()->has('message'))
        <div class="p-4 bg-status-hadir/10 border border-status-hadir/30 text-status-hadir text-xs font-semibold rounded-xl flex items-center gap-2 shadow-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 bg-status-alfa/10 border border-status-alfa/30 text-status-alfa text-xs font-semibold rounded-xl flex items-center gap-2 shadow-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Selector Bar & Live KPI Counters -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-4">
        <!-- Jadwal & Tanggal Picker (7 Cols) -->
        <div class="lg:col-span-7 bg-surface rounded-2xl p-5 border border-border shadow-card flex flex-col sm:flex-row gap-4 items-end">
            <div class="flex-1 w-full">
                <label class="block text-xs font-bold text-text-primary mb-1.5">Pilih Jadwal Mengajar</label>
                <select wire:model.live="selectedJadwalId" class="w-full text-xs font-semibold py-2.5 px-3 rounded-lg border border-border bg-surface-page focus:ring-2 focus:ring-brand/20 focus:border-brand transition-all">
                    @forelse($jadwals as $j)
                        <option value="{{ $j->id }}">
                            {{ $j->hari }} (Jam ke-{{ $j->jam_ke }}) — {{ $j->kelas->nama_kelas ?? 'Kelas' }} • {{ $j->mapel->nama_mapel ?? 'Mapel' }}
                        </option>
                    @empty
                        <option value="">Belum ada jadwal mengajar terdaftar</option>
                    @endforelse
                </select>
            </div>

            <div class="w-full sm:w-44">
                <label class="block text-xs font-bold text-text-primary mb-1.5">Tanggal Presensi</label>
                <input wire:model.live="tanggal" type="date" class="w-full text-xs font-semibold py-2 px-3 rounded-lg border border-border bg-surface-page focus:ring-2 focus:ring-brand/20 focus:border-brand transition-all" />
            </div>
        </div>

        <!-- KPI Mini Counters (5 Cols) -->
        <div class="lg:col-span-5 grid grid-cols-4 gap-2">
            <div class="bg-surface rounded-xl p-3 border border-border shadow-xs text-center">
                <div class="text-[10px] font-bold text-status-hadir uppercase">Hadir</div>
                <div class="text-xl font-extrabold text-status-hadir mt-1">{{ $hadirCount }}</div>
                <div class="text-[9px] text-text-secondary">dari {{ $totalSiswa }}</div>
            </div>
            <div class="bg-surface rounded-xl p-3 border border-border shadow-xs text-center">
                <div class="text-[10px] font-bold text-status-izin uppercase">Izin</div>
                <div class="text-xl font-extrabold text-status-izin mt-1">{{ $izinCount }}</div>
                <div class="text-[9px] text-text-secondary">siswa</div>
            </div>
            <div class="bg-surface rounded-xl p-3 border border-border shadow-xs text-center">
                <div class="text-[10px] font-bold text-status-sakit uppercase">Sakit</div>
                <div class="text-xl font-extrabold text-status-sakit mt-1">{{ $sakitCount }}</div>
                <div class="text-[9px] text-text-secondary">siswa</div>
            </div>
            <div class="bg-surface rounded-xl p-3 border border-border shadow-xs text-center">
                <div class="text-[10px] font-bold text-status-alfa uppercase">Alfa</div>
                <div class="text-xl font-extrabold text-status-alfa mt-1">{{ $alfaCount }}</div>
                <div class="text-[9px] text-text-secondary">siswa</div>
            </div>
        </div>
    </div>

    <!-- Student Attendance List / Table -->
    <div class="bg-surface rounded-2xl border border-border shadow-card overflow-hidden">
        <div class="p-4 border-b border-border bg-surface-page/50 flex items-center justify-between">
            <span class="text-xs font-bold text-text-primary uppercase tracking-wider">Daftar Kehadiran Siswa ({{ count($siswas) }} Santri)</span>
            <span class="text-xs text-text-secondary flex items-center gap-1">
                <span class="w-2 h-2 rounded-full bg-status-hadir animate-pulse"></span>
                <span>Auto-Save Aktif</span>
            </span>
        </div>

        <div class="divide-y divide-border">
            @forelse($siswas as $idx => $siswa)
                <div wire:key="siswa-row-{{ $siswa->id }}" class="p-4 sm:px-6 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-slate-50/70 transition-colors">
                    <!-- Student Info -->
                    <div class="flex items-center gap-3">
                        <span class="text-xs font-bold text-text-secondary w-5">{{ $idx + 1 }}.</span>
                        <div class="w-9 h-9 rounded-full bg-brand/10 text-brand font-bold text-xs flex items-center justify-center shrink-0">
                            {{ substr($siswa->nama, 0, 1) }}
                        </div>
                        <div>
                            <div class="text-sm font-bold text-text-primary">{{ $siswa->nama }}</div>
                            <div class="text-xs text-text-secondary flex items-center gap-2">
                                <span>NISN: {{ $siswa->nisn }}</span>
                                @if(!empty($keteranganData[$siswa->id]))
                                    <span class="text-amber-700 italic">• Ket: "{{ $keteranganData[$siswa->id] }}"</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Attendance Status Buttons Group -->
                    <div class="flex items-center gap-1.5 self-end sm:self-auto">
                        <!-- Hadir Button -->
                        <button type="button" wire:click="setPresence({{ $siswa->id }}, 'hadir')" class="min-h-touch-target px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1 {{ ($absensiData[$siswa->id] ?? '') === 'hadir' ? 'bg-status-hadir text-white shadow-xs' : 'bg-surface-page text-text-secondary border border-border hover:border-status-hadir hover:text-status-hadir' }}">
                            <span>Hadir</span>
                        </button>

                        <!-- Izin Button -->
                        <button type="button" wire:click="setPresence({{ $siswa->id }}, 'izin')" class="min-h-touch-target px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1 {{ ($absensiData[$siswa->id] ?? '') === 'izin' ? 'bg-status-izin text-white shadow-xs' : 'bg-surface-page text-text-secondary border border-border hover:border-status-izin hover:text-status-izin' }}">
                            <span>Izin</span>
                        </button>

                        <!-- Sakit Button -->
                        <button type="button" wire:click="setPresence({{ $siswa->id }}, 'sakit')" class="min-h-touch-target px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1 {{ ($absensiData[$siswa->id] ?? '') === 'sakit' ? 'bg-status-sakit text-white shadow-xs' : 'bg-surface-page text-text-secondary border border-border hover:border-status-sakit hover:text-status-sakit' }}">
                            <span>Sakit</span>
                        </button>

                        <!-- Alfa Button -->
                        <button type="button" wire:click="setPresence({{ $siswa->id }}, 'alfa')" class="min-h-touch-target px-3 py-1.5 rounded-lg text-xs font-bold transition-all flex items-center gap-1 {{ ($absensiData[$siswa->id] ?? '') === 'alfa' ? 'bg-status-alfa text-white shadow-xs' : 'bg-surface-page text-text-secondary border border-border hover:border-status-alfa hover:text-status-alfa' }}">
                            <span>Alfa</span>
                        </button>

                        <!-- Note Button -->
                        <button type="button" wire:click="openNoteModal({{ $siswa->id }}, '{{ addslashes($siswa->nama) }}')" title="Tambah Catatan/Keterangan" class="min-h-touch-target px-2.5 py-1.5 rounded-lg text-xs text-text-secondary hover:text-brand hover:bg-brand-surface transition-all border border-border">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                        </button>
                    </div>
                </div>
            @empty
                <div class="py-12 text-center text-xs text-text-secondary">
                    Tidak ada siswa pada rombel jadwal yang dipilih.
                </div>
            @endforelse
        </div>
    </div>

    <!-- Note Modal -->
    @if($isNoteModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-xs">
            <div class="bg-surface rounded-2xl p-6 border border-border shadow-xl max-w-md w-full space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-border">
                    <h3 class="font-bold text-sm text-text-primary">Catatan Presensi: {{ $activeSiswaName }}</h3>
                    <button wire:click="$set('isNoteModalOpen', false)" class="text-text-secondary hover:text-text-primary">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-text-secondary mb-1">Keterangan / Alasan Ketidakhadiran</label>
                    <textarea wire:model="noteText" rows="3" class="w-full text-xs p-3 rounded-lg border border-border bg-surface-page focus:ring-2 focus:ring-brand/20 focus:border-brand outline-none" placeholder="Contoh: Sakit demam surat dokter terlampir..."></textarea>
                </div>
                <div class="flex justify-end gap-2 pt-2">
                    <button wire:click="$set('isNoteModalOpen', false)" type="button" class="px-4 py-2 text-xs font-semibold rounded-lg border border-border text-text-secondary hover:bg-slate-50">Batal</button>
                    <button wire:click="saveNote" type="button" class="px-5 py-2 text-xs font-bold rounded-lg bg-brand text-white hover:bg-brand-hover shadow-xs">Simpan Catatan</button>
                </div>
            </div>
        </div>
    @endif
</div>
