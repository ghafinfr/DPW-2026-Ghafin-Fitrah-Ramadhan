# Security Checklist

# 1. SQL Injection


## Risiko

Penyerang dapat memanipulasi query SQL melalui input pengguna.

## Sebelum

Contoh query rentan:

```php
$sql = "SELECT * FROM buku WHERE judul = '$judul'";
```

## Sesudah

Menggunakan Prepared Statement:

```php
$stmt = $conn->prepare(
    "SELECT * FROM buku WHERE judul = ?"
);

$stmt->bind_param("s", $judul);
$stmt->execute();
```

## Hasil Audit

Seluruh query pada aplikasi menggunakan Prepared Statement sejak Jobsheet 8.

---

# 2. Cross-Site Scripting (XSS)


## Risiko

Penyerang dapat menyisipkan JavaScript berbahaya melalui input pengguna.

Contoh:

```html
<script>alert('XSS')</script>
```

## Sebelum

```php
<td><?= $anggota['nama']; ?></td>
```

## Sesudah

```php
<td><?= e($anggota['nama']); ?></td>
```

## Fungsi

```php
function e($value)
{
    return htmlspecialchars(
        $value,
        ENT_QUOTES,
        'UTF-8'
    );
}
```

## Hasil Audit

Seluruh output dari database dan URL telah dibungkus menggunakan fungsi `e()`.

---

# 3. Cross-Site Request Forgery (CSRF)

## Risiko

Penyerang dapat mengirim request tanpa sepengetahuan pengguna yang sedang login.

## Sebelum

Form tidak memiliki token keamanan.

```php
<form method="POST">
```

## Sesudah

```php
<form method="POST">
    <?= csrf_field(); ?>
```

## Verifikasi

```php
csrf_verify();
```

## Hasil Audit

Semua form POST telah menggunakan token CSRF dan diverifikasi sebelum proses database.

---

# 4. Validasi dan Sanitasi Input


## Risiko

Input tidak valid dapat menyebabkan error atau penyalahgunaan sistem.

## Sebelum

```php
$id = $_GET['id'];
```

## Sesudah

```php
$id = (int) $_GET['id'];
```

## Hasil Audit

Seluruh parameter numerik menggunakan type casting eksplisit.

---

# 5. Session Fixation


## Risiko

Penyerang dapat memanfaatkan Session ID yang sudah diketahui.

## Sebelum

Session ID tidak diperbarui setelah login.

## Sesudah

```php
session_regenerate_id(true);
```

## Lokasi

```text
auth/proses_login.php
```

## Hasil Audit

Session ID diperbarui setiap login berhasil.

---