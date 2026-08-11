<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Bacapedia') ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body { min-height:100vh; color:#172033; background:#f6f8fc; font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif; }
        .app-navbar { border-bottom:1px solid rgba(255,255,255,.1); background:linear-gradient(105deg,#101b33,#202a57 58%,#4c2c81); box-shadow:0 8px 20px rgba(16,27,51,.13); }
        .app-brand { display:flex; align-items:center; gap:10px; font-weight:750; letter-spacing:-.02em; }.app-brand-icon { display:grid; width:31px; height:31px; border-radius:9px; place-items:center; background:rgba(255,255,255,.14); font-size:.95rem; }.app-navbar .nav-link { color:rgba(255,255,255,.7); font-size:.9rem; font-weight:600; }.app-navbar .nav-link:hover,.app-navbar .nav-link:focus { color:#fff; }.profile-menu-toggle { display:flex; align-items:center; gap:9px; border:0; color:#fff; background:transparent; font-size:.88rem; font-weight:650; }.profile-menu-toggle::after { margin-left:1px; }.profile-menu-toggle:hover,.profile-menu-toggle:focus { color:#fff; }.nav-avatar { display:grid; width:30px; height:30px; overflow:hidden; border:1px solid rgba(255,255,255,.35); border-radius:50%; place-items:center; color:#fff; background:linear-gradient(135deg,#8b5cf6,#2dd4bf); font-size:.72rem; font-weight:750; }.nav-avatar img { width:100%; height:100%; object-fit:cover; }.profile-dropdown { min-width:230px; margin-top:10px!important; padding:9px; border:1px solid #e8edf5; border-radius:14px; box-shadow:0 14px 30px rgba(17,35,68,.14); }.profile-dropdown .dropdown-item { border-radius:9px; padding:9px 10px; color:#475569; font-size:.88rem; font-weight:600; }.profile-dropdown .dropdown-item:hover { color:#4f46e5; background:#f1f0ff; }.profile-dropdown-head { padding:9px 10px 11px; }.profile-dropdown-name { color:#1e293b; font-size:.88rem; font-weight:750; }.profile-dropdown-email { display:block; overflow:hidden; color:#94a3b8; font-size:.76rem; text-overflow:ellipsis; white-space:nowrap; }
    </style>
</head>
<body>
<?php
    $fotoProfilNav = session()->get('foto_profil');
    $namaNav = session()->get('nama') ?? 'User';
    $initialNav = strtoupper(substr(trim($namaNav), 0, 1));
?>
<nav class="navbar navbar-expand-lg navbar-dark app-navbar">
    <div class="container">
        <a class="navbar-brand app-brand" href="<?= site_url('dashboard') ?>"><span class="app-brand-icon"><i class="bi bi-book-half"></i></span>Bacapedia</a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Buka navigasi"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav ms-auto align-items-lg-center gap-lg-1">
                <li class="nav-item"><a class="nav-link" href="<?= site_url('dashboard') ?>">Dashboard</a></li>
                <?php if (session()->get('role') === 'ADMIN'): ?>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('kategori') ?>">Kategori</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('anggota') ?>">Anggota</a></li>
                <?php endif; ?>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('buku') ?>">Buku</a></li>
                <?php if (in_array(session()->get('role'), ['ADMIN', 'PETUGAS'], true)): ?><li class="nav-item"><a class="nav-link" href="<?= site_url('peminjaman') ?>">Peminjaman</a></li><?php endif; ?>
                <?php if (session()->get('role') === 'ANGGOTA'): ?><li class="nav-item"><a class="nav-link" href="<?= site_url('riwayat') ?>">Riwayat</a></li><?php endif; ?>
                <li class="nav-item dropdown ms-lg-2">
                    <a class="nav-link dropdown-toggle profile-menu-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><span class="nav-avatar"><?php if ($fotoProfilNav): ?><img src="<?= esc(base_url('uploads/profiles/' . rawurlencode($fotoProfilNav))) ?>" alt="Foto profil"><?php else: ?><?= esc($initialNav ?: 'U') ?><?php endif; ?></span><span class="d-lg-inline">Profil</span></a>
                    <ul class="dropdown-menu dropdown-menu-end profile-dropdown">
                        <li class="profile-dropdown-head"><span class="profile-dropdown-name"><?= esc($namaNav) ?></span><span class="profile-dropdown-email"><?= esc(session()->get('email') ?? '') ?></span></li>
                        <li><hr class="dropdown-divider my-1"></li>
                        <li><a class="dropdown-item" href="<?= site_url('profile') ?>"><i class="bi bi-person-circle me-2"></i>Profil Saya</a></li>
                        <li><a class="dropdown-item text-danger" href="<?= site_url('logout') ?>"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<main class="container mt-4">
    <?= $this->renderSection('content') ?>
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
