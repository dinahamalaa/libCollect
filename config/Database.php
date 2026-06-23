<?php

class Database {
    // Konfigurasi koneksi
    private string $host     = 'localhost';
    private string $username = 'root';
    private string $password = '';
    private string $dbname   = 'library_db';
    private string $charset  = 'utf8mb4';

    // Menyimpan instance tunggal (Singleton)
    private static ?Database $instance = null;

    // Objek koneksi mysqli
    private mysqli $connection;

    // Constructor private
    private function __construct() {
        $this->connection = new mysqli(
            $this->host,
            $this->username,
            $this->password,
            $this->dbname
        );

        // Cek koneksi
        if ($this->connection->connect_error) {
            die(json_encode([
                'status'  => 'error',
                'message' => 'Koneksi database gagal: ' 
                             . $this->connection->connect_error
            ]));
        }

        // Set charset agar mendukung karakter unik
        $this->connection->set_charset($this->charset);
    }

    public static function getInstance(): Database {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance;
    }

    public function getConnection(): mysqli {
        return $this->connection;
    }

    private function __clone() {}
}