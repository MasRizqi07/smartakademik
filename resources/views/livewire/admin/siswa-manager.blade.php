<div class="flex flex-col gap-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Manajemen Data Siswa</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Kelola direktori siswa, status akun portal, dan penempatan kelas madrasah.</p>
        </div>
        <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
            <a href="{{ route('admin.import') }}" wire:navigate class="flex-1 sm:flex-none inline-flex justify-center items-center gap-2 px-4 py-2 border border-border-default bg-surface-container-lowest text-on-surface hover:bg-surface-container-low font-label-md text-sm rounded-lg shadow-sm transition-all h-touch-target">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                <span>Import Excel</span>
            </a>
            <button wire:click="generateMissingAccounts" wire:confirm="Buat akun login otomatis untuk semua siswa yang belum memiliki akun?" class="flex-1 sm:flex-none inline-flex justify-center items-center gap-2 px-4 py-2 bg-secondary-container hover:bg-secondary-container/80 text-on-secondary-container font-label-md text-sm rounded-lg shadow-xs transition-all h-touch-target" title="Generate Akun Siswa">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                <span class="hidden lg:inline">Buat Akun Massal</span>
            </button>
            <button wire:click="create" class="flex-1 sm:flex-none inline-flex justify-center items-center gap-2 px-4 py-2 bg-primary text-on-primary hover:bg-primary-container font-label-md text-sm rounded-lg shadow-sm transition-all h-touch-target active:scale-95">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>
                <span>Tambah Siswa</span>
            </button>
        </div>
    </div>

    <!-- Alert Flash Message -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span class="font-label-md font-semibold text-sm">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Filters Bar -->
    <div class="bg-surface-container-lowest p-4 rounded-xl shadow-card border border-border-default flex flex-col md:flex-row gap-4 items-end">
        <div class="w-full md:w-1/2">
            <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Cari Nama / NISN</label>
            <div class="relative flex items-center bg-surface border border-border-default rounded-lg px-3 py-1 focus-within:ring-2 focus-within:ring-primary focus-within:border-transparent transition-all h-10">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                <input wire:model.live.debounce.300ms="search" class="bg-transparent border-none focus:ring-0 text-sm font-input-text w-full placeholder:text-outline py-0" placeholder="Ketik nama atau NISN siswa..." type="text"/>
            </div>
        </div>

        <div class="w-full md:w-1/4">
            <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Filter Kelas</label>
            <select wire:model.live="filterKelas" class="w-full h-10 rounded-lg border border-border-default bg-surface px-3 text-sm font-input-text focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                <option value="">Semua Kelas</option>
                @foreach($kelases as $k)
                    <option value="{{ $k->id }}">{{ $k->tingkat }} - {{ $k->nama_kelas }}</option>
                @endforeach
            </select>
        </div>

        <div class="w-full md:w-1/4">
            <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Status Akun</label>
            <select wire:model.live="filterStatus" class="w-full h-10 rounded-lg border border-border-default bg-surface px-3 text-sm font-input-text focus:ring-2 focus:ring-primary focus:border-transparent transition-all">
                <option value="">Semua Status</option>
                <option value="active">Memiliki Akun</option>
                <option value="inactive">Belum Ada Akun</option>
            </select>
        </div>
    </div>

    <!-- Drawer / Add & Edit Form Card -->
    @if($isFormOpen)
        <div class="bg-surface-container-lowest p-6 rounded-2xl border border-border-default shadow-card flex flex-col gap-6 animate-fade-in">
            <div class="flex items-center justify-between pb-4 border-b border-border-default">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary-container/10 text-primary flex items-center justify-center font-bold">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                    </div>
                    <h3 class="font-headline-md text-lg font-bold text-text-main">{{ $siswaId ? 'Edit Data Siswa' : 'Tambah Siswa Baru' }}</h3>
                </div>
                <button type="button" wire:click="resetForm" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-full">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                </button>
            </div>
            
            <form wire:submit="store" class="flex flex-col gap-5">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">NISN (Nomor Induk)</label>
                        <input type="text" wire:model="nisn" class="block w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" placeholder="Contoh: 0012345678">
                        @error('nisn') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Nama Lengkap</label>
                        <input type="text" wire:model="nama" class="block w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors" placeholder="Masukkan nama siswa">
                        @error('nama') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block font-label-sm text-xs text-on-surface-variant mb-1 font-semibold">Rombongan Belajar (Kelas)</label>
                        <select wire:model="kelas_id" class="block w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent transition-colors">
                            <option value="">-- Pilih Kelas --</option>
                            @foreach($kelases as $kelas)
                                <option value="{{ $kelas->id }}">{{ $kelas->tingkat }} - {{ $kelas->nama_kelas }}</option>
                            @endforeach
                        </select>
                        @error('kelas_id') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                @if(!$siswaId)
                    <div class="p-4 rounded-xl border {{ $create_user_account ? 'border-primary/40 bg-primary/5' : 'border-border-default bg-surface' }} transition-colors">
                        <label class="flex items-center gap-3 cursor-pointer">
                            <input type="checkbox" wire:model.live="create_user_account" class="h-4 w-4 rounded border-border-default text-primary focus:ring-primary">
                            <span class="font-label-md text-sm text-text-main font-semibold">Buat Akun Portal Login Siswa Sekaligus</span>
                        </label>
                        
                        @if($create_user_account)
                            <div class="mt-3 pt-3 border-t border-border-default/60 flex flex-col gap-1.5">
                                <label class="block font-label-sm text-xs text-on-surface-variant font-semibold">Email Login <span class="text-xs text-outline font-normal">(Password default = NISN)</span></label>
                                <input type="email" wire:model="email" class="block w-full h-touch-target rounded-lg border border-border-default bg-surface font-input-text text-sm focus:ring-2 focus:ring-primary focus:border-transparent" placeholder="siswa@man4jombang.sch.id">
                                @error('email') <span class="text-error text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    </div>
                @endif

                <div class="flex justify-end gap-3 pt-3 border-t border-border-default">
                    <button type="button" wire:click="resetForm" class="h-touch-target px-6 border border-border-default text-secondary font-label-md text-sm rounded-lg hover:bg-surface transition-all">Batal</button>
                    <button type="submit" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm rounded-lg shadow-xs transition-all flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        <span>Simpan Data</span>
                    </button>
                </div>
            </form>
        </div>
    @endif

    <!-- Data Table Container -->
    <div class="bg-surface-container-lowest rounded-xl border border-border-default shadow-card flex flex-col overflow-hidden relative">
        <div wire:loading wire:target="search, filterKelas, filterStatus, previousPage, nextPage, gotoPage" class="absolute inset-0 z-20 bg-surface-container-lowest/70 backdrop-blur-xs flex items-center justify-center">
            <svg class="w-8 h-8 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse text-sm">
                <thead>
                    <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase tracking-wider">
                        <th class="py-3.5 px-5 font-semibold">NISN</th>
                        <th class="py-3.5 px-5 font-semibold">Nama Siswa</th>
                        <th class="py-3.5 px-5 font-semibold">Kelas</th>
                        <th class="py-3.5 px-5 font-semibold">Status Akun Portal</th>
                        <th class="py-3.5 px-5 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border-default/60 font-body-default text-text-main">
                    @forelse ($siswas as $siswa)
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 px-5 font-mono text-xs font-semibold text-slate-700">{{ $siswa->nisn }}</td>
                            <td class="py-3.5 px-5 font-medium">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-xs shrink-0">
                                        {{ substr($siswa->nama, 0, 1) }}
                                    </div>
                                    <span class="font-semibold text-text-main">{{ $siswa->nama }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-5">
                                @if($siswa->kelas)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full bg-secondary-container/40 text-on-secondary-container font-label-sm text-xs font-semibold">
                                        {{ $siswa->kelas->tingkat }} - {{ $siswa->kelas->nama_kelas }}
                                    </span>
                                @else
                                    <span class="text-outline text-xs italic">Belum Ada</span>
                                @endif
                            </td>
                            <td class="py-3.5 px-5">
                                @if($siswa->user_id)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-status-hadir/15 text-status-hadir">
                                        <span class="w-1.5 h-1.5 rounded-full bg-status-hadir"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-medium bg-surface-container text-on-surface-variant">
                                        Belum Ada Akun
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <div class="flex items-center justify-end gap-1">
                                    @if(!$siswa->user_id)
                                        <button wire:click="createUserAccount({{ $siswa->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Buat Akun Portal">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" /></svg>
                                        </button>
                                    @endif
                                    <button wire:click="edit({{ $siswa->id }})" class="p-2 text-primary hover:bg-primary/10 rounded-lg transition-colors" title="Edit Data">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                                    </button>
                                    <button wire:click="delete({{ $siswa->id }})" wire:confirm="Yakin ingin menghapus data siswa ini?" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Hapus Data">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" /></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-4 text-center text-on-surface-variant">
                                <div class="flex flex-col items-center justify-center gap-2">
                                    <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" /></svg>
                                    <p class="font-label-md text-sm font-semibold">Tidak ada data siswa yang cocok.</p>
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
