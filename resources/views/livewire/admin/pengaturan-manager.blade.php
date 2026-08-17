<div class="space-y-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-primary">Pengaturan Akademik &amp; Profil Madrasah</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Kelola parameter operasional madrasah, periode tahun ajaran aktif, dan standar kurikulum.</p>
        </div>
        <button wire:click="saveSettings" class="px-6 h-touch-target bg-primary hover:bg-primary-container text-on-primary font-label-md text-sm font-semibold rounded-lg shadow-sm transition-all flex items-center gap-2 active:scale-95">
            <span class="material-symbols-outlined text-[20px]">save</span>
            <span>Simpan Pengaturan</span>
        </button>
    </div>

    <!-- Alert Flash Message -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-xl p-4 flex items-center gap-3 animate-fade-in shadow-xs">
            <span class="material-symbols-outlined text-[24px]">check_circle</span>
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
                        <span class="material-symbols-outlined text-[24px]">calendar_clock</span>
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
                <span class="material-symbols-outlined text-primary">cloud_done</span>
            </div>
        </div>

        <!-- Col 2 & 3: School Profile & Identity Form -->
        <div class="lg:col-span-2 bg-surface-container-lowest rounded-2xl p-6 md:p-8 shadow-card border border-border-default space-y-6">
            <div class="flex items-center gap-3 pb-4 border-b border-border-default">
                <div class="w-10 h-10 rounded-xl bg-secondary-container text-on-secondary-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-[24px]">school</span>
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
                        <span class="material-symbols-outlined text-[18px]">check</span>
                        <span>Perbarui Data Madrasah</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
