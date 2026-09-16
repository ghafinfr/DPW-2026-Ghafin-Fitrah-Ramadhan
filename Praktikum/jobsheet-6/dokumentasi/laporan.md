# Laporan Praktikum Jobsheet 1

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 17                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

# Pendahuluan
SIMPUS-Mini merupakan aplikasi sederhana yang digunakan untuk mengelola data perpustakaan, khususnya data buku dan anggota. Pada Jobsheet 6, aplikasi dikembangkan dengan memanfaatkan HTML, CSS, dan JavaScript sehingga halaman web tidak hanya menampilkan tampilan statis, tetapi juga dapat melakukan interaksi dengan pengguna.

JavaScript digunakan untuk beberapa fungsi, seperti menampilkan data buku dan anggota dari file JSON, melakukan pencarian data, menampilkan indikator loading, validasi form, membuka menu navigasi pada perangkat dengan layar kecil, serta memberikan konfirmasi sebelum menghapus data.

### JavaScript

```html
<script src="asset/js/app.js"></script>
```

Kode tersebut menghubungkan halaman Beranda dengan JavaScript umum pada `app.js`.

---

###  indikator loading

```html
<p id="loading-indicator" style="display:none;">
    Memuat data...
</p>
```

Elemen ini digunakan untuk memberi informasi kepada pengguna bahwa data sedang dimuat.

### `buku/list.html`

```html
<script src="../asset/js/app.js"></script>
<script src="../asset/js/buku.js"></script>
```

`app.js` menyediakan fungsi umum seperti pencarian, validasi, dan navigasi, sedangkan `buku.js` digunakan khusus untuk mengambil dan menampilkan data buku.

---

### `anggota/list.html`

```html
<script src="../asset/js/app.js"></script>
<script src="../asset/js/anggota.js"></script>
```

### `data/buku.json` 

File `buku.json` digunakan sebagai sumber data untuk halaman Daftar Buku.

Data yang tersedia berjumlah **12 buku**
Setiap objek buku memiliki empat atribut:

- `judul`
- `pengarang`
- `tahun`
- `stok`
File JSON digunakan oleh `buku.js` sebagai sumber data yang diambil menggunakan Fetch API.

---

### `data/anggota.json`

File `anggota.json` digunakan sebagai sumber data untuk halaman Daftar Anggota.

Data berjumlah **4 anggota**.
Setiap objek memiliki lima atribut:

- `no_anggota`
- `nama`
- `alamat`
- `no_hp`
- `tanggal_bergabung`

Data tersebut nantinya diambil oleh `anggota.js` dan ditampilkan pada tabel.

---

### `app.js`

`app.js` merupakan JavaScript umum yang digunakan oleh beberapa halaman.

####  Konfirmasi Hapus

```javascript
const btn = e.target.closest(".btn-hapus");
if (!btn) return;

const row = btn.closest("tr");
const yakin = confirm("Yakin ingin menghapus \"" + nama + "\"?");

if (yakin && row) {
    row.remove();
}
```

Kode tersebut mendeteksi tombol dengan class `.btn-hapus`, meminta konfirmasi kepada pengguna, kemudian menghapus baris tabel jika pengguna menyetujui.

Fitur ini masih bersifat **front-end**, sehingga penghapusan hanya menghilangkan baris dari tampilan.

---

### Penjelasan `buku.js`

#### Fungsi Memuat Data Buku

```javascript
async function muatDaftarBuku() {
    const tbody = document.querySelector(".table-responsive table tbody");
    const loading = document.getElementById("loading-indicator");
    if (!tbody) return;
```

Fungsi `muatDaftarBuku()` digunakan untuk mengambil dan menampilkan data buku. Program terlebih dahulu mencari `<tbody>` sebagai tempat data dimasukkan.

#### Loading Indicator

```javascript
loading.style.display = "block";
tbody.innerHTML = "";
```

Indikator loading ditampilkan dan isi tabel dikosongkan sebelum data baru dimuat.

#### Fetch API

```javascript
const res = await fetch("../data/buku.json");

if (!res.ok) {
    throw new Error("Gagal mengambil data (status " + res.status + ")");
}

const daftarBuku = await res.json();
```

`fetch()` digunakan untuk mengambil `buku.json`. Setelah respons berhasil, `res.json()` mengubah data JSON menjadi objek JavaScript.

#### Menampilkan Data ke Tabel

```javascript
daftarBuku.forEach(function (buku) {
    const tr = document.createElement("tr");

    tr.innerHTML =
        "<td>" + buku.judul + "</td>" +
        "<td>" + buku.pengarang + "</td>" +
        "<td>" + buku.tahun + "</td>" +
        "<td>" + buku.stok + "</td>";

    tbody.appendChild(tr);
});
```

`forEach()` digunakan untuk memproses setiap buku. `createElement("tr")` membuat baris baru, kemudian data buku dimasukkan ke dalam cell tabel.

#### Penanganan Error

```javascript
catch (err) {
    tbody.innerHTML =
        "<tr><td colspan=\"5\">Gagal memuat data: "
        + err.message + "</td></tr>";
}
```

Jika terjadi kesalahan saat mengambil data, program menampilkan pesan error pada tabel.

---

### `anggota.js`

#### Fungsi Memuat Data Anggota

```javascript
async function muatDaftarAnggota() {
    const tbody = document.querySelector(
        ".table-responsive table tbody"
    );
    const loading = document.getElementById("loading-indicator");

    if (!tbody) return;
}
```

Fungsi ini digunakan untuk mengambil dan menampilkan data anggota.

#### Mengambil Data JSON

```javascript
const res = await fetch("../data/anggota.json");

if (!res.ok) {
    throw new Error(
        "Gagal mengambil data (status " + res.status + ")"
    );
}

const daftarAnggota = await res.json();
```

Data anggota diambil dari `anggota.json` menggunakan Fetch API kemudian dikonversi menjadi data JavaScript.

#### Membuat Baris Tabel

```javascript
daftarAnggota.forEach(function (anggota) {
    const tr = document.createElement("tr");

    tr.innerHTML =
        "<td>" + anggota.no_anggota + "</td>" +
        "<td>" + anggota.nama + "</td>" +
        "<td>" + anggota.alamat + "</td>" +
        "<td>" + anggota.no_hp + "</td>" +
        "<td>" + anggota.tanggal_bergabung + "</td>";

    tbody.appendChild(tr);
});
```

Setiap objek anggota diproses menggunakan `forEach()`. Data nomor anggota, nama, alamat, nomor HP, dan tanggal bergabung dimasukkan ke cell tabel.

#### Menjalankan Fungsi

```javascript
document.addEventListener(
    "DOMContentLoaded",
    muatDaftarAnggota
);
```

Fungsi `muatDaftarAnggota()` dijalankan setelah struktur HTML selesai dimuat.

---

### Kesimpulan

Berdasarkan implementasi Jobsheet 6, SIMPUS-Mini berhasil dikembangkan menjadi aplikasi web sederhana yang menggabungkan HTML, CSS, JavaScript, dan JSON.

JavaScript digunakan untuk mengambil data menggunakan Fetch API, menampilkan data secara dinamis, melakukan pencarian, memberikan validasi form, mengatur hamburger menu, serta menangani konfirmasi penghapusan.

Penggunaan file JSON sebagai sumber data juga menunjukkan bagaimana data dapat dipisahkan dari struktur halaman dan dimuat secara asinkron. Dengan demikian, SIMPUS-Mini memiliki tampilan yang lebih terstruktur dan interaksi pengguna yang lebih lengkap dibandingkan halaman web statis.