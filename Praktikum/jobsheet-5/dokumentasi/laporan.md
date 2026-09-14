# Laporan Praktikum Jobsheet 1

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 17                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

# Pendahuluan
Laporan ini mendokumentasikan proses pengembangan dan perbaikan tata letak (layout) antarmuka pengguna responsif untuk proyek "SIMPUS-Mini" (Sistem Perpustakaan Mini). Fokus utama pada penyesuaian CSS agar tampilan dapat beradaptasi dengan baik pada berbagai ukuran layar, khususnya pada perangkat seluler (*mobile-friendly*).


# 1. Desain Visual dan Tata Letak (CSS)
Tampilan visual dibangun dengan fokus pada desain responsif (*mobile-first*) dan hierarki visual yang jelas menggunakan palet warna identitas hijau (`#006237`).
*   **Tipografi & Reset:** Menggunakan metode *reset* `box-sizing: border-box;` dengan keluarga font "Segoe UI"/Arial untuk tampilan modern.
*   **Sistem Tata Letak (Grid & Flexbox):** Elemen kartu ringkasan di dasbor (`index.html`) menggunakan `CSS Grid` (`grid-template-columns: repeat(2, 1fr)`). Bagian *header* dan navigasi menggunakan `CSS Flexbox` untuk perataan vertikal dan horizontal.
*   **Desain Responsif (*Media Queries*):**
    *   **Layar Desktop (>768px):** Menu navigasi horizontal, tombol hamburger disembunyikan.
    *   **Layar Tablet (<=768px):** Kartu dasbor menyesuaikan proporsi 2 kolom, ukuran font disesuaikan.
    *   **Layar Ponsel (<=480px):** Tombol hamburger muncul. Navigasi diubah menjadi susunan vertikal (kolom) dan disembunyikan secara *default*. Grid pada dasbor berubah menjadi 1 kolom (`1fr`).

    # 2.  Navigasi Global
     halaman menggunakan `<header>` dan `<nav>` terpusat. Tombol *hamburger* diimplementasikan menggunakan `<button id="nav-toggle-btn">` untuk aksesibilitas dan kemudahan manipulasi DOM.

# 2. Logika Interaksi Sisi Klien (JavaScript)
File `app.js` mengatur fungsionalitas sisi klien menggunakan pendekatan modular. Fungsi dijalankan saat DOM sepenuhnya dimuat (`DOMContentLoaded`).
*   **`initNavToggle()`:** Mengontrol menu seluler dengan menyuntikkan kelas `.nav-open` secara dinamis menggunakan `classList.toggle` saat tombol hamburger diklik.
*   **`initTableFilter()`:** Menyediakan fitur pencarian *real-time*. Fungsi mendengarkan *event* `keyup` pada kotak pencarian dan mencocokkan nilai input dengan teks setiap baris `<tr>`, lalu menyembunyikan baris yang tidak relevan.
*   **`initHapusConfirm()`:** Simulasi penghapusan data. Saat tombol "Hapus" ditekan, memunculkan dialog `confirm()`. Jika disetujui, mengeksekusi `row.remove()` pada baris tabel tersebut.
*   **`initValidasiForm()`:** Mencegah pengiriman formulir jika data tidak valid (`e.preventDefault()`). Memeriksa input yang kosong, rentang tahun yang logis (1900–2026), dan batas stok (minimal 0). Pesan *error* dinamis dimunculkan tepat di bawah elemen yang bermasalah.

# 3. Kesimpulan
Seluruh elemen antarmuka halaman Dasbor, Modul Buku, dan Modul Anggota telah terintegrasi dengan baik. Tata letak aplikasi berhasil dipertahankan pada resolusi besar, beradaptasi dengan elegan pada layar gawai seluler, dan memiliki validasi serta interaktivitas *front-end* yang kuat. Sistem sudah sepenuhnya siap untuk dihubungkan dengan *backend* atau *database* pada tahapan selanjutnya.