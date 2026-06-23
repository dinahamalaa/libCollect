<?php

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku — LibraryMS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-warning shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold text-dark" href="index.php">
            <i class="bi bi-book-half me-2"></i>LibraryMS
        </a>
        <div class="navbar-nav ms-auto">
            <a class="nav-link text-dark" href="index.php">
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
            <li class="breadcrumb-item active">Edit Buku</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-warning py-3">
                    <h5 class="mb-0 text-dark">
                        <i class="bi bi-pencil-square me-2"></i>Edit Buku
                        <small class="fw-normal ms-2 opacity-75">ID: <?= $book['id'] ?></small>
                    </h5>
                </div>
                <div class="card-body p-4">

                    <!-- Info buku yang sedang diedit -->
                    <div class="alert alert-warning border-0 mb-4">
                        <i class="bi bi-info-circle me-2"></i>
                        Sedang mengedit: <strong><?= htmlspecialchars($book['judul']) ?></strong>
                    </div>

                    <?php if (isset($errors['general'])): ?>
                    <div class="alert alert-danger">
                        <i class="bi bi-exclamation-triangle me-2"></i>
                        <?= htmlspecialchars($errors['general']) ?>
                    </div>
                    <?php endif; ?>

                    <form method="POST" 
                          action="index.php?action=edit&id=<?= $book['id'] ?>" 
                          novalidate>

                        <!-- Judul -->
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold">
                                <i class="bi bi-book me-1 text-warning"></i>Judul Buku 
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control <?= isset($errors['judul']) ? 'is-invalid' : 'is-valid' ?>" 
                                id="judul" 
                                name="judul" 
                                value="<?= htmlspecialchars($old['judul'] ?? '') ?>"
                                placeholder="Judul buku"
                                maxlength="100"
                            >
                            <?php if (isset($errors['judul'])): ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    <?= htmlspecialchars($errors['judul']) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Penulis -->
                        <div class="mb-3">
                            <label for="penulis" class="form-label fw-semibold">
                                <i class="bi bi-person me-1 text-warning"></i>Penulis 
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control <?= isset($errors['penulis']) ? 'is-invalid' : 'is-valid' ?>" 
                                id="penulis" 
                                name="penulis" 
                                value="<?= htmlspecialchars($old['penulis'] ?? '') ?>"
                                placeholder="Nama penulis"
                                maxlength="100"
                            >
                            <?php if (isset($errors['penulis'])): ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    <?= htmlspecialchars($errors['penulis']) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Penerbit -->
                        <div class="mb-3">
                            <label for="penerbit" class="form-label fw-semibold">
                                <i class="bi bi-building me-1 text-warning"></i>Penerbit 
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="text" 
                                class="form-control <?= isset($errors['penerbit']) ? 'is-invalid' : 'is-valid' ?>" 
                                id="penerbit" 
                                name="penerbit" 
                                value="<?= htmlspecialchars($old['penerbit'] ?? '') ?>"
                                placeholder="Nama penerbit"
                                maxlength="100"
                            >
                            <?php if (isset($errors['penerbit'])): ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    <?= htmlspecialchars($errors['penerbit']) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Tahun -->
                        <div class="mb-4">
                            <label for="tahun" class="form-label fw-semibold">
                                <i class="bi bi-calendar me-1 text-warning"></i>Tahun Terbit 
                                <span class="text-danger">*</span>
                            </label>
                            <input 
                                type="number" 
                                class="form-control <?= isset($errors['tahun']) ? 'is-invalid' : 'is-valid' ?>" 
                                id="tahun" 
                                name="tahun" 
                                value="<?= htmlspecialchars($old['tahun'] ?? '') ?>"
                                min="1900" 
                                max="<?= date('Y') ?>"
                            >
                            <?php if (isset($errors['tahun'])): ?>
                                <div class="invalid-feedback">
                                    <i class="bi bi-exclamation-circle me-1"></i>
                                    <?= htmlspecialchars($errors['tahun']) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Tombol -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save me-1"></i>Simpan Perubahan
                            </button>
                            <a href="index.php" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i>Batal
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