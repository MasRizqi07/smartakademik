<div class="space-y-8">
    <!-- Header Controls & Actions -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <h2 class="font-headline-lg text-2xl md:text-3xl font-bold text-text-main">Kalender Akademik {{ $activeYear }}</h2>
            <p class="font-body-default text-body-default text-on-surface-variant mt-1">Jadwal hari efektif belajar, agenda asesmen, dan libur madrasah.</p>
        </div>
        <button wire:click="openAddModal" class="bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md rounded-lg h-touch-target px-6 shadow-sm transition-all flex items-center gap-2 w-full md:w-auto justify-center active:scale-95">
            <span class="material-symbols-outlined text-[20px]">add_alarm</span>
            <span>Tambah Agenda Kegiatan</span>
        </button>
    </div>

    <!-- Feedback Message -->
    @if (session()->has('message'))
        <div class="p-4 bg-status-hadir/15 border border-status-hadir/30 text-status-hadir rounded-xl flex items-center gap-2 font-medium">
            <span class="material-symbols-outlined">check_circle</span>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Controls & Legend -->
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-4">
        <div class="flex items-center gap-2 bg-surface-container-lowest p-1.5 rounded-xl border border-border-default shadow-xs">
            <button wire:click="$set('activeSemester', 'Ganjil')" class="px-5 py-2 font-label-md text-label-md rounded-lg transition-all {{ $activeSemester === 'Ganjil' ? 'bg-primary-container text-on-primary-container font-bold shadow-xs' : 'text-secondary hover:bg-surface-container' }}">
                Semester Ganjil
            </button>
            <button wire:click="$set('activeSemester', 'Genap')" class="px-5 py-2 font-label-md text-label-md rounded-lg transition-all {{ $activeSemester === 'Genap' ? 'bg-primary-container text-on-primary-container font-bold shadow-xs' : 'text-secondary hover:bg-surface-container' }}">
                Semester Genap
            </button>
        </div>

        <div class="flex flex-wrap items-center gap-4 bg-surface-container-lowest py-2.5 px-4 rounded-xl border border-border-default shadow-xs text-xs font-medium">
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-full bg-status-hadir"></span>
                <span class="text-secondary">Hari Efektif</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-full bg-status-sakit"></span>
                <span class="text-secondary">Ujian / Asesmen</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-full bg-status-izin"></span>
                <span class="text-secondary">Kegiatan Madrasah</span>
            </div>
            <div class="flex items-center gap-1.5">
                <span class="w-3 h-3 rounded-full bg-status-alfa"></span>
                <span class="text-secondary">Libur Nasional / Semester</span>
            </div>
        </div>
    </div>

    <!-- Calendar Bento Grid (Months of the Active Semester) -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @php
            $months = $activeSemester === 'Ganjil' 
                ? [
                    ['name' => 'Juli 2026', 'start' => 3, 'days' => 31, 'events' => ['15' => 'status-hadir', '16' => 'status-izin', '17' => 'status-izin', '18' => 'status-izin']],
                    ['name' => 'Agustus 2026', 'start' => 6, 'days' => 31, 'events' => ['17' => 'status-alfa']],
                    ['name' => 'September 2026', 'start' => 2, 'days' => 30, 'events' => ['15' => 'status-sakit', '16' => 'status-sakit', '17' => 'status-sakit', '18' => 'status-sakit', '19' => 'status-sakit', '20' => 'status-sakit']],
                    ['name' => 'Oktober 2026', 'start' => 4, 'days' => 31, 'events' => ['22' => 'status-izin']],
                    ['name' => 'November 2026', 'start' => 0, 'days' => 30, 'events' => ['25' => 'status-izin']],
                    ['name' => 'Desember 2026', 'start' => 2, 'days' => 31, 'events' => ['1' => 'status-sakit', '2' => 'status-sakit', '3' => 'status-sakit', '19' => 'status-hadir', '21' => 'status-alfa', '22' => 'status-alfa', '25' => 'status-alfa']],
                  ]
                : [
                    ['name' => 'Januari 2027', 'start' => 5, 'days' => 31, 'events' => ['5' => 'status-hadir']],
                    ['name' => 'Februari 2027', 'start' => 1, 'days' => 28, 'events' => []],
                    ['name' => 'Maret 2027', 'start' => 1, 'days' => 31, 'events' => ['1' => 'status-sakit', '20' => 'status-izin']],
                    ['name' => 'April 2027', 'start' => 4, 'days' => 30, 'events' => []],
                    ['name' => 'Mei 2027', 'start' => 6, 'days' => 31, 'events' => ['17' => 'status-sakit', '18' => 'status-sakit']],
                    ['name' => 'Juni 2027', 'start' => 2, 'days' => 30, 'events' => ['19' => 'status-hadir']],
                  ];
        @endphp

        @foreach($months as $m)
            <div class="bg-surface-container-lowest rounded-xl border border-border-default p-5 shadow-card flex flex-col justify-between hover-lift transition-all">
                <div>
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="font-headline-md text-lg font-bold text-on-surface">{{ $m['name'] }}</h3>
                        <span class="text-secondary text-xs bg-surface-container px-2 py-0.5 rounded font-medium">{{ $activeSemester }}</span>
                    </div>

                    <!-- Days Header -->
                    <div class="grid grid-cols-7 gap-1 text-center mb-2 font-label-sm text-xs font-semibold">
                        <div class="text-status-alfa">M</div>
                        <div class="text-secondary">S</div>
                        <div class="text-secondary">S</div>
                        <div class="text-secondary">R</div>
                        <div class="text-secondary">K</div>
                        <div class="text-secondary">J</div>
                        <div class="text-secondary">S</div>
                    </div>

                    <!-- Days Grid -->
                    <div class="grid grid-cols-7 gap-1 text-center text-xs">
                        @for($i = 0; $i < $m['start']; $i++)
                            <div class="aspect-square"></div>
                        @endfor

                        @for($d = 1; $d <= $m['days']; $d++)
                            @php
                                $dayOfWeek = ($m['start'] + $d - 1) % 7;
                                $isSunday = $dayOfWeek === 0;
                                $eventColor = $m['events'][(string)$d] ?? null;
                            @endphp
                            <div class="aspect-square flex items-center justify-center rounded-lg transition-colors cursor-pointer {{ $eventColor ? 'text-white font-bold shadow-xs bg-' . $eventColor : ($isSunday ? 'text-status-alfa font-bold hover:bg-surface-container' : 'text-text-main hover:bg-surface-container') }}">
                                {{ $d }}
                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Timeline of Academic Agenda -->
    <div class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default p-6 md:p-8">
        <h3 class="font-headline-md text-xl font-bold text-text-main mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">event_note</span>
            <span>Rincian Agenda Kegiatan Akademik {{ $activeSemester }}</span>
        </h3>

        <div class="divide-y divide-border-default/60">
            @forelse($filteredEvents as $ev)
                <div class="py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-2 hover:bg-surface/50 px-3 rounded-lg transition-colors">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full shrink-0 bg-{{ $ev['color'] }}"></span>
                        <div>
                            <p class="font-label-md text-sm font-bold text-text-main">{{ $ev['judul'] }}</p>
                            <p class="text-xs text-on-surface-variant">Kategori: {{ $ev['kategori'] }}</p>
                        </div>
                    </div>
                    <span class="text-xs font-semibold px-3 py-1 bg-surface-container text-on-surface rounded-full self-start sm:self-auto shrink-0">
                        {{ $ev['tanggal'] }}
                    </span>
                </div>
            @empty
                <p class="text-sm text-on-surface-variant py-4 text-center">Belum ada agenda terdaftar untuk semester ini.</p>
            @endforelse
        </div>
    </div>

    <!-- Add Event Modal Dialog -->
    @if($isAddOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-xs animate-fade-in">
            <div class="bg-surface-container-lowest rounded-2xl max-w-md w-full p-6 shadow-2xl border border-border-default flex flex-col gap-4">
                <div class="flex justify-between items-center border-b border-border-default pb-3">
                    <h3 class="font-headline-md text-lg font-bold text-text-main">Tambah Agenda Kalender</h3>
                    <button wire:click="$set('isAddOpen', false)" class="text-on-surface-variant hover:bg-surface-container p-1 rounded-full">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>

                <form wire:submit.prevent="saveEvent" class="space-y-4 text-sm">
                    <div>
                        <label class="block font-label-sm text-on-surface-variant mb-1">Nama Agenda / Kegiatan</label>
                        <input wire:model="eventTitle" type="text" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface focus:ring-2 focus:ring-primary focus:border-transparent text-sm" placeholder="Contoh: Rapat Kerja Kurikulum">
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block font-label-sm text-on-surface-variant mb-1">Tanggal</label>
                            <input wire:model="eventDate" type="date" required class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                        </div>
                        <div>
                            <label class="block font-label-sm text-on-surface-variant mb-1">Kategori</label>
                            <select wire:model="eventCategory" class="w-full px-3 py-2 rounded-lg border border-border-default bg-surface text-sm">
                                <option value="Kegiatan">Kegiatan Madrasah</option>
                                <option value="Ujian">Ujian / Asesmen</option>
                                <option value="Libur">Libur / Tanggal Merah</option>
                                <option value="Rapat">Rapat Dinas</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-border-default">
                        <button type="button" wire:click="$set('isAddOpen', false)" class="px-4 py-2 bg-surface text-on-surface-variant rounded-lg font-label-md hover:bg-surface-container">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2 bg-primary text-on-primary rounded-lg font-label-md hover:bg-primary-container">
                            Simpan ke Kalender
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>
