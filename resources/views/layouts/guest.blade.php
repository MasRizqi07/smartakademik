<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SmartAkademik') }} - MAN 4 Jombang</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="bg-surface text-on-surface antialiased min-h-screen relative font-sans flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <!-- Subtle Glow Elements -->
        <div class="fixed inset-0 z-0 pointer-events-none opacity-40">
            <div class="absolute top-[-10%] left-[20%] w-[500px] h-[500px] rounded-full bg-primary/10 blur-[120px]"></div>
            <div class="absolute bottom-[-10%] right-[20%] w-[500px] h-[500px] rounded-full bg-secondary-container/30 blur-[120px]"></div>
        </div>

        <div class="relative z-10 w-full max-w-md">
            {{ $slot }}
        </div>
    </body>
</html>

