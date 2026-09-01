<div class="space-y-6">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-xs text-on-surface-variant font-medium">
        <a href="{{ route('guru.dashboard') }}" wire:navigate class="hover:text-primary transition-colors">Portal Guru</a>
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
        <span class="text-text-main font-semibold">Profil Tenaga Pendidik</span>
    </div>

    <!-- Alert Flash -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
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
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>
                                <span>NIP/NUPTK: {{ $nip }}</span>
                            </p>
                        </div>
                        <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider border border-primary/20">
                            {{ $golongan }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pt-3 border-t border-border-default text-xs">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                            <div>
                                <p class="text-on-surface-variant text-[11px]">Email Resmi</p>
                                <p class="font-semibold text-text-main">{{ $email }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
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
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                </div>
            </div>

            <div class="bg-surface-container-lowest rounded-2xl shadow-card p-5 border border-border-default flex items-center justify-between">
                <div>
                    <p class="text-xs text-on-surface-variant uppercase tracking-wider mb-1 font-semibold">Beban Mengajar</p>
                    <p class="font-headline-md text-2xl font-bold text-text-main">24 <span class="text-xs font-normal text-outline">Jam / Minggu</span></p>
                </div>
                <div class="w-11 h-11 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </div>
            </div>

            <button wire:click="openEdit" class="w-full h-touch-target bg-surface hover:bg-surface-container text-text-main rounded-xl font-label-md text-sm font-semibold shadow-xs flex items-center justify-center gap-2 border border-border-default transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" /></svg>
                <span>Edit Profil Guru</span>
            </button>
        </div>

        <!-- Subjects Taught List (12 Cols) -->
        <div class="lg:col-span-12 bg-surface-container-lowest rounded-2xl shadow-card p-6 md:p-8 border border-border-default space-y-4">
            <h3 class="font-headline-md text-base font-bold text-text-main flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
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
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" /></svg>
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
