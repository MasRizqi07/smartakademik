# Design System — Platform Operasional Akademik MAN 4 Jombang

**Stack:** Tailwind CSS (Laravel 13 default) + Blade + Livewire 3
**Prinsip:** mobile-first, data-density tinggi tapi tetap scannable, dipakai guru buru-buru di sela jam mengajar — bukan dashboard kontemplatif.

---

## 1. Prinsip Desain

1. **Kecepatan input di atas estetika.** Guru checklist absensi dalam <60 detik per kelas. Setiap elemen UI di flow absensi/nilai harus mengurangi tap, bukan menambah dekorasi.
2. **Mobile-first, bukan mobile-adapted.** Desain dari layar 375px ke atas, bukan desktop yang di-squeeze.
3. **Status visual instan.** Warna dan ikon untuk status kehadiran (hadir/izin/sakit/alfa) harus bisa dibaca sekilas tanpa membaca teks.
4. **Netral secara institusional.** Bukan web pemasaran sekolah — hindari ornamen islami/dekoratif berat yang sudah ada di website utama. Ini alat kerja, tampilan tenang dan fungsional.

## 2. Token Architecture (Material Design 3 Semantic Tokens)

Sistem token diimplementasikan langsung melalui theme extension di `tailwind.config.js` menggunakan penamaan semantik berbasis Material Design 3 (M3). Komponen menggunakan nama kelas semantik Tailwind (bukan arbitrary hex values inline).

```javascript
// tailwind.config.js theme.extend.colors
colors: {
    // Surface & Background
    'surface': '#f7f9fb',
    'surface-dim': '#d8dadc',
    'surface-bright': '#f7f9fb',
    'surface-container-lowest': '#ffffff',
    'surface-container-low': '#f2f4f6',
    'surface-container': '#eceef0',
    'surface-container-high': '#e6e8ea',
    'surface-container-highest': '#e0e3e5',
    'on-surface': '#191c1e',
    'on-surface-variant': '#3d4a42',
    
    // Brand & Primary
    'primary': '#006948',
    'on-primary': '#ffffff',
    'primary-container': '#00855d',
    'on-primary-container': '#f5fff7',
    
    // Secondary & Neutral
    'secondary': '#515f74',
    'on-secondary': '#ffffff',
    'secondary-container': '#d5e3fc',
    'on-secondary-container': '#57657a',
    
    // Status Absensi
    'status-hadir': '#22c55e',
    'status-izin':  '#f59e0b',
    'status-sakit': '#0ea5e9',
    'status-alfa':  '#f43f5e',
    
    // Borders & Text
    'border-default': '#e2e8f0',
    'text-main': '#0f172a',
    
    // Brand Palette
    brand: {
        50: '#ecfdf5',
        100: '#d1fae5',
        500: '#006948',
        600: '#006948',
        900: '#002114',
    }
}
```

> **Catatan Arsitektur Token & Dark Mode:**
> 3-tier CSS variable migration deferred until dark mode is actually scoped — tracked as a future phase, not MVP debt. Implementasi flat theme extension dengan semantic tokens yang aktif saat ini sudah stabil, teruji, dan mencukupi kebutuhan operasional MVP.

## 3. Tipografi

- **Font:** `Inter` (sudah default di starter kit Laravel 13, no extra load) — legibility tinggi di layar kecil.
- **Skala:**
  - `text-xs` (12px) — label sekunder, timestamp
  - `text-sm` (14px) — body default, isi tabel
  - `text-base` (16px) — form input (mencegah auto-zoom iOS saat fokus input)
  - `text-lg` / `text-xl` — judul halaman, angka ringkasan
- **Weight:** `font-medium` untuk label & nama siswa/mapel, `font-normal` untuk body, `font-semibold` hanya untuk judul & CTA.

## 4. Spacing & Layout

- Grid dasar: kelipatan 4px (Tailwind default).
- Touch target minimum **44×44px** — krusial untuk checklist absensi di HP, guru harus bisa tap tanpa salah pencet siswa sebelah.
- Container mobile: padding horizontal `px-4`, list item vertical gap `gap-2`.
- Breakpoint utama: `sm:` (≥640px, tablet) dan `lg:` (≥1024px, desktop Admin/TU & Waka Kurikulum). Guru & Siswa flow didesain cukup di breakpoint default (mobile).

## 5. Komponen Kunci

### 5.1 Status Badge (Absensi)
Pill kecil, warna solid dari token status, teks putih, ikon opsional:
- Hadir → hijau
- Izin → amber
- Sakit → sky blue
- Alfa → rose

Jangan pakai warna sama untuk dua status berbeda — ini satu-satunya sinyal visual yang guru baca sambil buru-buru.

### 5.2 Checklist Absensi (komponen paling sering dipakai)
- List siswa per kelas, 1 baris = 1 siswa: nama + 4 tombol status (bukan dropdown — dropdown terlalu banyak tap).
- Default state: belum ditandai (abu-abu netral), bukan default "hadir" — mencegah guru asal-submit tanpa cek.
- Livewire: update per-tap tanpa reload, optimistic UI dengan indikator saving kecil.
- Sticky submit button di bawah layar (mobile) supaya guru tidak perlu scroll ke atas.

### 5.3 Form Input (Nilai Formatif)
- Numeric input dengan `inputmode="numeric"` (munculkan keypad angka di HP, bukan keyboard penuh).
- Validasi range (0–100) inline, bukan setelah submit.

### 5.4 Tabel Data (Admin/TU, Waka Kurikulum — desktop-oriented)
- Untuk CRUD master data & rekap: tabel standar dengan sort/filter, boleh lebih dense karena role ini dominan akses dari desktop TU.
- Pagination, bukan infinite scroll — data akademik butuh referensi baris yang stabil (mis. saat cross-check dengan dokumen fisik).

## 6. Aksesibilitas Minimum

- Kontras teks minimum AA (4.5:1 body, 3:1 elemen UI besar) — dicek terhadap token di atas, bukan diasumsikan.
- Semua badge status punya teks/label, tidak hanya warna (untuk guru/siswa dengan buta warna).
- Focus state terlihat jelas (`ring-2 ring-emerald-500`) — banyak interaksi lewat keyboard/tab di sisi Admin/TU.

## 7. Yang Sengaja Tidak Dibangun (MVP)

- Dark mode toggle
- Animasi/transisi kompleks (Livewire loading state cukup pakai `wire:loading` sederhana)
- Custom illustration/ikon set — pakai Heroicons (built-in ekosistem Tailwind/Laravel), jangan generate icon custom untuk MVP.
