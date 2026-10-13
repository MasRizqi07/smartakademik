# System Architecture — SmartAkademik MAN 4 Jombang

Dokumentasi arsitektur sistem teknis lengkap telah tersedia pada direktori `docs/`:

👉 **[Buka Dokumentasi Arsitektur Sistem Lengkap (docs/ARCHITECTURE.md)](docs/ARCHITECTURE.md)**

### Ringkasan Cepat Arsitektur
- **Arsitektur Utama:** Modern Reactive Monolith (Laravel 11 + Livewire 3 + Tailwind CSS 3).
- **Model Data:** Normalisasi relasional dengan composite unique constraints (anti-bentrok jadwal & anti double-entry absensi).
- **Otorisasi Berlapis (4-Layer Defense-in-Depth):**
  1. Route Middleware (`role:admin_tu|waka_kurikulum|guru|siswa`)
  2. Component Mount & Policy Authorization (`authorize`)
  3. Query Scoping (Guru Schedule Isolation)
  4. Method & Attribute Guard (`#[Locked]` & Rollover Rejection Guard)
- **Optimasi Performa:** Kueri agregasi konstan $O(1)$ untuk analitik dan pelaporan akademik tanpa isu $N+1$.
- **Zona Waktu Terstandar:** Waktu Indonesia Barat (`Asia/Jakarta`, UTC+7).
