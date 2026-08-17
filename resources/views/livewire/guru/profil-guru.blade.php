<div class="space-y-6">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium">
        <a href="{{ route('guru.dashboard') }}" wire:navigate class="hover:text-primary transition-colors">Portal Guru</a>
        <span class="material-symbols-outlined text-[14px]">chevron_right</span>
        <span class="text-text-main font-semibold">Profil Tenaga Pendidik</span>
    </div>

    <!-- Alert Flash -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
            <span class="font-label-md text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <!-- Bento Grid Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        <!-- Identity Card (8 Cols) -->
        <div class="lg:col-span-8 bg-surface-container-lowest rounded-2xl shadow-card p-6 md:p-8 border border-border-default relative overflow-hidden group">
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6 relative z-10">
                <div class="w-24 h-24 sm:w-28 sm:h-28 rounded-2xl bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-3xl shrink-0 shadow-md">
                    {{ substr($nama, 0, 1) }}
                </div>
                <div class="flex-1 w-full space-y-2">
                    <div class="flex flex-wrap justify-between items-start gap-2">
                        <div>
                            <h2 class="font-headline-lg text-2xl font-bold text-text-main">{{ $nama }}</h2>
                            <p class="text-xs text-on-surface-variant flex items-center gap-1.5 mt-0.5 font-mono">
                                <span class="material-symbols-outlined text-[16px] text-primary">badge</span>
                                <span>NIP/NUPTK: {{ $nip }}</span>
                            </p>
                        </div>
                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-primary/20">
                            {{ $golongan }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 border-t border-border-default text-xs">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-outline text-[18px]">mail</span>
                            <div>
                                <p class="text-on-surface-variant text-[11px]">Email Resmi</p>
                                <p class="font-semibold text-text-main">{{ $email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-outline text-[18px]">phone</span>
                            <div>
                                <p class="text-on-surface-variant text-[11px]">Telepon / WhatsApp</p>
                                <p class="font-semibold text-text-main">{{ $phone }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Stats & Edit Trigger (4 Cols) -->
        <div class="lg:col-span-4 flex flex-col gap-4">
            <div class="bg-surface-container-lowest rounded-2xl shadow-card p-5 border border-border-default flex items-center justify-between">
                <div>
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1 font-semibold">Total Rombel Diajar</p>
                    <p class="font-headline-md text-2xl font-bold text-text-main">{{ $jadwals->count() }} <span class="text-xs font-normal text-outline">Rombel</span></p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">school</span>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl shadow-card p-5 border border-border-default flex items-center justify-between">
                <div>
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1 font-semibold">Beban Mengajar</p>
                    <p class="font-headline-md text-2xl font-bold text-text-main">24 <span class="text-xs font-normal text-outline">Jam / Minggu</span></p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">schedule</span>
                </div>
            </div>

            <button wire:click="openEdit" class="w-full h-touch-target bg-surface hover:bg-surface-container text-text-main rounded-xl font-label-md text-sm font-semibold shadow-xs flex items-center justify-center gap-2 border border-border-default transition-colors">
                <span class="material-symbols-outlined text-[18px]">edit</span>
                <span>Edit Profil Guru</span>
            </button>
        </div>

        <!-- Subjects Taught List (12 Cols) -->
        <div class="lg:col-span-12 bg-surface-container-lowest rounded-2xl shadow-card p-6 md:p-8 border border-border-default space-y-4">
            <h3 class="font-headline-md text-base font-bold text-text-main flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">book</span>
                <span>Mata Pelajaran &amp; Jadwal Mengajar Aktif</span>
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @forelse($jadwals as $j)
                    <div class="p-4 rounded-xl bg-surface border border-border-default/80 flex justify-between items-center hover-lift transition-all">
                        <div>
                            <h4 class="font-label-md text-sm font-bold text-text-main">{{ $j->mapel->nama_mapel ?? 'Mapel' }}</h4>
                            <p class="text-xs text-on-surface-variant mt-0.5">Kelas {{ $j->kelas->tingkat ?? '' }} {{ $j->kelas->nama_kelas ?? '' }} &bull; Hari {{ $j->hari }}</p>
                        </div>
                        <span class="bg-surface-container-high px-2.5 py-1 rounded-md text-xs font-bold text-on-surface-variant">Jam {{ $j->jam_ke }}</span>
                    </div>
                @empty
                    <div class="col-span-full py-8 text-center text-xs text-on-surface-variant">
                        Belum ada data jadwal mengajar aktif terhubung ke akun Anda.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Edit Profile Modal -->
    @if($isEditOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs animate-fade-in">
            <div class="bg-surface-container-lowest rounded-2xl max-w-md w-full p-6 shadow-2xl border border-border-default flex flex-col gap-4">
                <div class="flex justify-between items-center border-b border-border-default pb-3">
                    <h3 class="font-headline-md text-lg font-bold text-text-main">Edit Profil Guru</h3>
                    <button wire:click="$set('isEditOpen', false)" class="text-on-surface-variant hover:bg-surface-container p-1 rounded-full">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form wire:submit.prevent="updateProfile" class="space-y-4 text-sm">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Nama Lengkap &amp; Gelar</label>
                        <input wire:model="nama" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">NIP / NUPTK</label>
                        <input wire:model="nip" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Telepon / HP</label>
                        <input wire:model="phone" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-border-default">
                        <button type="button" wire:click="$set('isEditOpen', false)" class="px-4 py-2 bg-surface text-on-surface-variant rounded-lg font-label-md hover:bg-surface-container">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-primary text-on-primary rounded-lg font-label-md hover:bg-primary-container">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
