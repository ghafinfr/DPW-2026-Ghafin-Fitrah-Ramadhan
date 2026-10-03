# Laporan Praktikum Jobsheet

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 16                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

## 1. Pendahuluan
Pada Jobsheet 11 dilakukan audit keamanan menyeluruh terhadap aplikasi perpustakaan yang telah dikembangkan pada Jobsheet 7 sampai Jobsheet 10. Audit ini bertujuan untuk memastikan aplikasi memiliki perlindungan terhadap berbagai serangan yang umum terjadi pada aplikasi web.

Audit keamanan dilakukan berdasarkan lima aspek utama keamanan aplikasi web, yaitu:

1. SQL Injection
2. Cross-Site Scripting (XSS)
3. Cross-Site Request Forgery (CSRF)
4. Validasi dan Sanitasi Input
5. Session Fixation

Selain itu ditambahkan dua file baru sebagai pusat pengelolaan keamanan aplikasi, yaitu:

- `includes/helpers.php`
- `includes/csrf.php`

---

# 2. Tujuan Praktikum

Setelah menyelesaikan Jobsheet 11, mahasiswa diharapkan mampu:

- Memahami konsep keamanan aplikasi web.
- Mengidentifikasi kerentanan keamanan pada aplikasi.
- Menerapkan teknik mitigasi serangan SQL Injection.
- Mencegah serangan XSS pada tampilan aplikasi.
- Mengimplementasikan perlindungan CSRF pada form.
- Melakukan validasi dan sanitasi input dengan benar.
- Mengamankan sesi login dari serangan Session Fixation.

---

# 3. Struktur Penambahan File

Pada Jobsheet 11 ditambahkan dua file baru:

## 3.1 helpers.php

Lokasi:

```text
includes/helpers.php
```

Fungsi utama:

```php
function e($value)
{
    return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
```

Tujuan:

- Mengubah karakter khusus HTML menjadi bentuk aman.
- Mencegah eksekusi script berbahaya dari data pengguna.
- Digunakan pada seluruh output yang berasal dari database maupun URL.

---

## 3.2 csrf.php

Lokasi:

```text
includes/csrf.php
```

Fungsi yang tersedia:

### csrf_token()

Membuat token unik untuk setiap sesi pengguna.

### csrf_field()

Menambahkan input hidden ke dalam form.

Contoh:

```php
<?= csrf_field(); ?>
```

Output:

```html
<input type="hidden" name="_token" value="...">
```

### csrf_verify()

Memverifikasi token sebelum data diproses.

Contoh:

```php
csrf_verify();
```

Jika token tidak valid maka proses akan dihentikan.

---

# 4. Audit Keamanan

## 4.1 SQL Injection

### Deskripsi

SQL Injection adalah teknik serangan dengan menyisipkan perintah SQL ke dalam input pengguna untuk memanipulasi database.

Contoh serangan:

```sql
' OR 1=1 --
```

Jika query dibuat menggunakan concatenation:

```php
$sql = "SELECT * FROM user WHERE username='$username'";
```

Maka penyerang dapat login tanpa password.

---

### Hasil Audit

Pada Jobsheet 11 tidak terdapat perubahan kode untuk SQL Injection.

Hal ini karena sejak Jobsheet 8 seluruh query sudah menggunakan Prepared Statement.

Contoh:

```php
$stmt = $conn->prepare(
    "SELECT * FROM anggota WHERE id = ?"
);

$stmt->bind_param("i", $id);
$stmt->execute();
```


# 4.2 Cross-Site Scripting (XSS)

## Deskripsi

XSS terjadi ketika data pengguna ditampilkan kembali ke browser tanpa proses escaping.

Contoh data yang disimpan:

```html
<script>alert('Hacked')</script>
```

Jika ditampilkan langsung:

```php
<?= $nama ?>
```

Maka script akan dijalankan browser.

---

## Solusi

Dibuat fungsi:

```php
e()
```

yang menggunakan:

```php
htmlspecialchars()
```

---

## Sebelum

```php
<td><?= $anggota['nama']; ?></td>
```

---

## Sesudah

```php
<td><?= e($anggota['nama']); ?></td>
```

---

## Penerapan

Fungsi `e()` digunakan pada:

### Data Buku

- Judul
- Pengarang

### Data Anggota

- Nama
- Alamat
- Nomor HP

### Pencarian

- Keyword dari URL (`$_GET`)

### Navbar

- Nama petugas yang login

---


# 4.3 Cross-Site Request Forgery (CSRF)

## Deskripsi

CSRF adalah serangan yang memanfaatkan sesi login pengguna untuk menjalankan aksi tanpa sepengetahuan pengguna.

Contoh:

Penyerang membuat form tersembunyi:

```html
<form action="hapus.php" method="POST">
    <input name="id" value="1">
</form>
```

Ketika korban membuka halaman tersebut, data dapat terhapus tanpa izin.

---

## Solusi

Setiap form POST diberi token keamanan.

---

### Menambahkan Token

```php
<?= csrf_field(); ?>
```

---

### Contoh Form

```php
<form method="POST">
    <?= csrf_field(); ?>

    <input type="text" name="nama">
</form>
```

---

### Verifikasi Token

Pada file proses:

```php
csrf_verify();
```

Dilakukan sebelum query database dijalankan.

---

## Form yang Dilindungi

### Buku

- Tambah Buku
- Edit Buku
- Hapus Buku

### Anggota

- Tambah Anggota
- Edit Anggota
- Hapus Anggota

### Authentication

- Login
- Register

---

# 4.4 Validasi dan Sanitasi Input

## Deskripsi

Validasi digunakan untuk memastikan data sesuai format yang diharapkan.

Sanitasi digunakan untuk membersihkan data sebelum diproses.

---

## Peningkatan pada Jobsheet 11

Dilakukan audit ulang terhadap seluruh input.

Selain itu ditambahkan type casting eksplisit.

---

### Contoh

Sebelum:

```php
$id = $_GET['id'];
```

Sesudah:

```php
$id = (int) $_GET['id'];
```

---

### Manfaat

- Mencegah manipulasi parameter.
- Mengurangi kemungkinan error.
- Memastikan tipe data sesuai.

---


# 4.5 Session Fixation

## Deskripsi

Session Fixation terjadi ketika penyerang memaksa korban menggunakan Session ID tertentu.

Jika korban login menggunakan Session ID tersebut, penyerang dapat mengambil alih sesi.

---

## Solusi

Session ID diganti setelah login berhasil.

---

### Implementasi

File:

```text
auth/proses_login.php
```

Kode:

```php
session_regenerate_id(true);
```
