<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .category-form-page { --form-primary:#4f46e5; --form-ink:#172033; --form-muted:#64748b; max-width:760px; padding:12px 0 28px; }
    .category-form-back { display:inline-flex; align-items:center; gap:8px; margin-bottom:22px; color:#64748b; font-size:.87rem; font-weight:650; text-decoration:none; }.category-form-back:hover { color:var(--form-primary); }
    .category-form-card { overflow:hidden; border:1px solid #edf0f7; border-radius:20px; background:#fff; box-shadow:0 12px 30px rgba(15,23,42,.06); }
    .category-form-heading { padding:29px 32px; color:#fff; background:linear-gradient(135deg,#312e81,#4f46e5); }.category-form-icon { display:grid; width:45px; height:45px; margin-bottom:17px; border:1px solid rgba(255,255,255,.2); border-radius:13px; place-items:center; background:rgba(255,255,255,.13); font-size:1.2rem; }.category-form-title { margin:0; font-size:1.5rem; font-weight:750; letter-spacing:-.04em; }.category-form-subtitle { margin:7px 0 0; color:rgba(255,255,255,.75); font-size:.9rem; }
    .category-form-body { padding:31px 32px; }.category-form-label { margin-bottom:8px; color:#334155; font-size:.88rem; font-weight:700; }.category-form-control { min-height:52px; border:1px solid #e2e8f0; border-radius:12px; padding:.75rem .9rem; background:#f8fafc; box-shadow:none!important; }.category-form-control:focus { border-color:#818cf8; background:#fff; box-shadow:0 0 0 4px rgba(99,102,241,.12)!important; }.category-form-help { margin-top:8px; color:#94a3b8; font-size:.8rem; }.category-form-divider { margin:28px 0 22px; border-color:#f0f2f6; }.category-submit { min-height:48px; border:0; border-radius:11px; padding:0 17px; background:linear-gradient(135deg,#4f46e5,#6366f1); box-shadow:0 8px 17px rgba(79,70,229,.2); font-weight:650; }.category-submit:hover { background:linear-gradient(135deg,#4338ca,#4f46e5); transform:translateY(-1px); }.category-cancel { min-height:48px; border:1px solid #e2e8f0; border-radius:11px; padding:0 17px; color:#64748b; background:#fff; font-weight:650; }.category-cancel:hover { color:#334155; background:#f8fafc; }
    @media(max-width:575.98px) { .category-form-heading,.category-form-body { padding:25px 22px; } }
</style>

<div class="category-form-page">
    <a href="<?= site_url('kategori') ?>" class="category-form-back"><i class="bi bi-arrow-left"></i> Kembali ke daftar kategori</a>
    <section class="category-form-card">
        <header class="category-form-heading"><div class="category-form-icon"><i class="bi bi-tag-fill"></i></div><h1 class="category-form-title"><?= esc($title) ?></h1><p class="category-form-subtitle">Tambahkan nama kategori agar koleksi buku lebih mudah dikelompokkan.</p></header>
        <form action="<?= esc($action) ?>" method="post" class="category-form-body">
            <?= csrf_field() ?>
            <div>
                <label for="nama_kategori" class="form-label category-form-label">Nama kategori</label>
                <input type="text" id="nama_kategori" name="nama_kategori" class="form-control category-form-control" value="<?= esc(old('nama_kategori', $kategoriData['nama_kategori'] ?? '')) ?>" placeholder="Contoh: Novel, Sains, Sejarah" autocomplete="off" required autofocus>
                <div class="category-form-help">Gunakan nama yang singkat dan mudah dikenali.</div>
            </div>
            <hr class="category-form-divider">
            <div class="d-flex flex-column-reverse flex-sm-row gap-2 justify-content-end"><a href="<?= site_url('kategori') ?>" class="btn category-cancel">Batal</a><button type="submit" class="btn btn-primary category-submit"><i class="bi bi-check2-circle me-2"></i>Simpan Kategori</button></div>
        </form>
    </section>
</div>

<?= $this->endSection() ?>
