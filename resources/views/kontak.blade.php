<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Tim Support - MAN 4 Jombang Academic Portal</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-body-default min-h-screen flex flex-col antialiased">
    <!-- Ambient Background -->
    <div class="fixed inset-0 z-[-1] pointer-events-none opacity-20 shader-bg"></div>

    <!-- Navigation Header -->
    <header class="bg-surface/80 backdrop-blur-md border-b border-border-default sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-9 h-9 rounded-lg bg-primary flex items-center justify-center text-on-primary font-bold shadow-xs">
                        <span class="material-symbols-outlined text-[22px]">school</span>
                    </div>
                    <span class="font-headline-md text-headline-md font-bold text-primary">MAN 4 Jombang</span>
                </a>

                <nav class="hidden md:flex items-center gap-8">
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/fitur') }}">Fitur</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/prestasi') }}">Prestasi</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/kalender') }}">Kalender</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/tentang') }}">Tentang</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/bantuan') }}">Bantuan</a>
                    <a class="font-label-md text-label-md text-primary font-bold transition-colors" href="{{ url('/kontak') }}">Kontak</a>
                </nav>

                <div class="flex items-center gap-3">
                    
                    @auth
                        <a class="bg-primary text-on-primary font-label-md text-label-md px-5 py-2 rounded-lg hover:bg-primary-container transition-colors shadow-sm h-touch-target flex items-center gap-2" href="{{ route('dashboard') }}">
                            <span>Dashboard</span>
                            <span class="material-symbols-outlined text-[18px]">dashboard</span>
                        </a>
                    @else
                        <a class="bg-primary text-on-primary font-label-md text-label-md px-6 py-2 rounded-lg hover:bg-primary-container transition-colors shadow-sm h-touch-target flex items-center gap-2" href="{{ route('login') }}">
                            <span>Masuk Portal</span>
                            <span class="material-symbols-outlined text-[18px]">login</span>
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="flex-1 max-w-7xl mx-auto w-full p-4 sm:p-6 lg:p-8">
        <livewire:kontak-support />
    </main>

    <!-- Footer -->
    <footer class="bg-surface border-t border-border-default py-8 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="font-label-sm text-label-sm text-on-surface-variant">
                &copy; {{ date('Y') }} MAN 4 Jombang Academic Portal. All rights reserved.
            </p>
            <div class="flex items-center gap-4 text-label-sm text-on-surface-variant">
                <a href="{{ url('/') }}" class="hover:text-primary transition-colors">Beranda</a>
                <span>&bull;</span>
                <a href="{{ url('/fitur') }}" class="hover:text-primary transition-colors">Fitur</a>
                <span>&bull;</span>
                <a href="{{ url('/bantuan') }}" class="hover:text-primary transition-colors">Pusat Bantuan</a>
            </div>
        </div>
    </footer>
</body>
</html>
