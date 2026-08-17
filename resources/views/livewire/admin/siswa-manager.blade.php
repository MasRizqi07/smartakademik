<div class="flex flex-col gap-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg font-bold text-text-main">Manajemen Data Siswa</h2>
            <p class="font-body-default text-body-default text-on-surface-variant">Kelola data siswa, penempatan kelas, dan akun login siswa madrasah.</p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <div class="relative w-full sm:w-64">
                <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-outline text-[20px]">search</span>
                <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari NISN atau Nama..." 
                       class="w-full pl-10 pr-4 h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main placeholder:text-outline-variant focus-ring transition-colors">
            </div>
            <button wire:click="generateMissingAccounts" wire:confirm="Buat akun login otomatis untuk semua siswa yang belum memiliki akun?" class="h-touch-target px-4 bg-secondary-container hover:bg-secondary-container/80 text-on-secondary-container font-label-md rounded-DEFAULT shadow-xs transition-all flex items-center justify-center gap-2 shrink-0 active:scale-95" title="Generate Akun Siswa">
                <span class="material-symbols-outlined text-[20px]">manage_accounts</span>
                <span class="hidden md:inline">Buat Akun Massal</span>
            </button>
            <button wire:click="create" class="h-touch-target px-5 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs hover:shadow-md transition-all flex items-center justify-center gap-2 shrink-0 active:scale-95">
                <span class="material-symbols-outlined text-[20px]">person_add</span>
                <span>Tambah Siswa</span>
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

    <!-- Drawer / Form Card -->
    @if($isFormOpen)
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card flex flex-col gap-6 animate-fade-in">
            <div class="flex items-center justify-between pb-4 border-b border-border-default">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-lg bg-primary-container/10 text-primary flex items-center justify-center font-bold">
                        <span class="material-symbols-outlined text-[24px]">person</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md font-bold text-text-main">{{ $siswaId ? 'Edit Data Siswa' : 'Tambah Siswa Baru' }}</h3>
                </div>
                <button type="button" wire:click="resetForm" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-full">
                    <span class="material-symbols-outlined text-[20px]">close</span>
                </button>
            </div>
            
            <form wire:submit="store" class="flex flex-col gap-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">NISN</label>
                        <input type="text" wire:model="nisn" class="block w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text focus-ring transition-colors" placeholder="Masukkan NISN">
                        @error('nisn') <span class="text-error text-label-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="block w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text focus-ring transition-colors" placeholder="Masukkan nama siswa">
                        @error('nama') <span class="text-error text-label-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1">Kelas</label>
                        <select wire:model="kelas_id" class="block w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text focus-ring transition-colors">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelases as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id') <span class="text-error text-label-sm mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if(!$siswaId)
                    <div class="p-4 rounded-lg border {{ $create_user_account ? 'border-primary/40 bg-primary/5' : 'border-border-default bg-surface-container-low' }} transition-colors">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" wire:model.live="create_user_account" class="h-5 w-5 rounded border-border-default text-primary focus:ring-primary">
                            <span class="font-label-md text-text-main font-semibold">Buat Akun Portal Login untuk Siswa</span>
                        </label>
                        
                        @if($create_user_account)
                            <div class="mt-4 pt-4 border-t border-border-default/60 flex flex-col gap-2">
                                <label class="block font-label-sm text-label-sm text-on-surface-variant">Email Akun <span class="text-xs text-outline font-normal">(Password otomatis = NISN)</span></label>
                                <input type="email" wire:model="email" class="block w-full h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text focus-ring" placeholder="siswa@man4jombang.sch.id">
                                @error('email') <span class="text-error text-label-sm mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                @endif

                <div class="flex justify-end gap-3 pt-4 border-t border-border-default">
                    <button type="button" wire:click="resetForm" class="h-touch-target px-6 border border-border-default text-secondary font-label-md rounded-DEFAULT hover:bg-surface-container transition-all">Batal</button>
                    <button type="submit" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs transition-all flex items-center gap-2">
                        <span class="material-symbols-outlined text-[18px]">save</span>
                        <span>Simpan Data</span>
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
                        <th class="py-3.5 px-4 font-semibold">NISN</th>
                        <th class="py-3.5 px-4 font-semibold">Nama Siswa</th>
                        <th class="py-3.5 px-4 font-semibold">Kelas</th>
                        <th class="py-3.5 px-4 font-semibold">Status Akun</th>
                        <th class="py-3.5 px-4 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-default/60 font-body-default text-body-default text-text-main">
                    @forelse ($siswas as $siswa)
                        <tr class="hover:bg-surface-container-low/60 transition-colors">
                            <td class="py-3.5 px-4 font-mono font-medium text-slate-700">{{ $siswa->nisn }}</td>
                            <td class="py-3.5 px-4 font-medium">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ substr($siswa->nama, 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-text-main">{{ $siswa->nama }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-4">
                                @if($siswa->kelas)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-secondary-container/40 text-on-secondary-container font-label-sm text-[12px]">
                                        {{ $siswa->kelas->tingkat }} - {{ $siswa->kelas->nama_kelas }}
                                    </span>
                                @else
                                    <span class="text-outline text-xs italic">Belum Ada</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4">
                                @if($siswa->user_id)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-status-hadir/10 text-status-hadir">
                                        <span class="w-1.5 h-1.5 rounded-full bg-status-hadir"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-surface-container-high text-on-surface-variant">
                                        Tidak Ada Akun
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-4 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    @if(!$siswa->user_id)
                                        <button wire:click="createUserAccount({{ $siswa->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Buat Akun Portal">
                                            <span class="material-symbols-outlined text-[20px]">person_add</span>
                                        </button>
                                    @endif
                                    <button wire:click="edit({{ $siswa->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit Data">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </button>
                                    <button wire:click="delete({{ $siswa->id }})" wire:confirm="Yakin ingin menghapus siswa ini?" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Data">
                                        <span class="material-symbols-outlined text-[20px]">delete</span>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-4 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-[48px] text-outline">search_off</span>
                                    <p class="font-label-md text-label-md">Tidak ada data siswa ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($siswas->hasPages())
            <div class="p-4 border-t border-border-default bg-surface-container-low">
                {{ $siswas->links() }}
            </div>
        @endif
    </div>
</div>

