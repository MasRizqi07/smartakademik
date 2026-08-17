<div class="flex flex-col gap-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Manajemen Mata Pelajaran</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Kelola direktori mata pelajaran, kode kurikulum, dan alokasi guru pengampu.</p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Kode atau Nama..." 
                       class="w-full pl-10 pr-4 h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
            </div>
            <button wire:click="create" class="h-touch-target px-5 bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-sm transition-all flex items-center justify-center gap-2 shrink-0 active:scale-95">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Tambah Mapel</span>
            </button>
        </div>
    </div>

    <!-- Alert Flash Message -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
            <span class="font-label-md text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Form Drawer / Modal Card -->
    @if($isFormOpen)
        <div class="bg-surface-container-lowest p-6 rounded-2xl border border-border-default shadow-card flex flex-col gap-6 animate-fade-in">
            <div class="flex items-center justify-between pb-4 border-b border-border-default">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-status-sakit/10 text-status-sakit flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[24px]">book</span>
                    </div>
                    <h3 class="font-headline-md text-lg font-bold text-text-main">{{ $mapelId ? 'Edit Mata Pelajaran' : 'Tambah Mata Pelajaran Baru' }}</h3>
                </div>
                <button type="button" wire:click="resetForm" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-full">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <form wire:submit="store" class="flex flex-col gap-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div>
                        <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Kode Mapel</label>
                        <input type="text" wire:model="kode_mapel" placeholder="Misal: MTK, FIS, BIO, B-IND" class="block w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors uppercase">
                        @error('kode_mapel') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Nama Mata Pelajaran</label>
                        <input type="text" wire:model="nama_mapel" placeholder="Misal: Matematika Wajib" class="block w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                        @error('nama_mapel') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-3 border-t border-border-default">
                    <button type="button" wire:click="resetForm" class="h-touch-target px-6 border border-border-default text-secondary font-label-md text-sm rounded-lg hover:bg-surface transition-all">Batal</button>
                    <button type="submit" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-xs transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Simpan Mapel</span>
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Data Table Container -->
    <div class="bg-surface-container-lowest rounded-xl border border-border-default shadow-card flex flex-col overflow-hidden relative">
        <div wire:loading wire:target="search, previousPage, nextPage, gotoPage" class="absolute inset-0 z-20 bg-surface-container-lowest/70 backdrop-blur-xs flex items-center justify-center">
            <span class="material-symbols-outlined text-primary text-[36px] animate-spin">progress_activity</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase tracking-wider">
                        <th class="py-3.5 px-5 font-semibold">Kode Mapel</th>
                        <th class="py-3.5 px-5 font-semibold">Nama Mata Pelajaran</th>
                        <th class="py-3.5 px-5 font-semibold">Alokasi Mengajar</th>
                        <th class="py-3.5 px-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-default/60 font-body-default text-text-main">
                    @forelse ($mapels as $mapel)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 px-5">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-md text-xs font-mono font-bold bg-secondary-container/40 text-on-secondary-container border border-border-default uppercase">
                                    {{ $mapel->kode_mapel }}
                                </span>
                            </td>
                            <td class="py-3.5 px-5 font-semibold text-text-main">{{ $mapel->nama_mapel }}</td>
                            <td class="py-3.5 px-5 text-on-surface-variant text-xs">
                                <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-surface-container text-on-surface-variant font-medium">
                                    <span class="material-symbols-outlined text-[14px] text-primary">schedule</span>
                                    Kurikulum Nasional &bull; 4 Jam/Minggu
                                </span>
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button wire:click="edit({{ $mapel->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit Data">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    <button wire:click="delete({{ $mapel->id }})" wire:confirm="Yakin ingin menghapus mapel ini? Ini akan gagal jika mapel sudah digunakan di jadwal." class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Data">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-12 px-4 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[48px] text-outline">search_off</span>
                                    <p class="font-label-md text-sm font-semibold">Tidak ada data mata pelajaran ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($mapels->hasPages())
            <div class="p-4 border-t border-border-default bg-surface-container-low">
                {{ $mapels->links() }}
            </div>
        @endif
    </div>
</div>
