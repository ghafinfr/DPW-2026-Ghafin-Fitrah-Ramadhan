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

## Deskripsi Proyek
**SIMPUS-Mini** adalah sebuah website sederhana yang dibuat sebagai tugas Jobsheet 1 untuk mempraktikkan dasar-dasar pembuatan halaman web menggunakan HTML.
Website ini memiliki beberapa halaman yang digunakan untuk mengelola data buku dan anggota perpustakaan secara sederhana.

## Tujuan
Tujuan pembuatan proyek SIMPUS-Mini adalah:

1. Memahami struktur dasar dokumen HTML.
2. Memahami penggunaan elemen semantik HTML.
3. Membuat navigasi antarhalaman.
4. Membuat tabel untuk menampilkan data.
5. Membuat form untuk memasukkan data anggota.
6. Memahami penggunaan atribut HTML seperti `id`, `name`, `href`, dan `required`.
7. Membiasakan penggunaan struktur folder dalam sebuah proyek website

## Index.html
Merupakan file index yg terletak pada root, berfungsi sebagai home dengan 
navigasi menu antar page dan ringkasan mengenai anggota. 
Index terdiri dari `header`, `main`, dan `footer` yang semuanya dibungkus oleh tag body.


## Anggota
1. **list.html**
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

2. tambah.html
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