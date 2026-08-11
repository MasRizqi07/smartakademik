<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmartAkademik') }}</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased text-slate-800 bg-gradient-to-br from-slate-50 to-emerald-50/30 min-h-screen">
        <div class="min-h-screen flex flex-col relative overflow-hidden">
            <!-- Decorative background elements -->
            <div class="absolute top-[-10%] left-[-10%] w-[40%] h-[40%] rounded-full bg-brand-500/5 blur-3xl pointer-events-none z-0"></div>
            <div class="absolute bottom-[-10%] right-[-5%] w-[30%] h-[40%] rounded-full bg-accent-500/5 blur-3xl pointer-events-none z-0"></div>
            
            <div class="relative z-10 w-full flex-grow flex flex-col">
                <livewire:layout.navigation />

                <!-- Page Heading -->
                @if (isset($header))
                    <header class="bg-white/80 backdrop-blur-md border-b border-slate-200/60 sticky top-0 z-40 shadow-sm transition-all duration-300">
                        <div class="max-w-7xl mx-auto py-5 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <!-- Page Content -->
                <main class="flex-grow animate-fade-in">
                    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
                        {{ $slot }}
                    </div>
                </main>
                
                <!-- Footer -->
                <footer class="mt-auto py-6 text-center text-sm text-slate-500">
                    &copy; {{ date('Y') }} SmartAkademik MAN 4 Jombang. All rights reserved.
                </footer>
            </div>
        </div>
    </body>
</html>
