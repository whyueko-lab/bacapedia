<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .book-page {
        --book-primary: #4f46e5;
        --book-ink: #172033;
        --book-muted: #64748b;
        padding: 12px 0 28px;
    }

    .book-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 25px;
    }

    .book-header-icon {
        display: grid;
        width: 50px;
        height: 50px;
        border-radius: 15px;
        place-items: center;
        flex: 0 0 50px;
        color: var(--book-primary);
        background: #eef2ff;
        font-size: 1.4rem;
    }

    .book-kicker { margin-bottom: 4px; color: #818cf8; font-size: .7rem; font-weight: 750; letter-spacing: .12em; text-transform: uppercase; }
    .book-title { margin: 0; color: var(--book-ink); font-size: clamp(1.55rem, 3vw, 2rem); font-weight: 750; letter-spacing: -.045em; }
    .book-subtitle { margin: 4px 0 0; color: var(--book-muted); font-size: .9rem; }
    .book-count { padding: 8px 12px; border: 1px solid #e0e7ff; border-radius: 10px; color: #4338ca; background: #eef2ff; font-size: .8rem; font-weight: 700; white-space: nowrap; }

    .book-alert { display: flex; align-items: center; gap: 10px; border: 0; border-radius: 14px; font-size: .9rem; }
    .add-book-btn { border: 0; border-radius: 12px; padding: 11px 16px; background: linear-gradient(135deg, #4f46e5, #6366f1); box-shadow: 0 9px 18px rgba(79,70,229,.2); font-weight: 650; }
    .add-book-btn:hover { background: linear-gradient(135deg, #4338ca, #4f46e5); transform: translateY(-1px); }

    .book-table-card { overflow: hidden; border: 1px solid #edf0f7; border-radius: 19px; background: #fff; box-shadow: 0 9px 24px rgba(15,23,42,.045); }
    .book-table-top { padding: 19px 23px; border-bottom: 1px solid #edf0f7; }
    .book-table-title { margin: 0; color: var(--book-ink); font-size: 1rem; font-weight: 750; letter-spacing: -.02em; }
    .book-table-caption { margin: 3px 0 0; color: var(--book-muted); font-size: .84rem; }
    .book-table { margin: 0; }
    .book-table thead th { padding: 14px 16px; border: 0; color: #64748b; background: #f8fafc; font-size: .7rem; font-weight: 750; letter-spacing: .075em; text-transform: uppercase; white-space: nowrap; }
    .book-table tbody td { padding: 15px 16px; border-color: #f0f2f6; color: #475569; font-size: .9rem; vertical-align: middle; }
    .book-table tbody tr { transition: background .16s ease; }
    .book-table tbody tr:hover { background: #fafbff; }
    .book-no { color: #94a3b8; font-size: .8rem; font-weight: 700; }
    .book-name { display: flex; align-items: center; gap: 11px; min-width: 170px; color: #334155; font-weight: 700; }
    .book-name-icon { display: grid; width: 34px; height: 34px; border-radius: 10px; place-items: center; flex: 0 0 34px; color: #4f46e5; background: #eef2ff; }
    .category-badge { display: inline-block; padding: 6px 10px; border-radius: 8px; color: #475569; background: #f1f5f9; font-size: .76rem; font-weight: 650; }
    .stock-badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px; border-radius: 8px; font-size: .76rem; font-weight: 700; }
    .stock-available { color: #047857; background: #d1fae5; }
    .stock-empty { color: #b45309; background: #fef3c7; }
    .action-btn { border-radius: 9px; padding: 7px 10px; font-size: .78rem; font-weight: 650; }
    .empty-state { padding: 58px 20px !important; color: var(--book-muted) !important; text-align: center; }
    .empty-state i { display: block; margin-bottom: 10px; color: #c7d2fe; font-size: 2rem; }

    @media (max-width: 575.98px) {
        .book-header { align-items: flex-start; }
        .book-count { display: none; }
        .book-table-top { padding: 18px; }
    }
</style>

<div class="book-page">
    <header class="book-header">
        <div class="d-flex align-items-center gap-3">
            <div class="book-header-icon"><i class="bi bi-bookshelf"></i></div>
            <div>
                <div class="book-kicker">Katalog Perpustakaan</div>
                <h1 class="book-title"><?= esc($title) ?></h1>
                <p class="book-subtitle">Temukan dan kelola koleksi buku Bacapedia.</p>
            </div>
        </div>
        <span class="book-count"><i class="bi bi-book me-1"></i> <?= count($buku) ?> Buku</span>
    </header>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success book-alert mb-4" role="alert">
            <i class="bi bi-check-circle-fill"></i><span><?= esc(session()->getFlashdata('success')) ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger book-alert mb-4" role="alert">
            <i class="bi bi-exclamation-circle-fill"></i><span><?= esc(session()->getFlashdata('error')) ?></span>
        </div>
    <?php endif; ?>

    <?php if (session()->get('role') === 'ADMIN'): ?>
        <div class="mb-4">
            <a href="<?= site_url('buku/tambah') ?>" class="btn btn-primary add-book-btn"><i class="bi bi-plus-lg me-2"></i>Tambah Buku</a>
        </div>
    <?php endif; ?>

    <section class="book-table-card">
        <div class="book-table-top d-flex align-items-center justify-content-between gap-3">
            <div><h2 class="book-table-title">Daftar koleksi</h2><p class="book-table-caption">Ketersediaan buku diperbarui berdasarkan stok saat ini.</p></div>
            <i class="bi bi-three-dots text-muted"></i>
        </div>
        <div class="table-responsive">
            <table class="table book-table align-middle">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Judul Buku</th>
                        <th scope="col">Penulis</th>
                        <th scope="col">Kategori</th>
                        <th scope="col">Ketersediaan</th>
                        <th scope="col">Terbit</th>
                        <th scope="col" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($buku)): ?>
                        <tr><td colspan="7" class="empty-state"><i class="bi bi-journal-x"></i>Belum ada data buku yang tersedia.</td></tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($buku as $item): ?>
                            <?php $stokTersedia = (int) $item['stok'] > 0; ?>
                            <tr>
                                <td class="book-no"><?= $no++ ?></td>
                                <td><div class="book-name"><span class="book-name-icon"><i class="bi bi-book"></i></span><span><?= esc($item['judul']) ?></span></div></td>
                                <td><?= esc($item['penulis']) ?></td>
                                <td><span class="category-badge"><?= esc($item['nama_kategori']) ?></span></td>
                                <td>
                                    <span class="stock-badge <?= $stokTersedia ? 'stock-available' : 'stock-empty' ?>">
                                        <i class="bi <?= $stokTersedia ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill' ?>"></i>
                                        <?= esc($item['stok']) ?> <?= $stokTersedia ? 'tersedia' : 'habis' ?>
                                    </span>
                                </td>
                                <td><?= esc($item['tahun_terbit']) ?></td>
                                <td class="text-end text-nowrap">
                                    <?php if (session()->get('role') === 'ANGGOTA'): ?>
                                        <?php if ($stokTersedia): ?>
                                            <a href="<?= site_url('peminjaman/pinjam/' . $item['id']) ?>" class="btn btn-success action-btn"><i class="bi bi-box-arrow-up-right me-1"></i> Pinjam</a>
                                        <?php else: ?>
                                            <button class="btn btn-light text-muted action-btn" disabled><i class="bi bi-clock me-1"></i> Habis</button>
                                        <?php endif; ?>
                                    <?php elseif (session()->get('role') === 'ADMIN'): ?>
                                        <a href="<?= site_url('buku/edit/' . $item['id']) ?>" class="btn btn-outline-warning action-btn"><i class="bi bi-pencil-square"></i><span class="visually-hidden"> Edit</span></a>
                                        <a href="<?= site_url('buku/hapus/' . $item['id']) ?>" class="btn btn-outline-danger action-btn" onclick="return confirm('Yakin ingin menghapus buku ini?')"><i class="bi bi-trash3"></i><span class="visually-hidden"> Hapus</span></a>
                                    <?php else: ?>
                                        <button class="btn btn-light text-muted action-btn" disabled><i class="bi bi-person-workspace me-1"></i> Petugas</button>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
