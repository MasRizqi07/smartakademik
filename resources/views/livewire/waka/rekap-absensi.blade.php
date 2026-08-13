<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Rekapitulasi Kehadiran Siswa</h2>
            <p class="text-slate-500">Laporan statistik tingkat kehadiran siswa per kelas dan periode tanggal.</p>
        </div>
    </div>

    <!-- Filters -->
    <x-modern-card>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Cari Siswa</label>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Nama / NISN..." class="w-full rounded-xl border-slate-200 text-sm focus:border-brand-500 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Kelas</label>
                <select wire:model.live="selectedKelas" class="w-full rounded-xl border-slate-200 text-sm focus:border-brand-500 focus:ring-brand-500">
                    <option value="">Semua Kelas</option>
                    @foreach($kelases as $k)
                        <option value="{{ $k->id }}">{{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Dari Tanggal</label>
                <input type="date" wire:model.live="startDate" class="w-full rounded-xl border-slate-200 text-sm focus:border-brand-500 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Sampai Tanggal</label>
                <input type="date" wire:model.live="endDate" class="w-full rounded-xl border-slate-200 text-sm focus:border-brand-500 focus:ring-brand-500">
            </div>
        </div>
    </x-modern-card>

    <!-- Data Table -->
    <x-modern-card>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs border-b border-slate-200">
                    <tr>
                        <th class="p-4">Siswa</th>
                        <th class="p-4">Kelas</th>
                        <th class="p-4 text-center text-emerald-700">Hadir</th>
                        <th class="p-4 text-center text-blue-700">Izin</th>
                        <th class="p-4 text-center text-amber-700">Sakit</th>
                        <th class="p-4 text-center text-rose-700">Alfa</th>
                        <th class="p-4 text-center">Persentase Kehadiran</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($siswas as $s)
                        @php $stat = $rekapData[$s->id] ?? ['hadir'=>0,'izin'=>0,'sakit'=>0,'alfa'=>0,'total'=>0,'persentase'=>0]; @endphp
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-bold text-slate-800">
                                {{ $s->nama }}
                                <div class="text-xs font-normal text-slate-400">NISN: {{ $s->nisn }}</div>
                            </td>
                            <td class="p-4 font-medium text-slate-700">{{ $s->kelas->nama_kelas ?? '-' }}</td>
                            <td class="p-4 text-center font-bold text-emerald-600 bg-emerald-50/30">{{ $stat['hadir'] }}</td>
                            <td class="p-4 text-center font-bold text-blue-600 bg-blue-50/30">{{ $stat['izin'] }}</td>
                            <td class="p-4 text-center font-bold text-amber-600 bg-amber-50/30">{{ $stat['sakit'] }}</td>
                            <td class="p-4 text-center font-bold text-rose-600 bg-rose-50/30">{{ $stat['alfa'] }}</td>
                            <td class="p-4 text-center font-bold">
                                <span class="px-3 py-1 rounded-full text-xs {{ $stat['persentase'] >= 85 ? 'bg-emerald-100 text-emerald-800' : ($stat['persentase'] >= 70 ? 'bg-amber-100 text-amber-800' : 'bg-rose-100 text-rose-800') }}">
                                    {{ $stat['persentase'] }}%
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-slate-400">Tidak ada data siswa found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $siswas->links() }}
        </div>
    </x-modern-card>
</div>
