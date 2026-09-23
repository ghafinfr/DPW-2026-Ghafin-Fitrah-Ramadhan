<?php
session_start();
require __DIR__ . '/../includes/koneksi.php';

$judul = trim($_POST['judul'] ?? '');
$pengarang = trim($_POST['pengarang'] ?? '');
$tahun_terbit = $_POST['tahun_terbit'] ?? '';
$isbn = trim($_POST['isbn'] ?? '');
$stok = $_POST['stok'] ?? '';
$kategori = trim($_POST['kategori'] ?? '');

$errors = [];
if ($judul === '') {
    $errors[] = "Judul wajib diisi.";
}
if ($pengarang === '') {
    $errors[] = "Pengarang wajib diisi.";
}
if (!is_numeric($tahun_terbit) || $tahun_terbit < 1900 || $tahun_terbit > 2026) {
    $errors[] = "Tahun Terbit harus di antara 1900-2026.";
}
if (!is_numeric($stok) || $stok < 0) {
    $errors[] = "Stok tidak boleh negatif.";
}

if (!empty($errors)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $errors)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori)
     VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
     RETURNING id"
);
$stmt->execute([
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun_terbit' => (int) $tahun_terbit,
    'isbn' => $isbn,
    'stok' => (int) $stok,
    'kategori' => $kategori,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Buku berhasil ditambahkan.'];
header('Location: list.php');
exit;