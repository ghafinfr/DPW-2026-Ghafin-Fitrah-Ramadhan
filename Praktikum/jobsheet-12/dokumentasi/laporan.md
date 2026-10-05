# Laporan Praktikum Jobsheet

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 16                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

## 1. Pendahuluan
Jobsheet 12 bertujuan untuk mengembangkan aplikasi perpustakaan **SIMPUS-Mini** dengan menambahkan pengelolaan transaksi peminjaman dan pengembalian buku.

Fitur yang ditambahkan meliputi:

- Pencatatan peminjaman buku.
- Pengurangan stok buku secara otomatis.
- Pengembalian buku dan penambahan stok kembali.
- Riwayat peminjaman berdasarkan anggota.
- Perhitungan jumlah buku yang sedang dipinjam.
- Penambahan menu peminjaman pada navbar.
- Penggunaan **transaction** dan `SELECT ... FOR UPDATE` untuk menjaga konsistensi stok.
- Penggunaan `JOIN`, prepared statement, dan CSRF token pada proses yang membutuhkan keamanan.

## 2. Tabel Peminjaman

File sql/03_peminjaman.sql digunakan untuk membuat tabel peminjaman.
```sql
CREATE TABLE peminjaman (
    id SERIAL PRIMARY KEY,
    buku_id INTEGER REFERENCES buku(id),
    anggota_id INTEGER REFERENCES anggota(id),
    tanggal_pinjam DATE DEFAULT CURRENT_DATE,
    tanggal_kembali DATE,
    status VARCHAR(20) DEFAULT 'dipinjam'
);
```
Penjelasan:
Tabel ini menyimpan data transaksi peminjaman. buku_id dan anggota_id menjadi foreign key yang menghubungkan transaksi dengan tabel buku dan anggota.

## 3. Peminjaman Buku

File peminjaman/tambah.php digunakan untuk menampilkan form peminjaman, sedangkan proses_tambah.php memproses data tersebut.
```php
$pdo->beginTransaction();
```
Digunakan untuk memulai transaction agar proses peminjaman dan perubahan stok dilakukan sebagai satu kesatuan.
```sql
SELECT stok FROM buku
WHERE id = :id
FOR UPDATE
```
Digunakan untuk mengunci data stok sementara proses berlangsung sehingga mencegah perubahan stok secara bersamaan.
```sql
UPDATE buku
SET stok = stok - 1
WHERE id = :id
```
Digunakan untuk mengurangi stok buku setelah peminjaman berhasil.

## 4. Pengembalian Buku

File peminjaman/kembali.php menampilkan daftar buku yang masih dipinjam. Data buku dan anggota diperoleh menggunakan JOIN.
```sql
SELECT p.id, b.judul, a.nama, p.tanggal_pinjam
FROM peminjaman p
JOIN buku b ON b.id = p.buku_id
JOIN anggota a ON a.id = p.anggota_id
WHERE p.status = 'dipinjam'
```
Penjelasan:
JOIN digunakan untuk menggabungkan data dari tabel peminjaman, buku, dan anggota.

Pada proses_kembali.php, status peminjaman diubah:
```sql
UPDATE peminjaman
SET status = 'dikembalikan',
    tanggal_kembali = CURRENT_DATE
WHERE id = :id
```
Kemudian stok buku ditambah kembali:
```sql
UPDATE buku
SET stok = stok + 1
WHERE id = :buku_id
```
## 5. Riwayat Peminjaman

File peminjaman/riwayat.php digunakan untuk menampilkan histori peminjaman anggota.
```sql
SELECT b.judul, p.tanggal_pinjam,
       p.tanggal_kembali, p.status
FROM peminjaman p
JOIN buku b ON b.id = p.buku_id
WHERE p.anggota_id = :id
```
Penjelasan:
Query tersebut menampilkan judul buku, tanggal pinjam, tanggal kembali, dan status berdasarkan anggota yang dipilih.

## 6. Perubahan Navbar

Navbar menambahkan menu:

Peminjaman Baru
Pengembalian
Riwayat

Menu tersebut ditampilkan untuk petugas yang sudah login sehingga dapat mengakses fitur transaksi peminjaman.

## 7. Kartu Sedang Dipinjam

Pada index.php, jumlah buku yang sedang dipinjam dihitung dari database:
```sql
SELECT COUNT(*)
FROM peminjaman
WHERE status = 'dipinjam'
```
Penjelasan:
COUNT(*) menghitung jumlah transaksi yang statusnya masih dipinjam, sehingga angka pada beranda selalu mengikuti data sebenarnya.
