<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-800 leading-tight">
            {{ __('Dashboard Waka Kurikulum') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Greeting Card -->
            <div class="bg-gradient-to-r from-accent-600 to-brand-600 rounded-2xl p-8 text-white shadow-glow relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10 scale-150 transform translate-x-1/4 -translate-y-1/4">
                    <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 20 20"><path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"></path></svg>
                </div>
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-2">Selamat datang, {{ auth()->user()->name }}! 👋</h3>
                    <p class="text-brand-100 text-lg max-w-2xl">Pantau kurikulum dan kelola jadwal pelajaran di seluruh kelas dengan antarmuka modern.</p>
                </div>
            </div>

            <h3 class="text-xl font-bold text-slate-800 mt-8 mb-4">Akses Cepat Kurikulum</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Jadwal Widget -->
                <a href="{{ route('waka.jadwal') }}" class="group block">
                    <x-modern-card class="h-full border-l-4 border-l-brand-500 hover:border-l-accent-500 hover:shadow-lg transition-all duration-300">
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center group-hover:scale-110 transition-transform shadow-sm border border-brand-100">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl text-slate-800 group-hover:text-brand-600 transition-colors">Kelola Jadwal</h4>
                                <p class="text-base text-slate-500 mt-1">Atur jadwal mengajar guru per rombongan belajar</p>
                            </div>
                        </div>
                    </x-modern-card>
                </a>
            </div>
            
        </div>
    </div>
</x-app-layout>
