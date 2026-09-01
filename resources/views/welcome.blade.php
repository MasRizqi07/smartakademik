<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SmartAkademik - MAN 4 Jombang</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-surface text-text-primary font-sans min-h-screen flex flex-col items-center justify-center p-4">
    <div class="w-full max-w-lg text-center">
        <!-- School Logo/Icon -->
        <div class="w-20 h-20 rounded-2xl bg-brand flex items-center justify-center text-white mx-auto mb-6 shadow-lg">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
        </div>

        <h1 class="text-3xl sm:text-4xl font-extrabold text-brand mb-3">SmartAkademik</h1>
        <p class="text-lg text-text-secondary mb-2">MAN 4 Jombang</p>
        <p class="text-sm text-text-secondary mb-8 max-w-sm mx-auto">Platform operasional akademik harian — presensi, nilai formatif, dan manajemen jadwal terintegrasi.</p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            @auth
                <a href="{{ route('dashboard') }}" class="inline-flex items-center justify-center gap-2 min-h-touch-target px-8 bg-brand text-white font-semibold text-sm rounded-lg shadow-sm hover:bg-brand-hover transition-all active:scale-95">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" /></svg>
                    <span>Buka Dashboard</span>
                </a>
            @else
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center gap-2 min-h-touch-target px-8 bg-brand text-white font-semibold text-sm rounded-lg shadow-sm hover:bg-brand-hover transition-all active:scale-95">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" /></svg>
                    <span>Masuk Portal</span>
                </a>
                <a href="{{ url('/portal') }}" class="inline-flex items-center justify-center gap-2 min-h-touch-target px-6 bg-surface text-brand font-semibold text-sm rounded-lg border border-brand/30 hover:bg-white transition-all">
                    <span>Pilih Peran</span>
                </a>
            @endauth
        </div>
    </div>

    <footer class="mt-auto py-6 text-center text-xs text-text-secondary">
        &copy; {{ date('Y') }} MAN 4 Jombang. All rights reserved.
    </footer>
</body>
</html>
