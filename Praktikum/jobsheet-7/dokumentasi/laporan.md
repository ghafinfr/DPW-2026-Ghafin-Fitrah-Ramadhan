# Laporan Praktikum Jobsheet 

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 17                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

## 1. Pendahuluan

Jobsheet 7 menggunakan PHP untuk membuat halaman dinamis, mengelola session, menerima data form, melakukan validasi, dan menampilkan flash message.

## 2. File PHP

### `index.php`
Menampilkan halaman utama dan jumlah data buku serta anggota.

```php
$totalBuku = count($_SESSION['buku'] ?? []);
$totalAnggota = count($_SESSION['anggota'] ?? []);
```

`count()` digunakan untuk menghitung jumlah data dari session.

### `includes/header.php`
Digunakan sebagai bagian header dan untuk memulai session.

```php
session_start();
```

Selain itu, `$base` digunakan agar link tetap benar ketika halaman berada di subfolder.

### `includes/footer.php`
Digunakan untuk menutup halaman dan memanggil JavaScript.

```php
<script src="<?php echo $base; ?>assets/js/app.js"></script>
```

`session_start()` tidak perlu ditulis lagi karena session sudah dimulai di `header.php`.

### `buku/list.php`
Menampilkan data buku dari session.

```php
$daftarBuku = $_SESSION['buku'] ?? [];
```

Data kemudian ditampilkan menggunakan `foreach`.

### `buku/tambah.php`
Menyediakan form untuk menambahkan data buku.

```php
<form method="post" action="proses_tambah.php">
```

Data dikirim menggunakan metode `POST`.

### `buku/proses_tambah.php`
Memproses, memvalidasi, dan menyimpan data buku.

```php
$judul = trim($_POST['judul'] ?? '');
```

`trim()` digunakan untuk menghilangkan spasi berlebih.

Data yang valid disimpan ke:

```php
$_SESSION['buku'][] = [
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun_terbit' => $tahun_terbit,
    'isbn' => $isbn,
    'stok' => $stok,
    'kategori' => $kategori
];
```

### `anggota/list.php`
Menampilkan data anggota dari session menggunakan `foreach`.

```php
$daftarAnggota = $_SESSION['anggota'] ?? [];
```

### `anggota/tambah.php`
Menyediakan form untuk memasukkan data anggota menggunakan metode `POST`.

### `anggota/proses_tambah.php`
Memvalidasi dan menyimpan data anggota.

```php
$_SESSION['anggota'][] = [
    'nama' => $nama,
    'no_anggota' => $noAnggota,
    'alamat' => $alamat,
    'no_hp' => $noHp,
    'tanggal_bergabung' => $tanggalBergabung
];
```

## 3. Session dan Flash Message

Session digunakan untuk menyimpan data selama aplikasi berjalan.

```php
session_start();
```

Flash message digunakan untuk memberikan informasi setelah proses berhasil atau gagal.

```php
$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
```

Pesan dibaca kemudian dihapus agar tidak muncul kembali saat halaman direfresh.
