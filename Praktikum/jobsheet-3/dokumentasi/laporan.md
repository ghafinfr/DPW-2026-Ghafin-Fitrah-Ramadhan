# Laporan Praktikum Jobsheet 1

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 17                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |


## Deskripsi Proyek
CSS ini digunakan untuk mengatur tampilan website **SIMPUS-Mini** agar lebih rapi, menarik, dan mudah digunakan.
CSS mengatur berbagai bagian halaman, mulai dari reset tampilan bawaan browser, font, warna, header, navbar, layout utama, kartu statistik, tabel, form, tombol, hingga footer.
Dengan adanya CSS, tampilan halaman HTML yang sebelumnya masih menggunakan tampilan bawaan browser menjadi lebih terstruktur dan memiliki desain yang konsisten.

## Tujuan
Tujuan penggunaan CSS pada proyek SIMPUS-Mini adalah:
1. Memahami penggunaan CSS Grid untuk menyusun kart statistik.
2. Memahami penggunaan media query untuk membuat tampilan website responsif.
3. Memahami pembuatan hamburger menu menggunakan teknik checkbox.
4. Menyesuaikan tampilan website untuk tablet dan perangkat mobile.


## ``hamburger menu dan responsive breakpoints``

Kode CSS tersebut digunakan untuk membuat hamburger menu dan mengatur tampilan website agar responsif pada ukuran tablet.

```css
/* Hamburger menu */
.nav-toggle {
    display: none;
}

.nav-toggle-label {
    display: none;
    font-size: 1.6rem;
    color: #fff;
    cursor: pointer;
}

/* Tablet ke bawah */
@media (max-width: 768px) {
    main section:nth-of-type(2) {
        grid-template-columns: repeat(2, 1fr);
    }
}

```

### A. Hamburger Menu
```css
.nav-toggle {
    display: none;
}
```
Kode tersebut menyembunyikan checkbox yang digunakan sebagai pengontrol hamburger menu.
Checkbox tetap berfungsi walaupun tidak ditampilkan pada halaman.

### B. Responsive Tablet
```css
@media (max-width: 768px) {
    main section:nth-of-type(2) {
        grid-template-columns: repeat(2, 1fr);
    }
}
```
Media query ini diterapkan ketika lebar layar maksimal 768px,
misalnya pada tablet.

