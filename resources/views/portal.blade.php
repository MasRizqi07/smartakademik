<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Portal - MAN 4 Jombang Academic Portal</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-brand-surface text-text-primary font-sans min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-5xl px-4 sm:px-6 lg:px-8 flex flex-col items-center py-12">
        <!-- Header Section -->
        <div class="text-center mb-12 flex flex-col items-center">
            <div class="w-16 h-16 rounded-2xl bg-brand flex items-center justify-center text-white font-bold shadow-md mb-4">
                <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
            </div>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-brand mb-2">MAN 4 Jombang</h1>
            <p class="text-base text-text-secondary max-w-md">Pilih portal peran Anda untuk masuk ke dalam sistem akademik</p>
        </div>

        <!-- Portal Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full mb-10">
            <!-- Guru Card -->
            <a class="bg-surface rounded-lg p-8 flex flex-col items-center justify-center text-center group border border-border hover:border-brand/50 shadow-card hover:shadow-lg transition-all duration-200" href="{{ route('login', ['role' => 'guru']) }}">
                <div class="w-16 h-16 bg-brand/10 rounded-xl flex items-center justify-center mb-6 text-brand group-hover:bg-brand group-hover:text-white transition-all duration-200">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                </div>
                <h2 class="text-xl font-bold text-text-primary mb-2">Portal Guru</h2>
                <p class="text-sm text-text-secondary leading-relaxed">Akses cepat presensi kelas, input nilai formatif TP, dan jadwal mengajar.</p>
                <div class="mt-6 text-brand text-sm flex items-center gap-1.5 font-bold transition-all duration-200 group-hover:translate-x-1">
                    <span>Masuk sebagai Guru</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </div>
            </a>

            <!-- Siswa Card -->
            <a class="bg-surface rounded-lg p-8 flex flex-col items-center justify-center text-center group border border-border hover:border-brand/50 shadow-card hover:shadow-lg transition-all duration-200" href="{{ route('login', ['role' => 'siswa']) }}">
                <div class="w-16 h-16 bg-brand/10 rounded-xl flex items-center justify-center mb-6 text-brand group-hover:bg-brand group-hover:text-white transition-all duration-200">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                </div>
                <h2 class="text-xl font-bold text-text-primary mb-2">Portal Siswa</h2>
                <p class="text-sm text-text-secondary leading-relaxed">Lihat jadwal pelajaran, pantau rekap kehadiran mandiri, dan capaian nilai formatif.</p>
                <div class="mt-6 text-brand text-sm flex items-center gap-1.5 font-bold transition-all duration-200 group-hover:translate-x-1">
                    <span>Masuk sebagai Siswa</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </div>
            </a>

            <!-- Admin & Waka Card -->
            <a class="bg-surface rounded-lg p-8 flex flex-col items-center justify-center text-center group border border-border hover:border-brand/50 shadow-card hover:shadow-lg transition-all duration-200" href="{{ route('login', ['role' => 'admin']) }}">
                <div class="w-16 h-16 bg-brand/10 rounded-xl flex items-center justify-center mb-6 text-brand group-hover:bg-brand group-hover:text-white transition-all duration-200">
                    <svg class="w-8 h-8" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                </div>
                <h2 class="text-xl font-bold text-text-primary mb-2">Admin & Waka</h2>
                <p class="text-sm text-text-secondary leading-relaxed">Kelola data master siswa, guru, jadwal, rekapitulasi sekolah, dan pengaturan sistem.</p>
                <div class="mt-6 text-brand text-sm flex items-center gap-1.5 font-bold transition-all duration-200 group-hover:translate-x-1">
                    <span>Masuk sebagai Admin</span>
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                </div>
            </a>
        </div>

        <!-- Back Link -->
        <div class="flex items-center gap-4 text-sm text-text-secondary">
            <a class="hover:text-brand transition-colors flex items-center gap-1" href="{{ url('/') }}">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" /></svg>
                <span>Kembali ke Beranda</span>
            </a>
        </div>
    </div>
</body>
</html>
