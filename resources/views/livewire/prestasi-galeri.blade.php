<div class="space-y-8">
    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-text-main">Galeri Prestasi Siswa</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Portofolio capaian akademik, sains, olahraga, seni, dan keagamaan santri MAN 4 Jombang.</p>
        </div>
        <button wire:click="openAdd" class="bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md rounded-lg h-touch-target px-6 shadow-sm transition-all flex items-center gap-2 w-full md:w-auto justify-center active:scale-95">
            <span class="material-symbols-outlined text-[20px]">add</span>
            <span>Tambah Prestasi</span>
        </button>
    </div>

    <!-- Feedback Message -->
    @if (session()->has('message'))
        <div class="p-4 bg-status-hadir/15 border border-status-hadir/30 text-status-hadir rounded-xl flex items-center gap-2 font-medium">
            <span class="material-symbols-outlined">check_circle</span>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Filters & KPI Bento -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-card border border-border-default flex flex-col justify-center">
            <div class="text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider mb-1">Total Prestasi</div>
            <div class="font-headline-lg text-2xl font-bold text-primary">{{ $totalCount }}</div>
            <div class="text-xs text-status-hadir flex items-center gap-1 mt-2">
                <span class="material-symbols-outlined text-[16px]">trending_up</span>
                <span>+15% Tahun Ajaran Ini</span>
            </div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-card border border-border-default flex flex-col justify-center">
            <div class="text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider mb-1">Tingkat Nasional</div>
            <div class="font-headline-lg text-2xl font-bold text-text-main">{{ $nationalCount }}</div>
            <div class="text-xs text-secondary mt-2">Sains &amp; Kejuaraan</div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-5 shadow-card border border-border-default flex flex-col justify-center">
            <div class="text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider mb-1">Tingkat Provinsi</div>
            <div class="font-headline-lg text-2xl font-bold text-text-main">{{ $provincialCount }}</div>
            <div class="text-xs text-secondary mt-2">Jawa Timur &amp; Wilayah</div>
        </div>

        <div class="bg-surface-container-lowest rounded-xl p-4 shadow-card border border-border-default flex flex-col justify-center gap-2">
            <label class="text-on-surface-variant font-label-sm text-label-sm block">Filter Kategori</label>
            <div class="flex flex-wrap gap-1">
                @foreach(['Semua', 'Akademik', 'Olahraga', 'Seni', 'Keagamaan'] as $cat)
                    <button wire:click="$set('category', '{{ $cat }}')" class="px-2.5 py-1 text-xs rounded-md transition-colors {{ $category === $cat ? 'bg-primary text-on-primary font-bold' : 'bg-surface text-secondary hover:bg-surface-container' }}">
                        {{ $cat }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="bg-surface-container-lowest p-3 rounded-xl border border-border-default shadow-card flex items-center gap-3">
        <span class="material-symbols-outlined text-outline ml-2">search</span>
        <input wire:model.live.debounce.300ms="search" class="w-full bg-transparent border-none focus:ring-0 font-body-default text-text-main placeholder-outline text-sm" placeholder="Cari nama siswa, judul perlombaan, cabang kejuaraan..." type="text">
    </div>

    <!-- Achievement Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($items as $item)
            <div wire:click="openDetail({{ $item['id'] }})" class="bg-surface-container-lowest rounded-xl shadow-card border border-border-default p-6 flex flex-col justify-between hover-lift cursor-pointer group transition-all">
                <div>
                    <div class="flex items-center justify-between gap-2 mb-3">
                        <span class="px-2.5 py-0.5 rounded-full text-[11px] font-bold uppercase tracking-wide border {{ $item['tingkat'] === 'Nasional' ? 'bg-primary/10 text-primary border-primary/20' : ($item['tingkat'] === 'Provinsi' ? 'bg-status-izin/10 text-status-izin border-status-izin/20' : 'bg-surface-container text-on-surface border-border-default') }}">
                            {{ $item['tingkat'] }}
                        </span>
                        <span class="text-xs text-on-surface-variant">{{ $item['tanggal'] }}</span>
                    </div>
                    <h3 class="font-headline-md text-[18px] font-bold text-text-main mb-2 group-hover:text-primary transition-colors">
                        {{ $item['judul'] }}
                    </h3>
                    <p class="font-body-default text-body-default text-on-surface-variant text-sm line-clamp-3 mb-4 leading-relaxed">
                        {{ $item['deskripsi'] }}
                    </p>
                </div>

                <div class="pt-4 border-t border-border-default flex items-center justify-between">
                    <div class="flex items-center gap-2.5">
                        <div class="w-8 h-8 rounded-full bg-secondary-container text-on-secondary-container flex items-center justify-center font-bold text-xs">
                            {{ substr($item['siswa'], 0, 1) }}
                        </div>
                        <div>
                            <div class="font-label-md text-sm font-semibold text-text-main">{{ $item['siswa'] }}</div>
                            <div class="text-xs text-on-surface-variant">{{ $item['kelas'] }}</div>
                        </div>
                    </div>
                    <span class="material-symbols-outlined text-outline group-hover:text-primary group-hover:translate-x-1 transition-all text-[20px]">arrow_forward</span>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-on-surface-variant">
                <span class="material-symbols-outlined text-4xl mb-2 text-outline">search_off</span>
                <p>Tidak ada prestasi yang sesuai dengan kriteria pencarian.</p>
            </div>
        @endforelse
    </div>

    <!-- Detail Modal Dialog -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs animate-fade-in">
            <div class="bg-surface-container-lowest rounded-2xl max-w-lg w-full p-6 shadow-2xl border border-border-default flex flex-col gap-4">
                <div class="flex justify-between items-start">
                    <div class="flex items-center gap-2">
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-primary/10 text-primary border border-primary/20 uppercase">
                            {{ $modalLevel }}
                        </span>
                        <span class="px-2.5 py-0.5 rounded-full text-xs font-bold bg-surface-container text-on-surface uppercase">
                            {{ $modalCategory }}
                        </span>
                    </div>
                    <button wire:click="$set('isModalOpen', false)" class="text-on-surface-variant hover:bg-surface-container p-1 rounded-full">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <div>
                    <h3 class="font-headline-lg text-xl font-bold text-text-main mb-1">{{ $modalTitle }}</h3>
                    <p class="font-label-md text-primary font-semibold">{{ $modalStudent }}</p>
                    <p class="text-xs text-on-surface-variant mt-0.5">{{ $modalDate }}</p>
                </div>

                <div class="p-4 bg-surface rounded-xl border border-border-default/60 text-sm text-on-surface-variant leading-relaxed">
                    {{ $modalDesc }}
                </div>

                <div class="flex justify-end gap-2 pt-2">
                    <button wire:click="$set('isModalOpen', false)" class="px-5 py-2.5 bg-primary text-on-primary rounded-lg font-label-md hover:bg-primary-container transition-colors">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif

    <!-- Add Achievement Modal -->
    @if($isAddOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs animate-fade-in">
            <div class="bg-surface-container-lowest rounded-2xl max-w-md w-full p-6 shadow-2xl border border-border-default flex flex-col gap-4">
                <div class="flex justify-between items-center border-b border-border-default pb-3">
                    <h3 class="font-headline-md text-lg font-bold text-text-main">Tambah Capaian Prestasi</h3>
                    <button wire:click="$set('isAddOpen', false)" class="text-on-surface-variant hover:bg-surface-container p-1 rounded-full">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form wire:submit.prevent="saveAchievement" class="space-y-4 text-sm">
                    <div>
                        <label class="block font-label-sm text-on-surface-variant mb-1">Nama Siswa</label>
                        <input wire:model="newNamaSiswa" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Contoh: Ahmad Fauzi">
                    </div>

                    <div>
                        <label class="block font-label-sm text-on-surface-variant mb-1">Kelas</label>
                        <input wire:model="newKelas" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Contoh: XII MIPA 1">
                    </div>

                    <div>
                        <label class="block font-label-sm text-on-surface-variant mb-1">Judul Prestasi / Kejuaraan</label>
                        <input wire:model="newJudul" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Contoh: Juara 1 Robotika Madrasah">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-label-sm text-on-surface-variant mb-1">Kategori</label>
                            <select wire:model="newKategori" class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                                <option value="Akademik">Akademik</option>
                                <option value="Olahraga">Olahraga</option>
                                <option value="Seni">Seni</option>
                                <option value="Keagamaan">Keagamaan</option>
                            </select>
                        </div>
                        <div>
                            <label class="block font-label-sm text-on-surface-variant mb-1">Tingkat</label>
                            <select wire:model="newTingkat" class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                                <option value="Nasional">Nasional</option>
                                <option value="Provinsi">Provinsi</option>
                                <option value="Kabupaten">Kabupaten</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block font-label-sm text-on-surface-variant mb-1">Deskripsi / Keterangan</label>
                        <textarea wire:model="newDeskripsi" rows="3" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm" placeholder="Uraikan detail perlombaan atau penyelenggara..."></textarea>
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-border-default">
                        <button type="button" wire:click="$set('isAddOpen', false)" class="px-4 py-2 bg-surface text-on-surface-variant rounded-lg font-label-md hover:bg-surface-container">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-primary text-on-primary rounded-lg font-label-md hover:bg-primary-container">
                            Simpan Prestasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
