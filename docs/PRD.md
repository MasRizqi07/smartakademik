# PRD — Platform Operasional Akademik Harian MAN 4 Jombang

**Status:** Draft v1 — hasil brainstorming session
**Tanggal:** 10 Agustus 2026
**Target sekolah:** MAN 4 Jombang (single-tenant)
**Stack:** PHP 8.3, Laravel 13, Blade + Livewire 3, MySQL

---

## 1. Problem Statement

MAN 4 Jombang (±1.417 siswa, 154 guru/pegawai) sudah memiliki beberapa sistem digital berjalan:

| Sistem | Fungsi | Status |
|---|---|---|
| Website utama (man4jombang.sch.id) | Profil, berita, PPID | Aktif |
| `cbt.man4jombang.sch.id` | Ujian berbasis komputer | Aktif |
| `perpus.man4jombang.sch.id` | Perpustakaan digital | Aktif |
| `ppdbyamam.com` | PPDB (eksternal, level yayasan) | Aktif |
| EMIS / SIMPATIKA / eRapor (Kemenag) | Data pokok pendidikan, data guru, nilai akhir semester resmi | **Wajib, tidak dapat digantikan** |

**Gap yang belum tercover oleh sistem manapun di atas:** operasional kelas harian — guru tidak punya alat digital untuk mencatat kehadiran siswa per jam pelajaran, mencatat nilai tugas/ulangan harian (formatif, bukan nilai akhir rapor), atau melihat jadwal mengajar secara interaktif. Proses ini saat ini berjalan manual (kertas/buku absensi kelas).

## 2. Positioning (Constraint Permanen)

> Platform ini adalah **layer operasional harian**, BUKAN pengganti eRapor/EMIS/SIMPATIKA.

Implikasi konkret:
- Modul nilai di platform ini hanya menampung **nilai formatif** (tugas, ulangan harian). Nilai akhir semester / rapor resmi tetap diinput manual oleh guru ke eRapor Kemenag sebagai proses terpisah dan wajib.
- Tidak ada fitur sinkronisasi otomatis ke EMIS/SIMPATIKA/eRapor di MVP ini. Jika suatu saat dibutuhkan, itu adalah proyek integrasi terpisah yang butuh spek API resmi Kemenag — **di luar scope ini**.
- Modul kepegawaian, PPDB, ujian (CBT), dan perpustakaan **tidak dibangun ulang** — sudah tercover sistem lain.

Setiap penambahan fitur di masa depan wajib dicek terhadap tabel gap di atas sebelum masuk backlog, untuk mencegah duplikasi effort.

## 3. Scope MVP (Locked)

**Masuk MVP:**
1. Manajemen jadwal pelajaran
2. Absensi per jam pelajaran (JP)
3. Nilai formatif (tugas/ulangan harian)
4. Import massal data siswa/guru/kelas/mapel via Excel
5. RBAC 4 role: Admin/TU, Waka Kurikulum, Guru, Siswa

**Eksplisit di luar MVP (calon fase 2, proyek terpisah):**
- Portal komunikasi orang tua
- SPP / keuangan siswa
- Surat-menyurat & perizinan
- QR-code / biometrik untuk absensi
- Native mobile app (MVP ini web mobile-responsive)

Keputusan scope diambil breadth-narrowed-first: awalnya dipertimbangkan breadth-first mencakup semua modul administrasi, tapi dipersempit setelah kontradiksi teridentifikasi (memilih SPP+Portal Ortu+Surat-menyurat sekaligus "fokus akademik saja" tidak konsisten untuk kapasitas solo-dev). Core akademik operasional dipilih sebagai satu-satunya jalur MVP.

## 4. User Roles & Permissions

| Role | Akses |
|---|---|
| **Admin/TU** | Full CRUD master data (siswa, guru, kelas, mapel), manajemen user & role, import Excel |
| **Waka Kurikulum** | CRUD jadwal pelajaran, lihat seluruh laporan absensi & nilai formatif lintas kelas |
| **Guru** | Lihat jadwal mengajar sendiri, input absensi & nilai formatif untuk kelas/mapel yang diampu saja (scoped by jadwal miliknya) |
| **Siswa** | Read-only: jadwal, riwayat absensi, nilai formatif miliknya sendiri |

Guru tidak dapat mengedit data siswa lain di luar kelas yang diampunya — enforced di level query/policy, bukan hanya UI.

## 5. Core Entities (Data Model — ringkas)

```
users          (id, name, email, role via spatie/laravel-permission)
siswa          (id, nisn, nama, kelas_id, ...)
guru           (id, nip_nuptk, nama, ...)
kelas          (id, nama_kelas, tingkat, wali_kelas_id)
mapel          (id, nama_mapel, kode_mapel)
jadwal_pelajaran (id, kelas_id, mapel_id, guru_id, hari, jam_ke, waktu_mulai, waktu_selesai)
absensi        (id, siswa_id, jadwal_id, tanggal, status[hadir|izin|sakit|alfa], dicatat_oleh)
               UNIQUE(siswa_id, jadwal_id, tanggal)  -- cegah double-input
nilai_formatif (id, siswa_id, mapel_id, jenis[tugas|ulangan_harian], nilai, tanggal, guru_id)
```

## 6. Key User Flows

**Setup awal (sekali jalan):**
1. Admin/TU import Excel → data siswa, guru, kelas, mapel masuk sistem
2. Waka Kurikulum susun jadwal pelajaran per kelas per hari

**Harian (guru, dari HP):**
1. Login → lihat jadwal hari ini
2. Pilih jadwal aktif (kelas + JP saat ini)
3. Checklist kehadiran tiap siswa (hadir/izin/sakit/alfa)
4. (Opsional, saat ada penilaian) input nilai formatif per siswa

**Siswa:**
1. Login → lihat jadwal, riwayat kehadiran sendiri, nilai formatif per mapel

## 7. Non-Functional Requirements

- **Mobile-responsive wajib** — guru mengakses dari HP saat di kelas, bukan hanya desktop.
- **Import Excel harus validasi per-baris** — baris invalid dilaporkan dengan jelas (baris ke berapa, kolom apa), tidak menggagalkan seluruh import.
- **Absensi tidak boleh double-entry** — constraint unik per siswa+jadwal+tanggal di level database, bukan hanya validasi UI.
- **Single-tenant** — tidak ada isolasi multi-sekolah; asumsi ini disengaja untuk memangkas kompleksitas MVP.

## 8. Explicit Non-Goals

- Bukan sistem pelaporan resmi ke Kemenag.
- Bukan pengganti absensi guru/pegawai (itu domain SIMPATIKA).
- Bukan sistem pembayaran.
- Bukan native mobile app di fase ini.

## 9. Open Questions untuk Fase Implementasi

- Hosting target: shared hosting cPanel (umum untuk sekolah ID) atau VPS? Ini menentukan constraint Laravel deployment (queue driver, scheduler via cron).
- Apakah wali kelas butuh view tambahan (rekap absensi kelas per bulan) di luar 4 role di atas, atau itu cukup di-cover Waka Kurikulum?
- Semester aktif / tahun ajaran — apakah data historis lintas semester perlu tetap bisa diakses (arsip), atau reset tiap semester baru?
