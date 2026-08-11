# Design System — Platform Operasional Akademik MAN 4 Jombang

**Stack:** Tailwind CSS (Laravel 13 default) + Blade + Livewire 3
**Prinsip:** mobile-first, data-density tinggi tapi tetap scannable, dipakai guru buru-buru di sela jam mengajar — bukan dashboard kontemplatif.

---

## 1. Prinsip Desain

1. **Kecepatan input di atas estetika.** Guru checklist absensi dalam <60 detik per kelas. Setiap elemen UI di flow absensi/nilai harus mengurangi tap, bukan menambah dekorasi.
2. **Mobile-first, bukan mobile-adapted.** Desain dari layar 375px ke atas, bukan desktop yang di-squeeze.
3. **Status visual instan.** Warna dan ikon untuk status kehadiran (hadir/izin/sakit/alfa) harus bisa dibaca sekilas tanpa membaca teks.
4. **Netral secara institusional.** Bukan web pemasaran sekolah — hindari ornamen islami/dekoratif berat yang sudah ada di website utama. Ini alat kerja, tampilan tenang dan fungsional.

## 2. Token Architecture (3 Tier)

Ikuti pola token 3-tingkat: komponen tidak pernah reference hex value mentah.

```css
/* TIER 1: PRIMITIVES */
:root {
  --color-slate-50:  #f8fafc;
  --color-slate-200: #e2e8f0;
  --color-slate-600: #475569;
  --color-slate-900: #0f172a;

  --color-emerald-500: #10b981;  /* brand primary — netral-hijau, bukan hijau islami-berat */
  --color-emerald-600: #059669;
  --color-emerald-50:  #ecfdf5;

  --color-amber-500: #f59e0b;   /* izin */
  --color-sky-500:    #0ea5e9;  /* sakit */
  --color-rose-500:   #f43f5e;  /* alfa */
  --color-green-500:  #22c55e;  /* hadir */
}

/* TIER 2: SEMANTIC */
:root {
  --color-text-primary:   var(--color-slate-900);
  --color-text-secondary: var(--color-slate-600);
  --color-bg-page:        var(--color-slate-50);
  --color-bg-surface:     #ffffff;
  --color-border-default: var(--color-slate-200);

  --color-brand:           var(--color-emerald-600);
  --color-brand-surface:   var(--color-emerald-50);

  --color-status-hadir: var(--color-green-500);
  --color-status-izin:  var(--color-amber-500);
  --color-status-sakit: var(--color-sky-500);
  --color-status-alfa:  var(--color-rose-500);
}

/* TIER 3: COMPONENT */
:root {
  --button-primary-bg: var(--color-brand);
  --card-bg: var(--color-bg-surface);
  --card-border: var(--color-border-default);
  --badge-hadir-bg: var(--color-status-hadir);
  --badge-izin-bg:  var(--color-status-izin);
  --badge-sakit-bg: var(--color-status-sakit);
  --badge-alfa-bg:  var(--color-status-alfa);
}
```

**Catatan dark mode:** tidak masuk MVP (guru pakai HP di kelas terang, prioritas rendah). Tapi struktur 3-tier di atas sudah siap ditambahkan `[data-theme="dark"]` di fase berikutnya tanpa refactor komponen — jangan hardcode hex di file komponen manapun.

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
