<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .bac-dashboard {
        --dash-primary: #6941c6;
        --dash-ink: #152238;
        --dash-muted: #64748b;
        position: relative;
        isolation: isolate;
        overflow: hidden;
        margin-top: 12px;
        padding: 26px 24px 32px;
        border-radius: 28px;
        background:
            radial-gradient(circle at 0% 0%, rgba(78, 58, 154, .42), transparent 32%),
            radial-gradient(circle at 100% 100%, rgba(0, 138, 123, .20), transparent 28%),
            linear-gradient(135deg, #0d162b 0%, #142342 48%, #16213b 100%);
        box-shadow: 0 18px 42px rgba(13, 22, 43, .17);
    }

    .bac-dashboard::before {
        position: absolute;
        z-index: -1;
        width: 290px;
        height: 290px;
        top: -155px;
        right: -85px;
        border: 1px solid rgba(255, 255, 255, .08);
        border-radius: 50%;
        box-shadow: 0 0 0 42px rgba(255, 255, 255, .025), 0 0 0 84px rgba(255, 255, 255, .018);
        content: "";
    }

    .dash-hero {
        position: relative;
        overflow: hidden;
        padding: 34px 38px;
        border-radius: 24px;
        color: #fff;
        background:
            radial-gradient(circle at 84% 20%, rgba(45, 212, 191, .34), transparent 25%),
            radial-gradient(circle at 25% 120%, rgba(251, 191, 36, .20), transparent 32%),
            linear-gradient(120deg, #101b33 0%, #1d2b5b 48%, #55328d 100%);
        box-shadow: 0 20px 42px rgba(20, 35, 71, .28);
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
    .dash-eyebrow { margin-bottom: 10px; color: #a7f3d0; font-size: .72rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase; }
    .dash-title { margin: 0; font-size: clamp(1.75rem, 3.5vw, 2.35rem); font-weight: 750; letter-spacing: -.045em; }
    .dash-subtitle { margin: 9px 0 0; color: rgba(255,255,255,.78); }

    .dash-date {
        display: inline-flex;
        align-items: center;
        gap: 11px;
        padding: 12px 15px;
        border: 1px solid rgba(255,255,255,.18);
        border-radius: 14px;
        background: rgba(7, 18, 47, .38);
        color: #fff;
        text-align: left;
    }

    .dash-date i { color: #5eead4; font-size: 1.25rem; }
    .dash-date small { display: block; color: rgba(255,255,255,.64); font-size: .72rem; }
    .dash-date strong { display: block; font-size: .87rem; }
    .dash-section-title { color: var(--dash-ink); font-size: 1.02rem; font-weight: 750; letter-spacing: -.02em; }
    .bac-dashboard > .d-flex > .text-muted { color: #b9c4d8 !important; }

    .stat-card {
        position: relative;
        height: 100%;
        overflow: hidden;
        border: 1px solid #e8edf5;
        border-radius: 19px;
        background: #fff;
        box-shadow: 0 10px 26px rgba(17, 35, 68, .055);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .stat-card:hover { box-shadow: 0 17px 34px rgba(17, 35, 68, .12); transform: translateY(-4px); }
    .stat-card::after { position: absolute; width: 88px; height: 88px; right: -32px; bottom: -36px; border-radius: 50%; background: var(--stat-soft); content: ""; }
    .stat-card .card-body { position: relative; z-index: 1; padding: 23px; }
    .stat-label { margin: 0 0 8px; color: var(--dash-muted); font-size: .85rem; font-weight: 600; }
    .stat-number { margin: 0; color: var(--dash-ink); font-size: 1.9rem; font-weight: 750; letter-spacing: -.05em; }
    .stat-icon { display: grid; width: 48px; height: 48px; border-radius: 14px; place-items: center; color: var(--stat-color); background: var(--stat-soft); font-size: 1.32rem; }
    .stat-categories { --stat-color: #6941c6; --stat-soft: #f1ebff; }
    .stat-books { --stat-color: #008a7b; --stat-soft: #def7f3; }
    .stat-borrowed { --stat-color: #b7791f; --stat-soft: #fff4d8; }
    .stat-returned { --stat-color: #d9485f; --stat-soft: #ffebef; }

    .system-card {
        border: 1px solid #e8edf5;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 26px rgba(17, 35, 68, .055);
    }

    .system-card .card-body { padding: 28px; }
    .system-heading-icon { display: grid; width: 42px; height: 42px; border-radius: 13px; place-items: center; color: #6941c6; background: #f1ebff; font-size: 1.15rem; }
    .system-item { display: flex; align-items: center; gap: 13px; padding: 12px 0; border-bottom: 1px solid #f0f2f6; }
    .system-item:last-child { border-bottom: 0; }
    .system-item-icon { display: grid; width: 35px; height: 35px; flex: 0 0 35px; border-radius: 10px; place-items: center; color: #50637f; background: #f3f7fb; }
    .system-label { display: block; margin-bottom: 2px; color: #94a3b8; font-size: .72rem; font-weight: 700; letter-spacing: .07em; text-transform: uppercase; }
    .system-value { color: #334155; font-size: .9rem; font-weight: 600; }
    .online-badge { padding: 6px 10px; border-radius: 8px; color: #047857; background: #d5f6eb; font-size: .74rem; font-weight: 700; }

    @media (max-width: 575.98px) {
        .bac-dashboard { margin-top: 8px; padding: 18px 14px 24px; border-radius: 22px; }
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
        <h2 class="dash-section-title mb-0"><?= esc($ringkasanTitle) ?></h2>
        <span class="text-muted small"><i class="bi bi-activity me-1"></i> <?= $isAnggota ? 'Akun Anda' : 'Data terkini' ?></span>
    </div>

    <div class="row g-3 g-lg-4">
        <?php foreach ($statistik as $stat): ?>
            <div class="col-sm-6 col-xl-3">
            <article class="card stat-card <?= esc($stat['class']) ?>">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div><p class="stat-label"><?= esc($stat['label']) ?></p><p class="stat-number"><?= esc($stat['value']) ?></p></div>
                    <div class="stat-icon"><i class="bi <?= esc($stat['icon']) ?>"></i></div>
                </div>
            </article>
            </div>
        <?php endforeach; ?>
    </div>

    <section class="card system-card mt-4 mt-lg-5">
        <div class="card-body">
            <div class="d-flex align-items-center gap-3 mb-3">
                <div class="system-heading-icon"><i class="bi bi-grid-1x2-fill"></i></div>
                <div><h2 class="dash-section-title mb-1">Informasi sistem</h2><p class="text-muted small mb-0">Detail aplikasi dan sesi Anda saat ini.</p></div>
            </div>
            <div class="row gx-lg-5">
                <div class="col-md-6">
                    <div class="system-item"><div class="system-item-icon"><i class="bi bi-bookmark-star"></i></div><div><span class="system-label">Aplikasi</span><span class="system-value">Bacapedia &mdash; Manajemen Perpustakaan</span></div></div>
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
