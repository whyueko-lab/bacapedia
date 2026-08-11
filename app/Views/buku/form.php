<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php $dataBuku = $bukuData ?? $buku ?? []; ?>

<style>
    .book-form-page { --form-primary:#4f46e5; --form-ink:#172033; --form-muted:#64748b; max-width:900px; padding:12px 0 28px; }
    .book-form-back { display:inline-flex; align-items:center; gap:8px; margin-bottom:22px; color:#64748b; font-size:.87rem; font-weight:650; text-decoration:none; }.book-form-back:hover { color:var(--form-primary); }
    .book-form-card { overflow:hidden; border:1px solid #edf0f7; border-radius:20px; background:#fff; box-shadow:0 12px 30px rgba(15,23,42,.06); }
    .book-form-heading { padding:29px 32px; color:#fff; background:linear-gradient(135deg,#312e81,#4f46e5); }.book-form-icon { display:grid; width:45px; height:45px; margin-bottom:17px; border:1px solid rgba(255,255,255,.2); border-radius:13px; place-items:center; background:rgba(255,255,255,.13); font-size:1.2rem; }.book-form-title { margin:0; font-size:1.5rem; font-weight:750; letter-spacing:-.04em; }.book-form-subtitle { margin:7px 0 0; color:rgba(255,255,255,.75); font-size:.9rem; }
    .book-form-body { padding:31px 32px; }.book-form-label { margin-bottom:8px; color:#334155; font-size:.88rem; font-weight:700; }.book-form-control { min-height:52px; border:1px solid #e2e8f0; border-radius:12px; padding:.75rem .9rem; background:#f8fafc; box-shadow:none!important; }.book-form-control:focus { border-color:#818cf8; background:#fff; box-shadow:0 0 0 4px rgba(99,102,241,.12)!important; }.book-form-help { margin-top:8px; color:#94a3b8; font-size:.8rem; }.book-form-divider { margin:28px 0 22px; border-color:#f0f2f6; }.book-submit { min-height:48px; border:0; border-radius:11px; padding:0 17px; background:linear-gradient(135deg,#4f46e5,#6366f1); box-shadow:0 8px 17px rgba(79,70,229,.2); font-weight:650; }.book-submit:hover { background:linear-gradient(135deg,#4338ca,#4f46e5); transform:translateY(-1px); }.book-cancel { min-height:48px; border:1px solid #e2e8f0; border-radius:11px; padding:0 17px; color:#64748b; background:#fff; font-weight:650; }.book-cancel:hover { color:#334155; background:#f8fafc; }.book-form-section { margin-bottom:23px; color:#4f46e5; font-size:.76rem; font-weight:750; letter-spacing:.09em; text-transform:uppercase; }
    @media(max-width:575.98px) { .book-form-heading,.book-form-body { padding:25px 22px; } }
</style>

<div class="book-form-page">
    <a href="<?= site_url('buku') ?>" class="book-form-back"><i class="bi bi-arrow-left"></i> Kembali ke daftar buku</a>
    <section class="book-form-card">
        <header class="book-form-heading"><div class="book-form-icon"><i class="bi bi-book-half"></i></div><h1 class="book-form-title"><?= esc($title) ?></h1><p class="book-form-subtitle">Lengkapi informasi buku untuk memperbarui katalog Bacapedia.</p></header>
        <form action="<?= esc($action) ?>" method="post" class="book-form-body">
            <?= csrf_field() ?>
            <div class="book-form-section"><i class="bi bi-journal-text me-1"></i> Informasi buku</div>
            <div class="row g-3">
                <div class="col-12"><label for="judul" class="form-label book-form-label">Judul buku</label><input type="text" id="judul" name="judul" class="form-control book-form-control" value="<?= esc(old('judul', $dataBuku['judul'] ?? '')) ?>" placeholder="Masukkan judul buku" required autofocus></div>
                <div class="col-md-6"><label for="penulis" class="form-label book-form-label">Penulis</label><input type="text" id="penulis" name="penulis" class="form-control book-form-control" value="<?= esc(old('penulis', $dataBuku['penulis'] ?? '')) ?>" placeholder="Nama penulis" required></div>
                <div class="col-md-6"><label for="penerbit" class="form-label book-form-label">Penerbit</label><input type="text" id="penerbit" name="penerbit" class="form-control book-form-control" value="<?= esc(old('penerbit', $dataBuku['penerbit'] ?? '')) ?>" placeholder="Nama penerbit" required></div>
            </div>
            <hr class="book-form-divider">
            <div class="book-form-section"><i class="bi bi-box-seam me-1"></i> Katalog & ketersediaan</div>
            <div class="row g-3">
                <div class="col-md-6"><label for="kategori_id" class="form-label book-form-label">Kategori</label><select id="kategori_id" name="kategori_id" class="form-select book-form-control" required><option value="">Pilih kategori</option><?php $kategoriTerpilih = old('kategori_id', $dataBuku['kategori_id'] ?? ''); ?><?php foreach ($kategori as $k): ?><option value="<?= esc($k['id']) ?>" <?= (string) $kategoriTerpilih === (string) $k['id'] ? 'selected' : '' ?>><?= esc($k['nama_kategori']) ?></option><?php endforeach; ?></select><div class="book-form-help">Pilih kategori yang paling sesuai dengan buku.</div></div>
                <div class="col-6 col-md-3"><label for="stok" class="form-label book-form-label">Stok</label><input type="number" id="stok" name="stok" class="form-control book-form-control" value="<?= esc(old('stok', $dataBuku['stok'] ?? 1)) ?>" min="0" step="1" required></div>
                <div class="col-6 col-md-3"><label for="tahun_terbit" class="form-label book-form-label">Tahun terbit</label><input type="number" id="tahun_terbit" name="tahun_terbit" class="form-control book-form-control" value="<?= esc(old('tahun_terbit', $dataBuku['tahun_terbit'] ?? date('Y'))) ?>" min="1000" max="<?= date('Y') ?>" step="1" required></div>
            </div>
            <hr class="book-form-divider">
            <div class="d-flex flex-column-reverse flex-sm-row gap-2 justify-content-end"><a href="<?= site_url('buku') ?>" class="btn book-cancel">Batal</a><button type="submit" class="btn btn-primary book-submit"><i class="bi bi-check2-circle me-2"></i>Simpan Buku</button></div>
        </form>
    </section>
</div>

<?= $this->endSection() ?>
