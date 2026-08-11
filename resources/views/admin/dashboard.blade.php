<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard Admin TU') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Greeting Card -->
            <div class="bg-gradient-to-r from-brand-600 to-accent-600 rounded-2xl p-8 text-white shadow-glow relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10 scale-150 transform translate-x-1/4 -translate-y-1/4">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20"><path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z"></path></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-2">Selamat datang, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-brand-100 text-lg max-w-2xl">Kelola data master akademik dengan mudah. Pilih menu di bawah untuk mulai bekerja.</p>
                </div>
            </div>

            <h3 class="text-xl font-bold text-slate-800 mt-8 mb-4">Akses Cepat Master Data</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Siswa Widget -->
                <a href="{{ route('admin.siswa') }}" class="group block">
                    <x-modern-card class="h-full border-l-4 border-l-brand-500 hover:border-l-accent-500 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-brand-50 text-brand-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 group-hover:text-brand-600 transition-colors">Kelola Siswa</h4>
                                <p class="text-sm text-slate-500">Data & Akun Siswa</p>
                            </div>
                        </div>
                    </x-modern-card>
                </a>

                <!-- Guru Widget -->
                <a href="{{ route('admin.guru') }}" class="group block">
                    <x-modern-card class="h-full border-l-4 border-l-sky-500 hover:border-l-accent-500 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-sky-50 text-sky-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 group-hover:text-sky-600 transition-colors">Kelola Guru</h4>
                                <p class="text-sm text-slate-500">Data & Akun Guru</p>
                            </div>
                        </div>
                    </x-modern-card>
                </a>

                <!-- Kelas Widget -->
                <a href="{{ route('admin.kelas') }}" class="group block">
                    <x-modern-card class="h-full border-l-4 border-l-amber-500 hover:border-l-accent-500 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 group-hover:text-amber-600 transition-colors">Kelola Kelas</h4>
                                <p class="text-sm text-slate-500">Daftar Rombel</p>
                            </div>
                        </div>
                    </x-modern-card>
                </a>

                <!-- Mapel Widget -->
                <a href="{{ route('admin.mapel') }}" class="group block">
                    <x-modern-card class="h-full border-l-4 border-l-rose-500 hover:border-l-accent-500 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 rounded-full bg-rose-50 text-rose-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-slate-800 group-hover:text-rose-600 transition-colors">Kelola Mapel</h4>
                                <p class="text-sm text-slate-500">Mata Pelajaran</p>
                            </div>
                        </div>
                    </x-modern-card>
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>
