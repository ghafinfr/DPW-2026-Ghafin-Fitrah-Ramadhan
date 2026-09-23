# Laporan Praktikum Jobsheet 

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 16                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

## 1. Pendahuluan

SIMPUS-Mini merupakan aplikasi perpustakaan sederhana berbasis PHP dan PostgreSQL. Aplikasi ini digunakan untuk mengelola data buku dan anggota perpustakaan.

Pada Jobsheet 8, aplikasi mulai menggunakan database sehingga data tidak lagi hanya ditampilkan dari file statis. PHP digunakan sebagai bahasa pemrograman sisi server untuk menerima input form, melakukan validasi, menjalankan query SQL, dan menampilkan data dari database PostgreSQL.

---


# 2. Analisis File PHP

## 2.1 `index.php`

File `index.php` merupakan halaman utama aplikasi.

Proses yang dilakukan:

```php
$totalBuku = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
```

Kode tersebut mengambil jumlah seluruh data dari tabel `buku` dan `anggota`.

Hasilnya ditampilkan pada bagian Ringkasan:

- Total Buku
- Total Anggota
- Sedang Dipinjam

Namun, nilai **Sedang Dipinjam masih ditulis secara manual sebagai `0`**, sehingga belum mengambil data dari database.

```php
<p>0</p>
```

### Kesimpulan

`index.php` sudah berhasil menggunakan database untuk menampilkan jumlah buku dan anggota, tetapi statistik peminjaman belum terhubung dengan tabel database.

---

## 2.2 `includes/koneksi.php`

File ini digunakan untuk membuat koneksi antara PHP dan PostgreSQL.

```php
$host = "localhost";
$port = "5432";
$db   = "simpus_mini";
$user = "postgres";
$pass = "ghafin";
```

Koneksi dibuat menggunakan PDO:

```php
$pdo = new PDO(
    "pgsql:host=$host;port=$port;dbname=$db",
    $user,
    $pass
);
```

Kemudian mode error PDO diatur menjadi exception:

```php
$pdo->setAttribute(
    PDO::ATTR_ERRMODE,
    PDO::ERRMODE_EXCEPTION
);
```

### Kelebihan

- Menggunakan PDO.
- Error database dapat ditangani melalui `PDOException`.
- Koneksi database dipisahkan dalam file tersendiri sehingga dapat digunakan oleh banyak halaman.

### Catatan Keamanan

Password database ditulis langsung di source code:

```php
$pass = "ghafin";
```

Untuk aplikasi nyata, kredensial sebaiknya disimpan pada environment variable atau konfigurasi yang tidak dimasukkan ke repository.

---

## 2.3 `includes/header.php`

File `header.php` digunakan sebagai template bagian atas halaman.

Fungsinya antara lain:

- Memulai session.
- Menentukan path relatif aplikasi.
- Menampilkan judul halaman.
- Memanggil stylesheet.
- Menampilkan navigasi.

Session dimulai menggunakan:

```php
session_start();
```

Navigasi menyediakan menu:

- Beranda
- Daftar Buku
- Tambah Buku
- Daftar Anggota
- Tambah Anggota

### Catatan

Kode menggunakan:

```php
<link rel="stylesheet" href="<?php echo $base; ?>assets/css/style.css">
```

Padahal struktur project yang tersedia menggunakan folder:

```text
asset/css/style.css
```

Terdapat perbedaan **`assets`** dan **`asset`**. Akibatnya stylesheet berpotensi tidak ditemukan oleh browser.

---

## 2.4 `includes/footer.php`

File `footer.php` digunakan sebagai template bagian bawah halaman.

File ini memuat JavaScript:

```php
<script src="<?php echo $base; ?>assets/js/app.js"></script>
```

Masalah yang sama dengan `header.php` ditemukan pada path:

```text
assets/js/app.js
```

sedangkan file sebenarnya berada di:

```text
asset/js/app.js
```

Path sebaiknya diseragamkan.

---

# 3. Modul Buku

## 3.1 `buku/tambah.php`

File ini menampilkan form untuk menambahkan buku.

Field yang tersedia:

