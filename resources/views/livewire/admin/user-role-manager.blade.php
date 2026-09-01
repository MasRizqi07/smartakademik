<div class="space-y-6">
    <!-- Header Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold text-text-primary tracking-tight">Manajemen Pengguna & Peran (RBAC)</h1>
            <p class="text-sm text-text-secondary mt-1">Kelola akun pengguna portal madrasah, penetapan hak akses peran, dan reset kata sandi.</p>
        </div>
        <button wire:click="openCreateModal" class="inline-flex items-center gap-2 px-4 py-2.5 bg-brand text-white font-semibold text-xs rounded-lg shadow-sm hover:bg-brand-hover transition-all active:scale-95">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            <span>Tambah Pengguna Baru</span>
        </button>
    </div>

    <!-- Alert Notifications -->
    @if (session()->has('message'))
        <div class="p-4 bg-status-hadir/10 border border-status-hadir/30 text-status-hadir text-xs font-semibold rounded-xl flex items-center gap-2 shadow-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span>{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="p-4 bg-status-alfa/10 border border-status-alfa/30 text-status-alfa text-xs font-semibold rounded-xl flex items-center gap-2 shadow-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- 4 KPI Role Cards -->
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-surface rounded-2xl p-4 border border-border shadow-card">
            <div class="text-[11px] font-bold text-text-secondary uppercase">Total Pengguna</div>
            <div class="text-2xl font-extrabold text-text-primary mt-1">{{ $totalUsers }}</div>
            <div class="text-[10px] text-text-secondary mt-0.5">Akun Aktif Terdaftar</div>
        </div>
        <div class="bg-surface rounded-2xl p-4 border border-border shadow-card">
            <div class="text-[11px] font-bold text-brand uppercase">Guru Pengampu</div>
            <div class="text-2xl font-extrabold text-brand mt-1">{{ $guruCount }}</div>
            <div class="text-[10px] text-text-secondary mt-0.5">Hak Akses Presensi & Nilai</div>
        </div>
        <div class="bg-surface rounded-2xl p-4 border border-border shadow-card">
            <div class="text-[11px] font-bold text-blue-600 uppercase">Siswa Terdata</div>
            <div class="text-2xl font-extrabold text-blue-600 mt-1">{{ $siswaCount }}</div>
            <div class="text-[10px] text-text-secondary mt-0.5">Portal Rapor & Jadwal</div>
        </div>
        <div class="bg-surface rounded-2xl p-4 border border-border shadow-card">
            <div class="text-[11px] font-bold text-amber-600 uppercase">Admin TU & Waka</div>
            <div class="text-2xl font-extrabold text-amber-600 mt-1">{{ $adminCount + $wakaCount }}</div>
            <div class="text-[10px] text-text-secondary mt-0.5">Akses Penuh Manajemen</div>
        </div>
    </div>

    <!-- Search & Filter Controls -->
    <div class="bg-surface p-4 rounded-2xl border border-border shadow-xs flex flex-col sm:flex-row gap-3 items-center justify-between">
        <div class="relative w-full sm:w-80">
            <svg class="w-4 h-4 text-text-secondary absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
            </svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari nama atau email pengguna..." class="w-full pl-9 pr-4 py-2 text-xs rounded-lg border border-border bg-surface-page focus:ring-2 focus:ring-brand/20 focus:border-brand outline-none" />
        </div>

        <div class="flex items-center gap-2 w-full sm:w-auto">
            <span class="text-xs font-semibold text-text-secondary">Filter Peran:</span>
            <select wire:model.live="filterRole" class="text-xs font-medium py-1.5 px-3 rounded-lg border border-border bg-surface-page focus:ring-1 focus:ring-brand">
                <option value="">Semua Peran</option>
                <option value="admin_tu">Admin TU</option>
                <option value="waka_kurikulum">Waka Kurikulum</option>
                <option value="guru">Guru</option>
                <option value="siswa">Siswa</option>
            </select>
        </div>
    </div>

    <!-- Users Data Table -->
    <div class="bg-surface rounded-2xl border border-border shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm border-collapse">
                <thead>
                    <tr class="bg-surface-page border-b border-border text-[11px] font-bold text-text-secondary uppercase tracking-wider">
                        <th class="py-3 px-5">Nama Pengguna</th>
                        <th class="py-3 px-5">Email / Akun Login</th>
                        <th class="py-3 px-5">Peran Sistem (Role)</th>
                        <th class="py-3 px-5 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-border">
                    @forelse($users as $u)
                        @php
                            $roleName = $u->roles->first()?->name ?? 'Belum ada peran';
                        @endphp
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="py-3.5 px-5 font-bold text-text-primary">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-brand/10 text-brand font-bold text-xs flex items-center justify-center">
                                        {{ substr($u->name, 0, 1) }}
                                    </div>
                                    <span>{{ $u->name }}</span>
                                </div>
                            </td>
                            <td class="py-3.5 px-5 text-xs text-text-secondary font-mono">
                                {{ $u->email }}
                            </td>
                            <td class="py-3.5 px-5">
                                @if($roleName === 'admin_tu')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-purple-50 text-purple-700 border border-purple-200">
                                        Admin TU
                                    </span>
                                @elseif($roleName === 'waka_kurikulum')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                        Waka Kurikulum
                                    </span>
                                @elseif($roleName === 'guru')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-brand-surface text-brand border border-brand/30">
                                        Guru Pengampu
                                    </span>
                                @elseif($roleName === 'siswa')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                        Siswa
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-bold bg-slate-100 text-slate-700">
                                        {{ $roleName }}
                                    </span>
                                @endif
                            </td>
                            <td class="py-3.5 px-5 text-right">
                                <div class="inline-flex items-center gap-2">
                                    <button wire:click="openEditModal({{ $u->id }})" class="p-1.5 text-text-secondary hover:text-brand hover:bg-brand-surface rounded-lg transition-colors" title="Edit Akun & Peran">
                                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                    @if($u->id !== auth()->id())
                                        <button wire:click="deleteUser({{ $u->id }})" wire:confirm="Yakin ingin menghapus akun {{ $u->name }}?" class="p-1.5 text-text-secondary hover:text-status-alfa hover:bg-status-alfa/10 rounded-lg transition-colors" title="Hapus Akun">
                                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="py-8 text-center text-xs text-text-secondary">
                                Tidak ada data pengguna yang sesuai dengan kriteria.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-4 border-t border-border">
            {{ $users->links() }}
        </div>
    </div>

    <!-- Create / Edit User Modal -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/40 backdrop-blur-xs">
            <div class="bg-surface rounded-2xl p-6 border border-border shadow-xl max-w-md w-full space-y-4">
                <div class="flex items-center justify-between pb-3 border-b border-border">
                    <h3 class="font-bold text-sm text-text-primary">
                        {{ $userId ? 'Edit Akun Pengguna' : 'Tambah Pengguna Baru' }}
                    </h3>
                    <button wire:click="$set('isModalOpen', false)" class="text-text-secondary hover:text-text-primary">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
                    </button>
                </div>

                <form wire:submit="save" class="space-y-4 text-xs">
                    <div>
                        <label class="block font-semibold text-text-primary mb-1">Nama Lengkap</label>
                        <input wire:model="name" type="text" class="w-full py-2 px-3 rounded-lg border border-border bg-surface-page focus:ring-1 focus:ring-brand outline-none" placeholder="Contoh: Muhammad Rizqi, S.Pd." required />
                        @error('name') <span class="text-status-alfa text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-text-primary mb-1">Email / Username Login</label>
                        <input wire:model="email" type="email" class="w-full py-2 px-3 rounded-lg border border-border bg-surface-page focus:ring-1 focus:ring-brand outline-none" placeholder="email@man4jombang.sch.id" required />
                        @error('email') <span class="text-status-alfa text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-text-primary mb-1">Peran Akun (Role)</label>
                        <select wire:model="role" class="w-full py-2 px-3 rounded-lg border border-border bg-surface-page focus:ring-1 focus:ring-brand outline-none">
                            <option value="guru">Guru Pengampu</option>
                            <option value="siswa">Siswa</option>
                            <option value="waka_kurikulum">Waka Kurikulum</option>
                            <option value="admin_tu">Admin TU</option>
                        </select>
                        @error('role') <span class="text-status-alfa text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block font-semibold text-text-primary mb-1">
                            {{ $userId ? 'Kata Sandi Baru (Kosongkan jika tidak diubah)' : 'Kata Sandi' }}
                        </label>
                        <input wire:model="password" type="password" class="w-full py-2 px-3 rounded-lg border border-border bg-surface-page focus:ring-1 focus:ring-brand outline-none" placeholder="Minimal 6 karakter" {{ $userId ? '' : 'required' }} />
                        @error('password') <span class="text-status-alfa text-[10px]">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-border">
                        <button wire:click="$set('isModalOpen', false)" type="button" class="px-4 py-2 text-xs font-semibold rounded-lg border border-border text-text-secondary hover:bg-slate-50">Batal</button>
                        <button type="submit" class="px-5 py-2 text-xs font-bold rounded-lg bg-brand text-white hover:bg-brand-hover shadow-xs">Simpan Pengguna</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
