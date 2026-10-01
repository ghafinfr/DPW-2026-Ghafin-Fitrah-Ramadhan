<?php

$url = getenv('DATABASE_URL');

if (!$url) {
    die("DATABASE_URL belum diatur.");
}

$db = parse_url($url);

$host = $db['host'];
$port = $db['port'] ?? 5432;
$user = $db['user'];
$password = $db['pass'];
$dbname = ltrim($db['path'], '/');

try {
    $pdo = new PDO(
        "pgsql:host=$host;port=$port;dbname=$dbname",
        $user,
        $password,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );
} catch (PDOException $e) {
    error_log($e->getMessage());
    die("Koneksi database gagal.");
}