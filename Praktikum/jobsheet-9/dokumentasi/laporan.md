# Laporan Praktikum Jobsheet 

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 16                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

## 1. Pendahuluan
Jobsheet 9 bertujuan mengembangkan aplikasi SIMPUS-Mini berbasis PHP dan PostgreSQL. Aplikasi digunakan untuk mengelola data buku dan anggota perpustakaan dengan fitur tambah, tampil, edit, hapus, pencarian, dan pagination.


## 2. Penjelasan File PHP

### `index.php`

Menampilkan halaman utama dan jumlah data dari database.

```php
$totalBuku = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
```

Kode tersebut menghitung jumlah buku dan anggota yang tersimpan di database.

### `includes/koneksi.php`

Digunakan untuk menghubungkan PHP dengan PostgreSQL menggunakan PDO.

```php
$pdo = new PDO(
    "pgsql:host=$host;port=$port;dbname=$db",
    $user,
    $pass
);
```

`PDO::ATTR_ERRMODE` digunakan agar kesalahan database menghasilkan exception.

### `includes/header.php`

Berisi bagian atas halaman, navigasi, session, serta pemanggilan CSS. Variabel `$base` digunakan untuk membuat path relatif agar halaman dapat digunakan dari beberapa folder.

### `includes/footer.php`

Berisi bagian bawah halaman dan pemanggilan JavaScript.

### Modul `buku`

- `list.php` menampilkan daftar buku, pencarian, dan pagination.
- `tambah.php` menampilkan form tambah buku.
- `proses_tambah.php` melakukan validasi dan `INSERT` data buku.
- `edit.php` menampilkan data buku yang akan diubah.
- `proses_edit.php` melakukan validasi dan `UPDATE` data buku.
- `hapus.php` menghapus data buku menggunakan `DELETE`.

### Modul `anggota`

- `list.php` menampilkan daftar anggota, pencarian, dan pagination.
- `tambah.php` menampilkan form tambah anggota.
- `proses_tambah.php` menyimpan anggota baru.
- `edit.php` menampilkan data anggota yang akan diedit.
- `proses_edit.php` memperbarui data anggota.
- `hapus.php` menghapus data anggota.

## 3. Validasi Data

Validasi dilakukan pada sisi server sebelum data dimasukkan atau diperbarui.

Contohnya pada data buku:

```php
if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}

if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}
```

Validasi ini mencegah data kosong atau nilai stok yang tidak valid masuk ke database.

## 4. Prepared Statement

Proses tambah dan edit menggunakan prepared statement, misalnya:

```php
$stmt = $pdo->prepare(
    "UPDATE buku SET judul = :judul, pengarang = :pengarang,
     tahun = :tahun, isbn = :isbn, stok = :stok,
     kategori = :kategori WHERE id = :id"
);
```

Penggunaan prepared statement membantu membuat proses query lebih aman karena nilai input dikirim sebagai parameter.

## 5. Database

Database menggunakan dua tabel utama:

### Tabel `buku`

| Field | Tipe |
|---|---|
| id | SERIAL PRIMARY KEY |
| judul | VARCHAR(255) |
| pengarang | VARCHAR(255) |
| tahun | INTEGER |
| isbn | VARCHAR(50) |
| stok | INTEGER |
| kategori | VARCHAR(50) |

### Tabel `anggota`

| Field | Tipe |
|---|---|
| id | SERIAL PRIMARY KEY |
| nama | VARCHAR(255) |
| no_anggota | VARCHAR(50) UNIQUE |
| alamat | VARCHAR(255) |
| no_hp | VARCHAR(30) |


## 1. .pagination
```css
.pagination {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}
```
display: flex; → membuat elemen pagination tersusun secara horizontal.
gap: 0.5rem; → memberikan jarak antar tombol pagination sebesar 0.5rem.
margin-top: 1rem; → memberikan jarak bagian pagination dari elemen di atasnya.

## 2. .pagination a
```css
.pagination a {
    padding: 0.4rem 0.75rem;
    border: 1px solid #cdd4da;
    border-radius: 4px;
    color: #1d5b8a;
}
```
Digunakan untuk mengatur tampilan link/tombol nomor halaman.
padding: 0.4rem 0.75rem; → memberikan ruang di dalam tombol, sehingga teks tidak terlalu rapat.
border: 1px solid #cdd4da; → memberikan garis tepi berwarna abu-abu.
border-radius: 4px; → membuat sudut tombol sedikit membulat.
color: #1d5b8a; → memberikan warna biru pada teks tombol.

## 3. .pagination a.active
```css
.pagination a.active {
    background-color: #1d5b8a;
    color: #fff;
    border-color: #1d5b8a;
}
```
Digunakan untuk menandai halaman yang sedang aktif.
Misalnya pengguna sedang berada di halaman 2:
```html
<a href="?page=1">1</a>
<a href="?page=2" class="active">2</a>
<a href="?page=3">3</a>
```
Maka tombol 2 akan memiliki:
background-color → latar belakang biru.
color: #fff → teks menjadi putih.
border-color → garis tepi juga menjadi biru.
Jadi pengguna dapat dengan mudah mengetahui halaman yang sedang dibuka.

## 4. .search-box form
```css
.search-box form {
    display: flex;
    gap: 0.5rem;
    align-items: flex-end;
}
```
Digunakan untuk mengatur form pencarian.
display: flex; → membuat input dan tombol pencarian tersusun secara horizontal.
gap: 0.5rem; → memberikan jarak antara input dengan tombol.
align-items: flex-end; → membuat elemen form sejajar pada bagian bawah.

## 5. .search-box button
```css
.search-box button {
    padding: 0.55rem 1.2rem;
    border: none;
    border-radius: 4px;
    background-color: #1d5b8a;
    color: #fff;
    cursor: pointer;
}
```
Digunakan untuk mengatur tampilan tombol pencarian.
padding: 0.55rem 1.2rem; → mengatur ukuran ruang dalam tombol.
border: none; → menghilangkan garis tepi bawaan tombol.
border-radius: 4px; → membuat sudut tombol sedikit membulat.
background-color: #1d5b8a; → memberikan warna biru sebagai latar tombol.
color: #fff; → membuat teks tombol berwarna putih.
cursor: pointer; → mengubah kursor menjadi bentuk tangan ketika diarahkan ke tombol, menandakan tombol dapat diklik.
 