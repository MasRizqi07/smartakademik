# Panduan Review & Pengujian QA — SmartAkademik MAN 4 Jombang

Dokumen ini disusun khusus sebagai acuan kerja bagi **QA Engineer, Reviewer Teknis, dan Auditor Klien** dalam memverifikasi integritas fungsional, keamanan, dan kepatuhan sistem **SmartAkademik**.

---

## 1. Rangkuman Hasil Pengujian Otomatis (Automated Test Suite)

Sistem SmartAkademik memiliki cakupan pengujian otomatis lengkap yang dapat dijalankan secara instan:

```bash
# Perintah eksekusi test suite standar:
php artisan test
```

### Metrik Pengujian Aktif
- **Total Pengujian:** 95 Tests
- **Total Assertion:** 376 Assertions
- **Tingkat Kelulusan:** 100% PASS (0 Failed, 0 Skipped)
- **Framework:** PHPUnit 12 / Laravel Testing Framework dengan SQLite In-Memory Isolation

---

## 2. Matriks Pengujian Fungsional per Role

### 2.1 Role: Admin / Tata Usaha (`admin_tu`)

| ID Skenario | Deskripsi Pengujian | File Tes Terkait | Kriteria Kelulusan (Expected Result) |
|---|---|---|---|
| **QA-ADM-01** | CRUD Master Data (Siswa, Guru, Kelas, Mapel) | [MasterDataCRUDTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/MasterDataCRUDTest.php) | Record berhasil dibuat, divalidasi, dan terhubung dengan relasi terkait di database. |
| **QA-ADM-02** | Pembuatan Akun Otomatis saat Siswa/Guru Dibuat | [MasterDataCRUDTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/MasterDataCRUDTest.php) | User record otomatis terbuat dengan email/NISN dan role yang tepat. |
| **QA-ADM-03** | Import Excel Siswa & User Provisioning | [ImportExcelTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/ImportExcelTest.php) | Baris valid diimport, akun dibuat, error baris invalid dilaporkan jelas tanpa crash. |
| **QA-ADM-04** | Pengaturan Semester & Durasi KBM | [PengaturanTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/PengaturanTest.php) | Perubahan semester dan jam KBM tersimpan persisten ke database. |
| **QA-ADM-05** | Manajemen Event Ujian | [EventUjianTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/EventUjianTest.php) | Admin dapat menambah, mencari, memfilter, dan menghapus jadwal agenda ujian. |

### 2.2 Role: Waka Kurikulum (`waka_kurikulum`)

| ID Skenario | Deskripsi Pengujian | File Tes Terkait | Kriteria Kelulusan (Expected Result) |
|---|---|---|---|
| **QA-WAK-01** | Input Jadwal & Deteksi Bentrok Guru | [JadwalCRUDTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/JadwalCRUDTest.php) | Sistem menolak input jika guru sudah terjadwal di rombel lain pada hari & JP yang sama (`error: guru_id`). |
| **QA-WAK-02** | Deteksi Bentrok Jadwal Rombel Kelas | [JadwalCRUDTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/JadwalCRUDTest.php) | Sistem menolak input jika rombel kelas sudah memiliki mapel lain pada hari & JP yang sama (`error: kelas_id`). |
| **QA-WAK-03** | Analitik Akademik Bebas Masalah $N+1$ | [LaporanAkademikTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/LaporanAkademikTest.php) | Jumlah kueri SQL tetap konstan ($O(1)$) saat memproses banyak kelas sekaligus. |
| **QA-WAK-04** | Integritas Perhitungan Math Analitik | [LaporanAkademikTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/LaporanAkademikTest.php) | Persentase presensi dan ketuntasan KKM akurat sesuai rumus matematika riil. |
| **QA-WAK-05** | Ekspor CSV Analitik & Rekap Absensi | [LaporanAkademikTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/LaporanAkademikTest.php), [WakaTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/WakaTest.php) | Berhasil men-download file CSV ber-BOM UTF-8 dengan status HTTP 200 stream. |

### 2.3 Role: Guru Pengampu (`guru`)

| ID Skenario | Deskripsi Pengujian | File Tes Terkait | Kriteria Kelulusan (Expected Result) |
|---|---|---|---|
| **QA-GRU-01** | Penguncian Tanggal Presensi ke Hari Ini | [AbsensiGuruTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/AbsensiGuruTest.php) | `$tanggal` dipaksa ke `today()` saat komponen mount; tanggal di UI bersifat read-only. |
| **QA-GRU-02** | Penolakan Manipulasi Tanggal Klien | [AbsensiGuruTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/AbsensiGuruTest.php) | Upaya memodifikasi properti `$tanggal` dari klien melempar `CannotUpdateLockedPropertyException`. |
| **QA-GRU-03** | Proteksi Pergantian Hari (Rollover Guard) | [AbsensiGuruTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/AbsensiGuruTest.php) | Seluruh aksi mutasi (`setPresence`, `markAllHadir`, `resetAll`, `saveNote`, `save`) mengembalikan status HTTP 422 jika hari telah berganti. |
| **QA-GRU-04** | Isolasi Jadwal Mengajar Pribadi | [JadwalCRUDTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/JadwalCRUDTest.php) | Guru A hanya melihat jadwal miliknya; mapel dan nama Guru B tidak muncul (`assertDontSee`). |
| **QA-GRU-05** | Penolakan Mutasi Jadwal oleh Guru | [JadwalCRUDTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/JadwalCRUDTest.php) | Panggilan `store` atau `delete` jadwal oleh guru dibatalkan dengan status HTTP 403 Forbidden. |
| **QA-GRU-06** | Input & Perhitungan Nilai Formatif | [NilaiGuruTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/NilaiGuruTest.php) | Guru dapat menyimpan nilai tugas/ulangan harian siswa yang diajarnya saja. |

