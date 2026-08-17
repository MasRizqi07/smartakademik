<div class="space-y-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Rekapitulasi Presensi Bulanan</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Laporan komprehensif tingkat kehadiran siswa per kelas dan pemantauan alfa/izin.</p>
        </div>
        <div class="flex items-center gap-3">
            <button onclick="window.print()" class="px-5 h-touch-target border border-border-default bg-surface hover:bg-surface-container text-text-main rounded-lg font-label-md text-sm font-semibold shadow-xs transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">print</span>
                <span>Cetak Rekap</span>
            </button>
        </div>
    </div>

    <!-- Summary KPI Bento -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
            <div>
                <p class="text-xs text-on-surface-variant uppercase font-semibold">Tingkat Hadir</p>
                <p class="font-headline-lg text-2xl font-bold text-status-hadir mt-0.5">96.8%</p>
                <p class="text-[11px] text-status-hadir font-medium">+1.4% MoM</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-status-hadir/15 text-status-hadir flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">check_circle</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
            <div>
                <p class="text-xs text-on-surface-variant uppercase font-semibold">Total Izin</p>
                <p class="font-headline-lg text-2xl font-bold text-status-izin mt-0.5">14</p>
                <p class="text-[11px] text-on-surface-variant">Surat Tercatat</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-status-izin/15 text-status-izin flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">event_note</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
            <div>
                <p class="text-xs text-on-surface-variant uppercase font-semibold">Total Sakit</p>
                <p class="font-headline-lg text-2xl font-bold text-status-sakit mt-0.5">8</p>
                <p class="text-[11px] text-on-surface-variant">Surat Dokter</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-status-sakit/15 text-status-sakit flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">medical_services</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
            <div>
                <p class="text-xs text-on-surface-variant uppercase font-semibold">Total Tanpa Ket (Alfa)</p>
                <p class="font-headline-lg text-2xl font-bold text-status-alfa mt-0.5">3</p>
                <p class="text-[11px] text-status-alfa font-medium">Perlu Tindak Lanjut</p>
            </div>
            <div class="w-11 h-11 rounded-xl bg-status-alfa/15 text-status-alfa flex items-center justify-center">
                <span class="material-symbols-outlined text-[24px]">warning</span>
            </div>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Cari Siswa</label>
            <div class="relative">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nama atau NISN..." class="w-full pl-9 pr-4 h-10 rounded-lg border border-border-default bg-surface text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
            </div>
        </div>
        <div>
            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Filter Rombel Kelas</label>
            <select wire:model.live="selectedKelas" class="w-full h-10 rounded-lg border border-border-default bg-surface text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="">Semua Kelas</option>
                @foreach($kelases as $k)
                    <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Dari Tanggal</label>
            <input type="date" wire:model.live="startDate" class="w-full h-10 rounded-lg border border-border-default bg-surface text-sm">
        </div>
        <div>
            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Sampai Tanggal</label>
            <input type="date" wire:model.live="endDate" class="w-full h-10 rounded-lg border border-border-default bg-surface text-sm">
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
                        <th class="py-3.5 px-4 font-semibold text-center text-status-hadir">Hadir (H)</th>
                        <th class="py-3.5 px-4 font-semibold text-center text-status-izin">Izin (I)</th>
                        <th class="py-3.5 px-4 font-semibold text-center text-status-sakit">Sakit (S)</th>
                        <th class="py-3.5 px-4 font-semibold text-center text-status-alfa">Alfa (A)</th>
                        <th class="py-3.5 px-5 font-semibold text-right">Persentase Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-default/60 font-body-default text-text-main">
                    @forelse($siswas as $s)
                        @php 
                            $stat = $rekapData[$s->id] ?? ['hadir'=>0,'izin'=>0,'sakit'=>0,'alfa'=>0,'total'=>0,'persentase'=>0]; 
                            $pct = $stat['persentase'];
                        @endphp
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
                            <td class="py-3.5 px-4 text-center font-bold text-status-hadir">{{ $stat['hadir'] }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-status-izin">{{ $stat['izin'] }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-status-sakit">{{ $stat['sakit'] }}</td>
                            <td class="py-3.5 px-4 text-center font-bold text-status-alfa">{{ $stat['alfa'] }}</td>
                            <td class="py-3.5 px-5 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <div class="w-16 bg-surface-container rounded-full h-2 hidden sm:block overflow-hidden">
                                        <div class="h-2 rounded-full {{ $pct >= 85 ? 'bg-status-hadir' : ($pct >= 70 ? 'bg-status-izin' : 'bg-status-alfa') }}" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <span class="px-2.5 py-0.5 rounded-full text-xs font-bold {{ $pct >= 85 ? 'bg-status-hadir/15 text-status-hadir' : ($pct >= 70 ? 'bg-status-izin/15 text-status-izin' : 'bg-status-alfa/15 text-status-alfa') }}">
                                        {{ $pct }}%
                                    </span>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-4 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[48px] text-outline">search_off</span>
                                    <p class="font-label-md text-sm font-semibold">Tidak ada data rekap presensi ditemukan.</p>
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
