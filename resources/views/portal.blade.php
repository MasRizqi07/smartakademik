<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk Portal - MAN 4 Jombang Academic Portal</title>
    <x-theme-init />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body-default min-h-screen flex items-center justify-center shader-bg overflow-x-hidden relative p-4">
    <!-- Floating Theme Toggle in Top Right -->
    <div class="fixed top-5 right-5 z-50">
        <x-theme-toggle variant="pill" />
    </div>

    <!-- Decorative Ambient Elements -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-primary rounded-full mix-blend-multiply filter blur-[100px] opacity-20 animate-pulse pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-tertiary rounded-full mix-blend-multiply filter blur-[120px] opacity-20 pointer-events-none" style="animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;"></div>

    <div class="w-full max-w-5xl px-4 sm:px-6 lg:px-8 relative z-10 flex flex-col items-center py-12">
        <!-- Header Section -->
        <div class="text-center mb-12 flex flex-col items-center">
            <div class="w-16 h-16 rounded-2xl bg-primary flex items-center justify-center text-on-primary font-bold shadow-md mb-4">
                <span class="material-symbols-outlined text-[36px]">school</span>
            </div>
            <h1 class="font-headline-lg text-3xl sm:text-4xl font-extrabold text-primary mb-2">MAN 4 Jombang</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant max-w-md">Pilih portal peran Anda untuk masuk ke dalam sistem akademik terpadu</p>
        </div>

        <!-- Portal Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 w-full mb-10">
            <!-- Guru Card -->
            <a class="glass-card rounded-2xl p-8 flex flex-col items-center justify-center text-center hover-lift group relative overflow-hidden transition-all duration-300 border border-border-default hover:border-primary/50 shadow-sm hover:shadow-xl bg-surface-container-lowest/90 backdrop-blur-md" href="{{ route('login', ['role' => 'guru']) }}">
                <div class="absolute inset-0 bg-primary opacity-0 group-hover:opacity-5 transition-opacity duration-300 pointer-events-none"></div>
                <div class="w-20 h-20 bg-primary/10 rounded-2xl flex items-center justify-center shadow-xs mb-6 text-primary group-hover:bg-primary group-hover:text-on-primary transition-all duration-300 group-hover:scale-110">
                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">school</span>
                </div>
                <h2 class="font-headline-md text-[22px] font-bold text-on-surface mb-2">Portal Guru</h2>
                <p class="font-body-default text-body-default text-on-surface-variant leading-relaxed">Akses cepat presensi kelas, input nilai formatif TP, dan jadwal mengajar.</p>
                <div class="mt-6 text-primary font-label-md text-label-md flex items-center gap-1.5 font-bold transition-all duration-300 transform group-hover:translate-x-1">
                    <span>Masuk sebagai Guru</span>
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </div>
            </a>

            <!-- Siswa Card -->
            <a class="glass-card rounded-2xl p-8 flex flex-col items-center justify-center text-center hover-lift group relative overflow-hidden transition-all duration-300 border border-border-default hover:border-tertiary/50 shadow-sm hover:shadow-xl bg-surface-container-lowest/90 backdrop-blur-md" href="{{ route('login', ['role' => 'siswa']) }}">
                <div class="absolute inset-0 bg-tertiary opacity-0 group-hover:opacity-5 transition-opacity duration-300 pointer-events-none"></div>
                <div class="w-20 h-20 bg-tertiary/10 rounded-2xl flex items-center justify-center shadow-xs mb-6 text-tertiary group-hover:bg-tertiary group-hover:text-on-tertiary transition-all duration-300 group-hover:scale-110">
                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">face</span>
                </div>
                <h2 class="font-headline-md text-[22px] font-bold text-on-surface mb-2">Portal Siswa</h2>
                <p class="font-body-default text-body-default text-on-surface-variant leading-relaxed">Lihat jadwal pelajaran, pantau rekap kehadiran mandiri, dan capaian nilai formatif.</p>
                <div class="mt-6 text-tertiary font-label-md text-label-md flex items-center gap-1.5 font-bold transition-all duration-300 transform group-hover:translate-x-1">
                    <span>Masuk sebagai Siswa</span>
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </div>
            </a>

            <!-- Admin & Waka Card -->
            <a class="glass-card rounded-2xl p-8 flex flex-col items-center justify-center text-center hover-lift group relative overflow-hidden transition-all duration-300 border border-border-default hover:border-secondary/50 shadow-sm hover:shadow-xl bg-surface-container-lowest/90 backdrop-blur-md" href="{{ route('login', ['role' => 'admin']) }}">
                <div class="absolute inset-0 bg-secondary opacity-0 group-hover:opacity-5 transition-opacity duration-300 pointer-events-none"></div>
                <div class="w-20 h-20 bg-secondary/10 rounded-2xl flex items-center justify-center shadow-xs mb-6 text-secondary group-hover:bg-secondary group-hover:text-on-secondary transition-all duration-300 group-hover:scale-110">
                    <span class="material-symbols-outlined text-4xl" style="font-variation-settings: 'FILL' 1;">manage_accounts</span>
                </div>
                <h2 class="font-headline-md text-[22px] font-bold text-on-surface mb-2">Admin &amp; Waka</h2>
                <p class="font-body-default text-body-default text-on-surface-variant leading-relaxed">Kelola data master siswa, guru, jadwal, rekapitulasi sekolah, dan pengaturan sistem.</p>
                <div class="mt-6 text-secondary font-label-md text-label-md flex items-center gap-1.5 font-bold transition-all duration-300 transform group-hover:translate-x-1">
                    <span>Masuk sebagai Admin</span>
                    <span class="material-symbols-outlined text-lg">arrow_forward</span>
                </div>
            </a>
        </div>

        <!-- Back Link & Footer -->
        <div class="flex items-center gap-6">
            <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors flex items-center gap-2" href="{{ url('/') }}">
                <span class="material-symbols-outlined text-sm">arrow_back</span>
                <span>Kembali ke Beranda Utama</span>
            </a>
            <span class="text-border-default">&bull;</span>
            <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors flex items-center gap-1.5" href="{{ url('/bantuan') }}">
                <span class="material-symbols-outlined text-sm">help</span>
                <span>Butuh Bantuan?</span>
            </a>
        </div>
    </div>
</body>
</html>