### 2.4 Role: Siswa (`siswa`)

| ID Skenario | Deskripsi Pengujian | File Tes Terkait | Kriteria Kelulusan (Expected Result) |
|---|---|---|---|
| **QA-SIS-01** | Akses Dashboard Siswa | [SiswaDashboardTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/SiswaDashboardTest.php) | Siswa berhasil memuat dashboard pribadinya dengan status HTTP 200. |
| **QA-SIS-02** | Isolasi Data Antar Siswa | [SiswaDashboardTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/SiswaDashboardTest.php) | Dua siswa dengan data berbeda melihat data komputasi masing-masing, tidak tertukar. |
| **QA-SIS-03** | Penolakan Akses Siswa ke Modul Manajemen | [RBACTest.php](file:///d:/MY%20CODE/ANTIGRAVITY/PHP/smartakademik/tests/Feature/RBACTest.php) | Upaya siswa mengakses endpoint guru, waka, atau admin dibatalkan dengan 403 Forbidden. |

---

## 3. Checklist Pengujian Keamanan & RBAC (Security Checklist)

QA Reviewer wajib memastikan skenario negatif berikut lolos verifikasi:

- [x] **Pemeriksaan Otorisasi Level Metode:** Guru 2 tidak dapat memanggil aksi `setPresence`, `resetAll`, atau `saveNote` pada jadwal milik Guru 1 (menghasilkan status HTTP 403).
- [x] **Pemeriksaan Siswa Luar Rombel:** Guru tidak dapat mengabsen `siswa_id` yang tidak terdaftar pada `kelas_id` jadwal tersebut (menghasilkan status HTTP 404).
- [x] **Whitelist Status Kehadiran:** Sistem menolak status di luar whitelist `['hadir', 'izin', 'sakit', 'alfa']` (misal: 'bolos' menghasilkan status HTTP 422).
- [x] **Non-Vacuity Cycle Testing:** Log bukti tes red/green untuk fitur penguncian tanggal dan isolasi jadwal tersimpan dan tervalidasi.

---

## 4. Prosedur Audit Disiplin Desain UI

Untuk memverifikasi bahwa tidak ada degradasi kualitas visual antarmuka:

```bash
# Jalankan script disiplin desain:
bash scripts/check-discipline.sh
```

### Nilai Ambang Batas Kelulusan:
1. `raw_hues_live = 0`: Tidak ada warna mentah Tailwind (contoh: `text-blue-500`, `bg-indigo-600`) pada view aktif.
2. `decoration_live = 0`: Tidak ada dekorasi arbitrer non-standar.
3. `static_numeric_literals_live = 0`: Tidak ada nilai metrik palsu/hardcoded pada kartu dashboard.
4. `exit_code = 0`: Seluruh aturan terpenuhi.

---

## 5. Prosedur Verifikasi Manual Cepat untuk QA & Klien

Jika tim QA ingin melakukan verifikasi manual melalui browser:

1. Jalankan aplikasi lokal:
   ```bash
   php artisan serve --port=8000
   ```
2. Buka browser pada resolusi smartphone (**375px width** via Chrome DevTools Mobile Emulation).
3. **Uji Kasus Guru 1:**
   - Login dengan `guru@smartakademik.test` / `password`.
   - Buka `/guru/absensi` $\rightarrow$ Pastikan tanggal hari ini terkunci dan tidak bisa diedit.
   - Buka `/guru/jadwal` $\rightarrow$ Pastikan hanya jadwal Matematika (Budi Santoso) yang tampil.
4. **Uji Kasus Guru 2:**
   - Login dengan `guru2@smartakademik.test` / `password`.
   - Buka `/guru/jadwal` $\rightarrow$ Pastikan hanya jadwal Fisika (Siti Aminah) yang tampil.
5. **Uji Kasus Waka Kurikulum:**
   - Login dengan `waka@smartakademik.test` / `password`.
   - Buka `/waka/jadwal` $\rightarrow$ Pastikan seluruh jadwal madrasah tampil lengkap.
   - Buka `/waka/laporan` $\rightarrow$ Klik tombol "Export CSV" dan verifikasi file terunduh rapi.
