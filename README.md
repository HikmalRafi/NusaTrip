# NusaTrip — Bus Ticket Reservation System

# Nama : Fatih Hikmal Rafi
# NPM   : 2610010357

**NusaTrip** adalah aplikasi web pemesanan tiket bus antarkota yang dikembangkan menggunakan Laravel 10 dan MySQL. Aplikasi ini dirancang untuk memudahkan pengguna dalam mencari jadwal perjalanan, melihat informasi bus, memilih kursi, melakukan pemesanan, dan mendapatkan e-ticket secara digital.

Proyek ini dikembangkan sebagai implementasi pembelajaran pengembangan aplikasi web menggunakan framework Laravel, dengan menerapkan pengelolaan database, navigasi, validasi input, dan interaksi pengguna.

---

## 1. Fitur Aplikasi

NusaTrip memiliki beberapa fitur utama:

- **Ticket Catalog** — Menampilkan daftar bus dan jadwal perjalanan yang tersedia.
- **Ticket Search** — Mencari perjalanan berdasarkan kota asal, kota tujuan, dan tanggal keberangkatan.
- **Ticket Details** — Menampilkan informasi bus, fasilitas, waktu keberangkatan, waktu kedatangan, dan harga tiket.
- **Interactive Seat Selection** — Memungkinkan pengguna memilih kursi yang masih tersedia.
- **Passenger Information Form** — Mengumpulkan informasi penumpang sebelum pemesanan.
- **Booking Validation** — Memvalidasi data penumpang dan memastikan kursi sesuai dengan bus yang dipilih.
- **Duplicate Booking Prevention** — Mencegah pemesanan kursi yang sama pada jadwal perjalanan yang sama.
- **E-Ticket** — Menampilkan kode booking dan ringkasan pemesanan setelah transaksi berhasil.

## 2. Halaman Aplikasi

Aplikasi terdiri dari empat halaman utama yang saling terintegrasi.

| Halaman | Deskripsi |
|---|---|
| Home / Ticket Catalog | Menampilkan katalog bus dan fitur pencarian perjalanan. |
| Ticket Details | Menampilkan detail bus dan informasi perjalanan. |
| Seat Selection & Booking | Menampilkan pemilihan kursi dan formulir data penumpang. |
| Booking Summary / E-Ticket | Menampilkan konfirmasi pemesanan dan tiket digital. |

## 3. Teknologi yang Digunakan

| Teknologi | Kegunaan |
|---|---|
| PHP 8.1+ | Bahasa pemrograman backend |
| Laravel 10 | Framework aplikasi web |
| MySQL | Sistem manajemen database |
| Bootstrap 5.3 | Framework antarmuka pengguna |
| Bootstrap Icons | Ikon antarmuka |
| JavaScript | Interaksi pada halaman web |
| HTML & CSS | Struktur dan desain halaman |

## 4. Struktur Database

NusaTrip menggunakan empat tabel utama:

| Tabel | Fungsi |
|---|---|
| `buses` | Menyimpan informasi armada bus. |
| `schedules` | Menyimpan rute, waktu perjalanan, harga, dan status jadwal. |
| `seats` | Menyimpan daftar kursi setiap bus. |
| `bookings` | Menyimpan informasi pemesanan dan data penumpang. |

Relasi database dirancang menggunakan Eloquent ORM dan foreign key untuk menjaga keterkaitan data antar tabel.

## 5. Validasi dan Keamanan

Beberapa mekanisme validasi dan perlindungan data diterapkan pada proses pemesanan:

- Validasi input nama, email, nomor telepon, dan kursi.
- Pemeriksaan status serta waktu keberangkatan jadwal.
- Pemeriksaan kesesuaian kursi dengan bus yang dipilih.
- Harga tiket ditentukan berdasarkan data jadwal di database, bukan input dari browser.
- Penggunaan database transaction saat proses pemesanan.
- Pencegahan pemesanan kursi ganda melalui pemeriksaan backend dan constraint database.

## 6. Data Demo

Aplikasi menyediakan data awal melalui database seeder agar dapat langsung diuji.

Data demo terdiri dari:

- 3 armada bus dengan tipe Executive, Sleeper, dan Luxury.
- 30 kursi untuk setiap bus.
- 3 rute perjalanan.
- 14 hari jadwal keberangkatan.
- Total 42 jadwal perjalanan dan 90 kursi.

Data demo dapat dibuat ulang menggunakan perintah database seeder.

## 7. Instalasi dan Menjalankan Aplikasi

### Persyaratan

Pastikan perangkat telah memiliki:

- PHP 8.1 atau lebih baru.
- Composer.
- MySQL.
- Web browser.

### Langkah Instalasi

**1. Clone repository**

```bash
git clone https://github.com/HikmalRafi/NusaTrip.git
```

Masuk ke direktori proyek:

```bash
cd NusaTrip
```

**2. Install dependency**

```bash
composer install
```

**3. Konfigurasi environment**

Salin file `.env.example` menjadi `.env`.

```bash
cp .env.example .env
```

Pada Windows, file tersebut juga dapat disalin secara manual melalui File Explorer.

**4. Buat database**

Buat database MySQL dengan nama:

```text
nusatrip_db
```

**5. Konfigurasi database**

Sesuaikan konfigurasi database pada file `.env`:

```env
APP_NAME=NusaTrip
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nusatrip_db
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password MySQL dengan konfigurasi perangkat masing-masing.

**6. Generate application key**

```bash
php artisan key:generate
```

**7. Jalankan migration dan seeder**

Untuk membuat struktur database sekaligus memasukkan data demo:

```bash
php artisan migrate:fresh --seed
```

**Catatan:** Perintah tersebut menghapus tabel dan seluruh data lama pada database yang sedang digunakan, kemudian membuat ulang database berdasarkan migration dan seeder.

**8. Jalankan aplikasi**

```bash
php artisan serve
```

Buka aplikasi melalui browser:

```text
http://127.0.0.1:8000
```

## 8. Cara Menggunakan Aplikasi

1. Buka halaman utama NusaTrip.
2. Cari perjalanan berdasarkan kota asal, tujuan, dan tanggal.
3. Pilih salah satu jadwal perjalanan.
4. Periksa informasi bus dan detail perjalanan.
5. Pilih kursi yang tersedia.
6. Isi formulir informasi penumpang.
7. Lakukan pemesanan.
8. Sistem akan menampilkan halaman konfirmasi dan e-ticket yang berisi kode booking serta informasi perjalanan.

## 9. Tujuan Pengembangan

Pengembangan NusaTrip bertujuan untuk menerapkan konsep pengembangan aplikasi web berbasis Laravel, meliputi:

- Penerapan arsitektur Model-View-Controller (MVC).
- Pengelolaan database relasional.
- Implementasi routing dan navigasi antarhalaman.
- Validasi input pada sisi server.
- Interaksi pengguna melalui JavaScript.
- Pengelolaan proses pemesanan dan integritas data.

---

## Repository

**GitHub:** https://github.com/HikmalRafi/NusaTrip

**Project:** NusaTrip — Bus Ticket Reservation System

**Framework:** Laravel 10

