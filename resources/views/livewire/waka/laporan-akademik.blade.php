<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-text-primary tracking-tight">Laporan & Analitik Akademik</h1>
            <p class="text-sm text-text-secondary mt-1">Monitoring komprehensif performa kehadiran siswa, ketuntasan TP, dan rekapitulasi sekolah.</p>
        </div>
        <div class="flex items-center gap-3">
            <button wire:click="exportCsv" class="inline-flex items-center gap-2 px-4 py-2 bg-brand text-white font-semibold text-xs rounded-lg shadow-sm hover:bg-brand-hover transition-all active:scale-95">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                <span>Unduh Laporan CSV / Excel</span>
            </button>
        </div>
    </div>

    <!-- 4 KPI Summary Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Card 1: Total Siswa -->
        <div class="bg-surface rounded-2xl p-5 border border-border shadow-card flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-text-secondary uppercase tracking-wider">Total Siswa Aktif</span>
                <div class="w-9 h-9 rounded-xl bg-brand/10 text-brand flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-text-primary">{{ $totalSiswa }}</div>
                <div class="text-xs text-brand font-semibold mt-1">Tersebar di {{ $totalKelas }} Rombel Kelas</div>
            </div>
        </div>

        <!-- Card 2: Rerata Kehadiran -->
        <div class="bg-surface rounded-2xl p-5 border border-border shadow-card flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-text-secondary uppercase tracking-wider">Rata-rata Presensi</span>
                <div class="w-9 h-9 rounded-xl bg-status-hadir/10 text-status-hadir flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-text-primary">{{ $overallAttendanceRate }}%</div>
                <div class="text-xs text-status-hadir font-semibold mt-1">Status Sangat Baik (Target &ge;95%)</div>
            </div>
        </div>

        <!-- Card 3: Rerata Formatif -->
        <div class="bg-surface rounded-2xl p-5 border border-border shadow-card flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-text-secondary uppercase tracking-wider">Rata-rata Nilai Formatif</span>
                <div class="w-9 h-9 rounded-xl bg-blue-50 text-blue-700 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-text-primary">{{ $overallAvgGrade }}</div>
                <div class="text-xs text-text-secondary font-medium mt-1">Standar KKM Madrasah: 75.0</div>
            </div>
        </div>

        <!-- Card 4: Mata Pelajaran -->
        <div class="bg-surface rounded-2xl p-5 border border-border shadow-card flex flex-col justify-between">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold text-text-secondary uppercase tracking-wider">Mata Pelajaran Aktif</span>
                <div class="w-9 h-9 rounded-xl bg-amber-50 text-amber-700 flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" /></svg>
                </div>
            </div>
            <div class="mt-4">
                <div class="text-3xl font-extrabold text-text-primary">{{ $totalMapel }}</div>
                <div class="text-xs text-text-secondary font-medium mt-1">Kurikulum Merdeka 2025/2026</div>
            </div>
        </div>
    </div>

    <!-- Filter Control Bar -->
    <div class="bg-surface p-4 rounded-2xl border border-border shadow-xs flex flex-wrap items-center justify-between gap-4">
        <!-- Filter Tingkat -->
        <div class="flex items-center gap-2">
            <span class="text-xs font-bold text-text-secondary">Tingkat:</span>
            <div class="flex items-center gap-1 bg-surface-page p-1 rounded-xl border border-border">
                @foreach(['Semua', 'X', 'XI', 'XII'] as $tkt)
                    <button wire:click="$set('selectedTingkat', '{{ $tkt }}')" class="px-3 py-1.5 rounded-lg text-xs font-semibold transition-all {{ $selectedTingkat === $tkt ? 'bg-brand text-white shadow-xs' : 'text-text-secondary hover:text-brand' }}">
                        {{ $tkt }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Filter Dropdowns -->
        <div class="flex flex-wrap items-center gap-3">
            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-text-secondary">Kelas:</span>
                <select wire:model.live="selectedKelasId" class="text-xs font-medium py-1.5 px-3 rounded-lg border border-border bg-surface-page focus:ring-1 focus:ring-brand">
                    <option value="Semua">Semua Kelas</option>
                    @foreach($allKelasOptions as $klsOpt)
                        <option value="{{ $klsOpt->id }}">{{ $klsOpt->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-text-secondary">Mapel:</span>
                <select wire:model.live="selectedMapelId" class="text-xs font-medium py-1.5 px-3 rounded-lg border border-border bg-surface-page focus:ring-1 focus:ring-brand">
                    <option value="Semua">Semua Mata Pelajaran</option>
                    @foreach($mapels as $mpl)
                        <option value="{{ $mpl->id }}">{{ $mpl->nama_mapel }}</option>
                    @endforeach
                </select>
            </div>

            <div class="flex items-center gap-2">
                <span class="text-xs font-semibold text-text-secondary">Semester:</span>
                <select wire:model.live="selectedSemester" class="text-xs font-medium py-1.5 px-3 rounded-lg border border-border bg-surface-page focus:ring-1 focus:ring-brand">
                    <option value="Ganjil">Semester Ganjil</option>
                    <option value="Genap">Semester Genap</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Main Table: Analisis Performa Kelas -->
    <div class="bg-surface rounded-2xl border border-border shadow-card overflow-hidden">
        <div class="p-5 border-b border-border bg-surface-page/50 flex items-center justify-between">
            <h2 class="text-base font-bold text-text-primary">Matriks Capaian Akademik & Presensi per Rombel</h2>
            <span class="text-xs text-text-secondary">Menampilkan {{ count($classReports) }} Kelas</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-surface-page border-b border-border text-[11px] font-bold text-text-secondary uppercase tracking-wider">
                        <th class="py-3 px-5">Rombel Kelas</th>
                        <th class="py-3 px-4">Tingkat</th>
                        <th class="py-3 px-4">Jumlah Siswa</th>
                        <th class="py-3 px-5">Tingkat Kehadiran (%)</th>
                        <th class="py-3 px-5">Rerata Formatif TP</th>
                        <th class="py-3 px-5 text-center">Status Ketuntasan</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($classReports as $report)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 px-5 font-bold text-text-primary">
                                {{ $report['nama_kelas'] }}
                            </td>
                            <td class="py-3.5 px-4 text-xs font-semibold text-text-secondary">
                                Kelas {{ $report['tingkat'] }}
                            </td>
                            <td class="py-3.5 px-4 text-xs text-text-secondary">
                                {{ $report['siswa_count'] }} Siswa
                            </td>
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-3">
                                    <div class="w-24 bg-slate-100 rounded-full h-2 overflow-hidden">
                                        <div class="bg-status-hadir h-full" style="width: {{ min(100, $report['rate_hadir']) }}%"></div>
                                    </div>
                                    <span class="text-xs font-bold text-text-primary">{{ $report['rate_hadir'] }}%</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-5 font-bold {{ $report['avg_nilai'] >= 75 ? 'text-brand' : 'text-amber-600' }}">
                                {{ $report['avg_nilai'] }}
                            </td>
                            <td class="py-3.5 px-5 text-center">
                                @if($report['status_ketuntasan'] === 'Tuntas')
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-status-hadir/10 text-status-hadir border border-status-hadir/20">
                                        <span>Tuntas &ge; KKM</span>
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full text-xs font-bold bg-status-izin/10 text-status-izin border border-status-izin/20">
                                        <span>Perlu Remedial</span>
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-8 text-center text-xs text-text-secondary">
                                Tidak ada data kelas yang cocok dengan filter yang dipilih.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
