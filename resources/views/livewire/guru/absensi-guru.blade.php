<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
        <div class="p-6 bg-white border-b border-slate-200">
            
            @if (session()->has('message'))
                <div class="mb-6 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-md">
                    {{ session('message') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-slate-50 p-4 rounded-lg border border-slate-200">
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Tanggal Absensi</label>
                    <input type="date" wire:model.live="tanggal" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1">Jadwal Pelajaran (Hari Ini)</label>
                    @if(count($jadwals) > 0)
                        <select wire:model.live="selectedJadwalId" class="mt-1 block w-full rounded-md border-slate-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-base">
                            <option value="">-- Pilih Jadwal --</option>
                            @foreach($jadwals as $jadwal)
                                <option value="{{ $jadwal->id }}">
                                    Jam ke-{{ $jadwal->jam_ke }} ({{ substr($jadwal->waktu_mulai, 0, 5) }}) - {{ $jadwal->kelas->nama_kelas }} - {{ $jadwal->mapel->nama_mapel }}
                                </option>
                            @endforeach
                        </select>
                    @else
                        <div class="mt-2 text-sm text-amber-600 bg-amber-50 border border-amber-200 rounded-md p-2">
                            Tidak ada jadwal mengajar pada hari {{ $tanggal ? \Carbon\Carbon::parse($tanggal)->isoFormat('dddd') : 'ini' }}.
                        </div>
                    @endif
                </div>
            </div>

            @if($selectedJadwalId && $tanggal && count($siswas) > 0)
                <form wire:submit="save">
                    <div class="overflow-x-auto border border-slate-200 rounded-lg">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="bg-slate-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider w-16">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">NISN</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Nama Siswa</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Status Kehadiran</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-slate-200">
                                @foreach($siswas as $index => $siswa)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500">{{ $siswa->nisn }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $siswa->nama }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="inline-flex rounded-md shadow-sm" role="group">
                                                <label class="px-3 py-1.5 text-sm font-medium border border-slate-200 cursor-pointer transition-colors duration-150 {{ isset($absensiData[$siswa->id]) && $absensiData[$siswa->id] === 'hadir' ? 'bg-emerald-500 text-white border-emerald-500' : 'bg-white text-slate-700 hover:bg-slate-50' }} rounded-l-md">
                                                    <input type="radio" wire:model="absensiData.{{ $siswa->id }}" value="hadir" class="sr-only">
                                                    Hadir
                                                </label>
                                                <label class="px-3 py-1.5 text-sm font-medium border-t border-b border-r border-slate-200 cursor-pointer transition-colors duration-150 {{ isset($absensiData[$siswa->id]) && $absensiData[$siswa->id] === 'izin' ? 'bg-blue-500 text-white border-blue-500' : 'bg-white text-slate-700 hover:bg-slate-50' }}">
                                                    <input type="radio" wire:model="absensiData.{{ $siswa->id }}" value="izin" class="sr-only">
                                                    Izin
                                                </label>
                                                <label class="px-3 py-1.5 text-sm font-medium border-t border-b border-r border-slate-200 cursor-pointer transition-colors duration-150 {{ isset($absensiData[$siswa->id]) && $absensiData[$siswa->id] === 'sakit' ? 'bg-amber-500 text-white border-amber-500' : 'bg-white text-slate-700 hover:bg-slate-50' }}">
                                                    <input type="radio" wire:model="absensiData.{{ $siswa->id }}" value="sakit" class="sr-only">
                                                    Sakit
                                                </label>
                                                <label class="px-3 py-1.5 text-sm font-medium border-t border-b border-r border-slate-200 cursor-pointer transition-colors duration-150 {{ isset($absensiData[$siswa->id]) && $absensiData[$siswa->id] === 'alfa' ? 'bg-rose-500 text-white border-rose-500' : 'bg-white text-slate-700 hover:bg-slate-50' }} rounded-r-md">
                                                    <input type="radio" wire:model="absensiData.{{ $siswa->id }}" value="alfa" class="sr-only">
                                                    Alfa
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-emerald-600 text-white rounded-md font-semibold text-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2">
                            Simpan Absensi
                        </button>
                    </div>
                </form>
            @elseif($selectedJadwalId && $tanggal && count($siswas) == 0)
                <div class="text-center py-8 text-slate-500 bg-slate-50 rounded-lg border border-slate-200">
                    Tidak ada siswa di kelas ini.
                </div>
            @endif

        </div>
    </div>
</div>
