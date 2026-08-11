<div>
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
            <div class="p-6 bg-white border-b border-slate-200">
                
                <!-- Header & Actions -->
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                    <div class="w-full sm:w-1/2 md:w-1/3">
                        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Kelas, Mapel, atau Guru..." 
                               class="w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                    </div>
                    <button wire:click="create" class="px-4 py-2 bg-emerald-600 text-white rounded-md font-semibold text-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 whitespace-nowrap">
                        + Tambah Jadwal
                    </button>
                </div>

                <!-- Flash Message -->
                @if (session()->has('message'))
                    <div class="mb-4 px-4 py-2 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-md">
                        {{ session('message') }}
                    </div>
                @endif

                <!-- Form (Toggleable) -->
                @if($isFormOpen)
                    <div class="mb-6 p-4 bg-slate-50 border border-slate-200 rounded-md shadow-sm">
                        <h3 class="text-lg font-semibold mb-4 text-slate-900">{{ $jadwalId ? 'Edit Jadwal' : 'Tambah Jadwal Baru' }}</h3>
                        <form wire:submit="store">
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                                <!-- Relasi -->
                                <div class="col-span-1 lg:col-span-4 grid grid-cols-1 md:grid-cols-3 gap-4 border-b border-slate-200 pb-4 mb-2">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Kelas</label>
                                        <select wire:model="kelas_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                            <option value="">-- Pilih Kelas --</option>
                                            @foreach($kelases as $kelas)
                                                <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                            @endforeach
                                        </select>
                                        @error('kelas_id') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Mata Pelajaran</label>
                                        <select wire:model="mapel_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                            <option value="">-- Pilih Mapel --</option>
                                            @foreach($mapels as $mapel)
                                                <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                            @endforeach
                                        </select>
                                        @error('mapel_id') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Guru Pengajar</label>
                                        <select wire:model="guru_id" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                            <option value="">-- Pilih Guru --</option>
                                            @foreach($gurus as $guru)
                                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                            @endforeach
                                        </select>
                                        @error('guru_id') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <!-- Waktu -->
                                <div class="col-span-1 lg:col-span-4 grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Hari</label>
                                        <select wire:model="hari" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                            <option value="">-- Pilih Hari --</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                        @error('hari') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Jam Ke-</label>
                                        <input type="number" wire:model="jam_ke" min="1" max="15" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                        @error('jam_ke') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Waktu Mulai</label>
                                        <input type="time" wire:model="waktu_mulai" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                        @error('waktu_mulai') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-slate-700">Waktu Selesai</label>
                                        <input type="time" wire:model="waktu_selesai" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                        @error('waktu_selesai') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end gap-2 mt-4 pt-4 border-t border-slate-200">
                                <button type="button" wire:click="resetForm" class="px-4 py-2 border border-slate-300 text-slate-700 rounded-md text-sm hover:bg-slate-100">Batal</button>
                                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-md font-semibold text-sm hover:bg-emerald-700">Simpan</button>
                            </div>
                        </form>
                    </div>
                @endif

                <!-- Data Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Hari & Waktu</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Kelas</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Mata Pelajaran</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Guru</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-slate-200">
                            @forelse ($jadwals as $jadwal)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        <span class="font-semibold">{{ $jadwal->hari }}</span> (Jam ke-{{ $jadwal->jam_ke }})<br>
                                        <span class="text-xs text-slate-500">{{ substr($jadwal->waktu_mulai, 0, 5) }} - {{ substr($jadwal->waktu_selesai, 0, 5) }}</span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">
                                        {{ $jadwal->kelas->nama_kelas }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">
                                        {{ $jadwal->mapel->nama_mapel }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                        {{ $jadwal->guru->nama }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <button wire:click="edit({{ $jadwal->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                        <button wire:click="delete({{ $jadwal->id }})" wire:confirm="Yakin ingin menghapus jadwal ini?" class="text-rose-600 hover:text-rose-900">Hapus</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 whitespace-nowrap text-sm text-center text-slate-500">
                                        Tidak ada data jadwal ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-4">
                    {{ $jadwals->links() }}
                </div>

            </div>
        </div>
    </div>
</div>
