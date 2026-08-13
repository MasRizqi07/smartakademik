<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MAN 4 Jombang - Academic Portal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface antialiased min-h-screen relative font-sans">

    <!-- Top Navigation Header -->
    <header class="bg-surface-container-lowest/80 backdrop-blur-md border-b border-border-default h-20 px-6 sm:px-12 sticky top-0 flex justify-between items-center z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-primary flex items-center justify-center text-on-primary font-bold shadow-sm">
                <span class="material-symbols-outlined text-[24px]">school</span>
            </div>
            <div>
                <h1 class="font-headline-md text-headline-md font-bold text-primary">MAN 4 Jombang</h1>
                <p class="font-label-sm text-[11px] text-on-surface-variant uppercase tracking-wider">Academic Portal</p>
            </div>
        </div>

        <div class="flex items-center gap-4">
            @if (Route::has('login'))
                @auth
                    <a href="{{ route('dashboard') }}" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs hover:shadow-md transition-all flex items-center gap-2">
                        <span>Dashboard</span>
                        <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="h-touch-target px-6 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-xs hover:shadow-md transition-all flex items-center gap-2">
                        <span>Masuk Portal</span>
                        <span class="material-symbols-outlined text-[18px]">login</span>
                    </a>
                @endauth
            @endif
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex flex-col gap-16 py-12 px-6 sm:px-12 max-w-[1280px] mx-auto">
        <!-- Hero Section -->
        <section class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center py-6">
            <div class="flex flex-col gap-6">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-secondary-container text-on-secondary-container font-label-sm w-max">
                    <span class="material-symbols-outlined text-[16px]">verified</span>
                    <span>Sistem Informasi Akademik Resmi</span>
                </div>
                <h1 class="font-headline-lg text-4xl sm:text-5xl font-extrabold text-text-main leading-tight">
                    Transformasi Digital Operational Akademik
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant leading-relaxed">
                    Platform terpadu pengelolaan presensi kelas real-time, penilaian formatif digital, dan rekapitulasi kurikulum otomatis di Madrasah Aliyah Negeri 4 Jombang.
                </p>

                <div class="flex flex-wrap gap-4 pt-2">
                    @auth
                        <a href="{{ route('dashboard') }}" class="h-touch-target px-8 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 active:scale-95">
                            <span>Buka Portal Akademik</span>
                            <span class="material-symbols-outlined text-[20px]">dashboard</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="h-touch-target px-8 bg-primary hover:bg-primary-container text-on-primary font-label-md rounded-DEFAULT shadow-md hover:shadow-lg transition-all flex items-center justify-center gap-2 active:scale-95">
                            <span>Masuk Portal Sekarang</span>
                            <span class="material-symbols-outlined text-[20px]">login</span>
                        </a>
                    @endauth
                </div>

                <!-- Stats Overview -->
                <div class="grid grid-cols-3 gap-4 pt-6 border-t border-border-default/60">
                    <div>
                        <div class="font-headline-lg text-2xl font-bold text-primary">100%</div>
                        <div class="font-label-sm text-on-surface-variant">Presensi Digital</div>
                    </div>
                    <div>
                        <div class="font-headline-lg text-2xl font-bold text-primary">&lt; 60s</div>
                        <div class="font-label-sm text-on-surface-variant">Input per Kelas</div>
                    </div>
                    <div>
                        <div class="font-headline-lg text-2xl font-bold text-primary">Real-time</div>
                        <div class="font-label-sm text-on-surface-variant">Rekap Kurikulum</div>
                    </div>
                </div>
            </div>

            <!-- Hero Feature Cards Illustration -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-lg bg-status-hadir/10 text-status-hadir flex items-center justify-center">
                        <span class="material-symbols-outlined text-[28px]">fact_check</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md font-bold text-text-main">Presensi Terpadu</h3>
                    <p class="font-body-default text-body-default text-on-surface-variant">Pencatatan Hadir, Izin, Sakit, Alfa presisi dengan hit target 44px ramah perangkat seluler.</p>
                </div>

                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-lg bg-status-sakit/10 text-status-sakit flex items-center justify-center">
                        <span class="material-symbols-outlined text-[28px]">edit_note</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md font-bold text-text-main">Input Formatif</h3>
                    <p class="font-body-default text-body-default text-on-surface-variant">Penginputan nilai mata pelajaran dengan validasi otomatis dan keyboard numeric intuitif.</p>
                </div>

                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-lg bg-status-izin/10 text-status-izin flex items-center justify-center">
                        <span class="material-symbols-outlined text-[28px]">assessment</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md font-bold text-text-main">Laporan Waka</h3>
                    <p class="font-body-default text-body-default text-on-surface-variant">Rekapitulasi bulanan otomatis dan matriks capaian kurikulum madrasah secara akurat.</p>
                </div>

                <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card flex flex-col gap-3">
                    <div class="w-12 h-12 rounded-lg bg-primary-container/10 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[28px]">groups</span>
                    </div>
                    <h3 class="font-headline-md text-headline-md font-bold text-text-main">Manajemen Data</h3>
                    <p class="font-body-default text-body-default text-on-surface-variant">Pengelolaan data guru, siswa, kelas, dan jadwal pelajaran dalam satu dashboard admin.</p>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="bg-surface-container-lowest border-t border-border-default py-8 px-6 text-center text-on-surface-variant font-body-default">
        <p>&copy; {{ date('Y') }} MAN 4 Jombang Academic Portal. Built for High-Performance Academic Operations.</p>
    </footer>

