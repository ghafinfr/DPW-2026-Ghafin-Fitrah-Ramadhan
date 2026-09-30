# Laporan Praktikum Jobsheet 1

| Informasi      |                            |
| -------------- | -------------------------- |
| Nama           | Ghafin Fitrah Ramadhan     |
| Kelas          | TI-2F - 17                 |
| Program Studi  | D-IV - Teknik Informatika  |
| Mata Kuliah    | D&P WEB                    |

# Wireframe dan User Flow SIMPUS-Mini
rancangan wireframe teks dan user flow untuk fitur SIMPUS-Mini yang belum dibangun.

## 1. Login Petugas

### Wireframe

```text
┌──────────────────────────────────────┐
│            SIMPUS-Mini               │
│                                      │
│           LOGIN PETUGAS              │
│                                      │
│  Username                            │
│  ┌────────────────────────────────┐  │
│  │                                │  │
│  └────────────────────────────────┘  │
│                                      │
│  Password                            │
│  ┌────────────────────────────────┐  │
│  │                                │  │
│  └────────────────────────────────┘  │
│                                      │
│          ┌──────────────┐            │
│          │    LOGIN     │            │
│          └──────────────┘            │
│                                      │
│           Lupa Password?             │
└──────────────────────────────────────┘
```
### userflow

```text
START
  ▼
Halaman Login
  ▼
Masukkan Username & Password
  ▼
Klik Login
  ▼
Validasi Data
  │
  ├── Salah ──► Tampilkan Pesan Error
  │                  │
  │                  └──► Kembali ke Login
  │
  └── Benar ──► Dashboard Petugas
```
## 2. Dashboard Petugas

### Wireframe

```text
┌──────────────────────────────────────────────────────┐
│ SIMPUS-Mini                         Petugas ▼        │
├──────────────────────────────────────────────────────┤
│                                                      │
│  Dashboard                                           │
│                                                      │
│ ┌──────────────┐ ┌──────────────┐ ┌──────────────┐   │
│ │ Total Buku   │ │   Anggota    │ │ Dipinjam     │   │
│ │     16       │ │      8       │ │      3       │   │
│ └──────────────┘ └──────────────┘ └──────────────┘   │
│                                                      │
│ ┌──────────────────────────────────────────────────┐ │
│ │ Aktivitas Terbaru                                │ │
│ │                                                  │ │
│ │ • Peminjaman buku                                │ │
│ │ • Pengembalian buku                              │ │
│ │ • Anggota baru                                   │ │
│ └──────────────────────────────────────────────────┘ │
│                                                      │
│ ┌──────────────────────────────────────────────────┐ │
│ │ Peminjaman yang Harus Dikembalikan               │ │
│ │                                                  │ │
│ │ Nama | Buku | Tanggal Pinjam | Jatuh Tempo       │ │
│ └──────────────────────────────────────────────────┘ │
│                                                      │
└──────────────────────────────────────────────────────┘
```
### userflow

```text
Login Berhasil
      ▼
Dashboard Petugas
      ├────► Lihat Statistik
      │
      ├────► Lihat Aktivitas Terbaru
      │
      ├────► Peminjaman
      │
      ├────► Pengembalian
      │
      ├────► Riwayat
      │
      └────► Logout
```
## 3. Peminjaman

### Wireframe

```text
┌──────────────────────────────────────────────────────┐
│ SIMPUS-Mini                         Petugas ▼        │
├──────────────────────────────────────────────────────┤
│                                                      │
│                  PEMINJAMAN BUKU                     │
│                                                      │
│  Anggota                                             │
│  ┌────────────────────────────────────────────────┐  │
│  │ Pilih Anggota                              ▼   │  │
│  └────────────────────────────────────────────────┘  │
│                                                      │
│  Buku                                                │
│  ┌────────────────────────────────────────────────┐  │
│  │ Pilih Buku                                ▼    │  │
│  └────────────────────────────────────────────────┘  │
│                                                      │
│  Tanggal Pinjam                                      │
│  ┌────────────────────────────────────────────────┐  │
│  │ DD/MM/YYYY                                     │  │
│  └────────────────────────────────────────────────┘  │
│                                                      │
│  Jatuh Tempo                                         │
│  ┌────────────────────────────────────────────────┐  │
│  │ DD/MM/YYYY                                     │  │
│  └────────────────────────────────────────────────┘  │
│                                                      │
│              ┌──────────────────┐                    │
│              │  SIMPAN PINJAMAN │                    │
│              └──────────────────┘                    │
│                                                      │
└──────────────────────────────────────────────────────┘
```
### userflow

