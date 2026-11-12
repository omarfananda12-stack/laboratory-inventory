<?php
$host = 'localhost';
$db   = 'laboratory_inventory';
$user = 'root';
$pass = ''; // Default XAMPP biasanya kosong. Sesuaikan jika MySQL Anda memakai password.
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    exit('Koneksi database gagal. Periksa config/database.php dan pastikan MySQL aktif. Detail: ' . htmlspecialchars($e->getMessage()));
}
