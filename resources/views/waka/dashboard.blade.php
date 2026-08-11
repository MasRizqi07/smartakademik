<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Dashboard Waka Kurikulum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-slate-200">
                <div class="p-6 text-slate-900">
                    <h3 class="text-lg font-bold mb-4">Selamat datang, {{ auth()->user()->name }}!</h3>
                    <p class="mb-4">Sebagai Waka Kurikulum, Anda dapat mengelola jadwal pelajaran.</p>
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                        <a href="{{ route('waka.jadwal') }}" class="block p-4 bg-emerald-50 border border-emerald-200 rounded-lg text-emerald-800 hover:bg-emerald-100 transition-colors">Kelola Jadwal Pelajaran</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
