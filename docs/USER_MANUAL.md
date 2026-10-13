# Buku Panduan Pengguna (User Manual) — SmartAkademik MAN 4 Jombang

Selamat datang di Buku Panduan Pengguna **SmartAkademik**. Dokumen ini dirancang untuk memandu seluruh pengguna madrasah (Admin TU, Waka Kurikulum, Guru Pengampu, dan Siswa) dalam mengoperasikan sistem akademik harian **MAN 4 Jombang PP. Mamba'ul Ma'arif Denanyar**.

---

## 1. Pendahuluan

SmartAkademik adalah platform digital yang dirancang untuk menggantikan pencatatan presensi dan evaluasi harian berbasis kertas. Sistem ini dapat diakses melalui komputer desktop, laptop, tablet, maupun telepon genggam (smartphone).

### Akses Masuk ke Sistem (Login)
1. Buka peramban (browser) seperti Google Chrome atau Safari pada perangkat Anda.
2. Kunjungi alamat portal SmartAkademik: **`http://[domain-sekolah]/login`**.
3. Masukkan **Alamat Email / NIP / NISN** dan **Kata Sandi (Password)** Anda.
4. Klik tombol **"Masuk ke Portal"**.
5. Sistem akan secara otomatis mengarahkan Anda ke dashboard sesuai peran akun Anda.

---

## 2. Panduan untuk Administrator Tata Usaha (`Admin TU`)

Admin TU bertanggung jawab atas pengelolaan data induk madrasah dan manajemen akun.

### 2.1 Mengelola Data Master (Siswa, Guru, Kelas, Mapel)
- Buka menu navigasi samping: **Data Siswa**, **Data Guru**, **Rombel Kelas**, atau **Mata Pelajaran**.
- **Menambah Data Baru:** Klik tombol hijau *"Tambah [Data]"* di pojok kanan atas, isi formulir data secara lengkap, lalu tekan tombol *"Simpan Data"*.
- **Mengedit Data:** Klik ikon pensil pada baris data yang ingin diperbarui.
- **Menghapus Data:** Klik ikon tempat sampah merah pada baris data terkait.

### 2.2 Import Massal Data via Excel
Untuk menghemat waktu saat awal tahun ajaran baru:
1. Buka menu **Import Data**.
2. Unduh template Excel resmi yang telah disediakan (*Template Siswa, Template Guru, Template Kelas, atau Template Mapel*).
3. Isi data pada file Excel tanpa mengubah susunan kolom template.
4. Unggah file Excel pada kotak upload yang tersedia.
5. Klik tombol **"Mulai Proses Import"**.
6. Sistem akan memeriksa data per baris. Jika seluruh baris valid, data akan otomatis tersimpan dan akun pengguna untuk siswa/guru baru akan langsung dibuatkan oleh sistem.

### 2.3 Manajemen Pengguna & Reset Password
1. Buka menu **Manajemen User**.
2. Anda dapat melihat seluruh daftar akun pengguna madrasah.
3. Untuk mengubah peran atau mereset password akun guru/siswa yang lupa kata sandi, klik tombol edit pada akun yang bersangkutan.

---

## 3. Panduan untuk Waka Kurikulum (`Waka Kurikulum`)

Waka Kurikulum bertanggung jawab atas penataan jadwal belajar mengajar dan pemantauan analitik akademik.

### 3.1 Menyusun Jadwal Pelajaran & Deteksi Bentrok Otomatis
1. Buka menu **Jadwal Pelajaran**.
2. Klik tombol **"Tambah Jadwal Baru"**.
3. Pilih Hari, Jam Ke-, Rentang Waktu KBM, Rombel Kelas, Mata Pelajaran, dan Guru Pengampu.
4. Klik **"Simpan Jadwal"**.
5. **Fitur Keamanan Anti-Bentrok:**
   - Jika guru yang dipilih sudah terjadwal mengajar di kelas lain pada jam yang sama, sistem akan memunculkan peringatan merah: *"Bentrok Jadwal Guru! Guru ini sudah terjadwal di kelas..."*.
   - Jika kelas yang dipilih sudah memiliki jadwal mapel lain pada jam yang sama, sistem akan memunculkan peringatan: *"Bentrok Jadwal Kelas!..."*.
   - Jadwal yang bentrok tidak akan disimpan ke database sampai Anda memilih slot waktu yang benar.

