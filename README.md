# FikrLib: Library Management System
FikrLib adalah aplikasi perpustakaan digital yang terinspirasi dari semangat abad kejayaan Islam, ketika ilmu pengetahuan berkembang pesat melalui perpustakaan agung seperti Bayt al-Hikmah di Baghdad dan perpustakaan Cordoba di Andalusia.

Dengan menggabungkan warisan intelektual Islam dan teknologi modern, FikrLib hadir sebagai pusat pengetahuan yang menyediakan akses ke berbagai literatur, mulai dari karya klasik hingga koleksi digital kontemporer.

## Makna Nama

- **Fikr (فكر)** → melambangkan pemikiran, refleksi, dan pencarian ilmu.
- **Lib** → singkatan dari Library, simbol perpustakaan modern.

FikrLib adalah aplikasi manajemen perpustakaan berbasis web yang dibangun dengan **Laravel 12**. Aplikasi ini dirancang untuk mempermudah pengelolaan koleksi buku, peminjaman, pengembalian, dan aktivitas lain yang terkait dengan perpustakaan, dengan tujuan untuk memberikan pengalaman pengguna yang efisien dan mudah digunakan.

## Fitur Utama

- **Manajemen Koleksi Buku**: Menambah, mengedit, dan menghapus buku dengan data lengkap.
- **Peminjaman & Pengembalian Buku**: Sistem peminjaman dan pengembalian buku secara digital dengan status yang jelas.
- **Pencarian Buku**: Fitur pencarian cepat untuk menemukan buku berdasarkan judul, penulis, atau kategori.
- **Pengelolaan Anggota**: Menambahkan, mengedit, dan menghapus data anggota perpustakaan.
- **Riwayat Peminjaman**: Melihat riwayat transaksi peminjaman dan pengembalian buku oleh setiap anggota.
- **Admin Panel**: Dashboard untuk pengelolaan seluruh sistem, termasuk pengelolaan buku, anggota, transaksi, dll.

## Teknologi yang Digunakan

- **Backend**: Laravel 12
- **Frontend**: Blade (Laravel's templating engine), Bootstrap
- **Database**: MySQL / SQLite (dapat disesuaikan)
- **Authentication**: Laravel Breeze (untuk autentikasi pengguna)
- **API**: RESTful API untuk interaksi dengan frontend dan aplikasi lainnya
- **Other**: Composer, NPM, PHPUnit (untuk testing)

## Persyaratan Sistem

- PHP >= 8.4
- Composer
- MySQL atau SQLite
- Node.js dan NPM (untuk frontend build)

## ERD
  `https://dbdiagram.io/d/68a88e531e7a6119672e8a4a`
  `https://dbdocs.io/fikri.dulumina/FikrLib?view=relationships`

## Instalasi

### 1. Clone repository

```bash
git clone https://github.com/feldora/fikrlib.git
cd fikrlib
```

### 2. Install dependensi PHP

Pastikan Composer sudah terinstal di sistem kamu, kemudian jalankan:

```bash
composer install
```

### 3. Setup lingkungan .env

Salin file `.env.example` menjadi `.env`:

```bash
cp .env.example .env
```

### 4. Generate key aplikasi

Jalankan perintah berikut untuk menghasilkan key aplikasi:

```bash
php artisan key:generate
```

### 5. Konfigurasi database

Edit file `.env` untuk mengonfigurasi koneksi database. Misalnya, untuk MySQL:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=fikrlib
DB_USERNAME=root
DB_PASSWORD=
```

### 6. Setup Laravel Sail

Laravel Sail adalah lingkungan development Docker yang ringan. Untuk menginstallnya:

```bash
composer require laravel/sail --dev
php artisan sail:install
```

### 7. Start Docker container

```bash
./vendor/bin/sail up -d
```

### 8. Migrasi database

Jalankan migrasi untuk membuat tabel-tabel yang diperlukan dalam database:

```bash
./vendor/bin/sail artisan migrate
```

### 9. Install dependensi frontend

Jalankan perintah berikut untuk menginstal dependensi frontend:

```bash
./vendor/bin/sail npm install
```

### 10. Build assets frontend

Setelah dependensi terinstal, buat dan kompilasi file frontend:

```bash
./vendor/bin/sail npm run dev
```

## Menjalankan Aplikasi

### 1. Start Docker container

Jika container belum berjalan, jalankan:

```bash
./vendor/bin/sail up -d
```

Aplikasi akan berjalan di `http://127.0.0.1:8000`.

### 2. Akses aplikasi

Buka browser dan akses aplikasi di URL `http://127.0.0.1:8000`.

## Fitur Admin

- **Dashboard**: Melihat statistik peminjaman, jumlah buku, dan anggota aktif.
- **Pengelolaan Buku**: Menambah, mengedit, dan menghapus koleksi buku.
- **Pengelolaan Anggota**: Menambah, mengedit, dan menghapus data anggota.
- **Transaksi Peminjaman**: Melihat status peminjaman buku, serta mengatur status pengembalian.

## Pengujian

Aplikasi ini menggunakan **PHPUnit** untuk pengujian otomatis.

- Jalankan pengujian unit dengan perintah:

```bash
php artisan test
```

- Jalankan pengujian spesifikasi dengan perintah:

```bash
php artisan test --filter=Feature
```

## Kontribusi

Jika kamu ingin berkontribusi pada proyek ini, silakan buat **pull request** atau buka **issue** jika ada bug atau saran fitur. Pastikan untuk mengikuti pedoman berikut:

1. **Fork repository** ini.
2. **Buat branch** untuk fitur baru atau perbaikan.
3. **Push perubahan** dan buat pull request.

## Lisensi

Aplikasi ini dilisensikan di bawah **MIT License**. Lihat file LICENSE untuk informasi lebih lanjut.
