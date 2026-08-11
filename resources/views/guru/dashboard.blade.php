<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard Guru') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Greeting Card -->
            <div class="bg-gradient-to-r from-teal-500 to-brand-600 rounded-2xl p-8 text-white shadow-glow relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10 scale-150 transform translate-x-1/4 -translate-y-1/4">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20"><path d="M12 14l9-5-9-5-9 5 9 5z"></path><path d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"></path></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-2">Selamat datang, {{ auth()->user()->name }}! 👨‍🏫</h3>
                    <p class="text-brand-100 text-lg max-w-2xl">Kelola absensi harian dan input nilai formatif siswa dengan cepat dan efisien.</p>
                </div>
            </div>

            <h3 class="text-xl font-bold text-slate-800 mt-8 mb-4">Tugas Akademik</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Absensi Widget -->
                <a href="{{ route('guru.absensi') }}" class="group block">
                    <x-modern-card class="h-full border-l-4 border-l-amber-500 hover:border-l-accent-500 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm border border-amber-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-slate-800 group-hover:text-amber-600 transition-colors">Input Absensi</h4>
                                <p class="text-base text-slate-500 mt-1">Catat kehadiran harian siswa</p>
                            </div>
                        </div>
                    </x-modern-card>
                </a>

                <!-- Nilai Widget -->
                <a href="{{ route('guru.nilai') }}" class="group block">
                    <x-modern-card class="h-full border-l-4 border-l-sky-500 hover:border-l-accent-500 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm border border-sky-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-slate-800 group-hover:text-sky-600 transition-colors">Input Nilai Formatif</h4>
                                <p class="text-base text-slate-500 mt-1">Kelola nilai tugas dan kuis siswa</p>
                            </div>
                        </div>
                    </x-modern-card>
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>
