<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Manajemen Jadwal Pelajaran</h2>
            <p class="text-slate-500">Kelola jadwal mengajar, kelas, dan mata pelajaran.</p>
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <div class="relative w-full md:w-72">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Kelas, Mapel, atau Guru..." 
                       class="pl-10 w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 transition-colors">
            </div>
            <x-animated-button wire:click="create" variant="primary" icon="<svg fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M12 4v16m8-8H4'></path></svg>">
                Tambah
            </x-animated-button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 flex items-center gap-3 animate-slide-up">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    @if($isFormOpen)
        <div class="animate-fade-in mb-6 relative">
            <div class="absolute inset-0 bg-gradient-to-r from-brand-500 to-accent-500 rounded-2xl blur opacity-20"></div>
            <div class="relative bg-white rounded-2xl p-6 shadow-soft border border-slate-100">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-slate-100">
                    <div class="w-10 h-10 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-slate-800">{{ $jadwalId ? 'Edit Jadwal' : 'Tambah Jadwal Baru' }}</h3>
                </div>
                
                <form wire:submit="store">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
                        <!-- Relasi -->
                        <div class="col-span-1 lg:col-span-4 grid grid-cols-1 md:grid-cols-3 gap-6 pb-6 border-b border-slate-100">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Kelas</label>
                                <div class="relative">
                                    <select wire:model="kelas_id" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 transition-colors appearance-none bg-white">
                                        <option value="">-- Pilih Kelas --</option>
                                        @foreach($kelases as $kelas)
                                            <option value="{{ $kelas->id }}">{{ $kelas->nama_kelas }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('kelas_id') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Mata Pelajaran</label>
                                <div class="relative">
                                    <select wire:model="mapel_id" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 transition-colors appearance-none bg-white">
                                        <option value="">-- Pilih Mapel --</option>
                                        @foreach($mapels as $mapel)
                                            <option value="{{ $mapel->id }}">{{ $mapel->nama_mapel }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('mapel_id') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Guru Pengajar</label>
                                <div class="relative">
                                    <select wire:model="guru_id" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 transition-colors appearance-none bg-white">
                                        <option value="">-- Pilih Guru --</option>
                                        @foreach($gurus as $guru)
                                            <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('guru_id') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <!-- Waktu -->
                        <div class="col-span-1 lg:col-span-4 grid grid-cols-1 md:grid-cols-4 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Hari</label>
                                <div class="relative">
                                    <select wire:model="hari" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 transition-colors appearance-none bg-white">
                                        <option value="">-- Pilih Hari --</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                    </select>
                                </div>
                                @error('hari') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Jam Ke-</label>
                                <input type="number" wire:model="jam_ke" min="1" max="15" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 transition-colors">
                                @error('jam_ke') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Waktu Mulai</label>
                                <input type="time" wire:model="waktu_mulai" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 transition-colors">
                                @error('waktu_mulai') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Waktu Selesai</label>
                                <input type="time" wire:model="waktu_selesai" class="block w-full rounded-xl border-slate-200 shadow-sm focus:border-brand-500 focus:ring focus:ring-brand-200 focus:ring-opacity-50 transition-colors">
                                @error('waktu_selesai') <span class="text-rose-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                        <button type="button" wire:click="resetForm" class="px-6 py-2.5 border border-slate-200 text-slate-600 rounded-xl font-semibold text-sm hover:bg-slate-50 hover:text-slate-900 transition-all">Batal</button>
                        <x-animated-button type="submit" variant="primary" icon="<svg fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'></path></svg>">
                            Simpan Data
                        </x-animated-button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <x-modern-card>
        <div class="overflow-x-auto -mx-6 px-6 relative">
            <div wire:loading wire:target="search, previousPage, nextPage, gotoPage" class="absolute inset-0 z-10 bg-white/50 backdrop-blur-sm flex items-center justify-center rounded-xl">
                <svg class="animate-spin h-8 w-8 text-brand-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>
            
            <table class="min-w-full divide-y divide-slate-100">
                <thead>
                    <tr>
                        <th class="px-4 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Hari & Waktu</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Kelas</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Mata Pelajaran</th>
                        <th class="px-4 py-4 text-left text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Guru</th>
                        <th class="px-4 py-4 text-right text-xs font-bold text-slate-400 uppercase tracking-wider whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($jadwals as $jadwal)
                        <tr class="hover:bg-slate-50/70 transition-colors group">
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 rounded-xl bg-indigo-50 border border-indigo-100 flex flex-col items-center justify-center">
                                        <span class="text-xs font-bold text-indigo-700 uppercase">{{ substr($jadwal->hari, 0, 3) }}</span>
                                        <span class="text-[10px] text-indigo-500 font-semibold">{{ $jadwal->jam_ke }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-sm font-bold text-slate-800">{{ $jadwal->hari }}</span>
                                        <span class="text-xs font-medium text-slate-500 flex items-center gap-1 mt-0.5">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ substr($jadwal->waktu_mulai, 0, 5) }} - {{ substr($jadwal->waktu_selesai, 0, 5) }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-lg text-xs font-bold bg-slate-100 text-slate-700 border border-slate-200">
                                    {{ $jadwal->kelas->nama_kelas }}
                                </span>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-sm font-bold text-slate-900">
                                {{ $jadwal->mapel->nama_mapel }}
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-2 text-sm font-medium text-slate-700">
                                    <div class="w-6 h-6 rounded-full bg-brand-50 flex items-center justify-center text-brand-600 font-bold text-xs shrink-0">
                                        {{ substr($jadwal->guru->nama, 0, 1) }}
                                    </div>
                                    {{ $jadwal->guru->nama }}
                                </div>
                            </td>
                            <td class="px-4 py-4 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <button wire:click="edit({{ $jadwal->id }})" class="p-2 text-sky-600 hover:bg-sky-50 rounded-lg transition-colors" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="delete({{ $jadwal->id }})" wire:confirm="Yakin ingin menghapus jadwal ini?" class="p-2 text-rose-500 hover:bg-rose-50 rounded-lg transition-colors" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-12 text-center text-slate-500">
                                <div class="flex flex-col items-center justify-center">
                                    <svg class="w-12 h-12 text-slate-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    <p class="text-base font-medium">Tidak ada data jadwal yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($jadwals->hasPages())
            <div class="mt-6 pt-6 border-t border-slate-100">
                {{ $jadwals->links() }}
            </div>
        @endif
    </x-modern-card>
</div>
