<div class="space-y-6">
    @if(!$siswa)
        <div class="text-center py-12 text-status-alfa bg-status-alfa/10 rounded-2xl border border-status-alfa/20 shadow-sm p-6">
            <span class="material-symbols-outlined text-[48px] mb-2">person_off</span>
            <h3 class="text-xl font-bold">Data Siswa Belum Terhubung</h3>
            <p class="text-sm mt-1 text-on-surface-variant">Akun login Anda belum terhubung dengan data siswa di pangkalan data madrasah.</p>
        </div>
    @else
        <!-- Profile Bento Header Card -->
        <div class="bg-surface-container-lowest rounded-2xl shadow-card p-6 md:p-8 border border-border-default relative overflow-hidden group">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 relative z-10">
                <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-2xl bg-primary text-on-primary flex items-center justify-center font-bold text-3xl shrink-0 shadow-md">
                    {{ substr($siswa->nama, 0, 1) }}
                </div>
                <div class="flex-1 w-full space-y-2">
                    <div class="flex flex-wrap justify-between items-start gap-2">
                        <div>
                            <h2 class="font-headline-lg text-2xl font-bold text-text-main">{{ $siswa->nama }}</h2>
                            <p class="text-xs text-on-surface-variant flex items-center gap-2 mt-0.5 font-mono">
                                <span>NISN: <strong>{{ $siswa->nisn }}</strong></span>
                                <span>&bull;</span>
                                <span>Rombel: <strong>{{ $siswa->kelas->tingkat ?? '' }} {{ $siswa->kelas->nama_kelas ?? 'N/A' }}</strong></span>
                            </p>
                        </div>
                        <span class="bg-status-hadir/15 text-status-hadir px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-status-hadir/30">
                            Siswa Aktif
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 pt-3 border-t border-border-default text-xs">
                        <div>
                            <p class="text-on-surface-variant text-[11px]">Tahun Pelajaran</p>
                            <p class="font-semibold text-text-main">2026/2027 Ganjil</p>
                        </div>
                        <div>
                            <p class="text-on-surface-variant text-[11px]">Wali Kelas</p>
                            <p class="font-semibold text-text-main">Bpk. Ahmad Fauzi, S.Pd.</p>
                        </div>
                        <div>
                            <p class="text-on-surface-variant text-[11px]">Satuan Pendidikan</p>
                            <p class="font-semibold text-primary">MAN 4 Jombang</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick KPI Stats Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
                <div>
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Tingkat Kehadiran</p>
                    <p class="font-headline-lg text-2xl font-bold text-status-hadir mt-0.5">98.2%</p>
                    <p class="text-[11px] text-on-surface-variant">Sangat Baik</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-status-hadir/15 text-status-hadir flex items-center justify-center">
                    <span class="material-symbols-outlined text-[26px]">how_to_reg</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
                <div>
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Rata-rata Formatif</p>
                    <p class="font-headline-lg text-2xl font-bold text-primary mt-0.5">88.5</p>
                    <p class="text-[11px] text-status-hadir font-semibold">Di atas KKM (75)</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[26px]">grade</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest p-5 rounded-2xl shadow-card border border-border-default flex items-center justify-between hover-lift transition-all">
                <div>
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider font-semibold">Mata Pelajaran</p>
                    <p class="font-headline-lg text-2xl font-bold text-text-main mt-0.5">14 Mapel</p>
                    <p class="text-[11px] text-on-surface-variant">Kurikulum Merdeka</p>
                </div>
                <div class="w-12 h-12 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-[26px]">menu_book</span>
                </div>
            </div>
        </div>

        <!-- Role Tabs Bar -->
        <div class="bg-surface-container-lowest rounded-2xl p-1.5 shadow-card border border-border-default flex gap-2">
            <button wire:click="$set('activeTab', 'jadwal')" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 {{ $activeTab === 'jadwal' ? 'bg-primary text-on-primary shadow-xs' : 'text-on-surface-variant hover:bg-surface' }}">
                <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                <span>Jadwal Pelajaran</span>
            </button>
            <button wire:click="$set('activeTab', 'absensi')" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 {{ $activeTab === 'absensi' ? 'bg-primary text-on-primary shadow-xs' : 'text-on-surface-variant hover:bg-surface' }}">
                <span class="material-symbols-outlined text-[18px]">fact_check</span>
                <span>Riwayat Absensi</span>
            </button>
            <button wire:click="$set('activeTab', 'nilai')" class="flex-1 py-2.5 px-4 rounded-xl text-xs font-bold transition-all flex items-center justify-center gap-2 {{ $activeTab === 'nilai' ? 'bg-primary text-on-primary shadow-xs' : 'text-on-surface-variant hover:bg-surface' }}">
                <span class="material-symbols-outlined text-[18px]">bar_chart</span>
                <span>Nilai Formatif</span>
            </button>
        </div>

        <!-- Tab Content -->
        <div class="animate-fade-in">
            @if($activeTab === 'jadwal')
                @if($jadwals->isEmpty())
                    <div class="bg-surface-container-lowest rounded-2xl p-12 text-center border border-border-default text-on-surface-variant text-sm">
                        Belum ada jadwal pelajaran terdaftar untuk kelas Anda.
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($jadwals as $hari => $items)
                            <div class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default p-5 space-y-3">
                                <div class="flex items-center justify-between border-b border-border-default pb-2">
                                    <h4 class="font-headline-md text-base font-bold text-primary">{{ $hari }}</h4>
                                    <span class="text-xs bg-primary/10 text-primary px-2 py-0.5 rounded-md font-bold">{{ count($items) }} Jam</span>
                                </div>
                                <div class="divide-y divide-border-default/60">
                                    @foreach($items as $j)
                                        <div class="py-2.5 flex items-start gap-3">
                                            <div class="w-8 h-8 rounded-lg bg-surface flex items-center justify-center font-mono font-bold text-xs shrink-0 border border-border-default text-text-main">
                                                {{ $j->jam_ke }}
                                            </div>
                                            <div class="flex-1">
                                                <p class="font-bold text-sm text-text-main">{{ $j->mapel->nama_mapel }}</p>
                                                <p class="text-xs text-on-surface-variant">{{ $j->guru->nama }}</p>
                                                <p class="text-[11px] font-mono text-primary mt-0.5">{{ substr($j->waktu_mulai, 0, 5) }} - {{ substr($j->waktu_selesai, 0, 5) }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            @elseif($activeTab === 'absensi')
                <div class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase">
                                    <th class="py-3.5 px-5 font-semibold">Tanggal</th>
                                    <th class="py-3.5 px-5 font-semibold">Mata Pelajaran</th>
                                    <th class="py-3.5 px-5 font-semibold text-right">Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-default/60">
                                @forelse($absensis as $abs)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-3.5 px-5 font-medium text-text-main">
                                            {{ \Carbon\Carbon::parse($abs->tanggal)->isoFormat('dddd, D MMMM YYYY') }}
                                        </td>
                                        <td class="py-3.5 px-5 text-on-surface-variant">
                                            {{ $abs->jadwal->mapel->nama_mapel ?? '-' }}
                                        </td>
                                        <td class="py-3.5 px-5 text-right">
                                            @php
                                                $badgeColor = match($abs->status) {
                                                    'hadir' => 'bg-status-hadir/15 text-status-hadir border-status-hadir/30',
                                                    'izin' => 'bg-status-izin/15 text-status-izin border-status-izin/30',
                                                    'sakit' => 'bg-status-sakit/15 text-status-sakit border-status-sakit/30',
                                                    default => 'bg-status-alfa/15 text-status-alfa border-status-alfa/30',
                                                };
                                            @endphp
                                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold uppercase border {{ $badgeColor }}">
                                                {{ ucfirst($abs->status) }}
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-12 text-center text-on-surface-variant text-xs">
                                            Belum ada rekapan absensi yang dicatat.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            @elseif($activeTab === 'nilai')
                <div class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-sm">
                            <thead>
                                <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase">
                                    <th class="py-3.5 px-5 font-semibold">Tanggal</th>
                                    <th class="py-3.5 px-5 font-semibold">Mata Pelajaran</th>
                                    <th class="py-3.5 px-5 font-semibold">Jenis Asesmen</th>
                                    <th class="py-3.5 px-5 font-semibold text-right">Nilai &amp; Kelulusan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border-default/60">
                                @forelse($nilais as $nilai)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="py-3.5 px-5 font-medium text-text-main">
                                            {{ \Carbon\Carbon::parse($nilai->tanggal)->isoFormat('D MMM YYYY') }}
                                        </td>
                                        <td class="py-3.5 px-5">
                                            <p class="font-bold text-text-main">{{ $nilai->mapel->nama_mapel }}</p>
                                            <p class="text-xs text-on-surface-variant">{{ $nilai->guru->nama }}</p>
                                        </td>
                                        <td class="py-3.5 px-5 text-on-surface-variant capitalize text-xs">
                                            {{ str_replace('_', ' ', $nilai->jenis) }}
                                        </td>
                                        <td class="py-3.5 px-5 text-right">
                                            <span class="inline-flex items-center gap-2">
                                                <span class="text-base font-bold {{ $nilai->nilai >= 75 ? 'text-status-hadir' : 'text-status-alfa' }}">
                                                    {{ (float)$nilai->nilai }}
                                                </span>
                                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $nilai->nilai >= 75 ? 'bg-status-hadir/15 text-status-hadir' : 'bg-status-alfa/15 text-status-alfa' }}">
                                                    {{ $nilai->nilai >= 75 ? 'Tuntas' : 'Remedi' }}
                                                </span>
                                            </span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="py-12 text-center text-on-surface-variant text-xs">
                                            Belum ada rekapan nilai formatif yang tersimpan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
