<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
        <div class="p-6 bg-white border-b border-slate-200">
            
            @if (session()->has('message'))
                <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-md">
                    {{ session('message') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 bg-slate-50 p-4 rounded-lg border border-slate-200">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Kelas & Mata Pelajaran</label>
                    @if(count($kombinasiKelasMapel) > 0)
                        <select wire:model.live="selectedKombinasi" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                            <option value="">-- Pilih Kelas & Mapel --</option>
                            @foreach($kombinasiKelasMapel as $key => $item)
                                <option value="{{ $key }}">
                                    {{ $item['kelas_nama'] }} - {{ $item['mapel_nama'] }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div class="mt-2 text-sm text-amber-600 bg-amber-50 border border-amber-200 rounded-md p-2">
                            Anda belum memiliki jadwal mengajar.
                        </div>
                    @endif
                </div>

                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jenis Penilaian</label>
                    <select wire:model.live="jenis" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                        <option value="tugas">Tugas</option>
                        <option value="ulangan_harian">Ulangan Harian</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal</label>
                    <input type="date" wire:model.live="tanggal" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                </div>
            </div>

            @if($selectedKombinasi && $tanggal && $jenis && count($siswas) > 0)
                <form wire:submit="save">
                    <div class="overflow-x-auto border border-slate-200 rounded-lg">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider w-16">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">NISN</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Siswa</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider w-32">Nilai (0-100)</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @foreach($siswas as $index => $siswa)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $siswa->nisn }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $siswa->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <input type="number" inputmode="numeric" step="0.01" min="0" max="100" 
                                                   wire:model.defer="nilaiData.{{ $siswa->id }}" 
                                                   class="block w-full text-center rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base py-1.5"
                                                   placeholder="-">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-md font-semibold text-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            Simpan Nilai
                        </button>
                    </div>
                </form>
            @elseif($selectedKombinasi && $tanggal && $jenis && count($siswas) == 0)
                <div class="text-center py-8 text-slate-500 bg-slate-50 rounded-lg border border-slate-200">
                    Tidak ada siswa di kelas ini.
                </div>
            @endif

        </div>
    </div>
</div>
