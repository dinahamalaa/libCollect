<?php

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Buku — LibraryMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-danger shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-book-half me-2"></i>LibraryMS
        </a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link text-white" href="index.php">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
        </div>
    </div>
</nav>

<div class="container my-4">

    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php" class="text-decoration-none">
                    <i class="bi bi-house me-1"></i>Beranda
                </a>
            </li>
            <li class="breadcrumb-item active text-danger">Hapus Buku</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="card border-danger border-0 shadow-sm">
                <div class="card-header bg-danger text-white py-3">
                    <h5 class="mb-0">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        Konfirmasi Hapus Buku
                    </h5>
                </div>
                <div class="card-body p-4">

                    <!-- Peringatan -->
                    <div class="alert alert-danger border-0">
                        <i class="bi bi-exclamation-octagon me-2 fs-5"></i>
                        <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan. 
                        Data buku akan dihapus permanen dari database.
                    </div>

                    <!-- Detail Buku yang Akan Dihapus -->
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body">
                            <h6 class="fw-semibold text-danger mb-3">
                                <i class="bi bi-book me-2"></i>Detail Buku yang Akan Dihapus:
                            </h6>
                            <table class="table table-sm table-borderless mb-0">
                                <tr>
                                    <td class="fw-semibold text-muted" width="35%">ID</td>
                                    <td>: <span class="badge bg-secondary"><?= $book['id'] ?></span></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-muted">Judul</td>
                                    <td>: <strong><?= htmlspecialchars($book['judul']) ?></strong></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-muted">Penulis</td>
                                    <td>: <?= htmlspecialchars($book['penulis']) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-muted">Penerbit</td>
                                    <td>: <?= htmlspecialchars($book['penerbit']) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-muted">Tahun</td>
                                    <td>: <?= htmlspecialchars($book['tahun']) ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-muted">Ditambahkan</td>
                                    <td>: <?= date('d M Y H:i', strtotime($book['created_at'])) ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <!-- Form Konfirmasi Hapus -->
                    <form method="POST" 
                          action="index.php?action=delete&id=<?= $book['id'] ?>">
                        <p class="text-muted mb-3">
                            Apakah Anda yakin ingin menghapus buku 
                            <strong>"<?= htmlspecialchars($book['judul']) ?>"</strong>?
                        </p>
                        <div class="d-flex gap-2">
                            <!-- Tombol Hapus submit form -->
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash3 me-1"></i>Ya, Hapus Sekarang
                            </button>
                            <!-- Tombol Batal kembali tanpa hapus -->
                            <a href="index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-left me-1"></i>Batal, Kembali
                            </a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>