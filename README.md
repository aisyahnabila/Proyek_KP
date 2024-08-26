# Website LOGISTIK
Aplikasi manajemen logistik untuk Dinas Sosial X, yang dirancang khusus untuk bagian pengelolaan Barang Pakai Habis.

## Deskripsi
Aplikasi ini dikembangkan untuk memudahkan pengelolaan logistik barang-barang perishable di lingkungan Dinas Sosial. Serta secara terstruktur juga mencatat persediaan permintaan barang dari UPT. Fitur utama meliputi:
- Manajemen kelola permintaan barang
- Pelacakan stok barang secara real-time
- Laporan bulanan dan ekspor data
- Pembuatan dokumen permintaan secara otomatis

## Instalasi
Untuk menjalankan aplikasi ini secara lokal, ikuti langkah-langkah berikut:

### Prasyarat
- PHP 8.x
- Composer
- MySQL atau MariaDB

### Langkah-langkah Instalasi
Langkah instalasi ini menggunakan Git dan Visual Studio Code, berikut langkah yang dapat diikut:
1. Clone repositori ini:
   ```bash
   git clone https://github.com/username/logistik-dinsos.git
   cd logistik-dinsos
   ```

2. Instal dependensi:
   ```bash
   composer install
   ```

3. Salin file `.env.example` menjadi `.env` dan konfigurasikan sesuai dengan lingkungan Anda:
   ```bash
   cp .env.example .env
   ```

4. Generate key aplikasi:
   ```bash
   php artisan key:generate
   ```

5. Buat dan migrasikan database:
   ```bash
   php artisan migrate --seed
   ```

6. Jalankan aplikasi:
   ```bash
   php artisan serve
   ```

## Penggunaan
Setelah aplikasi berhasil diinstal, Anda dapat mengaksesnya melalui browser di `http://localhost:8000`. 
Login dengan akun admin yang telah dibuat saat seeding database. Berikut beberapa fitur utama:
- **Dashboard**: untuk melihat perhitungan barang setiap harinya.
- **Kelola Barang**: untuk menginputkan deskripsi barang, menambah jumlah stok barang, dan import data barang sesuai dengan format yang tersedia.
- **Permintaan Barang**: untuk menginputkan permintaan barang yang diajukan oleh pegawai kepada admin gudang.
- **Laporan Per Permintaan**: untuk mengetahui detail permintaan yang sudah diinputkan oleh admin gudang dan admin dapat meng-export dokumen yang dibutuhkan untuk setiap permintaannya.
- **Laporan Bulanan**: untuk membuat laporan bulanan dan menghitung jumlah permintaan setiap unit kerja pada setiap bulannya.

## Struktur Proyek
Berikut adalah struktur direktori utama dalam proyek ini:
- `app/`: Berisi file-file utama dari aplikasi seperti model, controller, dan layanan.
- `resources/views/`: Berisi template Blade untuk tampilan frontend.
- `routes/`: Berisi file konfigurasi rute untuk aplikasi.
- `database/migrations/`: Berisi file-file migrasi database.

## Kontributor
Terima kasih kepada semua kontributor yang telah membantu dalam pengembangan proyek ini:

| [![aidarifdatul](https://avatars.githubusercontent.com/u/117977490?v=4)](https://github.com/aidarifdatul) | [![rzqthya](https://avatars.githubusercontent.com/u/111686681?v=4)](https://github.com/rzqthya) | [![aisyahnabila](https://avatars.githubusercontent.com/u/94779721?v=4)](https://github.com/aisyahnabila) |
|:--:|:--:|:--:|
| [aidarifdatul](https://github.com/aidarifdatul) | [rzqthya](https://github.com/rzqthya) | [aisyahnabila](https://github.com/aisyahnabila) |
| Sistem Analis| Front-End Developer | Back-End Developer |


