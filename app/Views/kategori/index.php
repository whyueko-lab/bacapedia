<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .category-page { --category-primary: #4f46e5; --category-ink: #172033; --category-muted: #64748b; padding: 12px 0 28px; }
    .category-header { display: flex; align-items: center; justify-content: space-between; gap: 20px; margin-bottom: 25px; }
    .category-header-icon { display: grid; width: 50px; height: 50px; border-radius: 15px; place-items: center; flex: 0 0 50px; color: var(--category-primary); background: #eef2ff; font-size: 1.4rem; }
    .category-kicker { margin-bottom: 4px; color: #818cf8; font-size: .7rem; font-weight: 750; letter-spacing: .12em; text-transform: uppercase; }
    .category-title { margin: 0; color: var(--category-ink); font-size: clamp(1.55rem, 3vw, 2rem); font-weight: 750; letter-spacing: -.045em; }
    .category-subtitle { margin: 4px 0 0; color: var(--category-muted); font-size: .9rem; }
    .add-category-btn { border: 0; border-radius: 12px; padding: 11px 16px; background: linear-gradient(135deg, #4f46e5, #6366f1); box-shadow: 0 9px 18px rgba(79,70,229,.2); font-weight: 650; white-space: nowrap; }
    .add-category-btn:hover { background: linear-gradient(135deg, #4338ca, #4f46e5); transform: translateY(-1px); }
    .category-table-card { overflow: hidden; border: 1px solid #edf0f7; border-radius: 19px; background: #fff; box-shadow: 0 9px 24px rgba(15,23,42,.045); }
    .category-table-top { padding: 19px 23px; border-bottom: 1px solid #edf0f7; }
    .category-table-title { margin: 0; color: var(--category-ink); font-size: 1rem; font-weight: 750; letter-spacing: -.02em; }
    .category-table-caption { margin: 3px 0 0; color: var(--category-muted); font-size: .84rem; }
    .category-count { padding: 7px 11px; border-radius: 9px; color: #4338ca; background: #eef2ff; font-size: .76rem; font-weight: 700; white-space: nowrap; }
    .category-table { margin: 0; }
    .category-table thead th { padding: 14px 17px; border: 0; color: #64748b; background: #f8fafc; font-size: .7rem; font-weight: 750; letter-spacing: .075em; text-transform: uppercase; }
    .category-table tbody td { padding: 15px 17px; border-color: #f0f2f6; color: #475569; font-size: .9rem; vertical-align: middle; }
    .category-table tbody tr { transition: background .16s ease; }
    .category-table tbody tr:hover { background: #fafbff; }
    .category-no { color: #94a3b8; font-size: .8rem; font-weight: 700; }
    .category-name { display: flex; align-items: center; gap: 12px; color: #334155; font-weight: 700; }
    .category-name-icon { display: grid; width: 35px; height: 35px; border-radius: 10px; place-items: center; color: #4f46e5; background: #eef2ff; }
    .action-btn { border-radius: 9px; padding: 7px 10px; font-size: .78rem; font-weight: 650; }
    .empty-state { padding: 55px 20px !important; color: var(--category-muted) !important; text-align: center; }
    .empty-state i { display: block; margin-bottom: 10px; color: #c7d2fe; font-size: 2rem; }
    @media (max-width: 575.98px) { .category-header { align-items: flex-start; } .category-header-icon { display: none; } .category-table-top { padding: 18px; } .add-category-btn { padding: 10px 12px; } .add-category-btn .btn-text { display: none; } }
</style>

<div class="category-page">
    <header class="category-header">
        <div class="d-flex align-items-center gap-3">
            <div class="category-header-icon"><i class="bi bi-tags-fill"></i></div>
            <div>
                <div class="category-kicker">Manajemen Koleksi</div>
                <h1 class="category-title">Data Kategori</h1>
                <p class="category-subtitle">Atur pengelompokan buku agar katalog selalu terstruktur.</p>
            </div>
        </div>
        <a href="<?= site_url('kategori/tambah') ?>" class="btn btn-primary add-category-btn"><i class="bi bi-plus-lg me-sm-2"></i><span class="btn-text">Tambah Kategori</span></a>
    </header>

    <section class="category-table-card">
        <div class="category-table-top d-flex align-items-center justify-content-between gap-3">
            <div><h2 class="category-table-title">Daftar kategori</h2><p class="category-table-caption">Kategori yang tersedia di perpustakaan Bacapedia.</p></div>
            <span class="category-count"><?= count($kategori) ?> Kategori</span>
        </div>
        <div class="table-responsive">
            <table class="table category-table align-middle">
                <thead><tr><th scope="col">No.</th><th scope="col">Nama Kategori</th><th scope="col" class="text-end">Aksi</th></tr></thead>
                <tbody>
                    <?php if (empty($kategori)): ?>
                        <tr><td colspan="3" class="empty-state"><i class="bi bi-tags"></i>Belum ada kategori yang tersedia.</td></tr>
                    <?php else: ?>
                        <?php $no = 1; ?>
                        <?php foreach ($kategori as $k): ?>
                            <tr>
                                <td class="category-no"><?= $no++ ?></td>
                                <td><div class="category-name"><span class="category-name-icon"><i class="bi bi-tag"></i></span><?= esc($k['nama_kategori']) ?></div></td>
                                <td class="text-end text-nowrap">
                                    <a href="<?= site_url('kategori/edit/' . $k['id']) ?>" class="btn btn-outline-warning action-btn" aria-label="Edit <?= esc($k['nama_kategori']) ?>"><i class="bi bi-pencil-square"></i><span class="visually-hidden"> Edit</span></a>
                                    <a href="<?= site_url('kategori/hapus/' . $k['id']) ?>" class="btn btn-outline-danger action-btn" aria-label="Hapus <?= esc($k['nama_kategori']) ?>" onclick="return confirm('Hapus kategori ini?')"><i class="bi bi-trash3"></i><span class="visually-hidden"> Hapus</span></a>
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
