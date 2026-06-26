<?php
class Database {
    // Properti statis untuk menyimpan instance (Singleton Pattern)
    private static $instance = null;
    private $pdo;

    // Enkapsulasi kredensial
    private $host = '127.0.0.1';
    private $db   = 'DB_UAS_PBO_TRPL1A_YaafiYumana';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';

    // Constructor di-set private agar tidak bisa di-instansiasi berulang kali dengan keyword 'new' di luar class
    private function __construct() {
        $dsn = "mysql:host=$this->host;dbname=$this->db;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
        
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            die("Koneksi Database Gagal: " . $e->getMessage());
        }
    }

    // Mencegah cloning objek
    private function __clone() {}

    // Method statis untuk mendapatkan instance database (Singleton)
    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    // Getter untuk objek PDO
    public function getConnection() {
        return $this->pdo;
    }
}
?>