<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan &amp; Dokumentasi - MAN 4 Jombang Academic Portal</title>
    <x-theme-init />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-surface text-on-surface font-body-default min-h-screen flex flex-col antialiased" x-data="{
    searchQuery: '',
    activeTab: 'semua',
    openFaq: null,
    toggleFaq(id) {
        this.openFaq = this.openFaq === id ? null : id;
    }
}">
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
                    <a class="font-label-md text-label-md text-primary font-bold transition-colors" href="{{ url('/bantuan') }}">Bantuan</a>
                    <a class="font-label-md text-label-md text-on-surface-variant hover:text-primary transition-colors" href="{{ url('/kontak') }}">Kontak</a>
                </nav>

                <div class="flex items-center gap-3">
                    <x-theme-toggle variant="pill" />

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
    <main class="flex-1 max-w-5xl mx-auto w-full p-4 sm:p-6 lg:p-8 space-y-10">
        <!-- Hero Search Section -->
        <section class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default overflow-hidden relative p-8 md:p-12 text-center flex flex-col items-center">
            <span class="text-primary font-label-sm uppercase tracking-wider font-bold mb-2">Help Center &amp; Documentation</span>
            <h1 class="font-headline-lg text-3xl sm:text-4xl font-extrabold text-primary mb-3">Ada yang bisa kami bantu?</h1>
            <p class="font-body-lg text-body-lg text-on-surface-variant mb-8 max-w-xl">
                Cari panduan langkah demi langkah seputar presensi kelas, input nilai formatif, kalender jadwal, atau bantuan akun portal Anda.
            </p>

            <div class="relative w-full max-w-xl">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline text-[22px]">search</span>
                <input x-model="searchQuery" class="w-full pl-12 pr-4 py-3 bg-surface rounded-xl border border-border-default focus:border-primary focus:ring-2 focus:ring-primary/20 text-input-text font-input-text h-[52px] shadow-sm transition-all placeholder:text-outline" placeholder="Ketik kata kunci (contoh: presensi, nilai, password)..." type="text"/>
            </div>
        </section>

        <!-- Category Bento Grid -->
        <section class="space-y-4">
            <h2 class="font-headline-md text-xl font-bold text-text-main">Kategori Panduan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Absensi Card -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-card border border-border-default hover:border-primary/50 transition-all flex flex-col h-full hover-lift">
                    <div class="w-12 h-12 bg-secondary-container text-on-secondary-container rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[26px]">how_to_reg</span>
                    </div>
                    <h3 class="font-headline-md text-lg font-bold text-primary mb-2">Presensi Kehadiran</h3>
                    <p class="font-body-default text-on-surface-variant text-sm mb-4 flex-grow">
                        Panduan mencatat presensi harian siswa, mengelola status Hadir/Izin/Sakit/Alfa, dan sinkronisasi otomatis.
                    </p>
                    <ul class="flex flex-col gap-2 pt-2 border-t border-border-default/60 text-xs">
                        <li class="flex items-center gap-1.5 text-primary font-semibold hover:underline cursor-pointer" @click="toggleFaq('faq-1')">
                            <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span> Cara cepat input absensi 60 detik
                        </li>
                        <li class="flex items-center gap-1.5 text-primary font-semibold hover:underline cursor-pointer" @click="toggleFaq('faq-2')">
                            <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span> Mengubah status kehadiran kemarin
                        </li>
                    </ul>
                </div>

                <!-- Nilai Card -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-card border border-border-default hover:border-primary/50 transition-all flex flex-col h-full hover-lift">
                    <div class="w-12 h-12 bg-tertiary-container text-on-tertiary-container rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[26px]">grade</span>
                    </div>
                    <h3 class="font-headline-md text-lg font-bold text-primary mb-2">Penilaian Formatif</h3>
                    <p class="font-body-default text-on-surface-variant text-sm mb-4 flex-grow">
                        Instruksi pengisian nilai per Capaian TP 1-5, rumus rata-rata otomatis, dan export data nilai ke Excel.
                    </p>
                    <ul class="flex flex-col gap-2 pt-2 border-t border-border-default/60 text-xs">
                        <li class="flex items-center gap-1.5 text-primary font-semibold hover:underline cursor-pointer" @click="toggleFaq('faq-3')">
                            <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span> Input nilai formatif TP di smartphone
                        </li>
                        <li class="flex items-center gap-1.5 text-primary font-semibold hover:underline cursor-pointer" @click="toggleFaq('faq-4')">
                            <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span> Ekspor rekapan nilai kurikulum
                        </li>
                    </ul>
                </div>

                <!-- Jadwal & Akun Card -->
                <div class="bg-surface-container-lowest p-6 rounded-xl shadow-card border border-border-default hover:border-primary/50 transition-all flex flex-col h-full hover-lift">
                    <div class="w-12 h-12 bg-primary/10 text-primary rounded-xl flex items-center justify-center mb-4">
                        <span class="material-symbols-outlined text-[26px]">manage_accounts</span>
                    </div>
                    <h3 class="font-headline-md text-lg font-bold text-primary mb-2">Jadwal &amp; Akun Login</h3>
                    <p class="font-body-default text-on-surface-variant text-sm mb-4 flex-grow">
                        Informasi jadwal mengajar mingguan, reset password mandiri, dan integrasi nomor induk NIP/NISN.
                    </p>
                    <ul class="flex flex-col gap-2 pt-2 border-t border-border-default/60 text-xs">
                        <li class="flex items-center gap-1.5 text-primary font-semibold hover:underline cursor-pointer" @click="toggleFaq('faq-5')">
                            <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span> Lupa password akun madrasah
                        </li>
                        <li class="flex items-center gap-1.5 text-primary font-semibold hover:underline cursor-pointer" @click="toggleFaq('faq-6')">
                            <span class="material-symbols-outlined text-[16px]">arrow_right_alt</span> Menghubungi admin IT Support
                        </li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- Interactive FAQ Accordion Section -->
        <section class="bg-surface-container-lowest rounded-2xl shadow-card border border-border-default p-6 md:p-8 space-y-4">
            <h2 class="font-headline-md text-xl font-bold text-text-main mb-2">Pertanyaan yang Sering Diajukan (FAQ)</h2>

            <div class="space-y-3">
                <!-- FAQ Item 1 -->
                <div class="border border-border-default rounded-xl overflow-hidden">
                    <button @click="toggleFaq('faq-1')" class="w-full p-4 text-left font-label-md font-semibold text-text-main bg-surface/50 hover:bg-surface flex items-center justify-between transition-colors">
                        <span>Bagaimana cara mencatat presensi kelas dengan cepat?</span>
                        <span class="material-symbols-outlined transition-transform" :class="openFaq === 'faq-1' ? 'rotate-180 text-primary' : 'text-outline'">expand_more</span>
                    </button>
                    <div x-show="openFaq === 'faq-1'" x-collapse class="p-4 bg-surface-container-lowest border-t border-border-default/60 text-sm text-on-surface-variant leading-relaxed">
                        Masuk ke menu <strong>Input Presensi</strong> di navigasi kiri, pilih kelas dan mata pelajaran Anda. Gunakan tombol <strong>"Tandai Semua Hadir"</strong> di bagian atas untuk mencentang seluruh siswa sekaligus, lalu cukup ubah status siswa yang izin, sakit, atau alfa secara manual. Sistem akan menyimpan secara otomatis.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="border border-border-default rounded-xl overflow-hidden">
                    <button @click="toggleFaq('faq-2')" class="w-full p-4 text-left font-label-md font-semibold text-text-main bg-surface/50 hover:bg-surface flex items-center justify-between transition-colors">
                        <span>Apakah bapak/ibu guru bisa mengubah data presensi tanggal sebelumnya?</span>
                        <span class="material-symbols-outlined transition-transform" :class="openFaq === 'faq-2' ? 'rotate-180 text-primary' : 'text-outline'">expand_more</span>
                    </button>
                    <div x-show="openFaq === 'faq-2'" x-collapse class="p-4 bg-surface-container-lowest border-t border-border-default/60 text-sm text-on-surface-variant leading-relaxed">
                        Bisa. Anda dapat mengganti filter tanggal pada halaman presensi ke tanggal yang ingin disesuaikan. Pastikan perubahan dilakukan sebelum periode penutupan rekapitulasi bulanan oleh Waka Kurikulum.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="border border-border-default rounded-xl overflow-hidden">
                    <button @click="toggleFaq('faq-3')" class="w-full p-4 text-left font-label-md font-semibold text-text-main bg-surface/50 hover:bg-surface flex items-center justify-between transition-colors">
                        <span>Bagaimana format penilaian formatif di Kurikulum Merdeka?</span>
                        <span class="material-symbols-outlined transition-transform" :class="openFaq === 'faq-3' ? 'rotate-180 text-primary' : 'text-outline'">expand_more</span>
                    </button>
                    <div x-show="openFaq === 'faq-3'" x-collapse class="p-4 bg-surface-container-lowest border-t border-border-default/60 text-sm text-on-surface-variant leading-relaxed">
                        Nilai formatif diinputkan pada kolom TP 1 hingga TP 5 (rentang 0-100). Sistem secara otomatis menghitung nilai rata-rata dan memberikan indikator kelulusan KKM secara live.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="border border-border-default rounded-xl overflow-hidden">
                    <button @click="toggleFaq('faq-4')" class="w-full p-4 text-left font-label-md font-semibold text-text-main bg-surface/50 hover:bg-surface flex items-center justify-between transition-colors">
                        <span>Bagaimana cara masuk jika lupa kata sandi akun?</span>
                        <span class="material-symbols-outlined transition-transform" :class="openFaq === 'faq-4' ? 'rotate-180 text-primary' : 'text-outline'">expand_more</span>
                    </button>
                    <div x-show="openFaq === 'faq-4'" x-collapse class="p-4 bg-surface-container-lowest border-t border-border-default/60 text-sm text-on-surface-variant leading-relaxed">
                        Klik tautan <strong>"Lupa Password?"</strong> pada halaman Login untuk mengatur ulang kata sandi via email terdaftar, atau hubungi <strong>Admin TU / Tim IT Support</strong> di madrasah untuk melakukan reset kredensial langsung.
                    </div>
                </div>
            </div>
        </section>

        <!-- Still Need Help CTA -->
        <section class="bg-gradient-to-r from-secondary-container/50 to-primary/10 border border-border-default rounded-2xl p-6 md:p-8 flex flex-col sm:flex-row items-center justify-between gap-6">
            <div>
                <h3 class="font-headline-md text-lg font-bold text-text-main">Masih membutuhkan bantuan teknis?</h3>
                <p class="text-sm text-on-surface-variant mt-1">Tim IT Support MAN 4 Jombang siap membantu operasional sistem akademik Anda.</p>
            </div>
            <a href="{{ url('/kontak') }}" class="bg-primary hover:bg-primary-container text-on-primary font-label-md px-6 py-3 rounded-lg shadow-sm transition-all shrink-0 flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px]">support_agent</span>
                <span>Hubungi IT Support</span>
            </a>
        </section>
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
                <a href="{{ url('/kontak') }}" class="hover:text-primary transition-colors">Kontak Support</a>
            </div>
        </div>
    </footer>
</body>
</html>
