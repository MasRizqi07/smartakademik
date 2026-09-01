<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmartAkademik') }} - MAN 4 Jombang</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-surface-page text-text-primary antialiased min-h-screen relative font-sans">
        <div class="min-h-screen flex flex-col md:flex-row relative">
            <livewire:layout.navigation />

            <!-- Main Content Wrapper -->
            <div class="flex-1 md:ml-64 w-full md:w-[calc(100%-16rem)] min-h-screen flex flex-col relative z-10 transition-all">
                @if (isset($header))
                    <header class="bg-surface/90 backdrop-blur-md border-b border-border-default h-16 px-6 sticky top-0 flex items-center justify-between z-30">
                        <div class="max-w-7xl w-full mx-auto flex items-center justify-between gap-4">
                            <div class="flex-1 truncate">
                                {{ $header }}
                            </div>
                        </div>
                    </header>
                @endif

                <!-- Page Canvas -->
                <main class="flex-1 p-4 md:p-8 max-w-[1280px] mx-auto w-full flex flex-col gap-section-margin animate-fade-in">
                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="mt-auto py-6 px-6 text-center text-label-sm text-text-secondary border-t border-border-default/60">
                    <span>&copy; {{ date('Y') }} MAN 4 Jombang Academic Portal. All rights reserved.</span>
                </footer>
            </div>
        </div>
    </body>
</html>
