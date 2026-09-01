<div class="flex flex-col gap-6">
    <!-- Header Title & Action Bar -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-headline-lg font-bold text-text-main">Import Data Massal</h2>
            <p class="font-body-default text-body-default text-on-surface-variant">Unggah berkas Excel / CSV untuk memasukkan data siswa, guru, kelas, atau mapel sekaligus.</p>
        </div>
        <div class="flex items-center gap-3 w-full sm:w-auto">
            <select wire:model.live="type" class="h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text focus-ring">
                <option value="siswa">Siswa</option>
                <option value="guru">Guru</option>
                <option value="kelas">Kelas</option>
                <option value="mapel">Mata Pelajaran</option>
            </select>
            <button wire:click="downloadTemplate" class="h-touch-target px-4 bg-secondary-container text-on-secondary-container hover:bg-surface-container font-label-md rounded-DEFAULT transition-all flex items-center gap-2 shrink-0">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" /></svg>
                <span>Template CSV</span>
            </button>
        </div>
    </div>

    <!-- Flash Alerts -->
    @if (session()->has('message'))
        <div class="bg-status-hadir/10 border border-status-hadir/30 text-status-hadir rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
            <span class="font-label-md">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="bg-status-izin/10 border border-status-izin/30 text-status-izin rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
            <span class="font-label-md">{{ session('warning') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-error/10 border border-error/30 text-error rounded-lg p-4 flex items-center gap-3 animate-fade-in">
            <svg class="w-5 h-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" /></svg>
            <span class="font-label-md">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Main Drag Drop Zone -->
        <div class="md:col-span-2 bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card">
            <form wire:submit="import" class="flex flex-col items-center justify-center gap-6">
                <label class="w-full flex flex-col items-center px-6 py-12 bg-surface-container-low text-on-surface-variant rounded-xl border-2 border-dashed border-outline-variant cursor-pointer hover:border-primary hover:bg-primary-container/5 transition-all group">
                    <div class="w-16 h-16 rounded-full bg-surface-container-lowest shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform text-primary">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                    </div>
                    <span class="font-headline-md text-headline-md font-bold text-text-main">Pilih Berkas Excel / CSV</span>
                    <span class="font-body-default text-body-default text-on-surface-variant mt-1 text-center">Format .xlsx, .xls, atau .csv (Maksimal 10MB)</span>
                    <input type="file" wire:model="file" class="hidden" accept=".xlsx,.xls,.csv" />
                </label>
                
                <div class="w-full min-h-[40px] flex items-center justify-center">
                    @if($file)
                        <div class="flex items-center gap-3 px-4 py-2 bg-status-hadir/10 text-status-hadir rounded-lg font-medium border border-status-hadir/30 w-full animate-fade-in">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                            <span class="truncate font-mono text-sm">{{ $file->getClientOriginalName() }}</span>
                        </div>
                    @else
                        <span class="font-body-default text-body-default text-outline italic">Belum ada berkas terpilih</span>
                    @endif
                </div>
                
                @error('file') <span class="text-error font-label-sm">{{ $message }}</span> @enderror

                <button type="submit" @if(!$file) disabled @endif class="w-full h-touch-target bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs hover:shadow-md disabled:opacity-50 disabled:cursor-not-allowed transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                    <span wire:loading.remove wire:target="import">Proses Import Data</span>
                    <span wire:loading wire:target="import" class="flex items-center gap-2">
                        <svg class="w-8 h-8 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                        <span>Memproses Impor...</span>
                    </span>
                </button>
            </form>
        </div>
        
        <!-- Sidebar Guide -->
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card flex flex-col gap-4">
            <h3 class="font-headline-md text-headline-md font-bold text-text-main flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Panduan Impor</span>
            </h3>
            
            <ul class="flex flex-col gap-3 font-body-default text-body-default text-on-surface-variant">
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-primary-container/20 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                    <span>Gunakan struktur kolom persis sesuai <button type="button" wire:click="downloadTemplate" class="text-primary hover:underline font-semibold">template CSV</button>.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-primary-container/20 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                    <span>Pastikan data pengenal unik (NISN / NIP) tidak duplikat.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-primary-container/20 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                    <span>Format tanggal disarankan YYYY-MM-DD.</span>
                </li>
                <li class="flex items-start gap-3">
                    <span class="w-5 h-5 rounded-full bg-primary-container/20 text-primary font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">4</span>
                    <span>Tinjau laporan kesalahan di bawah jika ada baris data bermasalah.</span>
                </li>
            </ul>
        </div>
    </div>

    <!-- Error Report Table -->
    @if(count($failures) > 0)
        <div class="bg-surface-container-lowest rounded-xl border border-error/30 shadow-card flex flex-col overflow-hidden animate-fade-in">
            <div class="p-4 bg-error/10 border-b border-error/20 flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" /></svg>
                <div>
                    <h4 class="font-headline-md text-headline-md font-bold text-error">Laporan Kegagalan Impor</h4>
                    <p class="font-body-default text-body-default text-on-surface-variant">Beberapa baris data gagal diproses. Detail baris dan kesalahan tertera di bawah.</p>
                </div>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse font-body-default text-body-default">
                    <thead>
                        <tr class="bg-surface-container-low border-b border-border-default font-label-sm text-on-surface-variant text-[12px] uppercase">
                            <th class="py-3 px-4 font-semibold w-24">Baris</th>
                            <th class="py-3 px-4 font-semibold">Kolom Error</th>
                            <th class="py-3 px-4 font-semibold">Detail Kesalahan</th>
                            <th class="py-3 px-4 font-semibold hidden md:table-cell">Data Baris</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border-default/60">
                        @foreach($failures as $failure)
                            <tr class="hover:bg-surface-container-low/60 transition-colors">
                                <td class="py-3 px-4 font-bold text-text-main">
                                    <span class="inline-block px-2 py-0.5 bg-surface-container-high rounded text-xs">#{{ is_array($failure) ? ($failure['row'] ?? '-') : $failure->row() }}</span>
                                </td>
                                <td class="py-3 px-4 font-medium text-text-main capitalize">
                                    {{ str_replace('_', ' ', is_array($failure) ? ($failure['attribute'] ?? '-') : $failure->attribute()) }}
                                </td>
                                <td class="py-3 px-4 text-error font-medium">
                                    <ul class="list-disc pl-4 space-y-0.5">
                                        @php
                                            $errs = is_array($failure) ? ($failure['errors'] ?? []) : $failure->errors();
                                        @endphp
                                        @foreach($errs as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="py-3 px-4 text-outline font-mono text-xs hidden md:table-cell">
                                    @php
                                        $vals = is_array($failure) ? ($failure['values'] ?? []) : $failure->values();
                                    @endphp
                                    <code class="bg-surface-container-low p-1.5 rounded block truncate max-w-xs" title="{{ json_encode($vals) }}">
                                        {{ json_encode($vals) }}
                                    </code>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

