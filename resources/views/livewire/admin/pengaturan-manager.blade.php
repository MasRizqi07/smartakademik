<div class="space-y-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Pengaturan Akademik &amp; Profil Madrasah</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Kelola parameter operasional madrasah, periode tahun ajaran aktif, dan standar kurikulum.</p>
        </div>
        <button wire:click="saveSettings" class="px-6 h-touch-target bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-sm transition-all flex items-center gap-2 active:scale-95">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span>Simpan Pengaturan</span>
        </button>
    </div>

    <!-- Alert Flash Message -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span class="font-label-md text-sm font-semibold">{{ session('message') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">
        <!-- Col 1: Academic Period & System Status -->
        <div class="space-y-6">
            <!-- Active Semester Card -->
            <div class="bg-surface-container-lowest rounded-2xl p-6 shadow-card border border-border-default space-y-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-primary/10 text-primary flex items-center justify-center">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    </div>
                    <div>
                        <h3 class="font-headline-md text-base font-bold text-text-main">Periode Aktif</h3>
                        <p class="text-xs text-on-surface-variant">Tahun Pelajaran &amp; Semester</p>
                    </div>
                </div>

                <div class="space-y-4 pt-2">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Tahun Ajaran</label>
                        <select wire:model="tahunAjaran" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm">
                            <option value="2025/2026">2025/2026</option>
                            <option value="2026/2027">2026/2027</option>
                            <option value="2027/2028">2027/2028</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Semester</label>
                        <div class="grid grid-cols-2 gap-2 p-1 bg-surface rounded-xl border border-border-default">
                            <button type="button" wire:click="$set('semesterAktif', 'Ganjil')" class="py-2 rounded-lg text-xs font-bold transition-all {{ $semesterAktif === 'Ganjil' ? 'bg-primary text-on-primary shadow-xs' : 'text-on-surface-variant hover:bg-surface-container' }}">
                                Ganjil
                            </button>
                            <button type="button" wire:click="$set('semesterAktif', 'Genap')" class="py-2 rounded-lg text-xs font-bold transition-all {{ $semesterAktif === 'Genap' ? 'bg-primary text-on-primary shadow-xs' : 'text-on-surface-variant hover:bg-surface-container' }}">
                                Genap
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Standar KKM Nasional</label>
                        <div class="relative">
                            <input wire:model="kkmDefault" type="number" min="50" max="100" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm font-bold pr-12">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold text-on-surface-variant">Poin</span>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Durasi 1 Jam KBM</label>
                        <div class="relative">
                            <input wire:model="durasiJamKbm" type="number" min="30" max="60" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm font-bold pr-14">
                            <span class="absolute right-3 top-1/2 -translate-y-1/2 text-xs font-bold text-on-surface-variant">Menit</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Server Info -->
            <div class="bg-surface-container-lowest rounded-2xl p-5 shadow-card border border-border-default flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="w-3 h-3 rounded-full bg-status-hadir animate-pulse"></span>
                    <div>
                        <p class="font-bold text-xs text-text-main">Status Sinkronisasi Emis/Dapodik</p>
                        <p class="text-[11px] text-status-hadir font-medium">Terhubung &amp; Aktif</p>
                    </div>
                </div>
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </div>
        </div>

        <!-- Col 2 & 3: School Profile & Identity Form -->
        <div class="lg:col-span-2 bg-surface-container-lowest rounded-2xl p-6 md:p-8 shadow-card border border-border-default space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-border-default">
                <div class="w-10 h-10 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                </div>
                <div>
                    <h3 class="font-headline-md text-base font-bold text-text-main">Identitas Satuan Pendidikan</h3>
                    <p class="text-xs text-on-surface-variant">Data profil resmi MAN 4 Jombang pada laporan akademik dan rapor.</p>
                </div>
            </div>

            <form wire:submit.prevent="saveSettings" class="space-y-4 text-sm">
                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-1">Nama Resmi Madrasah</label>
                    <input wire:model="namaMadrasah" type="text" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm font-bold">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">NPSN</label>
                        <input wire:model="npsn" type="text" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm font-mono">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">NSM (Nomor Statistik Madrasah)</label>
                        <input wire:model="nsm" type="text" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm font-mono">
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Kepala Madrasah</label>
                        <input wire:model="kepalaSekolah" type="text" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm font-semibold">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">NIP Kepala Madrasah</label>
                        <input wire:model="nipKepsek" type="text" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm font-mono">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-on-surface-variant mb-1">Alamat Lengkap</label>
                    <textarea wire:model="alamatMadrasah" rows="2" class="w-full rounded-lg border border-border-default bg-surface p-3 text-sm resize-none"></textarea>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Email Resmi</label>
                        <input wire:model="emailMadrasah" type="email" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-on-surface-variant mb-1">Nomor Telepon</label>
                        <input wire:model="teleponMadrasah" type="text" class="w-full h-touch-target rounded-lg border border-border-default bg-surface text-sm">
                    </div>
                </div>

                <div class="pt-4 flex justify-end">
                    <button type="submit" class="px-8 h-touch-target bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-sm transition-all flex items-center gap-2 active:scale-95">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Perbarui Data Madrasah</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
