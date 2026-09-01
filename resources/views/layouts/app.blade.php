<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmartAkademik') }} — MAN 4 Jombang</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800|outfit:500,600,700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="bg-surface-page text-text-primary antialiased min-h-screen relative font-sans selection:bg-brand selection:text-white overflow-x-hidden">
        <div class="min-h-screen flex flex-col md:flex-row relative">
            <livewire:layout.navigation />

            <!-- Main Content Area -->
            <div class="flex-1 md:ml-64 w-full md:w-[calc(100%-16rem)] min-h-screen flex flex-col relative z-10 transition-all">
                <!-- Top Header Bar -->
                <header class="bg-white/85 backdrop-blur-md border-b border-slate-200/80 h-16 sm:h-20 px-4 sm:px-8 sticky top-0 flex items-center justify-between z-30 shadow-xs">
                    <div class="max-w-7xl w-full mx-auto flex items-center justify-between gap-4">
                        <div class="flex items-center gap-3 truncate">
                            @if (isset($header))
                                <div class="text-base sm:text-lg font-bold text-text-primary font-display truncate">
                                    {{ $header }}
                                </div>
                            @else
                                <div class="text-base font-bold text-text-primary font-display">
                                    SmartAkademik Portal
                                </div>
                            @endif
                        </div>

                        <!-- Top Right Academic Badges & Date -->
                        <div class="flex items-center gap-2 sm:gap-3">
                            <span class="hidden sm:inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-emerald-50 text-emerald-800 text-[11px] font-bold border border-emerald-200/60 shadow-2xs">
                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                <span>TP 2026/2027 Ganjil</span>
                            </span>

                            <span class="hidden lg:inline-flex text-[11px] text-text-secondary font-medium items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                                <span>{{ date('d M Y') }}</span>
                            </span>

                            <a href="{{ url('/') }}" target="_blank" title="Buka Portal Publik Madrasah" class="p-2 rounded-xl text-text-secondary hover:text-brand hover:bg-brand-surface border border-slate-200 transition-colors">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" /></svg>
                            </a>
                        </div>
                    </div>
                </header>

                <!-- Page Canvas -->
                <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl mx-auto w-full animate-fade-in space-y-6">
                    {{ $slot }}
                </main>

                <!-- App Footer -->
                <footer class="mt-auto py-5 px-6 text-center text-xs text-text-secondary border-t border-slate-200/80 bg-white/60">
                    <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-2">
                        <span>&copy; {{ date('Y') }} <strong>SmartAkademik</strong> — MAN 4 Jombang PP. Mamba'ul Ma'arif Denanyar.</span>
                        <a href="{{ route('kontak') }}" class="text-brand hover:underline font-medium">Bantuan &amp; Dukungan Sistem</a>
                    </div>
                </footer>
            </div>
        </div>

        @livewireScripts
    </body>
</html>