### 3.2 Memantau Analitik Akademik & Unduh Laporan (CSV)
1. Buka menu **Laporan Analitik**.
2. Anda dapat melihat ringkasan performa per rombel kelas: *Rata-rata Presensi (%), Rata-rata Nilai Formatif, dan Persentase Ketuntasan KKM*.
3. Gunakan filter tingkat kelas (X, XI, XII) untuk menyaring data.
4. Klik tombol **"Export CSV"** di pojok kanan atas untuk mengunduh laporan resmi siap cetak dan siap diolah di Microsoft Excel.

---

## 4. Panduan untuk Guru Pengampu (`Guru`)

Guru dapat mengakses sistem langsung dari smartphone di ruang kelas saat jam pelajaran berlangsung.

### 4.1 Mengisi Presensi Kelas Harian (Absensi Terkunci Hari Ini)
1. Login dan buka menu **Input Presensi**.
2. **Pilih Jadwal Mengajar:** Pilih rombel kelas dan jam mengajar aktif dari menu dropdown.
3. **Tanggal Presensi:** Tanggal akan secara otomatis menampilkan **Hari Ini** (read-only). Sistem sengaja mengunci tanggal agar pencatatan presensi berlangsung objektif dan real-time.
4. **Menandai Kehadiran Siswa:**
   - Pada baris tiap siswa, ketuk salah satu dari 4 tombol status: **Hadir** (Hijau), **Izin** (Kuning), **Sakit** (Biru), atau **Alfa** (Merah).
   - Jika mayoritas siswa hadir, Anda dapat menekan tombol pintas **"Set Semua Hadir"** di bagian atas untuk mempercepat pengisian.
5. **Menambahkan Catatan Siswa (Opsional):** Ketuk ikon catatan kecil di sebelah nama siswa untuk mengisi keterangan detail (contoh: *"Izin dispensasi lomba pramuka"*).
6. **Menyimpan Presensi:** Pastikan seluruh siswa sudah memiliki status, lalu tekan tombol biru besar **"Simpan Presensi Kelas"**.

### 4.2 Melihat Jadwal Mengajar Pribadi
1. Buka menu **Jadwal Mengajar**.
2. Sistem hanya akan menampilkan jadwal kelas yang Anda ampu secara pribadi, sehingga tampilan tetap ringkas dan tidak membingungkan.

### 4.3 Menginput Nilai Formatif Harian
1. Buka menu **Nilai Formatif**.
2. Pilih Jadwal Kelas dan Mata Pelajaran Anda.
3. Masukkan Tujuan Pembelajaran (TP) / Materi Pembahasan.
4. Pilih jenis penilaian (*Tugas, Kuis, atau Ulangan Harian*).
5. Masukkan nilai angka (skala 0–100) pada masing-masing siswa.
6. Klik tombol **"Simpan Nilai Formatif"**.

---

## 5. Panduan untuk Siswa (`Siswa`)

Siswa dapat memantau transparansi kehadiran dan perkembangan belajarnya secara mandiri.

### 5.1 Dashboard Kehadiran Pribadi
1. Login ke akun siswa Anda.
2. Di halaman utama dashboard, Anda akan melihat kartu ringkasan:
   - **Tingkat Kehadiran (%):** Persentase kehadiran Anda selama semester aktif.
   - **Total Izin, Sakit, dan Alfa:** Rincian hari di mana Anda tidak hadir.
   - **Rata-rata Nilai Formatif:** Perkembangan nilai evaluasi harian Anda.
3. Anda dapat memeriksa tabel riwayat tanggal kehadiran secara detail di bagian bawah dashboard.

---

## 6. Pertanyaan yang Sering Diajukan (FAQ)

### Q: Mengapa guru tidak bisa mengganti tanggal presensi ke hari kemarin?
**A:** Sesuai kebijakan tata kelola madrasah (Owner Decision D9), presensi siswa dikunci strictly hanya untuk hari KBM aktif (*today only*). Hal ini bertujuan untuk memastikan presensi dilakukan secara disiplin dan langsung di dalam kelas, serta mencegah kecurangan back-dating.

### Q: Apa yang harus dilakukan jika guru lupa mengabsen kemarin?
**A:** Silakan berkoordinasi langsung dengan Waka Kurikulum atau Bagian Tata Usaha madrasah untuk verifikasi manual secara kedinasan.

### Q: Apakah nilai formatif di sistem ini otomatis masuk ke rapor resmi madrasah?
**A:** Tidak. SmartAkademik bertindak sebagai alat operasional kelas harian. Nilai akhir rapor semester tetap diolah dan diinput secara resmi oleh guru ke sistem eRapor Kementerian Agama RI.

### Q: Bagaimana jika saya lupa kata sandi akun?
**A:** Silakan hubungi Administrator Tata Usaha MAN 4 Jombang di ruang tata usaha untuk melakukan reset kata sandi akun Anda.
