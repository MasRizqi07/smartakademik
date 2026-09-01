<div class="space-y-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="text-2xl md:text-3xl font-bold text-brand">Rekapitulasi Presensi Bulanan</h2>
            <p class="text-sm text-text-secondary mt-1">Laporan komprehensif tingkat kehadiran siswa per kelas dan pemantauan alfa/izin.</p>
        </div>
        <div class="flex items-center gap-3">
            <button wire:click="exportCsv" class="px-4 min-h-touch-target border border-brand/20 bg-brand/10 hover:bg-brand/20 text-brand rounded-lg text-sm font-semibold transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                <span>Export CSV</span>
            </button>
            <button onclick="window.print()" class="px-5 min-h-touch-target border border-border bg-surface hover:bg-slate-100 text-text-primary rounded-lg text-sm font-semibold transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" /></svg>
                <span>Cetak Rekap</span>
            </button>
        </div>
    </div>

    <!-- Summary KPI Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-surface p-5 rounded-lg shadow-card border border-border flex items-center justify-between">
            <div>
                <p class="text-xs text-text-secondary uppercase font-semibold">Tingkat Hadir</p>
                <p class="text-2xl font-bold text-status-hadir mt-0.5">96.8%</p>
                <p class="text-[11px] text-status-hadir font-medium">+1.4% MoM</p>
            </div>
            <div class="w-11 h-11 rounded-lg bg-status-hadir/15 text-status-hadir flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            </div>
        </div>

        <div class="bg-surface p-5 rounded-lg shadow-card border border-border flex items-center justify-between">
            <div>
                <p class="text-xs text-text-secondary uppercase font-semibold">Total Izin</p>
                <p class="text-2xl font-bold text-status-izin mt-0.5">14</p>
                <p class="text-[11px] text-text-secondary">Surat Tercatat</p>
            </div>
            <div class="w-11 h-11 rounded-lg bg-status-izin/15 text-status-izin flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /></svg>
            </div>
        </div>

        <div class="bg-surface p-5 rounded-lg shadow-card border border-border flex items-center justify-between">
            <div>
                <p class="text-xs text-text-secondary uppercase font-semibold">Total Sakit</p>
                <p class="text-2xl font-bold text-status-sakit mt-0.5">8</p>
                <p class="text-[11px] text-text-secondary">Surat Dokter</p>
            </div>
            <div class="w-11 h-11 rounded-lg bg-status-sakit/15 text-status-sakit flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" /></svg>
            </div>
        </div>

        <div class="bg-surface p-5 rounded-lg shadow-card border border-border flex items-center justify-between">
            <div>
                <p class="text-xs text-text-secondary uppercase font-semibold">Total Tanpa Ket (Alfa)</p>
                <p class="text-2xl font-bold text-status-alfa mt-0.5">3</p>
                <p class="text-[11px] text-status-alfa font-medium">Perlu Tindak Lanjut</p>
            </div>
            <div class="w-11 h-11 rounded-lg bg-status-alfa/15 text-status-alfa flex items-center justify-center">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
            </div>
        </div>
    </div>

    <!-- Filters Bar -->
    <div class="bg-surface p-5 rounded-lg shadow-card border border-border grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div>
            <label class="block text-xs font-semibold text-text-secondary mb-1">Cari Siswa</label>
            <div class="relative">
                <svg class="w-4 h-4 absolute left-3 top-1/2 -translate-y-1/2 text-text-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nama atau NISN..." class="w-full pl-9 pr-4 h-10 rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent">
            </div>
        </div>
        <div>
            <label class="block text-xs font-semibold text-text-secondary mb-1">Filter Rombel Kelas</label>
            <select wire:model.live="selectedKelas" class="w-full h-10 rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent">
                <option value="">Semua Kelas</option>
                @foreach($kelases as $k)
                    <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-text-secondary mb-1">Dari Tanggal</label>
            <input type="date" wire:model.live="startDate" class="w-full h-10 rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent">
        </div>
        <div>
            <label class="block text-xs font-semibold text-text-secondary mb-1">Sampai Tanggal</label>
            <input type="date" wire:model.live="endDate" class="w-full h-10 rounded-lg border border-border bg-surface text-sm focus:ring-2 focus:ring-brand focus:border-transparent">
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="bg-surface rounded-lg border border-border shadow-card flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-slate-100 border-b border-border text-text-secondary text-[12px] uppercase tracking-wider">
                        <th class="py-2 px-5 font-semibold">Nama Siswa &amp; NISN</th>
                        <th class="py-2 px-5 font-semibold">Kelas</th>
                        <th class="py-2 px-4 font-semibold text-center text-status-hadir">Hadir (H)</th>
                        <th class="py-2 px-4 font-semibold text-center text-status-izin">Izin (I)</th>
                        <th class="py-2 px-4 font-semibold text-center text-status-sakit">Sakit (S)</th>
                        <th class="py-2 px-4 font-semibold text-center text-status-alfa">Alfa (A)</th>
                        <th class="py-2 px-5 font-semibold text-right">Persentase Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border/60 text-text-primary">
                    @forelse($siswas as $s)
                        @php 
                            $stat = $rekapData[$s->id] ?? ['hadir'=>0,'izin'=>0,'sakit'=>0,'alfa'=>0,'total'=>0,'persentase'=>0]; 
                            $pct = $stat['persentase'];
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors even:bg-slate-50/50">
                            <td class="py-2 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-brand-surface text-brand flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ substr($s->nama, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-bold text-text-primary text-sm">{{ $s->nama }}</p>
                                        <p class="text-xs text-text-secondary font-mono">NISN: {{ $s->nisn }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-2 px-5 font-medium text-xs">
                                {{ $s->kelas->tingkat ?? '' }} {{ $s->kelas->nama_kelas ?? '-' }}
                            </td>
                            <td class="py-2 px-4 text-center font-bold text-status-hadir">{{ $stat['hadir'] }}</td>
                            <td class="py-2 px-4 text-center font-bold text-status-izin">{{ $stat['izin'] }}</td>
                            <td class="py-2 px-4 text-center font-bold text-status-sakit">{{ $stat['sakit'] }}</td>
                            <td class="py-2 px-4 text-center font-bold text-status-alfa">{{ $stat['alfa'] }}</td>
                            <td class="py-2 px-5 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <div class="w-16 bg-slate-200 rounded-full h-2 hidden sm:block overflow-hidden">
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
                            <td colspan="7" class="py-12 px-4 text-center text-text-secondary">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-12 h-12 text-text-secondary" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                                    <p class="text-sm font-semibold">Tidak ada data rekap presensi ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($siswas->hasPages())
            <div class="p-4 border-t border-border bg-slate-50">
                {{ $siswas->links() }}
            </div>
        @endif
    </div>
</div>
