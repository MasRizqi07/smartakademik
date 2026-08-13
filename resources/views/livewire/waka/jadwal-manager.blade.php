<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Monitoring & Pengawasan Jadwal Pelajaran</h2>
            <p class="text-slate-500">Pantau seluruh jadwal kegiatan belajar mengajar lintas kelas dan guru di MAN 4 Jombang.</p>
        </div>
    </div>

    <!-- Filter Card -->
    <x-modern-card>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Cari Guru / Mapel / Kelas</label>
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari nama guru, mapel..." class="w-full rounded-xl border-slate-200 text-sm focus:border-brand-500 focus:ring-brand-500">
            </div>
            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Hari</label>
                <select wire:model.live="selectedHari" class="w-full rounded-xl border-slate-200 text-sm focus:border-brand-500 focus:ring-brand-500">
                    <option value="">Semua Hari</option>
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                </select>
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
        </div>
    </x-modern-card>

    <!-- Table -->
    <x-modern-card>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-600">
                <thead class="bg-slate-50 text-slate-700 uppercase font-semibold text-xs border-b border-slate-200">
                    <tr>
                        <th class="p-4">Hari / Jam</th>
                        <th class="p-4">Waktu</th>
                        <th class="p-4">Kelas</th>
                        <th class="p-4">Mata Pelajaran</th>
                        <th class="p-4">Guru Pengampu</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($jadwals as $j)
                        <tr class="hover:bg-slate-50/80 transition-colors">
                            <td class="p-4 font-semibold text-slate-800">
                                <span class="inline-block px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-700 text-xs font-bold mr-2">{{ $j->hari }}</span>
                                Jam ke-{{ $j->jam_ke }}
                            </td>
                            <td class="p-4 text-slate-500">{{ substr($j->waktu_mulai, 0, 5) }} - {{ substr($j->waktu_selesai, 0, 5) }}</td>
                            <td class="p-4 font-bold text-slate-700">{{ $j->kelas->nama_kelas }}</td>
                            <td class="p-4 font-medium text-slate-800">{{ $j->mapel->nama_mapel }}</td>
                            <td class="p-4 text-slate-600 font-medium">{{ $j->guru->nama }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-8 text-center text-slate-400">Tidak ada data jadwal pelajaran yang sesuai.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $jadwals->links() }}
        </div>
    </x-modern-card>
</div>
