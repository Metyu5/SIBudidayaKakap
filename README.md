# SIBudidayaKakap 🐟

**SIBudidayaKakap** adalah sistem informasi berbasis web yang dibangun menggunakan **PHP Native**. Aplikasi ini dirancang untuk memudahkan manajemen dan pendataan dalam budidaya ikan kakap secara efisien dan sistematis.

## 🚀 Fitur Utama

- **Manajemen Data**: Pencatatan data budidaya (input, edit, hapus).
- **Sistem Login**: Autentikasi pengguna untuk keamanan data.
- **Monitoring**: Dashboard sederhana untuk melihat status budidaya.
- **Laporan**: Rekapitulasi data budidaya dalam format tabel/cetak.

## 🛠️ Teknologi yang Digunakan

- **Bahasa Pemrograman**: PHP (Native)
- **Database**: MySQL
- **Frontend**: HTML, CSS, JavaScript (Bootstrap/UI Framework terkait)
- **Server**: Apache (XAMPP/Laragon)

## 💻 Cara Instalasi & Menjalankan

Ikuti langkah-langkah ini untuk menjalankan proyek di komputer lokal (localhost):

1. **Clone Repositori**
   ```bash
   git clone [https://github.com/Metyu5/SIBudidayaKakap.git](https://github.com/Metyu5/SIBudidayaKakap.git)
Persiapkan Database

Buka phpMyAdmin (biasanya di http://localhost/phpmyadmin).

Buat database baru dengan nama (misal: db_kakap).

Import file .sql yang ada di dalam folder proyek (jika tersedia) atau folder database/.

Konfigurasi Koneksi Database

Buka file koneksi database (biasanya bernama koneksi.php, config.php, atau di folder config/).

Sesuaikan username, password, dan database_name dengan pengaturan MySQL Anda.

PHP

$host = "localhost";
$user = "root";
$pass = "";
$db   = "nama_database_anda";
Pindahkan Proyek

Pastikan folder proyek berada di dalam direktori htdocs (XAMPP) atau www (WampServer).

Akses di Browser

Buka browser dan ketik: http://localhost/SIBudidayaKakap

📂 Struktur Proyek
index.php - Halaman utama / Login.

koneksi.php - Pengaturan koneksi ke database.

assets/ - Folder untuk file CSS, JS, dan gambar.

modul/ atau pages/ - Folder berisi file logika fitur aplikasi.