| Field | Keterangan |
|---|---|
| Judul | Wajib diisi |
| Pengarang | Wajib diisi |
| Tahun Terbit | 1900–2026 |
| ISBN | Opsional |
| Stok | Minimal 0 |
| Kategori | Fiksi, Non-Fiksi, Referensi |

Form dikirim menggunakan metode POST:

```html
<form id="form-tambah" method="post" action="proses_tambah.php">
```

Dengan demikian, data akan diproses oleh `buku/proses_tambah.php`.

---

## 3.2 `buku/proses_tambah.php`

File ini bertugas menerima dan memproses data buku.

Data diambil dari `$_POST`:

```php
$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun_terbit = $_POST['tahun_terbit'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');
```

### Validasi Server-Side

Program melakukan validasi:

- Judul tidak boleh kosong.
- Pengarang tidak boleh kosong.
- Tahun harus berada pada rentang 1900–2026.
- Stok tidak boleh negatif.

Jika terdapat error, pengguna diarahkan kembali ke halaman tambah buku.

### Prepared Statement

Data dimasukkan menggunakan prepared statement:

```php
$stmt = $pdo->prepare(
    "INSERT INTO buku
    (judul, pengarang, tahun, isbn, stok, kategori)
    VALUES
    (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
    RETURNING id"
);
```

Penggunaan prepared statement merupakan praktik yang baik karena membantu mencegah SQL injection pada input pengguna.


## 3.3 `buku/list.php`

File ini mengambil seluruh data buku:

```php
$daftarBuku = $pdo->query(
    "SELECT * FROM buku ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
```

Data kemudian ditampilkan dalam tabel.

Kolom yang ditampilkan:

- Judul
- Pengarang
- Tahun Terbit
- Stok
- Aksi

Terdapat fitur pencarian berdasarkan judul melalui input:

```html
<input
    type="text"
    id="search-input"
    placeholder="Ketik judul buku..."
>
```

Terdapat pula tombol:

```text
Edit
Hapus
```

Namun pada kode yang diperiksa, tombol Edit belum mempunyai proses edit database dan tombol Hapus belum mempunyai proses penghapusan database. Tombol tersebut masih berupa tombol antarmuka.

---

# 4. Modul Anggota

## 4.1 `anggota/tambah.php`

File ini menyediakan form untuk menambahkan anggota.

Field yang tersedia:

- Nama
- No. Anggota
- Alamat
- No. HP
- Tanggal Bergabung

Form dikirim ke:

```text
anggota/proses_tambah.php
```

## 4.2 `anggota/proses_tambah.php`

File ini menerima data anggota dari form.

Data yang diterima:

```php
$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$tanggalBergabung = trim($_POST['tanggal_bergabung'] ?? '');
```

Validasi yang dilakukan:

- Nama wajib diisi.
- Nomor anggota wajib diisi.
- Tanggal bergabung wajib diisi.

Data dimasukkan menggunakan prepared statement:

```php
INSERT INTO anggota
(nama, no_anggota, alamat, no_hp, tanggal_bergabung)
```

## 4.3 `anggota/list.php`

File ini mengambil seluruh anggota:

```php
$daftarAnggota = $pdo->query(
    "SELECT * FROM anggota ORDER BY id DESC"
)->fetchAll(PDO::FETCH_ASSOC);
```

Data ditampilkan dengan kolom:

- No. Anggota
- Nama
- Alamat
- No. HP
- Tanggal Bergabung
- Aksi

# 5. Analisis File SQL

## 5.1 Tabel `buku`

SQL membuat tabel:

```sql
CREATE TABLE IF NOT EXISTS buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(255) NOT NULL,
    tahun_terbit INTEGER NOT NULL,
    isbn VARCHAR(50),
    stok INTEGER NOT NULL DEFAULT 0,
    kategori VARCHAR(50)
);
```

## 5.2 Tabel `anggota`

SQL membuat tabel:

```sql
CREATE TABLE IF NOT EXISTS anggota (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    no_anggota VARCHAR(50) NOT NULL UNIQUE,
    alamat VARCHAR(255),
    no_hp VARCHAR(30),
    tanggal_bergabung DATE NOT NULL
);
```