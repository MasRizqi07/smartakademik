<x-public-layout>
    <x-slot:title>Pusat Bantuan & Dokumentasi - MAN 4 Jombang</x-slot:title>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-12" x-data="{
        searchQuery: '',
        openFaq: null,
        toggleFaq(id) {
            this.openFaq = this.openFaq === id ? null : id;
        }
    }">
        <!-- Hero Search Section -->
        <section class="bg-gradient-to-b from-brand-surface to-surface p-8 sm:p-12 rounded-3xl border border-border shadow-sm text-center flex flex-col items-center">
            <span class="inline-block px-3.5 py-1 rounded-full bg-brand/10 text-brand font-bold text-xs uppercase tracking-wider mb-3">Pusat Bantuan & Panduan</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-text-primary tracking-tight mb-4">Ada yang bisa kami bantu?</h1>
            <p class="text-base text-text-secondary max-w-xl mx-auto mb-8 leading-relaxed">
                Cari panduan langkah demi langkah seputar presensi kelas, input nilai formatif, kalender jadwal, atau bantuan akun portal Anda.
            </p>

            <div class="relative w-full max-w-xl">
                <svg class="w-5 h-5 text-text-secondary absolute left-4 top-1/2 -translate-y-1/2" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                </svg>
                <input x-model="searchQuery" class="w-full pl-12 pr-4 py-3.5 bg-surface rounded-xl border border-border focus:border-brand focus:ring-2 focus:ring-brand/20 text-sm shadow-sm transition-all placeholder:text-text-secondary" placeholder="Ketik kata kunci (contoh: presensi, nilai, jadwal, password)..." type="text" />
            </div>
        </section>

        <!-- Category Grid -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold text-text-primary">Kategori Panduan</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Absensi Card -->
                <div class="bg-surface p-6 rounded-2xl border border-border shadow-xs flex flex-col justify-between hover:border-brand/40 transition-colors">
                    <div>
                        <div class="w-10 h-10 bg-brand/10 text-brand rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" /></svg>
                        </div>
                        <h3 class="text-lg font-bold text-text-primary mb-2">Presensi Kehadiran</h3>
                        <p class="text-xs text-text-secondary leading-relaxed mb-4">
                            Panduan mencatat presensi harian siswa, mengelola status Hadir/Izin/Sakit/Alfa, dan sinkronisasi otomatis.
                        </p>
                    </div>
                    <button @click="toggleFaq('faq-1')" class="text-xs font-bold text-brand flex items-center gap-1 hover:underline">
                        <span>Buka FAQ Presensi</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </button>
                </div>

                <!-- Nilai Card -->
                <div class="bg-surface p-6 rounded-2xl border border-border shadow-xs flex flex-col justify-between hover:border-brand/40 transition-colors">
                    <div>
                        <div class="w-10 h-10 bg-brand/10 text-brand rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" /></svg>
                        </div>
                        <h3 class="text-lg font-bold text-text-primary mb-2">Penilaian Formatif TP</h3>
                        <p class="text-xs text-text-secondary leading-relaxed mb-4">
                            Cara menginput nilai TP Kurikulum Merdeka, mengatur KKM mata pelajaran, dan mencetak laporan nilai.
                        </p>
                    </div>
                    <button @click="toggleFaq('faq-3')" class="text-xs font-bold text-brand flex items-center gap-1 hover:underline">
                        <span>Buka FAQ Nilai</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </button>
                </div>

                <!-- Akun & Keamanan Card -->
                <div class="bg-surface p-6 rounded-2xl border border-border shadow-xs flex flex-col justify-between hover:border-brand/40 transition-colors">
                    <div>
                        <div class="w-10 h-10 bg-brand/10 text-brand rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" /></svg>
                        </div>
                        <h3 class="text-lg font-bold text-text-primary mb-2">Akun & Sandi</h3>
                        <p class="text-xs text-text-secondary leading-relaxed mb-4">
                            Bantuan reset kata sandi, pengaturan profil guru/siswa, dan pemulihan akses masuk akun portal.
                        </p>
                    </div>
                    <button @click="toggleFaq('faq-5')" class="text-xs font-bold text-brand flex items-center gap-1 hover:underline">
                        <span>Buka FAQ Akun</span>
                        <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" /></svg>
                    </button>
                </div>
            </div>
        </section>

        <!-- FAQ Accordion Section -->
        <section class="space-y-4">
            <h2 class="text-xl font-bold text-text-primary">Pertanyaan Yang Sering Diajukan (FAQ)</h2>
            <div class="space-y-3">
                <!-- FAQ Item 1 -->
                <div class="bg-surface rounded-2xl border border-border overflow-hidden transition-all">
                    <button @click="toggleFaq('faq-1')" class="w-full p-5 text-left flex items-center justify-between gap-4 font-semibold text-sm text-text-primary hover:bg-slate-50">
                        <span>Bagaimana cara guru mencatat kehadiran siswa dengan cepat?</span>
                        <svg class="w-5 h-5 text-text-secondary shrink-0 transition-transform duration-200" :class="openFaq === 'faq-1' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <div x-show="openFaq === 'faq-1'" x-cloak class="px-5 pb-5 text-xs text-text-secondary leading-relaxed border-t border-border/50 pt-3">
                        Guru cukup masuk ke menu <strong>Presensi Kelas</strong>, pilih mata pelajaran dan tanggal hari ini. Tekan tombol <em>"Tandai Semua Hadir"</em>, lalu ubah hanya nama siswa yang berhalangan (Izin/Sakit/Alfa). Perubahan langsung tersimpan otomatis dengan tanda <em>Tersimpan ✓</em>.
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="bg-surface rounded-2xl border border-border overflow-hidden transition-all">
                    <button @click="toggleFaq('faq-2')" class="w-full p-5 text-left flex items-center justify-between gap-4 font-semibold text-sm text-text-primary hover:bg-slate-50">
                        <span>Apakah siswa bisa melihat rekapitulasi kehadiran dan nilai mereka?</span>
                        <svg class="w-5 h-5 text-text-secondary shrink-0 transition-transform duration-200" :class="openFaq === 'faq-2' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <div x-show="openFaq === 'faq-2'" x-cloak class="px-5 pb-5 text-xs text-text-secondary leading-relaxed border-t border-border/50 pt-3">
                        Ya! Siswa dapat login menggunakan NISN dan kata sandi yang diberikan TU. Di dashboard siswa, tersedia persentase kehadiran mandiri dan grafik capaian nilai formatif TP setiap mata pelajaran.
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="bg-surface rounded-2xl border border-border overflow-hidden transition-all">
                    <button @click="toggleFaq('faq-3')" class="w-full p-5 text-left flex items-center justify-between gap-4 font-semibold text-sm text-text-primary hover:bg-slate-50">
                        <span>Bagaimana format penilaian formatif di SmartAkademik?</span>
                        <svg class="w-5 h-5 text-text-secondary shrink-0 transition-transform duration-200" :class="openFaq === 'faq-3' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <div x-show="openFaq === 'faq-3'" x-cloak class="px-5 pb-5 text-xs text-text-secondary leading-relaxed border-t border-border/50 pt-3">
                        Penilaian menggunakan skala 0–100 sesuai standar Kurikulum Merdeka. Guru dapat mengisi nilai untuk TP 1 hingga TP 6. Nilai yang diinput akan otomatis dibandingkan dengan KKM mata pelajaran dan menghasilkan status Tuntas / Belum Tuntas secara instan.
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="bg-surface rounded-2xl border border-border overflow-hidden transition-all">
                    <button @click="toggleFaq('faq-4')" class="w-full p-5 text-left flex items-center justify-between gap-4 font-semibold text-sm text-text-primary hover:bg-slate-50">
                        <span>Bagaimana jika saya lupa kata sandi akun portal?</span>
                        <svg class="w-5 h-5 text-text-secondary shrink-0 transition-transform duration-200" :class="openFaq === 'faq-4' ? 'rotate-180' : ''" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" /></svg>
                    </button>
                    <div x-show="openFaq === 'faq-4'" x-cloak class="px-5 pb-5 text-xs text-text-secondary leading-relaxed border-t border-border/50 pt-3">
                        Guru dan siswa dapat menghubungi Staf Tata Usaha (TU) atau Waka Kurikulum untuk melakukan reset kata sandi instan melalui menu Manajemen User, atau menghubungi tim support via halaman Kontak.
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-public-layout>
