<div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
        <div class="p-6 bg-white border-b border-slate-200">
            
            @if(!$siswa)
                <div class="text-center py-8 text-rose-500 bg-rose-50 rounded-lg border border-rose-200">
                    Data Siswa tidak ditemukan untuk akun ini. Silakan hubungi Administrator.
                </div>
            @else
                <div class="mb-6 pb-6 border-b border-slate-200">
                    <h2 class="text-2xl font-bold text-slate-800">{{ $siswa->nama }}</h2>
                    <p class="text-slate-500">NISN: {{ $siswa->nisn }} | Kelas: {{ $siswa->kelas->nama_kelas }}</p>
                </div>

                <!-- Tabs -->
                <div class="border-b border-slate-200 mb-6">
                    <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                        <button wire:click="$set('activeTab', 'jadwal')" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'jadwal' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                            Jadwal Pelajaran
                        </button>
                        <button wire:click="$set('activeTab', 'absensi')" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'absensi' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                            Riwayat Absensi
                        </button>
                        <button wire:click="$set('activeTab', 'nilai')" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm transition-colors {{ $activeTab === 'nilai' ? 'border-emerald-500 text-emerald-600' : 'border-transparent text-slate-500 hover:text-slate-700 hover:border-slate-300' }}">
                            Nilai Formatif
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="mt-4">
                    @if($activeTab === 'jadwal')
                        @if($jadwals->isEmpty())
                            <div class="text-center py-8 text-slate-500 bg-slate-50 rounded-lg border border-slate-200">
                                Belum ada jadwal pelajaran untuk kelas Anda.
                            </div>
                        @else
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                                @foreach($jadwals as $hari => $items)
                                    <div class="bg-slate-50 rounded-lg border border-slate-200 overflow-hidden shadow-sm">
                                        <div class="bg-emerald-600 text-white font-bold py-2 px-4 text-center">
                                            {{ $hari }}
                                        </div>
                                        <ul class="divide-y divide-slate-200">
                                            @foreach($items as $j)
                                                <li class="p-4 hover:bg-white transition-colors">
                                                    <div class="text-xs font-semibold text-emerald-600 mb-1">
                                                        Jam {{ $j->jam_ke }} ({{ substr($j->waktu_mulai, 0, 5) }} - {{ substr($j->waktu_selesai, 0, 5) }})
                                                    </div>
                                                    <div class="font-medium text-slate-900">{{ $j->mapel->nama_mapel }}</div>
                                                    <div class="text-sm text-slate-500">{{ $j->guru->nama }}</div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    
                    @elseif($activeTab === 'absensi')
                        @if($absensis->isEmpty())
                            <div class="text-center py-8 text-slate-500 bg-slate-50 rounded-lg border border-slate-200">
                                Belum ada catatan absensi.
                            </div>
                        @else
                            <div class="overflow-x-auto border border-slate-200 rounded-lg shadow-sm">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Mata Pelajaran</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-slate-200">
                                        @foreach($absensis as $abs)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-medium">
                                                    {{ \Carbon\Carbon::parse($abs->tanggal)->isoFormat('DD MMM YYYY') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                                    {{ $abs->jadwal->mapel->nama_mapel ?? '-' }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-semibold">
                                                    @if($abs->status === 'hadir')
                                                        <span class="px-2 py-1 bg-emerald-100 text-emerald-800 rounded-full text-xs">Hadir</span>
                                                    @elseif($abs->status === 'izin')
                                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">Izin</span>
                                                    @elseif($abs->status === 'sakit')
                                                        <span class="px-2 py-1 bg-amber-100 text-amber-800 rounded-full text-xs">Sakit</span>
                                                    @else
                                                        <span class="px-2 py-1 bg-rose-100 text-rose-800 rounded-full text-xs">Alfa</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif

                    @elseif($activeTab === 'nilai')
                        @if($nilais->isEmpty())
                            <div class="text-center py-8 text-slate-500 bg-slate-50 rounded-lg border border-slate-200">
                                Belum ada catatan nilai formatif.
                            </div>
                        @else
                            <div class="overflow-x-auto border border-slate-200 rounded-lg shadow-sm">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Tanggal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Mata Pelajaran</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-slate-500 uppercase tracking-wider">Jenis</th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-slate-500 uppercase tracking-wider">Nilai</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-slate-200">
                                        @foreach($nilais as $nilai)
                                            <tr>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-medium">
                                                    {{ \Carbon\Carbon::parse($nilai->tanggal)->isoFormat('DD MMM YYYY') }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                                    {{ $nilai->mapel->nama_mapel }}
                                                    <div class="text-xs text-slate-500">Guru: {{ $nilai->guru->nama }}</div>
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700 capitalize">
                                                    {{ str_replace('_', ' ', $nilai->jenis) }}
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                                    <span class="font-bold text-lg {{ $nilai->nilai < 75 ? 'text-rose-600' : 'text-emerald-600' }}">
                                                        {{ (float)$nilai->nilai }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endif
                </div>
            @endif

        </div>
    </div>
</div>
