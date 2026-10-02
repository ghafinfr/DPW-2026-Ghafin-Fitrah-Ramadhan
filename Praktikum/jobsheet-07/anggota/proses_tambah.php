<?php
session_start();

$nama = trim($_POST['nama'] ?? '');
$noAnggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$noHp = trim($_POST['no_hp'] ?? '');
$tanggalBergabung = trim($_POST['tanggal_bergabung'] ?? '');

$errors = [];
if ($nama === '') {
    $errors[] = 'Nama Wajib Diisi.';
}
if ($noAnggota === '') {
    $errors[] = 'No. Anggota Wajib Diisi.';
}

if (!empty($errors)) {
    $_SESSION['flash'] = [
        'type' => 'error',
        'pesan' => implode('', $errors)
        ];
    header('Location: tambah.php');
    exit;
}

if(!isset($_SESSION['anggota'])) {
    $_SESSION['anggota'] = [];
}

$_SESSION['anggota'][] = [    
    'nama' => $nama,
    'no_anggota' => $noAnggota,
    'alamat' => $alamat,
    'no_hp' => $noHp,
    'tanggal_bergabung' => $tanggalBergabung
];

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan.'];
header('Location: list.php');
exit;