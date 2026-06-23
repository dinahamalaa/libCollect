<?php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>libCollect</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/style.css?v=20260614" rel="stylesheet">
</head>
<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-book-half me-2"></i>libCollect
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php">
                        <i class="bi bi-house me-1"></i>Beranda
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?action=create">
                        <i class="bi bi-plus-circle me-1"></i>Tambah Buku
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- MAIN -->
<div class="container my-4">

    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">
                <i class="bi bi-journal-bookmarks me-2"></i>Daftar Buku
            </h2>
            <p class="text-muted mb-0">Kelola koleksi buku perpustakaan Anda</p>
        </div>
        <a href="index.php?action=create" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i>Tambah Buku
        </a>
    </div>

    <!-- Flash Message -->
    <?php if ($message): ?>
    <div class="alert alert-<?= $message['type'] ?> alert-dismissible fade show shadow-sm" role="alert">
        <i class="bi bi-<?= $message['type'] === 'success' ? 'check-circle' : 'exclamation-triangle' ?> me-2"></i>
        <?= $message['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <div class="row mb-4">
        <div class="col-md-4 col-sm-6 mb-3">
            <div class="card stat-card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-center">
                    <div class="stat-icon bg-primary bg-opacity-10 rounded-3 p-3 me-3">
                        <i class="bi bi-book fs-2 text-primary"></i>
                    </div>
                    <div>
                        <div class="h3 fw-bold mb-0 text-primary" style="line-height: 1;"><?= $totalBooks ?></div>
                        <small class="text-muted">Koleksi Tersimpan</small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8 col-sm-6 mb-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body d-flex align-items-start">
                    <i class="text-info fs-4 me-3" aria-hidden="true"></i>
                    <div>
                        Tambahkan buku dengan klik tombol <strong>Tambah Buku</strong> di atas.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabel Buku -->
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-table me-2 text-primary"></i>Data Koleksi Buku
                </h5>
                <span class="badge bg-primary rounded-pill"><?= $totalBooks ?> buku</span>
            </div>
        </div>
        <div class="card-body p-0">
            <?php if (empty($books)): ?>
            <!-- Empty State -->
            <div class="text-center py-5">
                <i class="bi bi-inbox text-muted" style="font-size: 4rem;"></i>
                <h5 class="text-muted mt-3">Belum Ada Data Buku</h5>
                <p class="text-muted">Mulai tambahkan buku ke koleksi perpustakaan Anda.</p>
                <a href="index.php?action=create" class="btn btn-primary mt-2">
                    <i class="bi bi-plus-lg me-1"></i>Tambah Buku Pertama
                </a>
            </div>
            <?php else: ?>
            <!-- Tabel Responsif -->
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="ps-4" width="5%">No</th>
                            <th width="25%">Judul Buku</th>
                            <th width="20%">Penulis</th>
                            <th width="20%">Penerbit</th>
                            <th class="text-center" width="8%">Tahun</th>
                            <th class="text-center" width="15%">Ditambahkan</th>
                            <th class="text-center" width="12%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $index => $book): ?>
                        <tr class="book-row">
                            <td class="ps-4 text-muted fw-semibold"><?= $index + 1 ?></td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="book-icon me-3">
                                        <i class="bi bi-book text-primary fs-4"></i>
                                    </div>
                                    <div>
                                        <p class="mb-0 fw-semibold">
                                            <?= htmlspecialchars($book['judul']) ?>
                                        </p>
                                        <small class="text-muted">ID: <?= $book['id'] ?></small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <i class="bi bi-person text-muted me-1"></i>
                                <?= htmlspecialchars($book['penulis']) ?>
                            </td>
                            <td>
                                <i class="bi bi-building text-muted me-1"></i>
                                <?= htmlspecialchars($book['penerbit']) ?>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark rounded-pill">
                                    <?= htmlspecialchars($book['tahun']) ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <small class="text-muted">
                                    <?= date('d M Y', strtotime($book['created_at'])) ?>
                                </small>
                            </td>
                            <td class="text-center">
                                <div class="action-buttons">
                                    <!-- Tombol Edit -->
                                    <a href="index.php?action=edit&id=<?= $book['id'] ?>" 
                                       class="btn btn-warning btn-action" 
                                       title="Edit Buku">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <!-- Tombol Hapus -->
                                    <a href="index.php?action=delete&id=<?= $book['id'] ?>" 
                                       class="btn btn-danger btn-action" 
                                       title="Hapus Buku">
                                        <i class="bi bi-trash3"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>