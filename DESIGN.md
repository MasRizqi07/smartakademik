# UI/UX Design System — SmartAkademik MAN 4 Jombang

Dokumentasi sistem desain UI/UX dan arsitektur token semantik lengkap telah tersedia pada direktori `docs/`:

👉 **[Buka Dokumentasi Sistem Desain UI/UX Lengkap (docs/DESIGN.md)](docs/DESIGN.md)**

### Ringkasan Cepat Sistem Desain
- **Prinsip Utama:** Utilitarian Speed over Frivolous Decoration (Mobile-first density, input presensi <60 detik per kelas).
- **Arsitektur Token:** Material Design 3 (M3) Semantic Tokens (`primary`, `surface-*`, `status-hadir`, `status-izin`, `status-sakit`, `status-alfa`).
- **Kebijakan Kualitas Desain (Zero Raw Hues):** 100% bebas dari utility warna mentah Tailwind arbitrer (`blue-*`, `indigo-*`, `purple-*`).
- **Standar Touch-Target:** Minimal 44x44px untuk kemudahan input guru di smartphone ruang kelas.
- **Audit Otomatis:** Diverifikasi berkala via `scripts/check-discipline.sh`.
