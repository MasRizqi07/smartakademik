<div class="space-y-6">
    <!-- Header Title & Actions -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Manajemen Jadwal Pelajaran</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Susun dan pantau jadwal kegiatan belajar mengajar lintas kelas dan guru di MAN 4 Jombang.</p>
        </div>
        <button wire:click="create" class="px-5 h-touch-target bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 active:scale-95">
            <span class="material-symbols-outlined text-[20px]">add_circle</span>
            <span>Tambah Jadwal Baru</span>
        </button>
    </div>

    <!-- Alert Flash -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
            <span class="font-label-md text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Filter Card & Day Selector Pills -->
    <div class="bg-surface-container-lowest p-6 rounded-2xl shadow-card border border-border-default space-y-4">
        <!-- Day Pills -->
        <div class="flex flex-wrap items-center gap-2">
            @php
                $days = ['' => 'Semua Hari', 'Senin' => 'Senin', 'Selasa' => 'Selasa', 'Rabu' => 'Rabu', 'Kamis' => 'Kamis', 'Jumat' => 'Jumat', 'Sabtu' => 'Sabtu'];
            @endphp
            @foreach($days as $key => $label)
                <button wire:click="$set('selectedHari', '{{ $key }}')" 
                        class="px-4 py-2 rounded-lg text-xs font-bold transition-all {{ $selectedHari === $key ? 'bg-primary text-on-primary shadow-xs' : 'bg-surface hover:bg-surface-container text-on-surface-variant' }}">
                    {{ $label }}
                </button>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2 border-t border-border-default/60">
            <div>
                <label class="block text-xs font-semibold text-on-surface-variant mb-1">Cari Guru / Mapel / Kelas</label>
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[18px]">search</span>
                    <input type="text" wire:model.live.debounce.300ms="search" placeholder="Ketik nama guru atau mapel..." class="w-full pl-9 pr-4 h-10 rounded-lg border border-border-default bg-surface text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-on-surface-variant mb-1">Filter Rombel Kelas</label>
                <select wire:model.live="selectedKelas" class="w-full h-10 rounded-lg border border-border-default bg-surface text-sm focus:ring-2 focus:ring-primary focus:border-transparent">
                    <option value="">Semua Rombel</option>
                    @foreach($kelases as $k)
                        <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama_kelas }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <!-- Form Drawer / Modal Card -->
    @if($isFormOpen)
        <div class="bg-surface-container-lowest p-6 rounded-2xl border border-border-default shadow-card flex flex-col gap-6 animate-fade-in">
            <div class="flex items-center justify-between pb-4 border-b border-border-default">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-container text-on-primary-container flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[24px]">calendar_month</span>
                    </div>
                    <h3 class="font-headline-md text-lg font-bold text-text-main">{{ $jadwalId ? 'Edit Jadwal Pelajaran' : 'Tambah Jadwal Baru' }}</h3>
                </div>
                <button type="button" wire:click="resetForm" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-full">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <form wire:submit="store" class="flex flex-col gap-5">
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Hari</label>
                        <select wire:model="hari" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm">
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                        </select>
                        @error('hari') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Jam Ke-</label>
                        <input type="number" min="1" max="12" wire:model="jam_ke" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm">
                        @error('jam_ke') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Rentang Waktu</label>
                        <div class="flex items-center gap-2">
                            <input type="text" wire:model="waktu_mulai" placeholder="07:00" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm text-center font-mono">
                            <span class="text-on-surface-variant font-bold">-</span>
                            <input type="text" wire:model="waktu_selesai" placeholder="08:30" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm text-center font-mono">
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Rombel Kelas</label>
                        <select wire:model="kelas_id" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelases as $k)
                                <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Mata Pelajaran</label>
                        <select wire:model="mapel_id" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm">
                            <option value="">-- Pilih Mapel --</option>
                            @foreach($mapels as $m)
                                <option value="{{ $m->id }}">{{ $m->kode_mapel }} - {{ $m->nama_mapel }}</option>
                            @endforeach
                        </select>
                        @error('mapel_id') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Guru Pengampu</label>
                        <select wire:model="guru_id" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm">
                            <option value="">-- Pilih Guru --</option>
                            @foreach($gurus as $g)
                                <option value="{{ $g->id }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                        @error('guru_id') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-3 border-t border-border-default">
                    <button type="button" wire:click="resetForm" class="h-touch-target px-6 border border-border-default text-secondary font-label-md text-sm rounded-lg hover:bg-surface transition-all">Batal</button>
                    <button type="submit" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-xs transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Simpan Jadwal</span>
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Data Table Container -->
    <div class="bg-surface-container-lowest rounded-xl border border-border-default shadow-card flex flex-col overflow-hidden relative">
        <div wire:loading wire:target="search, selectedHari, selectedKelas, previousPage, nextPage, gotoPage" class="absolute inset-0 z-20 bg-surface-container-lowest/70 backdrop-blur-xs flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-[36px] animate-spin">progress_activity</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase tracking-wider">
                        <th class="py-3.5 px-5 font-semibold">Hari / Jam</th>
                        <th class="py-3.5 px-5 font-semibold">Waktu KBM</th>
                        <th class="py-3.5 px-5 font-semibold">Kelas</th>
                        <th class="py-3.5 px-5 font-semibold">Mata Pelajaran</th>
                        <th class="py-3.5 px-5 font-semibold">Guru Pengampu</th>
                        <th class="py-3.5 px-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-default/60 font-body-default text-text-main">
                    @forelse ($jadwals as $j)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 px-5">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-xs font-bold bg-primary/10 text-primary uppercase">
                                    {{ $j->hari }} &bull; Jam {{ $j->jam_ke }}
                                </span>
                            </td>
                            <td class="py-3.5 px-5 font-mono text-xs text-on-surface-variant">
                                {{ substr($j->waktu_mulai, 0, 5) }} - {{ substr($j->waktu_selesai, 0, 5) }}
                            </td>
                            <td class="py-3.5 px-5 font-semibold text-text-main">
                                {{ $j->kelas->tingkat ?? '' }} {{ $j->kelas->nama_kelas ?? 'N/A' }}
                            </td>
                            <td class="py-3.5 px-5 font-medium text-text-main">
                                {{ $j->mapel->nama_mapel ?? 'N/A' }}
                            </td>
                            <td class="py-3.5 px-5 text-on-surface-variant text-xs font-medium">
                                {{ $j->guru->nama ?? 'N/A' }}
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button wire:click="edit({{ $j->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit Jadwal">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    <button wire:click="delete({{ $j->id }})" wire:confirm="Yakin ingin menghapus jadwal ini?" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Jadwal">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-4 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[48px] text-outline">calendar_today</span>
                                    <p class="font-label-md text-sm font-semibold">Tidak ada jadwal pelajaran ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($jadwals->hasPages())
            <div class="p-4 border-t border-border-default bg-surface-container-low">
                {{ $jadwals->links() }}
            </div>
        @endif
    </div>
</div>
