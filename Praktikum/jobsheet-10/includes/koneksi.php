<?php
// Koneksi PostgreSQL untuk lokal dan DockHosting.
$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: '5432';
$db   = getenv('DB_NAME') ?: 'simpus_mini';
$user = getenv('DB_USER') ?: 'postgres';
$pass = getenv('DB_PASSWORD') ?: 'ghafin';

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$db",
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // Membuat tabel otomatis jika database masih kosong.
    $pdo->exec("CREATE TABLE IF NOT EXISTS buku (
        id SERIAL PRIMARY KEY,
        judul VARCHAR(255) NOT NULL,
        pengarang VARCHAR(255) NOT NULL,
        tahun INTEGER NOT NULL,
        isbn VARCHAR(50),
        stok INTEGER NOT NULL DEFAULT 0,
        kategori VARCHAR(50)
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS anggota (
        id SERIAL PRIMARY KEY,
        nama VARCHAR(255) NOT NULL,
        no_anggota VARCHAR(50) NOT NULL UNIQUE,
        alamat VARCHAR(255),
        no_hp VARCHAR(30)
    )");

    $pdo->exec("CREATE TABLE IF NOT EXISTS users (
        id SERIAL PRIMARY KEY,
        nama VARCHAR(255) NOT NULL,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        role VARCHAR(20) NOT NULL DEFAULT 'petugas'
    )");
} catch (PDOException $e) {
    die("Koneksi database gagal: " . $e->getMessage());
}
