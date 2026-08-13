<div class="flex flex-col gap-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg font-bold text-text-main">Manajemen Data Rombel Kelas</h2>
            <p class="font-body-default text-body-default text-on-surface-variant">Pengaturan rombongan belajar, tingkat kelas, dan penugasan wali kelas.</p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Nama Kelas..." 
                       class="w-full pl-10 pr-4 h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main placeholder:text-outline-variant focus-ring transition-colors">
            </div>
            <button wire:click="create" class="h-touch-target px-5 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs hover:shadow-md transition-all flex items-center justify-center gap-2 shrink-0 active:scale-95">
                <span class="material-symbols-outlined text-[20px]">add</span>
                <span>Tambah Kelas</span>
            </button>
        </div>
    </div>

    <!-- Alert Flash Message -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
            <span class="font-label-md">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Form Drawer / Modal Card -->
    @if($isFormOpen)
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card flex flex-col gap-6 animate-fade-in">
            <div class="flex items-center justify-between pb-4 border-b border-border-default">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-status-izin/10 text-status-izin flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[24px]">meeting_room</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md font-bold text-text-main">{{ $kelasId ? 'Edit Kelas' : 'Tambah Kelas Baru' }}</h3>
                </div>
                <button type="button" wire:click="resetForm" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-full">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <form wire:submit="store" class="flex flex-col gap-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Tingkat</label>
                        <select wire:model="tingkat" class="block w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text focus-ring transition-colors">
                            <option value="">-- Pilih Tingkat --</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                        @error('tingkat') <span class="text-error text-label-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Nama Kelas</label>
                        <input type="text" wire:model="nama_kelas" placeholder="Misal: X-A, XI-IPA-1" class="block w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text focus-ring transition-colors">
                        @error('nama_kelas') <span class="text-error text-label-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Wali Kelas (Opsional)</label>
                        <select wire:model="wali_kelas_id" class="block w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text focus-ring transition-colors">
                            <option value="">-- Tidak Ada Wali Kelas --</option>
                            @foreach($gurus as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->nama }}</option>
                            @endforeach
                        </select>
                        @error('wali_kelas_id') <span class="text-error text-label-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-border-default">
                    <button type="button" wire:click="resetForm" class="h-touch-target px-6 border border-border-default text-secondary font-label-md rounded-DEFAULT hover:bg-surface-container transition-all">Batal</button>
                    <button type="submit" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Simpan Data Kelas</span>
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
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase tracking-wider">
                        <th class="py-3.5 px-4 font-semibold">Tingkat</th>
                        <th class="py-3.5 px-4 font-semibold">Nama Rombel Kelas</th>
                        <th class="py-3.5 px-4 font-semibold">Wali Kelas</th>
                        <th class="py-3.5 px-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-default/60 font-body-default text-body-default text-text-main">
                    @forelse ($kelases as $kelas)
                        <tr class="hover:bg-surface-container-low/60 transition-colors">
                            <td class="py-3.5 px-4">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-primary-container/20 text-primary font-bold text-xs">
                                    {{ $kelas->tingkat }}
                                </span>
                            </td>
                            <td class="py-3.5 px-4 font-semibold text-text-main">{{ $kelas->nama_kelas }}</td>
                            <td class="py-3.5 px-4">
                                @if($kelas->waliKelas)
                                    <span class="font-medium text-text-main">{{ $kelas->waliKelas->nama }}</span>
                                @else
                                    <span class="text-outline text-xs italic">Belum Ditentukan</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    <button wire:click="edit({{ $kelas->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit Data">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    <button wire:click="delete({{ $kelas->id }})" wire:confirm="Yakin ingin menghapus kelas ini? Data siswa di kelas ini bisa terpengaruh." class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Data">
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
                                    <p class="font-label-md text-label-md">Tidak ada data kelas ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kelases->hasPages())
            <div class="p-4 border-t border-border-default bg-surface-container-low">
                {{ $kelases->links() }}
            </div>
        @endif
    </div>
</div>
