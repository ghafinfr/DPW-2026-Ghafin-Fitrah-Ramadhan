<?php
// Koneksi PostgreSQL: Railway/Supabase menggunakan DATABASE_URL.
// Untuk lokal, DB_HOST/DB_PORT/DB_NAME/DB_USER/DB_PASSWORD tetap didukung.

$url = getenv('DATABASE_URL');

try {
    if ($url) {
        $db = parse_url($url);

        if ($db === false || empty($db['host']) || empty($db['user']) || !isset($db['pass'])) {
            throw new RuntimeException('DATABASE_URL tidak valid.');
        }

        $host = $db['host'];
        $port = $db['port'] ?? 5432;
        $dbname = ltrim($db['path'] ?? '/postgres', '/');
        $user = $db['user'];
        $password = rawurldecode($db['pass']);
    } else {
        $host = getenv('DB_HOST') ?: 'localhost';
        $port = getenv('DB_PORT') ?: '5432';
        $dbname = getenv('DB_NAME') ?: 'simpus_mini';
        $user = getenv('DB_USER') ?: 'postgres';
        $password = getenv('DB_PASSWORD') ?: 'ghafin';
    }

    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

    // Membuat tabel jika database masih kosong.
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
} catch (Throwable $e) {
    error_log($e->getMessage());
    die("Koneksi database gagal.");
}
