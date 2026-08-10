<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .bac-dashboard {
        --dash-primary: #4f46e5;
        --dash-ink: #172033;
        --dash-muted: #64748b;
        padding: 12px 0 28px;
    }

    .dash-hero {
        position: relative;
        overflow: hidden;
        padding: 34px 38px;
        border-radius: 24px;
        color: #fff;
        background: linear-gradient(125deg, #312e81 0%, #4338ca 52%, #6366f1 100%);
        box-shadow: 0 18px 36px rgba(67, 56, 202, .22);
    }

    .dash-hero::before,
    .dash-hero::after {
        position: absolute;
        border: 1px solid rgba(255, 255, 255, .16);
        border-radius: 50%;
        content: "";
    }

    .dash-hero::before { width: 290px; height: 290px; top: -175px; right: -42px; }
    .dash-hero::after { width: 170px; height: 170px; right: 17%; bottom: -128px; background: rgba(255,255,255,.07); }
    .dash-hero-content { position: relative; z-index: 1; }
    .dash-eyebrow { margin-bottom: 10px; color: #c7d2fe; font-size: .72rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
    .dash-title { margin: 0; font-size: clamp(1.75rem, 3.5vw, 2.35rem); font-weight: 750; letter-spacing: -.045em; }
    .dash-subtitle { margin: 9px 0 0; color: rgba(255,255,255,.78); }

    .dash-date {
        display: inline-flex;
        align-items: center;
        gap: 11px;
        padding: 12px 15px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 14px;
        background: rgba(21, 20, 97, .25);
        color: #fff;
        text-align: left;
    }

    .dash-date i { color: #c7d2fe; font-size: 1.25rem; }
    .dash-date small { display: block; color: rgba(255,255,255,.64); font-size: .72rem; }
    .dash-date strong { display: block; font-size: .87rem; }
    .dash-section-title { color: var(--dash-ink); font-size: 1.02rem; font-weight: 750; letter-spacing: -.02em; }

    .stat-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        border: 1px solid #edf0f7;
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 9px 24px rgba(15, 23, 42, .045);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover { box-shadow: 0 15px 30px rgba(15, 23, 42, .09); transform: translateY(-4px); }
    .stat-card::after { position: absolute; width: 88px; height: 88px; right: -32px; bottom: -36px; border-radius: 50%; background: var(--stat-soft); content: ""; }
    .stat-card .card-body { position: relative; z-index: 1; padding: 23px; }
    .stat-label { margin: 0 0 8px; color: var(--dash-muted); font-size: .85rem; font-weight: 600; }
    .stat-number { margin: 0; color: var(--dash-ink); font-size: 1.9rem; font-weight: 750; letter-spacing: -.05em; }
    .stat-icon { display: grid; width: 48px; height: 48px; border-radius: 14px; place-items: center; color: var(--stat-color); background: var(--stat-soft); font-size: 1.32rem; }
    .stat-categories { --stat-color: #4f46e5; --stat-soft: #eef2ff; }
    .stat-books { --stat-color: #059669; --stat-soft: #ecfdf5; }
    .stat-borrowed { --stat-color: #d97706; --stat-soft: #fffbeb; }
    .stat-returned { --stat-color: #e11d48; --stat-soft: #fff1f2; }

    .system-card {
        border: 1px solid #edf0f7;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 9px 24px rgba(15, 23, 42, .045);
    }

    .system-card .card-body { padding: 28px; }
    .system-heading-icon { display: grid; width: 42px; height: 42px; border-radius: 13px; place-items: center; color: var(--dash-primary); background: #eef2ff; font-size: 1.15rem; }
    .system-item { display: flex; align-items: center; gap: 13px; padding: 12px 0; border-bottom: 1px solid #f0f2f6; }
    .system-item:last-child { border-bottom: 0; }
    .system-item-icon { display: grid; width: 35px; height: 35px; flex: 0 0 35px; border-radius: 10px; place-items: center; color: #64748b; background: #f8fafc; }
    .system-label { display: block; margin-bottom: 2px; color: #94a3b8; font-size: .72rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; }
    .system-value { color: #334155; font-size: .9rem; font-weight: 600; }
    .online-badge { padding: 6px 10px; border-radius: 8px; color: #047857; background: #d1fae5; font-size: .74rem; font-weight: 700; }

    @media (max-width: 575.98px) {
        .dash-hero { padding: 27px 24px; border-radius: 20px; }
        .dash-date { margin-top: 22px; }
        .system-card .card-body { padding: 22px; }
    }
</style>

<div class="bac-dashboard">
    <section class="dash-hero mb-4">
        <div class="dash-hero-content d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
            <div>
                <div class="dash-eyebrow">Dashboard utama</div>
                <h1 class="dash-title">Halo, <?= esc(session()->get('nama') ?? 'User') ?>!</h1>
                <p class="dash-subtitle">Pantau ringkasan aktivitas perpustakaan Anda hari ini.</p>
            </div>
            <div class="dash-date">
                <i class="bi bi-calendar3"></i>
                <span><small>Hari ini</small><strong><?= date('d M Y') ?></strong></span>
            </div>
        </div>
    </section>

    <div class="d-flex align-items-center justify-content-between mb-3">
        <h2 class="dash-section-title mb-0">Ringkasan koleksi</h2>
        <span class="text-muted small"><i class="bi bi-activity me-1"></i> Data terkini</span>
    </div>

    <div class="row g-3 g-lg-4">
        <div class="col-sm-6 col-xl-3">
            <article class="card stat-card stat-categories">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div><p class="stat-label">Total Kategori</p><p class="stat-number"><?= esc($jumlahKategori) ?></p></div>
                    <div class="stat-icon"><i class="bi bi-tags-fill"></i></div>
                </div>
            </article>
        </div>
        <div class="col-sm-6 col-xl-3">
            <article class="card stat-card stat-books">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div><p class="stat-label">Total Buku</p><p class="stat-number"><?= esc($jumlahBuku) ?></p></div>
                    <div class="stat-icon"><i class="bi bi-book-half"></i></div>
                </div>
            </article>
        </div>
        <div class="col-sm-6 col-xl-3">
            <article class="card stat-card stat-borrowed">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div><p class="stat-label">Sedang Dipinjam</p><p class="stat-number"><?= esc($sedangDipinjam) ?></p></div>
                    <div class="stat-icon"><i class="bi bi-arrow-left-right"></i></div>
                </div>
            </article>
        </div>
        <div class="col-sm-6 col-xl-3">
            <article class="card stat-card stat-returned">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div><p class="stat-label">Sudah Dikembalikan</p><p class="stat-number"><?= esc($sudahKembali) ?></p></div>
                    <div class="stat-icon"><i class="bi bi-check2-circle"></i></div>
                </div>
            </article>
        </div>
    </div>

    <section class="card system-card mt-4 mt-lg-5">
        <div class="card-body">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="system-heading-icon"><i class="bi bi-grid-1x2-fill"></i></div>
                <div><h2 class="dash-section-title mb-1">Informasi sistem</h2><p class="text-muted small mb-0">Detail aplikasi dan sesi Anda saat ini.</p></div>
            </div>
            <div class="row gx-lg-5">
                <div class="col-md-6">
                    <div class="system-item"><div class="system-item-icon"><i class="bi bi-bookmark-star"></i></div><div><span class="system-label">Aplikasi</span><span class="system-value">Bacapedia — Manajemen Perpustakaan</span></div></div>
                    <div class="system-item"><div class="system-item-icon"><i class="bi bi-code-square"></i></div><div><span class="system-label">Framework</span><span class="system-value">CodeIgniter 4</span></div></div>
                    <div class="system-item"><div class="system-item-icon"><i class="bi bi-database"></i></div><div><span class="system-label">Database</span><span class="system-value">MySQL</span></div></div>
                </div>
                <div class="col-md-6">
                    <div class="system-item"><div class="system-item-icon"><i class="bi bi-person-badge"></i></div><div><span class="system-label">Role login</span><span class="system-value"><?= esc(session()->get('role') ?? '-') ?></span></div></div>
                    <div class="system-item"><div class="system-item-icon"><i class="bi bi-wifi"></i></div><div><span class="system-label">Status layanan</span><span class="online-badge"><i class="bi bi-circle-fill me-1" style="font-size:.45rem"></i> Online</span></div></div>
                    <div class="system-item"><div class="system-item-icon"><i class="bi bi-clock-history"></i></div><div><span class="system-label">Waktu akses</span><span class="system-value"><?= date('d M Y, H:i') ?> WIB</span></div></div>
                </div>
            </div>
        </div>
    </section>
</div>

<?= $this->endSection() ?>
