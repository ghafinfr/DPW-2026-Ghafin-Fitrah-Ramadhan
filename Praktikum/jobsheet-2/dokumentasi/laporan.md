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
6. [Penjelasan `asset/css/style.css`(Tampilan Web)]

## Deskripsi Proyek
CSS ini digunakan untuk mengatur tampilan website **SIMPUS-Mini** agar lebih rapi, menarik, dan mudah digunakan.
CSS mengatur berbagai bagian halaman, mulai dari reset tampilan bawaan browser, font, warna, header, navbar, layout utama, kartu statistik, tabel, form, tombol, hingga footer.
Dengan adanya CSS, tampilan halaman HTML yang sebelumnya masih menggunakan tampilan bawaan browser menjadi lebih terstruktur dan memiliki desain yang konsisten.

## Tujuan
Tujuan penggunaan CSS pada proyek SIMPUS-Mini adalah:

1. Mengatur tampilan dasar halaman website.
2. Menghilangkan margin dan padding bawaan browser.
3. Mengatur jenis, ukuran, dan warna teks.
4. Membuat header dan navbar menggunakan Flexbox.
5. Mengatur layout utama website.
6. Membuat kartu statistik menggunakan CSS Grid.
7. Memperbaiki tampilan tabel data.
8. Membuat form input menjadi lebih rapi.
9. Memberikan desain pada tombol.
10. Mengatur tampilan footer.
11. Membuat tampilan website lebih nyaman digunakan.

# Reset & Base

Bagian ini digunakan untuk mengatur tampilan dasar semua elemen HTML.

```css
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: "Segoe UI", Arial, sans-serif;
    color: #2b2b2b;
    background-color: #f5f6f8;
    line-height: 1.5;
}

/* pemberian warna dan garis bawah Link */
a {
    color: #1d5b8a;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}
```
# Header & Navbar

Digunakan untuk mengatur header dan menu navigasi.Header menggunakan Flexbox agar judul dan menu dapat tersusun dengan rapi.

```css
header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
}
```
# Main Layout

Digunakan untuk mengatur ukuran dan posisi konten utama.
Section dibuat seperti kartu dengan background putih, sudut melengkung, dan bayangan.

```css
main {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}
```
# Kartu Statistik

Bagian kartu statistik menggunakan CSS Grid.CSS tersebut membuat kartu statistik tersusun menjadi 3 kolom.

```css
main section:nth-of-type(2) {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 1rem;
}
```
# Tabel

CSS digunakan untuk membuat tabel lebih rapi.Tabel juga memiliki efek hover dan warna berbeda pada baris genap.
Tombol Edit diberi warna oranye, sedangkan tombol Hapus diberi warna merah.

```css
table {
    width: 100%;
    border-collapse: collapse;
}

thead {
    background-color: #1d5b8a;
    color: #fff;
}
```
# Form

CSS digunakan untuk memperbaiki tampilan form pada halaman Tambah Buku dan Tambah Anggota.Input dan select dibuat lebih rapi dengan ukuran, padding, dan border yang sesuai.
Tombol Simpan diberi warna biru dan memiliki efek hover.

```css
form input,
form select {
    width: 100%;
    max-width: 400px;
    padding: 0.55rem 0.7rem;
    border: 1px solid #cdd4da;
    border-radius: 4px;
}
```
# Footer

Footer digunakan untuk menampilkan informasi pada bagian bawah website.Footer dibuat dengan teks rata tengah dan ukuran font yang lebih kecil.

```css
footer {
    text-align: center;
    padding: 1.25rem;
    color: #7a8794;
    font-size: 0.9rem;
}
```