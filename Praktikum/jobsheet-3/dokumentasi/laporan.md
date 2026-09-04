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


/* Mobile */
@media (max-width: 480px) {
    header {
        position: relative;
    }

    .nav-toggle-label {
        display: block;
    }

    header nav {
        display: none;
        width: 100%;
        order: 3;
        margin-top: 1rem;
    }

    .nav-toggle:checked ~ nav {
        display: block;
    }

    header nav ul {
        flex-direction: column;
        gap: 0.75rem;
    }

    main section:nth-of-type(2) {
        grid-template-columns: 1fr;
    }

    form input,
    form select {
        max-width: 100%;
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

### Responsive Mobile

Kode tersebut digunakan ketika lebar layar maksimal 480px, sehingga cocok untuk perangkat smartphone.
Header dibuat relatif agar elemen navigasi dan hamburger dapat diposisikan dengan lebih mudah.
```css
@media (max-width: 480px) {
header {
    position: relative;
}
```
```css
.nav-toggle-label {
    display: block;
}
header nav {
    display: none;
    width: 100%;
    order: 3;
    margin-top: 1rem;
}
```
Pada layar mobile, tombol hamburger ditampilkan.Navigasi awalnya disembunyikan pada perangkat mobile. Lebarnya dibuat 100%, diletakkan pada urutan ketiga, dan diberi jarak bagian atas.

```css
.nav-toggle:checked ~ nav {
    display: block;
}

header nav ul {
    flex-direction: column;
    gap: 0.75rem;
}
```
Kode ini merupakan bagian utama dari checkbox hack. Ketika checkbox ``.nav-toggle`` dicentang, elemen ``nav`` yang berada setelahnya akan ditampilkan.
Menu navigasi pada smartphone diubah menjadi susunan vertikal dan setiap menu diberi jarak sebesar 0.75rem.

```css
main section:nth-of-type(2) {
    grid-template-columns: 1fr;
}
```
Pada layar mobile, kartu statistik dibuat menjadi 1 kolom agar lebih mudah dibaca pada layar yang sempit.

```css
form input,
form select {
    max-width: 100%;
}
```
Input dan select pada form dibatasi agar tidak melebihi lebar container ketika ditampilkan pada perangkat mobile.

## 5. Hasil yang Diharapkan

`Pada layar desktop` navigasi ditampilkan secara normal dan kartu statistik dapat menggunakan dua kolom.
`Pada layar tablet` dengan lebar maksimal 768px, kartu statistik tetap disusun menjadi dua kolom.

`Pada layar mobile` dengan lebar maksimal 480px: 
- Tombol hamburgerditampilkan. 
- Navigasi disembunyikan sebelum hamburger diklik. 
- Navigasi dapat dibuka menggunakan checkbox. 
- Menu navigasi berubah menjadi vertikal. 
- Kartu statistik berubah menjadi satu kolom. 
- Form menyesuaikan lebar layar.