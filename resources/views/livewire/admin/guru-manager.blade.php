<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
        <div class="p-6 bg-white border-b border-slate-200">
            
            <!-- Header & Actions -->
            <div class="flex justify-between items-center mb-6">
                <div class="w-1/3">
                    <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari NIP/NUPTK atau Nama..." 
                           class="w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                </div>
                <button wire:click="create" class="px-4 py-2 bg-emerald-600 text-white rounded-md font-semibold text-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                    + Tambah Guru
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
                <div class="mb-6 p-4 bg-slate-50 border border-slate-200 rounded-md">
                    <h3 class="text-lg font-semibold mb-4 text-slate-900">{{ $guruId ? 'Edit Guru' : 'Tambah Guru Baru' }}</h3>
                    <form wire:submit="store">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700">NIP / NUPTK</label>
                                <input type="text" wire:model="nip_nuptk" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                @error('nip_nuptk') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-slate-700">Nama Guru</label>
                                <input type="text" wire:model="nama" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                                @error('nama') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        @if(!$guruId)
                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" wire:model.live="create_user_account" class="rounded border-slate-300 text-emerald-600 shadow-sm focus:border-emerald-300 focus:ring focus:ring-emerald-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-slate-700">Buat Akun Login untuk Guru</span>
                            </label>
                        </div>
                        
                        @if($create_user_account)
                        <div class="mb-4 p-4 border border-emerald-200 bg-emerald-50 rounded-md">
                            <label class="block text-sm font-medium text-slate-700">Email Akun (Password default = NIP/NUPTK)</label>
                            <input type="email" wire:model="email" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base" placeholder="guru@sekolah.com">
                            @error('email') <span class="text-rose-500 text-xs">{{ $message }}</span> @enderror
                        </div>
                        @endif
                        @endif

                        <div class="flex justify-end gap-2 mt-4">
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">NIP/NUPTK</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Akun Login</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-slate-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-slate-200">
                        @forelse ($gurus as $guru)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $guru->nip_nuptk }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $guru->nama }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">
                                    @if($guru->user_id)
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-emerald-100 text-emerald-800">Aktif</span>
                                    @else
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-slate-800">Tidak ada</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <button wire:click="edit({{ $guru->id }})" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</button>
                                    <button wire:click="delete({{ $guru->id }})" wire:confirm="Yakin ingin menghapus guru ini?" class="text-rose-600 hover:text-rose-900">Hapus</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 whitespace-nowrap text-sm text-center text-slate-500">
                                    Tidak ada data guru ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $gurus->links() }}
            </div>

        </div>
    </div>
</div>
