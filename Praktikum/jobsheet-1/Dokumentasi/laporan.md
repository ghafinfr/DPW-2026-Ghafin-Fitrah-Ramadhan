# Laporan Praktikum Jobsheet 1

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 17                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

## Daftar Isi

1. [Penjelasan `index.html` (Halaman Beranda)]
2. [Penjelasan `anggota/list.html` (Daftar Anggota)]
3. [Penjelasan `anggota/tambah.html` (Form Tambah Anggota)]
4. [Penjelasan `buku/list.html` (Daftar Buku)]
5. [Penjelasan `buku/tambah.html` (Form Tambah Buku)]

## Deskripsi Proyek
**SIMPUS-Mini** adalah sebuah website sederhana yang dibuat sebagai tugas Jobsheet 1 untuk mempraktikkan dasar-dasar pembuatan halaman web menggunakan HTML.
Website ini memiliki beberapa halaman yang digunakan untuk mengelola data buku dan anggota perpustakaan secara sederhana.

## Tujuan
Tujuan pembuatan proyek SIMPUS-Mini adalah:

1. Memahami struktur dasar dokumen HTML.
2. Memahami penggunaan elemen semantik HTML.
3. Membuat navigasi antarhalaman.
4. Membuat tabel untuk menampilkan data.
5. Membuat form untuk memasukkan data buku dan anggota.
6. Memahami penggunaan atribut HTML seperti `id`, `name`, `href`, dan `required`.
7. Membiasakan penggunaan struktur folder dalam sebuah proyek website

## Index.html
Merupakan file index yg terletak pada root, berfungsi sebagai home dengan 
navigasi menu antar page dan ringkasan mengenai anggota. 
Index terdiri dari `header`, `main`, dan `footer` yang semuanya dibungkus oleh tag body.
Pada bagian navigasi terdapat beberapa menu untuk berpindah ke halaman lain, yaitu:

- Daftar Anggota
- Tambah Anggota
- Daftar Buku
- Tambah Buku
- Index(Beranda)

## Anggota
### 1. **list.html**

Digunakan untuk menampilkan daftar anggota perpustakaan dalam bentuk tabel.

Halaman **Daftar Anggota** digunakan untuk menampilkan data anggota perpustakaan.
Data yang ditampilkan terdiri dari:

| No. Anggota | Nama | Alamat | No. HP |
|---|---|---|---|
| A001 | Siti Aminah | Malang | 0812xxxx |
| A002 | Budi Santoso | Batu | 0813xxxx |

Selain data anggota, terdapat tombol:
**Edit**
**Hapus**
Tombol tersebut masih berupa tampilan dan belum memiliki fungsi pemrosesan data karena proyek ini masih menggunakan HTML dasar.

### 2. **tambah.html**

Page ini berfungsi sebagai formulir isian untuk input/menambah anggota dan data anggota baru. 
**table**

```html
  <p>
                 <label for="nama">Nama</label><br>
                 <input type="text" id="nama" name="nama" required>
                </p>
                <p>
                    <label for="no_anggota">No. Anggota</label><br>
                    <input type="text" id="no_anggota" name="no_anggota" required>
                </p>
                <p>
                    <label for="alamat">Alamat</label><br>
                    <input type="text" id="alamat" name="alamat">
                </p>
                <p>
                    <label for="no_hp">No. HP</label><br>
                    <input type="text" id="no_hp" name="no_hp">
                </p>
```

## Buku
### 1. **list.html**

Digunakan untuk menampilkan daftar buku perpustakaan dalam bentuk tabel.

Halaman **Daftar Buku** digunakan untuk menampilkan data buku yang tersedia pada sistem SIMPUS-Mini.

Data yang ditampilkan terdiri dari:

| Judul | Pengarang | Tahun | Stok |
|---|---|---|---|
| Laskar Pelangi | Andrea Hirata | 2005 | 4 |
| Bumi Manusia | Pramoedya Ananta Toer | 1980 | 2 |
| Negeri 5 Menara | Ahmad Fuadi | 2009 | 0 |
| Filosofi Teras | Henry Manampiring | 2018 | 5 |
| Ronggeng Dukuh Paruk | Ahmad Tohari | 1982 | 1 |

Selain data buku, terdapat tombol:

**Edit**

**Hapus**

Tombol tersebut masih berupa tampilan dan belum memiliki fungsi pemrosesan data karena proyek ini masih menggunakan HTML dasar.

### Struktur Tabel

Pada halaman `buku/list.html`, tabel dibuat menggunakan tag `table`, `thead`, `tbody`, `tr`, `th`, dan `td`.

```html
<table>
    <thead>
        <tr>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Tahun</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>
        <tr>
            <td>Laskar Pelangi</td>
            <td>Andrea Hirata</td>
            <td>2005</td>
            <td>4</td>
            <td>
                <button type="button">Edit</button>
                <button type="button">Hapus</button>
            </td>
        </tr>
    </tbody>
</table>
```
### 2. **tambah.html**

Page ini berfungsi sebagai formulir isian untuk input atau menambah data buku baru ke dalam sistem SIMPUS-Mini.

Form tambah buku terdiri dari beberapa field, yaitu:

- Judul
- Pengarang
- Tahun Terbit
- ISBN
- Stok
- Kategori

**Form Tambah Buku**

```html
<form>
    <p>
        <label for="judul">Judul</label><br>
        <input type="text" id="judul" name="judul" required>
    </p>

    <p>
        <label for="pengarang">Pengarang</label><br>
        <input type="text" id="pengarang" name="pengarang" required>
    </p>

    <p>
        <label for="tahun">Tahun Terbit</label><br>
        <input type="number" id="tahun" name="tahun" min="1900" max="2026" required>
    </p>

    <p>
        <label for="isbn">ISBN</label><br>
        <input type="text" id="isbn" name="isbn">
    </p>

    <p>
        <label for="stok">Stok</label><br>
        <input type="number" id="stok" name="stok" min="0" required>
    </p>

    <p>
        <label for="kategori">Kategori</label><br>
        <select id="kategori" name="kategori">
            <option value="fiksi">Fiksi</option>
            <option value="non-fiksi">Non-Fiksi</option>
            <option value="referensi">Referensi</option>
        </select>
    </p>

    <p>
        <button type="submit">Simpan</button>
    </p>
</form>
```