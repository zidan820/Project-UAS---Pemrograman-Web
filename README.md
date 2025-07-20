### Pendataan Barang

Aplikasi ini digunakan untuk melakukan pencatatan data barang, transaksi penjualan, retur, stok masuk, serta manajemen data pelanggan dan supplier.

### **LINK WEBSITE** : https://pendataanbarang.space/ 
---

## 📄 `docs/INSTALLATION.md`

### 📥 Instalasi Aplikasi

#### 1. Persyaratan Sistem

* PHP 7.4 atau lebih baru
* MySQL/MariaDB
* Web server (XAMPP, Laragon, Apache)
* Browser modern (Chrome/Firefox)

#### 2. Langkah Instalasi

1. **Unduh dan ekstrak source code**

   * Ekstrak file `pendataan_barang.zip` ke folder `htdocs` (jika menggunakan XAMPP).

2. **Persiapkan Database**

   * Jalankan `phpMyAdmin`.
   * Buat database baru dengan nama: `db_pendataan_barang`.
   * Import file `db_pendataan_barang.sql` ke database tersebut.

3. **Konfigurasi Koneksi Database**

   * Buka file `koneksi.php` (biasanya di folder `config/` atau root).
   * Sesuaikan dengan konfigurasi lokal:

     ```php
     $host = "localhost";
     $user = "root";
     $pass = "";
     $db   = "db_pendataan_barang";
     ```

4. **Menjalankan Aplikasi**

   * Buka browser dan akses: `http://localhost/pendataan_barang/`
   * Login menggunakan:

     * Username: `admin`
     * Password: `admin123`

---

## 🗄️ `docs/DATABASE.md`

### Struktur Database

Terdapat 10 tabel utama:

| Tabel              | Deskripsi                    |
| ------------------ | ---------------------------- |
| `users`            | Data pengguna aplikasi       |
| `barang`           | Daftar barang yang tersedia  |
| `kategori`         | Kategori barang              |
| `supplier`         | Data supplier                |
| `pelanggan`        | Data pelanggan               |
| `stok_masuk`       | Catatan barang masuk         |
| `transaksi`        | Transaksi penjualan          |
| `detail_transaksi` | Detail dari setiap transaksi |
| `retur_barang`     | Barang yang dikembalikan     |
| `log_aktivitas`    | Catatan aktivitas pengguna   |

#### Relasi Utama:

* `barang.id_kategori` → `kategori.id`
* `detail_transaksi.id_barang` → `barang.id`
* `detail_transaksi.id_transaksi` → `transaksi.id`
* `transaksi.id_pelanggan` → `pelanggan.id`
* `stok_masuk.id_barang` → `barang.id`
* `stok_masuk.id_supplier` → `supplier.id`
* `retur_barang.id_barang` → `barang.id`
* `log_aktivitas.id_user` → `users.id`


### Panduan Penggunaan Aplikasi

#### 🔐 Login

* Akses halaman login melalui browser.
* Masukkan `username` dan `password`.

#### 🧭 Navigasi Menu

Menu utama biasanya terdiri dari:

* **Dashboard**
* **Data Barang**
* **Kategori**
* **Supplier**
* **Pelanggan**
* **Transaksi**
* **Retur**
* **Stok Masuk**
* **Laporan**
* **Logout**

#### 🛒 Modul-Transaksi

1. Klik menu **Transaksi**.
2. Pilih barang yang dibeli, jumlah, dan masukkan data pelanggan.
3. Sistem akan otomatis menghitung total.

#### 📦 Modul-Stok Masuk

1. Pilih **Stok Masuk**.
2. Pilih barang dan masukkan jumlah stok baru.
3. Pilih supplier dan tanggal masuk.

#### 🔁 Modul-Retur Barang

1. Masukkan ID transaksi, barang yang diretur, dan alasan.
2. Simpan dan data akan tercatat di log retur.

#### 👥 Manajemen Pengguna

* Tambahkan atau ubah data pengguna (opsional, jika tersedia di menu admin).

