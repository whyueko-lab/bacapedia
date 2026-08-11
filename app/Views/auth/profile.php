<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<?php
    $fotoProfil = !empty($user['foto_profil']) ? base_url('uploads/profiles/' . rawurlencode($user['foto_profil'])) : null;
    $initial = strtoupper(substr(trim($user['nama'] ?? 'U'), 0, 1));
?>

<style>
    .profile-page { --profile-primary:#6941c6; --profile-ink:#172033; --profile-muted:#64748b; max-width:860px; padding:12px 0 28px; }
    .profile-back { display:inline-flex; align-items:center; gap:8px; margin-bottom:22px; color:#64748b; font-size:.87rem; font-weight:650; text-decoration:none; }.profile-back:hover { color:var(--profile-primary); }
    .profile-card { overflow:hidden; border:1px solid #e8edf5; border-radius:22px; background:#fff; box-shadow:0 14px 32px rgba(17,35,68,.07); }.profile-hero { position:relative; min-height:145px; padding:29px 32px; overflow:hidden; color:#fff; background:radial-gradient(circle at 90% 15%,rgba(45,212,191,.33),transparent 28%),linear-gradient(125deg,#101b33,#302561 58%,#6941c6); }.profile-hero::after { position:absolute; width:190px; height:190px; right:-70px; bottom:-120px; border:1px solid rgba(255,255,255,.18); border-radius:50%; box-shadow:0 0 0 26px rgba(255,255,255,.05); content:""; }.profile-hero-content { position:relative; z-index:1; }.profile-kicker { margin-bottom:8px; color:#a7f3d0; font-size:.7rem; font-weight:750; letter-spacing:.12em; text-transform:uppercase; }.profile-title { margin:0; font-size:1.6rem; font-weight:750; letter-spacing:-.04em; }.profile-subtitle { margin:6px 0 0; color:rgba(255,255,255,.76); font-size:.9rem; }
    .profile-body { position:relative; z-index:2; padding:0 32px 32px; }.profile-photo-wrap { position:relative; z-index:3; display:flex; align-items:end; gap:18px; margin-top:-43px; margin-bottom:30px; }.profile-avatar { position:relative; z-index:4; display:grid; width:96px; height:96px; overflow:hidden; border:4px solid #fff; border-radius:50%; place-items:center; flex:0 0 96px; color:#fff; background:linear-gradient(135deg,#6941c6,#2dd4bf); box-shadow:0 8px 20px rgba(17,35,68,.18); font-size:2rem; font-weight:750; }.profile-avatar img { width:100%; height:100%; object-fit:cover; }.profile-name { margin:0; color:var(--profile-ink); font-size:1.15rem; font-weight:750; }.profile-role { display:inline-block; margin-top:5px; padding:5px 9px; border-radius:8px; color:#5b21b6; background:#ede9fe; font-size:.72rem; font-weight:750; }
    .profile-label { margin-bottom:8px; color:#334155; font-size:.88rem; font-weight:700; }.profile-control { min-height:52px; border:1px solid #e2e8f0; border-radius:12px; padding:.75rem .9rem; background:#f8fafc; box-shadow:none!important; }.profile-control:focus { border-color:#8b5cf6; background:#fff; box-shadow:0 0 0 4px rgba(139,92,246,.12)!important; }.profile-help { margin-top:8px; color:#94a3b8; font-size:.79rem; }.profile-upload { border:1px dashed #c7d2fe; border-radius:13px; padding:15px; background:#fafaff; }.profile-alert { display:flex; align-items:center; gap:10px; border:0; border-radius:13px; font-size:.9rem; }.profile-divider { margin:29px 0 22px; border-color:#f0f2f6; }.profile-save { min-height:48px; border:0; border-radius:11px; padding:0 18px; background:linear-gradient(135deg,#6941c6,#8b5cf6); box-shadow:0 8px 17px rgba(105,65,198,.22); font-weight:650; }.profile-save:hover { background:linear-gradient(135deg,#5b21b6,#7c3aed); transform:translateY(-1px); }
    @media(max-width:575.98px) { .profile-hero { padding:25px 22px; }.profile-body { padding:0 22px 26px; }.profile-photo-wrap { gap:13px; }.profile-avatar { width:82px; height:82px; flex-basis:82px; font-size:1.7rem; } }
</style>

<div class="profile-page">
    <a href="<?= site_url('dashboard') ?>" class="profile-back"><i class="bi bi-arrow-left"></i> Kembali ke dashboard</a>
    <?php if (session()->getFlashdata('success')): ?><div class="alert alert-success profile-alert mb-4" role="alert"><i class="bi bi-check-circle-fill"></i><span><?= esc(session()->getFlashdata('success')) ?></span></div><?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger profile-alert mb-4" role="alert"><i class="bi bi-exclamation-circle-fill"></i><span><?= esc(session()->getFlashdata('error')) ?></span></div><?php endif; ?>
    <section class="profile-card">
        <header class="profile-hero"><div class="profile-hero-content"><div class="profile-kicker">Pengaturan akun</div><h1 class="profile-title">Profil Saya</h1><p class="profile-subtitle">Kelola informasi pribadi dan foto profil Anda.</p></div></header>
        <form action="<?= site_url('profile') ?>" method="post" enctype="multipart/form-data" class="profile-body">
            <?= csrf_field() ?>
            <div class="profile-photo-wrap"><div id="avatarPreview" class="profile-avatar"><?php if ($fotoProfil): ?><img src="<?= esc($fotoProfil) ?>" alt="Foto profil <?= esc($user['nama']) ?>"><?php else: ?><span><?= esc($initial ?: 'U') ?></span><?php endif; ?></div><div><h2 class="profile-name"><?= esc($user['nama']) ?></h2><span class="profile-role"><i class="bi bi-person-badge me-1"></i><?= esc($user['role']) ?></span></div></div>
            <div class="row g-3"><div class="col-md-6"><label for="nama" class="form-label profile-label">Nama lengkap</label><input type="text" id="nama" name="nama" class="form-control profile-control" value="<?= esc(old('nama', $user['nama'])) ?>" autocomplete="name" required></div><div class="col-md-6"><label for="email" class="form-label profile-label">Alamat email</label><input type="email" id="email" name="email" class="form-control profile-control" value="<?= esc(old('email', $user['email'])) ?>" autocomplete="email" required></div></div>
            <div class="mt-4"><label for="foto_profil" class="form-label profile-label">Foto profil</label><div class="profile-upload"><input type="file" id="foto_profil" name="foto_profil" class="form-control profile-control" accept="image/png,image/jpeg,image/webp"><div class="profile-help"><i class="bi bi-info-circle me-1"></i> JPG, PNG, atau WEBP. Ukuran maksimum 2 MB.</div></div></div>
            <hr class="profile-divider"><div class="d-flex justify-content-end"><button type="submit" class="btn btn-primary profile-save"><i class="bi bi-check2-circle me-2"></i>Simpan Perubahan</button></div>
        </form>
    </section>
</div>

<script>
    document.getElementById('foto_profil').addEventListener('change', (event) => {
        const file = event.target.files[0];
        if (!file) return;
        const preview = document.getElementById('avatarPreview');
        const reader = new FileReader();
        reader.onload = (loadEvent) => { preview.innerHTML = `<img src="${loadEvent.target.result}" alt="Pratinjau foto profil">`; };
        reader.readAsDataURL(file);
    });
</script>

<?= $this->endSection() ?>
