<div class="space-y-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Laporan Akademik &amp; Rekapitulasi Nilai</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Evaluasi capaian hasil belajar siswa madrasah lintas rombel, mapel, dan analisis KKM.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="px-5 h-touch-target border border-border-default bg-surface hover:bg-surface-container text-text-main rounded-lg font-label-md text-sm font-semibold shadow-xs transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Cetak Laporan</span>
            </button>
        </div>
    </div>

    <!-- Summary KPI Bento -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
            <div>
                <p class="text-xs text-on-surface-variant uppercase font-semibold">Rata-rata Madrasah</p>
                <p class="font-headline-lg text-2xl font-bold text-primary mt-0.5">84.8</p>
                <p class="text-[11px] text-status-hadir font-semibold">Memenuhi KKM (75)</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
            <div>
                <p class="text-xs text-on-surface-variant uppercase font-semibold">Ketuntasan Klasikal</p>
                <p class="font-headline-lg text-2xl font-bold text-status-hadir mt-0.5">94.2%</p>
                <p class="text-[11px] text-status-hadir font-medium">Sangat Baik</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-status-hadir/15 text-status-hadir flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
            <div>
                <p class="text-xs text-on-surface-variant uppercase font-semibold">Perlu Remedial</p>
                <p class="font-headline-lg text-2xl font-bold text-status-alfa mt-0.5">5.8%</p>
                <p class="text-[11px] text-on-surface-variant">Bimbingan Khusus</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-status-alfa/15 text-status-alfa flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
            <div>
                <p class="text-xs text-on-surface-variant uppercase font-semibold">Total Nilai Terekam</p>
                <p class="font-headline-lg text-2xl font-bold text-text-main mt-0.5">{{ $siswas->total() }}</p>
                <p class="text-[11px] text-on-surface-variant">Penilaian Formatif</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </div>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default grid grid-cols-1 sm:grid-cols-3 gap-4">
        <div>
            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Cari Siswa</label>
            <div class="relative">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nama atau NISN..." class="w-full pl-9 pr-4 h-10 rounded-lg border border-border-default bg-surface text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
        </div>
        <div>
            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Filter Kelas</label>
            <select wire:model.live="selectedKelas" class="w-full h-10 rounded-lg border border-border-default bg-surface text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="">Semua Rombel</option>
                @foreach($kelases as $k)
                    <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Mata Pelajaran</label>
            <select wire:model.live="selectedMapel" class="w-full h-10 rounded-lg border border-border-default bg-surface text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="">Semua Mapel</option>
                @foreach($mapels as $m)
                    <option value="{{ $m->id }}">{{ $m->kode_mapel }} - {{ $m->nama_mapel }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="bg-surface-container-lowest rounded-xl border border-border-default shadow-card flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase tracking-wider">
                        <th class="py-3.5 px-5 font-semibold">Nama Siswa &amp; NISN</th>
                        <th class="py-3.5 px-5 font-semibold">Kelas</th>
                        <th class="py-3.5 px-4 font-semibold text-center">Rata-rata Tugas</th>
                        <th class="py-3.5 px-4 font-semibold text-center">Rata-rata UH</th>
                        <th class="py-3.5 px-4 font-semibold text-center">Nilai PTS</th>
                        <th class="py-3.5 px-4 font-semibold text-center">Nilai PAS</th>
                        <th class="py-3.5 px-5 font-semibold text-right">Rata-rata Akhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-default/60 font-body-default text-text-main">
                    @forelse($siswas as $s)
                        @php $n = $rekapNilai[$s->id] ?? ['tugas'=>'-','uh'=>'-','pts'=>'-','pas'=>'-','rata_rata'=>'-']; @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ substr($s->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-text-main text-sm">{{ $s->nama }}</p>
                                        <p class="text-xs text-on-surface-variant font-mono">NISN: {{ $s->nisn }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-5 font-medium text-xs">
                                {{ $s->kelas->tingkat ?? '' }} {{ $s->kelas->nama_kelas ?? '-' }}
                            </td>
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-xs text-on-surface-variant">{{ $n['tugas'] }}</td>
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-xs text-on-surface-variant">{{ $n['uh'] }}</td>
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-xs text-on-surface-variant">{{ $n['pts'] }}</td>
                            <td class="py-3.5 px-4 text-center font-mono font-bold text-xs text-on-surface-variant">{{ $n['pas'] }}</td>
                            <td class="py-3.5 px-5 text-right">
                                @php
                                    $isNumeric = is_numeric($n['rata_rata']);
                                    $val = $isNumeric ? (float)$n['rata_rata'] : null;
                                @endphp
                                @if($isNumeric)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold {{ $val >= 75 ? 'bg-status-hadir/15 text-status-hadir border border-status-hadir/30' : 'bg-status-alfa/15 text-status-alfa border border-status-alfa/30' }}">
                                        <span>{{ $val }}</span>
                                        <span>&bull;</span>
                                        <span class="text-[10px] uppercase">{{ $val >= 75 ? 'Tuntas' : 'Remedi' }}</span>
                                    </span>
                                @else
                                    <span class="text-xs text-outline italic">Belum Ada</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-4 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                                    <p class="font-label-md text-sm font-semibold">Tidak ada data rekap nilai ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($siswas->hasPages())
            <div class="p-4 border-t border-border-default bg-surface-container-low">
                {{ $siswas->links() }}
            </div>
        @endif
    </div>
</div>