```text
Dashboard
    ▼
Pilih Peminjaman
    ▼
Pilih Anggota
    ▼
Pilih Buku
    ▼
Cek Ketersediaan Buku
    │
    ├── Tidak Tersedia
    │       ▼
    │   Tampilkan Pesan
    │
    └── Tersedia
            ▼
       Tentukan Tanggal
            ▼
       Simpan Peminjaman
            ▼
       Update Status Buku
            ▼
          Berhasil
```
## 4. Pengembalian

### Wireframe

```text
┌──────────────────────────────────────────────────────┐
│ SIMPUS-Mini                         Petugas ▼        │
├──────────────────────────────────────────────────────┤
│                                                      │
│                 PENGEMBALIAN BUKU                    │
│                                                      │
│  Cari Peminjaman                                     │
│  ┌────────────────────────────────────────────────┐  │
│  │ Cari nama anggota / judul buku                 │  │
│  └────────────────────────────────────────────────┘  │
│                                                      │
│  Data Peminjaman                                     │
│  ┌────────────────────────────────────────────────┐  │
│  │ Anggota        : Ahmad                         │  │
│  │ Buku           : Pemrograman Web               │  │
│  │ Tanggal Pinjam : 01/09/2026                    │  │
│  │ Jatuh Tempo    : 08/09/2026                    │  │
│  └────────────────────────────────────────────────┘  │
│                                                      │
│  Tanggal Kembali                                     │
│  ┌────────────────────────────────────────────────┐  │
│  │ DD/MM/YYYY                                     │  │
│  └────────────────────────────────────────────────┘  │
│                                                      │
│              ┌──────────────────┐                    │
│              │  KEMBALIKAN BUKU │                    │
│              └──────────────────┘                    │
│                                                      │
└──────────────────────────────────────────────────────┘
```
### userflow

```text
Dashboard
    ▼
Pilih Pengembalian
    ▼
Cari Data Peminjaman
    ▼
Pilih Peminjaman
    ▼
Periksa Data
    ▼
Masukkan Tanggal Kembali
    ▼
Klik Kembalikan Buku
    ▼
Update Status Peminjaman
    ▼
Update Status Buku → Tersedia
    ▼
Simpan ke Riwayat
    ▼
Pengembalian Berhasil
```
## 5. Riwayat

### Wireframe

```text
┌────────────────────────────────────────────────────────────┐
│ SIMPUS-Mini                              Petugas ▼         │
├────────────────────────────────────────────────────────────┤
│                                                            │
│                      RIWAYAT TRANSAKSI                     │
│                                                            │
│  Filter: [ Semua ▼ ]       Cari: [____________________]    │
│                                                            │
│ ┌────────────────────────────────────────────────────────┐ │
│ │ No │ Anggota │ Buku │ Pinjam │ Kembali │ Status        │ │
│ ├────┼─────────┼──────┼────────┼─────────┼───────────────┤ │
│ │ 1  │ Ahmad   │ ...  │ 01/09  │ 08/09   │ Dikembalikan  │ │
│ │ 2  │ Budi    │ ...  │ 02/09  │ -       │ Dipinjam      │ │
│ │ 3  │ Citra   │ ...  │ 03/09  │ 07/09   │ Dikembalikan  │ │
│ └────────────────────────────────────────────────────────┘ │
│                                                            │
└────────────────────────────────────────────────────────────┘
```
### userflow

```text
Dashboard
    ▼
Pilih Riwayat
    ▼
Tampilkan Semua Transaksi
    │
    ├────► Cari Transaksi
    │
    ├────► Filter Status
    │
    └────► Lihat Detail
              ▼
         Detail Transaksi
```
