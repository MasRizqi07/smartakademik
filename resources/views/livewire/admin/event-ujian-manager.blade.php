<div class="space-y-6">
    <!-- Page Header -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Manajemen Event Ujian &amp; Asesmen</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Kelola agenda PTS, PAS, pembagian ruang ujian, dan penugasan pengawas madrasah.</p>
        </div>
        <button wire:click="openAddModal" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary rounded-lg font-label-md text-sm font-semibold shadow-sm transition-all flex items-center gap-2 active:scale-95">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            <span>Tambah Jadwal Asesmen</span>
        </button>
    </div>

    <!-- Alert Flash -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span class="font-label-md text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Dashboard Stats Bento -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col justify-between hover-lift transition-all">
            <div class="flex justify-between items-start mb-3">
                <span class="p-2.5 bg-secondary-container text-on-secondary-container rounded-xl">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </span>
                <span class="text-[10px] font-bold uppercase tracking-wider text-primary px-2.5 py-1 bg-primary/10 rounded-full">Aktif Semester</span>
            </div>
            <div>
                <h3 class="font-body-default text-xs text-on-surface-variant">Total Event Asesmen</h3>
                <p class="font-headline-lg text-2xl font-bold text-text-main mt-1">{{ $eventList->count() }} Ujian</p>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col justify-between hover-lift transition-all">
            <div class="flex justify-between items-start mb-3">
                <span class="p-2.5 bg-primary/10 text-primary rounded-xl">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </span>
                <span class="text-[10px] font-bold uppercase tracking-wider text-status-hadir px-2.5 py-1 bg-status-hadir/15 rounded-full">Terisi</span>
            </div>
            <div>
                <h3 class="font-body-default text-xs text-on-surface-variant">Pengawas Terploting</h3>
                <p class="font-headline-lg text-2xl font-bold text-text-main mt-1">{{ $eventList->whereNotNull('pengawas_nama')->count() }} <span class="text-xs font-normal text-on-surface-variant">/ Guru Pendidik</span></p>
            </div>
        </div>

        <div class="bg-surface-container-lowest p-5 rounded-xl border border-border-default shadow-card flex flex-col justify-between hover-lift transition-all">
            <div class="flex justify-between items-start mb-3">
                <span class="p-2.5 bg-status-izin/10 text-status-izin rounded-xl">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </span>
                <span class="text-[10px] font-bold uppercase tracking-wider text-status-izin px-2.5 py-1 bg-status-izin/15 rounded-full">Siap Pakai</span>
            </div>
            <div>
                <h3 class="font-body-default text-xs text-on-surface-variant">Ruang &amp; Lab Digunakan</h3>
                <p class="font-headline-lg text-2xl font-bold text-text-main mt-1">{{ $eventList->pluck('ruangan')->filter()->unique()->count() }} Ruang</p>
            </div>
        </div>
    </div>

    <!-- Filter Bar -->
    <div class="bg-surface-container-lowest p-4 rounded-xl shadow-card border border-border-default flex flex-col md:flex-row gap-4 items-center justify-between">
        <div class="relative w-full md:w-80">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama ujian, ruang, pengawas..." 
                   class="w-full pl-10 pr-4 h-10 rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
        </div>

        <div class="w-full md:w-64">
            <select wire:model.live="filterJenis" class="w-full h-10 rounded-lg border border-border-default bg-surface text-sm px-3 focus:ring-2 focus:ring-primary focus:border-transparent">
                <option value="">Semua Jenis Asesmen</option>
                <option value="PTS Ganjil">PTS Ganjil</option>
                <option value="PAS Ganjil">PAS Ganjil</option>
                <option value="PTS Genap">PTS Genap</option>
                <option value="PAT/AAT">PAT / AAT</option>
                <option value="Asesmen Madrasah">Asesmen Madrasah</option>
            </select>
        </div>
    </div>

    <!-- Data Table Container -->
    <div class="bg-surface-container-lowest rounded-xl border border-border-default shadow-card flex flex-col overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase tracking-wider">
                        <th class="py-3.5 px-5 font-semibold">Nama Asesmen / Mata Uji</th>
                        <th class="py-3.5 px-5 font-semibold">Tanggal &amp; Waktu</th>
                        <th class="py-3.5 px-5 font-semibold">Ruang Ujian</th>
                        <th class="py-3.5 px-5 font-semibold">Guru Pengawas</th>
                        <th class="py-3.5 px-5 font-semibold">Peserta</th>
                        <th class="py-3.5 px-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-default/60 font-body-default text-text-main">
                    @forelse ($eventList as $e)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 px-5">
                                <div class="flex items-center gap-2">
                                    <span class="w-2.5 h-2.5 rounded-full bg-primary shrink-0"></span>
                                    <div>
                                        <p class="font-bold text-text-main text-sm">{{ $e->nama }}</p>
                                        <span class="text-[11px] font-semibold text-primary uppercase">{{ $e->jenis }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-3.5 px-5">
                                <p class="font-semibold text-xs text-text-main">{{ $e->tanggal ? date('d M Y', strtotime($e->tanggal)) : '-' }}</p>
                                <p class="text-[11px] text-on-surface-variant font-mono">{{ $e->waktu }}</p>
                            </td>
                            <td class="py-3.5 px-5">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-md text-xs font-semibold bg-surface-container text-text-main border border-border-default">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                                    {{ $e->ruangan }}
                                </span>
                            </td>
                            <td class="py-3.5 px-5 text-xs text-on-surface-variant font-medium">
                                {{ $e->pengawas_nama }}
                            </td>
                            <td class="py-3.5 px-5 text-xs font-bold text-text-main">
                                {{ $e->peserta ? $e->peserta . ' Siswa' : '–' }}
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <button wire:click="deleteEvent({{ $e->id }})" wire:confirm="Hapus jadwal ujian ini?" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Ujian">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-4 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                                    <p class="font-label-md text-sm font-semibold">Tidak ada event ujian terdaftar.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal Dialog -->
    @if($isAddOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs animate-fade-in">
            <div class="bg-surface-container-lowest rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-border-default flex flex-col gap-4">
                <div class="flex justify-between items-center border-b border-border-default pb-3">
                    <h3 class="font-headline-md text-lg font-bold text-text-main">Tambah Jadwal Event Ujian</h3>
                    <button wire:click="$set('isAddOpen', false)" class="text-on-surface-variant hover:bg-surface-container p-1 rounded-full">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit.prevent="saveEvent" class="space-y-4 text-sm">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Nama Asesmen / Mata Ujian</label>
                        <input wire:model="namaUjian" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Contoh: PTS Ganjil - Matematika Wajib">
                        @error('namaUjian') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Jenis Asesmen</label>
                            <select wire:model="jenisUjian" class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                                <option value="PTS Ganjil">PTS Ganjil</option>
                                <option value="PAS Ganjil">PAS Ganjil</option>
                                <option value="PTS Genap">PTS Genap</option>
                                <option value="PAT/AAT">PAT / Asesmen Akhir Tahun</option>
                                <option value="Asesmen Madrasah">Asesmen Madrasah</option>
                            </select>
                            @error('jenisUjian') <span class="text-error text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Tanggal Ujian</label>
                            <input wire:model="tanggalUjian" type="date" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                            @error('tanggalUjian') <span class="text-error text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Ruangan / Lab</label>
                            <input wire:model="ruangan" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm" placeholder="Contoh: Ruang 01 (Lab IPA)">
                            @error('ruangan') <span class="text-error text-xs">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-on-surface-variant mb-1">Waktu Pelaksanaan</label>
                            <input wire:model="waktuUjian" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm" placeholder="07:30 - 09:30">
                            @error('waktuUjian') <span class="text-error text-xs">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Guru Pengawas</label>
                        <select wire:model="pengawasNama" class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                            @foreach($gurus as $g)
                                <option value="{{ $g->nama }}">{{ $g->nama }}</option>
                            @endforeach
                        </select>
                        @error('pengawasNama') <span class="text-error text-xs">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-border-default">
                        <button type="button" wire:click="$set('isAddOpen', false)" class="px-4 py-2 bg-surface text-on-surface-variant rounded-lg font-label-md hover:bg-surface-container">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-primary text-on-primary rounded-lg font-label-md hover:bg-primary-container">
                            Simpan Jadwal Ujian
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
