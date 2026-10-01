# Laporan Praktikum Jobsheet 

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 16                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

## 1. Pendahuluan
Jobsheet 10 mengembangkan aplikasi **SIMPUS-Mini** berbasis PHP dan PostgreSQL dengan menambahkan sistem autentikasi petugas. Aplikasi memiliki fitur login, registrasi, logout, session, serta pengelolaan data buku dan anggota.

## 2. Penjelasan File PHP

### `index.php`

Menampilkan halaman utama aplikasi dan ringkasan jumlah buku serta anggota.

```php
$totalBuku = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
$totalAnggota = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
```

`COUNT(*)` digunakan untuk menghitung jumlah data pada tabel buku dan anggota.

### `includes/koneksi.php`

Digunakan untuk membuat koneksi PHP dengan PostgreSQL menggunakan PDO. PDO mempermudah proses menjalankan query dan penggunaan prepared statement.

### `includes/auth.php`

File ini digunakan untuk membatasi halaman agar hanya dapat diakses oleh pengguna yang sudah login.

```php
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}
```

Jika `user_id` belum tersedia di session, pengguna diarahkan ke halaman login.

### `auth/login.php`

Menampilkan form login yang berisi username dan password. Form mengirim data ke `proses_login.php`.

### `auth/proses_login.php`

Memeriksa username pada database dan memverifikasi password.

```php
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['nama'] = $user['nama'];
    $_SESSION['role'] = $user['role'];
}
```

`password_verify()` digunakan untuk mencocokkan password yang dimasukkan dengan password yang sudah di-hash di database.

### `auth/register.php`

Menampilkan form pendaftaran petugas baru berupa nama, username, dan password.

### `auth/proses_register.php`

Melakukan validasi data registrasi, mengecek apakah username sudah digunakan, kemudian menyimpan pengguna baru ke database.

```php
'password' => password_hash($password, PASSWORD_DEFAULT),
```

`password_hash()` digunakan untuk menyimpan password dalam bentuk hash sehingga password asli tidak disimpan secara langsung.

### `auth/logout.php`

Digunakan untuk mengakhiri session pengguna sehingga pengguna keluar dari sistem.

## 3. Modul Buku dan Anggota

### Modul Buku

- `list.php` menampilkan data buku, pencarian, dan pagination.
- `tambah.php` menampilkan form penambahan buku.
- `proses_tambah.php` menyimpan buku baru.
- `edit.php` menampilkan data buku untuk diedit.
- `proses_edit.php` memperbarui data buku.
- `hapus.php` menghapus data buku.

### Modul Anggota

- `list.php` menampilkan data anggota, pencarian, dan pagination.
- `tambah.php` menampilkan form penambahan anggota.
- `proses_tambah.php` menyimpan anggota baru.
- `edit.php` menampilkan data anggota untuk diedit.
- `proses_edit.php` memperbarui data anggota.
- `hapus.php` menghapus data anggota.

## 4. Validasi dan Keamanan

Validasi dilakukan sebelum data diproses. Pada registrasi, nama dan username wajib diisi serta password minimal 6 karakter.

```php
if (strlen($password) < 6) {
    $errors[] = "Password minimal 6 karakter.";
}
```

Username juga diperiksa agar tidak terjadi duplikasi.

Query database menggunakan **prepared statement**, misalnya:

```php
$stmt = $pdo->prepare(
    "SELECT * FROM users WHERE username = :username"
);
$stmt->execute(['username' => $username]);
```

Prepared statement membantu memisahkan perintah SQL dari nilai input pengguna.

## 5. CSS Pagination

Pagination digunakan untuk mengatur navigasi halaman pada daftar buku dan anggota.

```css
.pagination {
    display: flex;
    gap: 0.5rem;
    margin-top: 1rem;
}
```

- `display: flex` membuat tombol pagination tersusun secara horizontal.
- `gap: 0.5rem` memberikan jarak antar tombol.
- `margin-top: 1rem` memberikan jarak antara pagination dan elemen di atasnya.

Tampilan link pagination diatur dengan:

```css
.pagination a {
    padding: 0.4rem 0.75rem;
    border: 1px solid #cdd4da;
    border-radius: 4px;
    color: #1d5b8a;
}
```

`padding` mengatur ruang dalam tombol, `border` memberikan garis tepi, `border-radius` membuat sudut tombol membulat, dan `color` menentukan warna teks.

Halaman aktif menggunakan:

```css
.pagination a.active {
    background-color: #1d5b8a;
    color: #fff;
    border-color: #1d5b8a;
}
```

Class `active` memberikan warna berbeda pada halaman yang sedang dipilih sehingga pengguna dapat mengetahui posisi halaman saat ini.

## 6. CSS Search Box

Form pencarian menggunakan flexbox agar input dan tombol tersusun dengan rapi.

```css
.search-box form {
    display: flex;
    gap: 0.5rem;
    align-items: flex-end;
}
```

Tombol pencarian diatur menggunakan:

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

`cursor: pointer` membuat kursor berubah menjadi bentuk tangan ketika diarahkan ke tombol.

## 7. Database

Selain tabel buku dan anggota, Jobsheet 10 menggunakan tabel `users` untuk menyimpan akun petugas.

Contoh data yang disimpan pada tabel `users` meliputi:

- `id`
- `nama`
- `username`
- `password`
- `role`

Password disimpan menggunakan hasil `password_hash()`.

## 8. Kesimpulan

Jobsheet 10 berhasil mengembangkan SIMPUS-Mini dengan menambahkan **autentikasi pengguna**. Pengguna dapat melakukan registrasi, login, dan logout, sedangkan halaman yang membutuhkan autentikasi dapat dilindungi menggunakan session.

Selain autentikasi, fitur pengelolaan buku dan anggota tetap menggunakan CRUD, pencarian, pagination, validasi, dan prepared statement. Dengan demikian, aplikasi menjadi lebih terstruktur dan memiliki mekanisme dasar keamanan untuk membatasi akses pengguna.