</body>
</html>

                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><g fill="#FF2D20"><path d="M8.75 4.5H5.5c-.69 0-1.25.56-1.25 1.25v4.75c0 .69.56 1.25 1.25 1.25h3.25c.69 0 1.25-.56 1.25-1.25V5.75c0-.69-.56-1.25-1.25-1.25Z"/><path d="M24 10a3 3 0 0 0-3-3h-2V2.5a2 2 0 0 0-2-2H2a2 2 0 0 0-2 2V20a3.5 3.5 0 0 0 3.5 3.5h17A3.5 3.5 0 0 0 24 20V10ZM3.5 21.5A1.5 1.5 0 0 1 2 20V3a.5.5 0 0 1 .5-.5h14a.5.5 0 0 1 .5.5v17c0 .295.037.588.11.874a.5.5 0 0 1-.484.625L3.5 21.5ZM22 20a1.5 1.5 0 1 1-3 0V9.5a.5.5 0 0 1 .5-.5H21a1 1 0 0 1 1 1v10Z"/><path d="M12.751 6.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 7.3v-.5a.75.75 0 0 1 .751-.753ZM12.751 10.047h2a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-2A.75.75 0 0 1 12 11.3v-.5a.75.75 0 0 1 .751-.753ZM4.751 14.047h10a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-10A.75.75 0 0 1 4 15.3v-.5a.75.75 0 0 1 .751-.753ZM4.75 18.047h7.5a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-.75.75h-7.5A.75.75 0 0 1 4 19.3v-.5a.75.75 0 0 1 .75-.753Z"/></g></svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Laravel News</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Laravel News is a community driven portal and newsletter aggregating all of the latest and most important news in the Laravel ecosystem, including new package releases and tutorials.
                                    </p>
                                </div>

                                <svg class="size-6 shrink-0 self-center stroke-[#FF2D20]" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/></svg>
                            </a>

                            <div class="flex items-start gap-4 rounded-lg bg-white p-6 shadow-[0px_14px_34px_0px_rgba(0,0,0,0.08)] ring-1 ring-white/[0.05] lg:pb-10 dark:bg-zinc-900 dark:ring-zinc-800">
                                <div class="flex size-12 shrink-0 items-center justify-center rounded-full bg-[#FF2D20]/10 sm:size-16">
                                    <svg class="size-5 sm:size-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <g fill="#FF2D20">
                                            <path
                                                d="M16.597 12.635a.247.247 0 0 0-.08-.237 2.234 2.234 0 0 1-.769-1.68c.001-.195.03-.39.084-.578a.25.25 0 0 0-.09-.267 8.8 8.8 0 0 0-4.826-1.66.25.25 0 0 0-.268.181 2.5 2.5 0 0 1-2.4 1.824.045.045 0 0 0-.045.037 12.255 12.255 0 0 0-.093 3.86.251.251 0 0 0 .208.214c2.22.366 4.367 1.08 6.362 2.118a.252.252 0 0 0 .32-.079 10.09 10.09 0 0 0 1.597-3.733ZM13.616 17.968a.25.25 0 0 0-.063-.407A19.697 19.697 0 0 0 8.91 15.98a.25.25 0 0 0-.287.325c.151.455.334.898.548 1.328.437.827.981 1.594 1.619 2.28a.249.249 0 0 0 .32.044 29.13 29.13 0 0 0 2.506-1.99ZM6.303 14.105a.25.25 0 0 0 .265-.274 13.048 13.048 0 0 1 .205-4.045.062.062 0 0 0-.022-.07 2.5 2.5 0 0 1-.777-.982.25.25 0 0 0-.271-.149 11 11 0 0 0-5.6 2.815.255.255 0 0 0-.075.163c-.008.135-.02.27-.02.406.002.8.084 1.598.246 2.381a.25.25 0 0 0 .303.193 19.924 19.924 0 0 1 5.746-.438ZM9.228 20.914a.25.25 0 0 0 .1-.393 11.53 11.53 0 0 1-1.5-2.22 12.238 12.238 0 0 1-.91-2.465.248.248 0 0 0-.22-.187 18.876 18.876 0 0 0-5.69.33.249.249 0 0 0-.179.336c.838 2.142 2.272 4 4.132 5.353a.254.254 0 0 0 .15.048c1.41-.01 2.807-.282 4.117-.802ZM18.93 12.957l-.005-.008a.25.25 0 0 0-.268-.082 2.21 2.21 0 0 1-.41.081.25.25 0 0 0-.217.2c-.582 2.66-2.127 5.35-5.75 7.843a.248.248 0 0 0-.09.299.25.25 0 0 0 .065.091 28.703 28.703 0 0 0 2.662 2.12.246.246 0 0 0 .209.037c2.579-.701 4.85-2.242 6.456-4.378a.25.25 0 0 0 .048-.189 13.51 13.51 0 0 0-2.7-6.014ZM5.702 7.058a.254.254 0 0 0 .2-.165A2.488 2.488 0 0 1 7.98 5.245a.093.093 0 0 0 .078-.062 19.734 19.734 0 0 1 3.055-4.74.25.25 0 0 0-.21-.41 12.009 12.009 0 0 0-10.4 8.558.25.25 0 0 0 .373.281 12.912 12.912 0 0 1 4.826-1.814ZM10.773 22.052a.25.25 0 0 0-.28-.046c-.758.356-1.55.635-2.365.833a.25.25 0 0 0-.022.48c1.252.43 2.568.65 3.893.65.1 0 .2 0 .3-.008a.25.25 0 0 0 .147-.444c-.526-.424-1.1-.917-1.673-1.465ZM18.744 8.436a.249.249 0 0 0 .15.228 2.246 2.246 0 0 1 1.352 2.054c0 .337-.08.67-.23.972a.25.25 0 0 0 .042.28l.007.009a15.016 15.016 0 0 1 2.52 4.6.25.25 0 0 0 .37.132.25.25 0 0 0 .096-.114c.623-1.464.944-3.039.945-4.63a12.005 12.005 0 0 0-5.78-10.258.25.25 0 0 0-.373.274c.547 2.109.85 4.274.901 6.453ZM9.61 5.38a.25.25 0 0 0 .08.31c.34.24.616.561.8.935a.25.25 0 0 0 .3.127.631.631 0 0 1 .206-.034c2.054.078 4.036.772 5.69 1.991a.251.251 0 0 0 .267.024c.046-.024.093-.047.141-.067a.25.25 0 0 0 .151-.23A29.98 29.98 0 0 0 15.957.764a.25.25 0 0 0-.16-.164 11.924 11.924 0 0 0-2.21-.518.252.252 0 0 0-.215.076A22.456 22.456 0 0 0 9.61 5.38Z"
                                            />
                                        </g>
                                    </svg>
                                </div>

                                <div class="pt-3 sm:pt-5">
                                    <h2 class="text-xl font-semibold text-black dark:text-white">Vibrant Ecosystem</h2>

                                    <p class="mt-4 text-sm/relaxed">
                                        Laravel's robust library of first-party tools and libraries, such as <a href="https://forge.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white dark:focus-visible:ring-[#FF2D20]">Forge</a>, <a href="https://vapor.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Vapor</a>, <a href="https://nova.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Nova</a>, <a href="https://envoyer.io" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Envoyer</a>, and <a href="https://herd.laravel.com" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Herd</a> help you take your projects to the next level. Pair them with powerful open source libraries like <a href="https://laravel.com/docs/billing" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Cashier</a>, <a href="https://laravel.com/docs/dusk" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Dusk</a>, <a href="https://laravel.com/docs/broadcasting" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Echo</a>, <a href="https://laravel.com/docs/horizon" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Horizon</a>, <a href="https://laravel.com/docs/sanctum" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Sanctum</a>, <a href="https://laravel.com/docs/telescope" class="rounded-sm underline hover:text-black focus:outline-none focus-visible:ring-1 focus-visible:ring-[#FF2D20] dark:hover:text-white">Telescope</a>, and more.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </main>

                    <footer class="py-16 text-center text-sm text-black dark:text-white/70">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
    </body>
</html>
