<?php
$host = '127.0.0.1';
$db   = 'DB_UAS_PBO_TRPL1A_YaafiYumana';
$user = 'root'; // Sesuaikan username database Anda (default xampp: root)
$pass = '';     // Sesuaikan password database Anda (default xampp: kosong)
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Koneksi Database Gagal: " . $e->getMessage());
}
