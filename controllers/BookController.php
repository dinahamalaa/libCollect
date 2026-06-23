<?php

require_once __DIR__ . '/../models/book.php';

class BookController {
    private Book $bookModel;

    public function __construct() {
        $this->bookModel = new Book();
    }

    // Tampilkan daftar semua buku
    public function index(): void {
        $books      = $this->bookModel->getAll();
        $totalBooks = $this->bookModel->countAll();
        $message    = $this->getFlashMessage();

        require_once __DIR__ . '/../views/index.php';
    }

    // Tampilkan form tambah buku
    public function create(): void {
        $errors = [];
        $old    = []; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Sanitasi input
            $old = $this->sanitizeInput($_POST);

            // Validasi
            $errors = $this->validate($old);

            if (empty($errors)) {
                $success = $this->bookModel->create($old);

                if ($success) {
                    $this->setFlashMessage('success', 
                        '✅ Buku <strong>' . htmlspecialchars($old['judul']) 
                        . '</strong> berhasil ditambahkan!');
                    $this->redirect('index.php');
                } else {
                    $errors['general'] = 'Gagal menyimpan data. Coba lagi.';
                }
            }
        }

        require_once __DIR__ . '/../views/create.php';
    }

    // Tampilkan form edit buku
    public function edit(int $id): void {
        $book = $this->bookModel->getById($id);

        if (!$book) {
            $this->setFlashMessage('danger', '❌ Buku tidak ditemukan.');
            $this->redirect('index.php');
            return;
        }

        $errors = [];
        $old    = $book; 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $old    = $this->sanitizeInput($_POST);
            $errors = $this->validate($old);

            if (empty($errors)) {
                $success = $this->bookModel->update($id, $old);

                if ($success) {
                    $this->setFlashMessage('success',
                        '✅ Buku <strong>' . htmlspecialchars($old['judul'])
                        . '</strong> berhasil diperbarui!');
                    $this->redirect('index.php');
                } else {
                    $errors['general'] = 'Gagal memperbarui data. Coba lagi.';
                }
            }
        }

        require_once __DIR__ . '/../views/edit.php';
    }

    // Konfirmasi & proses hapus buku
    public function delete(int $id): void {
        $book = $this->bookModel->getById($id);

        if (!$book) {
            $this->setFlashMessage('danger', '❌ Buku tidak ditemukan.');
            $this->redirect('index.php');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $success = $this->bookModel->delete($id);

            if ($success) {
                $this->setFlashMessage('success',
                    '🗑️ Buku <strong>' . htmlspecialchars($book['judul'])
                    . '</strong> berhasil dihapus!');
            } else {
                $this->setFlashMessage('danger', '❌ Gagal menghapus buku.');
            }

            $this->redirect('index.php');
        }

        require_once __DIR__ . '/../views/delete.php';
    }

    // VALIDASI FORM
    private function validate(array $data): array {
        $errors      = [];
        $currentYear = (int) date('Y');

        // Judul 
        if (empty($data['judul'])) {
            $errors['judul'] = 'Judul buku wajib diisi.';
        } elseif (mb_strlen($data['judul']) < 3) {
            $errors['judul'] = 'Judul minimal 3 karakter.';
        } elseif (mb_strlen($data['judul']) > 100) {
            $errors['judul'] = 'Judul maksimal 100 karakter.';
        }

        // Penulis 
        if (empty($data['penulis'])) {
            $errors['penulis'] = 'Nama penulis wajib diisi.';
        } elseif (mb_strlen($data['penulis']) < 3) {
            $errors['penulis'] = 'Nama penulis minimal 3 karakter.';
        } elseif (mb_strlen($data['penulis']) > 100) {
            $errors['penulis'] = 'Nama penulis maksimal 100 karakter.';
        }

        // Penerbit
        if (empty($data['penerbit'])) {
            $errors['penerbit'] = 'Nama penerbit wajib diisi.';
        } elseif (mb_strlen($data['penerbit']) < 3) {
            $errors['penerbit'] = 'Nama penerbit minimal 3 karakter.';
        } elseif (mb_strlen($data['penerbit']) > 100) {
            $errors['penerbit'] = 'Nama penerbit maksimal 100 karakter.';
        }

        // Tahun 
        if (empty($data['tahun']) && $data['tahun'] !== '0') {
            $errors['tahun'] = 'Tahun terbit wajib diisi.';
        } elseif (!ctype_digit((string) $data['tahun'])) {
            $errors['tahun'] = 'Tahun harus berupa angka.';
        } elseif ((int) $data['tahun'] < 1900 || (int) $data['tahun'] > $currentYear) {
            $errors['tahun'] = "Tahun harus antara 1900 sampai {$currentYear}.";
        }

        return $errors;
    }

    // HELPER — Sanitasi input dari form
    private function sanitizeInput(array $post): array {
        return [
            'judul'   => trim(strip_tags($post['judul']   ?? '')),
            'penulis' => trim(strip_tags($post['penulis'] ?? '')),
            'penerbit'=> trim(strip_tags($post['penerbit']?? '')),
            'tahun'   => trim($post['tahun'] ?? ''),
        ];
    }

    // HELPER — Flash message via session
    private function setFlashMessage(string $type, string $message): void {
        if (session_status() === PHP_SESSION_NONE) session_start();
        $_SESSION['flash'] = ['type' => $type, 'message' => $message];
    }

    private function getFlashMessage(): ?array {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }
    
    // HELPER — Redirect
    private function redirect(string $url): void {
        header("Location: {$url}");
        exit();
    }
}