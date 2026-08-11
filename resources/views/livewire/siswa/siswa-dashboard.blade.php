<div class="space-y-6">
    @if(!$siswa)
        <div class="text-center py-12 text-rose-500 bg-rose-50 rounded-2xl border border-rose-200 shadow-sm">
            <svg class="w-16 h-16 mx-auto mb-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
            <h3 class="text-xl font-bold">Data Siswa Tidak Ditemukan</h3>
            <p class="mt-2">Silakan hubungi Administrator untuk menghubungkan akun ini dengan data siswa.</p>
        </div>
    @else
        <!-- Profile Banner -->
        <div class="bg-gradient-to-r from-brand-600 to-accent-600 rounded-3xl p-8 text-white shadow-glow relative overflow-hidden flex flex-col md:flex-row items-center gap-6">
            <div class="absolute right-0 top-0 opacity-10 scale-150 transform translate-x-1/4 -translate-y-1/4">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path></svg>
            </div>
            
            <div class="w-24 h-24 rounded-full bg-white/20 backdrop-blur-md border-4 border-white/30 flex items-center justify-center text-4xl font-bold shadow-lg z-10 shrink-0">
                {{ substr($siswa->nama, 0, 1) }}
            </div>
            <div class="relative z-10 text-center md:text-left">
                <h2 class="text-3xl font-bold mb-1">{{ $siswa->nama }}</h2>
                <div class="flex flex-wrap items-center justify-center md:justify-start gap-3 mt-2">
                    <span class="px-3 py-1 bg-white/20 rounded-full text-sm font-medium backdrop-blur-sm border border-white/10">NISN: {{ $siswa->nisn }}</span>
                    <span class="px-3 py-1 bg-white/20 rounded-full text-sm font-medium backdrop-blur-sm border border-white/10">Kelas: <strong class="text-white">{{ $siswa->kelas->nama_kelas }}</strong></span>
                </div>
            </div>
        </div>

        <!-- Modern Tabs -->
        <div class="bg-white rounded-2xl p-2 shadow-soft border border-slate-100 flex overflow-x-auto snap-x hide-scrollbar">
            <button wire:click="$set('activeTab', 'jadwal')" class="snap-start flex-1 whitespace-nowrap py-3 px-6 rounded-xl font-semibold text-sm transition-all duration-200 {{ $activeTab === 'jadwal' ? 'bg-brand-50 text-brand-600 shadow-sm' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Jadwal Pelajaran
                </div>
            </button>
            <button wire:click="$set('activeTab', 'absensi')" class="snap-start flex-1 whitespace-nowrap py-3 px-6 rounded-xl font-semibold text-sm transition-all duration-200 {{ $activeTab === 'absensi' ? 'bg-amber-50 text-amber-600 shadow-sm' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Riwayat Absensi
                </div>
            </button>
            <button wire:click="$set('activeTab', 'nilai')" class="snap-start flex-1 whitespace-nowrap py-3 px-6 rounded-xl font-semibold text-sm transition-all duration-200 {{ $activeTab === 'nilai' ? 'bg-sky-50 text-sky-600 shadow-sm' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50' }}">
                <div class="flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    Nilai Formatif
                </div>
            </button>
        </div>

        <!-- Tab Content -->
        <div class="animate-fade-in relative min-h-[400px]">
            <div wire:loading class="absolute inset-0 z-10 bg-white/50 backdrop-blur-sm rounded-2xl flex items-center justify-center">
                <svg class="animate-spin h-8 w-8 text-brand-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
            </div>

            @if($activeTab === 'jadwal')
                @if($jadwals->isEmpty())
                    <x-modern-card class="text-center py-12">
                        <div class="text-slate-400">Belum ada jadwal pelajaran.</div>
                    </x-modern-card>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($jadwals as $hari => $items)
                            <x-modern-card title="{{ $hari }}" icon="<svg class='w-5 h-5' fill='none' stroke='currentColor' viewBox='0 0 24 24'><path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z'></path></svg>">
                                <ul class="divide-y divide-slate-100">
                                    @foreach($items as $j)
                                        <li class="py-3 first:pt-0 last:pb-0 hover:bg-slate-50 transition-colors rounded-lg px-2 -mx-2">
                                            <div class="flex items-center gap-3">
                                                <div class="w-12 h-12 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center font-bold text-lg shrink-0">
                                                    {{ $j->jam_ke }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-slate-800">{{ $j->mapel->nama_mapel }}</div>
                                                    <div class="text-sm text-slate-500 line-clamp-1">{{ $j->guru->nama }}</div>
                                                    <div class="text-xs font-semibold text-brand-600 mt-0.5">
                                                        {{ substr($j->waktu_mulai, 0, 5) }} - {{ substr($j->waktu_selesai, 0, 5) }}
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </x-modern-card>
                        @endforeach
                    </div>
                @endif
            
            @elseif($activeTab === 'absensi')
                @if($absensis->isEmpty())
                    <x-modern-card class="text-center py-12">
                        <div class="text-slate-400">Belum ada catatan absensi.</div>
                    </x-modern-card>
                @else
                    <x-data-table :headers="['Tanggal', 'Mata Pelajaran', 'Status']">
                        @foreach($absensis as $abs)
                            <tr class="hover:bg-slate-50 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-medium">
                                    {{ \Carbon\Carbon::parse($abs->tanggal)->isoFormat('DD MMM YYYY') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                    {{ $abs->jadwal->mapel->nama_mapel ?? '-' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <x-status-badge status="{{ ucfirst($abs->status) }}" />
                                </td>
                            </tr>
                        @endforeach
                    </x-data-table>
                @endif

            @elseif($activeTab === 'nilai')
                @if($nilais->isEmpty())
                    <x-modern-card class="text-center py-12">
                        <div class="text-slate-400">Belum ada catatan nilai formatif.</div>
                    </x-modern-card>
                @else
                    <x-data-table :headers="['Tanggal', 'Pelajaran', 'Jenis Tugas', 'Nilai']">
                        @foreach($nilais as $nilai)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-900 font-medium">
                                    {{ \Carbon\Carbon::parse($nilai->tanggal)->isoFormat('DD MMM YYYY') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700">
                                    <div class="font-bold text-slate-800">{{ $nilai->mapel->nama_mapel }}</div>
                                    <div class="text-xs text-slate-500">{{ $nilai->guru->nama }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-700 capitalize font-medium">
                                    {{ str_replace('_', ' ', $nilai->jenis) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg {{ $nilai->nilai < 75 ? 'bg-rose-100 text-rose-700 border-2 border-rose-200' : 'bg-emerald-100 text-emerald-700 border-2 border-emerald-200' }}">
                                        {{ (float)$nilai->nilai }}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </x-data-table>
                @endif
            @endif
        </div>
    @endif
</div>
