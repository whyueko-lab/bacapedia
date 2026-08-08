<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="container-fluid mt-4">

```
<!-- Header -->
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="fw-bold mb-1">Dashboard Bacapedia</h2>
        <p class="text-muted mb-0">
            Selamat datang, <strong><?= session()->get('nama') ?? 'User'; ?></strong>
            (<?= session()->get('role'); ?>)
        </p>
    </div>
    <div class="text-end">
        <small class="text-muted">Tanggal</small><br>
        <strong><?= date('d M Y'); ?></strong>
    </div>
</div>

<!-- Statistik -->
<div class="row g-4">

    <!-- Total Kategori -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Kategori</p>
                    <h2 class="fw-bold text-primary mb-0">
                        <?= $jumlahKategori ?>
                    </h2>
                </div>
                <div class="bg-primary bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-tags-fill fs-2 text-primary"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Buku -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Total Buku</p>
                    <h2 class="fw-bold text-success mb-0">
                        <?= $jumlahBuku ?>
                    </h2>
                </div>
                <div class="bg-success bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-book-half fs-2 text-success"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sedang Dipinjam -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Sedang Dipinjam</p>
                    <h2 class="fw-bold text-warning mb-0">
                        <?= $sedangDipinjam ?>
                    </h2>
                </div>
                <div class="bg-warning bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-arrow-left-right fs-2 text-warning"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Sudah Dikembalikan -->
    <div class="col-md-3">
        <div class="card border-0 shadow-sm rounded-4 h-100">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <p class="text-muted mb-1">Sudah Dikembalikan</p>
                    <h2 class="fw-bold text-danger mb-0">
                        <?= $sudahKembali ?>
                    </h2>
                </div>
                <div class="bg-danger bg-opacity-10 rounded-circle p-3">
                    <i class="bi bi-check-circle-fill fs-2 text-danger"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Informasi Sistem -->
<div class="card border-0 shadow-sm rounded-4 mt-5">
    <div class="card-body">
        <h5 class="fw-bold mb-3">Informasi Sistem</h5>

        <div class="row">
            <div class="col-md-6">
                <p class="mb-2">
                    <strong>Aplikasi:</strong> Bacapedia - Sistem Manajemen Perpustakaan
                </p>
                <p class="mb-2">
                    <strong>Framework:</strong> CodeIgniter 4
                </p>
                <p class="mb-2">
                    <strong>Database:</strong> MySQL
                </p>
            </div>

            <div class="col-md-6">
                <p class="mb-2">
                    <strong>Role Login:</strong> <?= session()->get('role'); ?>
                </p>
                <p class="mb-2">
                    <strong>Status:</strong>
                    <span class="badge bg-success">Online</span>
                </p>
                <p class="mb-2">
                    <strong>Tanggal:</strong> <?= date('d M Y H:i'); ?>
                </p>
            </div>
        </div>

    </div>
</div>
```

</div>

<?= $this->endSection() ?>
