<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
        <div class="p-6 bg-white border-b border-slate-200">
            
            <div class="mb-8">
                <h3 class="text-lg font-semibold mb-2 text-slate-900">Import Data Siswa</h3>
                <p class="text-sm text-slate-600 mb-4">Upload file Excel/CSV untuk menambahkan banyak siswa sekaligus. Pastikan format sesuai dengan template.</p>
                
                <button wire:click="downloadTemplate" class="inline-flex items-center px-4 py-2 bg-slate-100 border border-slate-300 rounded-md font-semibold text-xs text-slate-700 uppercase tracking-widest shadow-sm hover:bg-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Download Template
                </button>
            </div>

            <div class="mb-8 p-6 border-2 border-dashed border-slate-300 rounded-lg bg-slate-50">
                <form wire:submit="import">
                    <div class="flex flex-col items-center justify-center">
                        <label class="w-full max-w-md flex flex-col items-center px-4 py-6 bg-white text-emerald-600 rounded-lg shadow-sm tracking-wide uppercase border border-emerald-500 cursor-pointer hover:bg-emerald-50">
                            <svg class="w-8 h-8" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z" />
                            </svg>
                            <span class="mt-2 text-base leading-normal">Pilih File Excel/CSV</span>
                            <input type='file' wire:model="file" class="hidden" accept=".xlsx,.xls,.csv" />
                        </label>
                        
                        <div class="mt-4 text-sm text-slate-600">
                            @if($file)
                                File terpilih: <span class="font-semibold text-slate-900">{{ $file->getClientOriginalName() }}</span>
                            @else
                                Belum ada file yang dipilih.
                            @endif
                        </div>
                        
                        @error('file') <span class="mt-2 text-rose-500 text-sm">{{ $message }}</span> @enderror

                        <button type="submit" @if(!$file) disabled @endif class="mt-6 px-6 py-3 bg-emerald-600 text-white rounded-md font-semibold text-sm hover:bg-emerald-700 disabled:opacity-50 disabled:cursor-not-allowed w-full max-w-md">
                            <span wire:loading.remove wire:target="import">Mulai Import</span>
                            <span wire:loading wire:target="import">Mengimport Data...</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Flash Messages -->
            @if (session()->has('message'))
                <div class="mb-4 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-md flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('message') }}
                </div>
            @endif

            @if (session()->has('warning'))
                <div class="mb-4 px-4 py-3 bg-amber-50 border border-amber-200 text-amber-700 rounded-md flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    {{ session('warning') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="mb-4 px-4 py-3 bg-rose-50 border border-rose-200 text-rose-700 rounded-md flex items-start">
                    <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <!-- Error Report Table -->
            @if(count($failures) > 0)
                <div class="mt-8">
                    <h4 class="text-md font-semibold text-rose-600 mb-4 border-b border-rose-200 pb-2">Laporan Error Import</h4>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-rose-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-rose-700 uppercase tracking-wider w-20">Baris Excel</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-rose-700 uppercase tracking-wider">Kolom</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-rose-700 uppercase tracking-wider">Pesan Error</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-rose-700 uppercase tracking-wider hidden md:table-cell">Data Input</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @foreach($failures as $failure)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-slate-900 text-center">{{ $failure->row() }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900">{{ $failure->attribute() }}</td>
                                        <td class="px-6 py-4 text-sm text-rose-600">
                                            <ul class="list-disc pl-4">
                                                @foreach($failure->errors() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500 hidden md:table-cell">
                                            <code class="text-xs bg-slate-100 p-1 rounded">{{ json_encode($failure->values()) }}</code>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

        </div>
    </div>
</div>
