<?php

require_once __DIR__ . '/../config/database.php';

class Book {
    private mysqli $db;
    private string $table = 'books';

    public function __construct() {
        // Ambil koneksi dari Singleton Database
        $this->db = Database::getInstance()->getConnection();
    }

    // READ Ambil semua buku
    public function getAll(): array {
        $sql    = "SELECT * FROM {$this->table} ORDER BY created_at DESC";
        $result = $this->db->query($sql);

        $books = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $books[] = $row;
            }
        }
        return $books;
    }

    // READ Ambil satu buku berdasarkan ID
    public function getById(int $id): ?array {
        $sql  = "SELECT * FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) return null;

        $stmt->bind_param('i', $id); 
        $stmt->execute();

        $result = $stmt->get_result();
        $book   = $result->fetch_assoc();

        $stmt->close();
        return $book ?: null;
    }

    // CREATE Tambah buku baru
    public function create(array $data): bool {
        $sql = "INSERT INTO {$this->table} 
                    (judul, penulis, penerbit, tahun) 
                VALUES (?, ?, ?, ?)";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param(
            'sssi',
            $data['judul'],
            $data['penulis'],
            $data['penerbit'],
            $data['tahun']
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // UPDATE Perbarui data buku berdasarkan ID
    public function update(int $id, array $data): bool {
        $sql = "UPDATE {$this->table} 
                SET judul = ?, penulis = ?, penerbit = ?, tahun = ? 
                WHERE id = ?";

        $stmt = $this->db->prepare($sql);
        if (!$stmt) return false;

        $stmt->bind_param(
            'sssii',
            $data['judul'],
            $data['penulis'],
            $data['penerbit'],
            $data['tahun'],
            $id
        );

        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // DELETE Hapus buku berdasarkan ID
    public function delete(int $id): bool {
        $sql  = "DELETE FROM {$this->table} WHERE id = ?";
        $stmt = $this->db->prepare($sql);

        if (!$stmt) return false;

        $stmt->bind_param('i', $id);
        $result = $stmt->execute();
        $stmt->close();
        return $result;
    }

    // HELPER Hitung total buku
    public function countAll(): int {
        $result = $this->db->query("SELECT COUNT(*) as total FROM {$this->table}");
        if ($result) {
            $row = $result->fetch_assoc();
            return (int) $row['total'];
        }
        return 0;
    }
}