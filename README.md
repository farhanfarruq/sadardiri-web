# SadarDiri: Aplikasi Pelacak Keuangan dan Kebiasaan

**SadarDiri** adalah aplikasi web yang dirancang untuk membantu pengguna mengelola keuangan pribadi dan membangun kebiasaan positif. Proyek ini dikembangkan sebagai tugas akhir semester untuk mata kuliah Rekayasa Web.

Aplikasi ini menyediakan antarmuka yang bersih dan modern untuk melacak pemasukan, pengeluaran, progres tabungan, dan konsistensi dalam menjalankan kebiasaan harian.

## ✨ Fitur Utama

-   **Dashboard Utama**: Menampilkan ringkasan statistik harian dan bulanan, termasuk kebiasaan yang harus diselesaikan, total pemasukan/pengeluaran bulan ini, dan grafik progres mingguan.
-   **Manajemen Keuangan**:
    -   Pencatatan transaksi pemasukan dan pengeluaran.
    -   Kustomisasi kategori untuk setiap transaksi.
    -   Riwayat transaksi dengan tampilan desktop dan mobile yang responsif.
-   **Pelacak Kebiasaan (Habit Tracker)**:
    -   Membuat kebiasaan baru dengan frekuensi harian, mingguan, atau bulanan.
    -   Melacak progres harian dan melihat *streak* (rentetan) keberhasilan.
    -   Visualisasi progres bulanan untuk setiap kebiasaan.
-   **Target Tabungan**:
    -   Menetapkan target tabungan dengan jumlah dan tanggal target.
    -   Memantau progres tabungan secara visual.
-   **Laporan Aktivitas**: Melihat gabungan riwayat aktivitas keuangan dan kebiasaan dalam satu halaman.
-   **Autentikasi Pengguna**: Sistem pendaftaran dan login yang aman menggunakan email & kata sandi, serta opsi login melalui **Google OAuth**.
-   **Antarmuka Responsif**: Desain yang dioptimalkan untuk pengalaman pengguna yang baik di perangkat desktop maupun mobile.

## 💻 Teknologi yang Digunakan

-   **Backend**: PHP, **Laravel Framework 11**
-   **Frontend**: HTML, CSS, JavaScript, **Bootstrap 5**
-   **Database**: SQLite (default), MySQL, MariaDB, PostgreSQL
-   **Development Tools**: Vite, Composer, NPM
-   **Paket Tambahan**:
    -   `laravel/socialite` untuk autentikasi Google
    -   `barryvdh/laravel-dompdf` untuk potensi ekspor laporan ke PDF

## 🚀 Instalasi & Konfigurasi Lokal

Untuk menjalankan proyek ini di lingkungan lokal Anda, ikuti langkah-langkah berikut:

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/nama-anda/nama-repo.git](https://github.com/nama-anda/nama-repo.git)
    cd nama-repo
    ```

2.  **Instal Dependensi PHP**
    ```bash
    composer install
    ```

3.  **Konfigurasi Lingkungan**
    -   Salin file `.env.example` menjadi `.env`.
        ```bash
        cp .env.example .env
        ```
    -   Buat *application key* baru.
        ```bash
        php artisan key:generate
        ```
    -   Konfigurasikan koneksi database Anda di dalam file `.env` (misalnya, untuk MySQL).
        ```
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=sadardiri
        DB_USERNAME=root
        DB_PASSWORD=
        ```

4.  **Migrasi dan Seeding Database**
    Jalankan migrasi untuk membuat tabel dan *seeder* untuk mengisi kategori awal.
    ```bash
    php artisan migrate --seed
    ```

5.  **Instal Dependensi JavaScript**
    ```bash
    npm install
    ```

6.  **Jalankan Server Pengembangan**
    -   Jalankan Vite untuk *compiling assets* frontend.
        ```bash
        npm run dev
        ```
    -   Di terminal lain, jalankan server pengembangan Laravel.
        ```bash
        php artisan serve
        ```

7.  **Selesai!**
    Aplikasi sekarang dapat diakses di `http://localhost:8000`.

## 🧑‍💻 Kontributor

-   **Nama**: [Farhan Miftakhul Farruq]
-   **NIM**: [23030019]
-   **Mata Kuliah**: Rekayasa Web - Tugas Akhir Semester
-   **Dosen Pengampu**: [Pak Harliyus Agustian]

---
