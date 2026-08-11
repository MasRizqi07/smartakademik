<div class="space-y-6">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="text-2xl font-bold text-slate-800">Import Data Siswa</h2>
            <p class="text-slate-500">Upload file Excel/CSV untuk menambahkan banyak siswa sekaligus.</p>
        </div>
        <x-animated-button wire:click="downloadTemplate" variant="secondary" icon="<svg fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4'></path></svg>">
            Download Template
        </x-animated-button>
    </div>

    <!-- Flash Messages -->
    @if (session()->has('message'))
        <div class="bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl p-4 flex items-center gap-3 animate-slide-up">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('warning'))
        <div class="bg-amber-50 border border-amber-200 text-amber-700 rounded-xl p-4 flex items-center gap-3 animate-slide-up">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <span class="font-medium">{{ session('warning') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="bg-rose-50 border border-rose-200 text-rose-700 rounded-xl p-4 flex items-center gap-3 animate-slide-up">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2">
            <x-modern-card>
                <form wire:submit="import">
                    <div class="flex flex-col items-center justify-center py-8">
                        <label class="w-full max-w-md flex flex-col items-center px-6 py-10 bg-slate-50 text-slate-500 rounded-2xl border-2 border-dashed border-slate-300 cursor-pointer hover:bg-brand-50 hover:border-brand-300 hover:text-brand-500 transition-all group">
                            <div class="w-16 h-16 rounded-full bg-white shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <span class="text-lg font-bold">Pilih File Excel / CSV</span>
                            <span class="text-sm mt-2 text-slate-400 text-center">Tarik file ke sini atau klik untuk browse file dari perangkatmu (Maks 10MB)</span>
                            <input type='file' wire:model="file" class="hidden" accept=".xlsx,.xls,.csv" />
                        </label>
                        
                        <div class="mt-6 text-sm text-slate-600 h-10 flex items-center justify-center w-full">
                            @if($file)
                                <div class="flex items-center gap-3 px-4 py-2 bg-emerald-50 text-emerald-700 rounded-lg font-medium border border-emerald-100 animate-fade-in w-full max-w-md">
                                    <svg class="w-5 h-5 text-emerald-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    <span class="truncate">{{ $file->getClientOriginalName() }}</span>
                                </div>
                            @else
                                <span class="italic text-slate-400">Belum ada file terpilih</span>
                            @endif
                        </div>
                        
                        @error('file') <span class="mt-2 text-rose-500 text-sm font-medium">{{ $message }}</span> @enderror

                        <div class="w-full max-w-md mt-6">
                            <button type="submit" @if(!$file) disabled @endif class="w-full px-6 py-3.5 bg-gradient-to-r from-brand-600 to-accent-600 hover:from-brand-500 hover:to-accent-500 text-white rounded-xl font-bold text-base shadow-sm hover:shadow focus:outline-none focus:ring-2 focus:ring-brand-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed transition-all flex items-center justify-center gap-2">
                                <span wire:loading.remove wire:target="import">Mulai Import Data</span>
                                <span wire:loading wire:target="import" class="flex items-center gap-2">
                                    <svg class="animate-spin -ml-1 mr-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Memproses...
                                </span>
                            </button>
                        </div>
                    </div>
                </form>
            </x-modern-card>
        </div>
        
        <div>
            <div class="bg-gradient-to-br from-slate-800 to-slate-900 rounded-2xl p-6 text-white shadow-soft relative overflow-hidden">
                <div class="absolute top-0 right-0 p-8 opacity-10">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z" /><path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd" /></svg>
                </div>
                
                <h3 class="font-bold text-lg mb-4 flex items-center gap-2 relative z-10">
                    <svg class="w-5 h-5 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Panduan Import
                </h3>
                
                <ul class="space-y-4 text-sm text-slate-300 relative z-10">
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-full bg-brand-500/20 text-brand-400 flex items-center justify-center shrink-0 mt-0.5">1</div>
                        <p>Pastikan format kolom sesuai dengan <span class="text-white font-semibold cursor-pointer underline decoration-brand-400 decoration-2 underline-offset-2" wire:click="downloadTemplate">template excel</span>.</p>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-full bg-brand-500/20 text-brand-400 flex items-center justify-center shrink-0 mt-0.5">2</div>
                        <p><strong class="text-white">NISN</strong> tidak boleh kosong dan harus unik.</p>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-full bg-brand-500/20 text-brand-400 flex items-center justify-center shrink-0 mt-0.5">3</div>
                        <p>Pastikan <strong class="text-white">Email</strong> valid (jika diisi) untuk pembuatan akun otomatis.</p>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <div class="w-5 h-5 rounded-full bg-brand-500/20 text-brand-400 flex items-center justify-center shrink-0 mt-0.5">4</div>
                        <p>Jika terjadi error, data yang berhasil tetap tersimpan, dan Anda bisa melihat detail error di bawah.</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Error Report Table -->
    @if(count($failures) > 0)
        <div class="animate-fade-in">
            <div class="bg-rose-50 border border-rose-100 rounded-2xl overflow-hidden shadow-sm">
                <div class="p-4 bg-white/50 backdrop-blur border-b border-rose-100 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold text-rose-700">Terdapat Kesalahan pada Data</h4>
                        <p class="text-sm text-rose-600/80">Beberapa baris data gagal di-import. Silakan periksa detail berikut.</p>
                    </div>
                </div>
                
                <div class="overflow-x-auto p-4">
                    <table class="min-w-full divide-y divide-rose-200 border border-rose-200 rounded-xl overflow-hidden">
                        <thead class="bg-rose-100/50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-bold text-rose-800 uppercase tracking-wider w-24">Baris</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-rose-800 uppercase tracking-wider">Kolom Error</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-rose-800 uppercase tracking-wider">Pesan Detail</th>
                                <th class="px-4 py-3 text-left text-xs font-bold text-rose-800 uppercase tracking-wider hidden md:table-cell">Data Asli</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white/80 divide-y divide-rose-100">
                            @foreach($failures as $failure)
                                <tr class="hover:bg-rose-50/50 transition-colors">
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-bold text-slate-800">
                                        <span class="inline-flex items-center justify-center px-2 py-1 bg-white border border-slate-200 rounded text-slate-600 shadow-sm">
                                            #{{ $failure->row() }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-sm font-medium text-slate-700 capitalize">
                                        {{ str_replace('_', ' ', $failure->attribute()) }}
                                    </td>
                                    <td class="px-4 py-3 text-sm text-rose-600 font-medium">
                                        <ul class="list-disc pl-4 space-y-1">
                                            @foreach($failure->errors() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-slate-500 hidden md:table-cell">
                                        <code class="text-xs bg-slate-100 p-1.5 rounded-md border border-slate-200 whitespace-nowrap block w-max max-w-[200px] truncate" title="{{ json_encode($failure->values()) }}">
                                            {{ json_encode($failure->values()) }}
                                        </code>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>
