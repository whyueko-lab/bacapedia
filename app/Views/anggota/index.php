<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .member-page { --member-primary:#4f46e5; --member-ink:#172033; --member-muted:#64748b; padding:12px 0 28px; }
    .member-header { display:flex; align-items:center; justify-content:space-between; gap:20px; margin-bottom:25px; }
    .member-header-icon { display:grid; width:50px; height:50px; border-radius:15px; place-items:center; flex:0 0 50px; color:var(--member-primary); background:#eef2ff; font-size:1.4rem; }
    .member-kicker { margin-bottom:4px; color:#818cf8; font-size:.7rem; font-weight:750; letter-spacing:.12em; text-transform:uppercase; }
    .member-title { margin:0; color:var(--member-ink); font-size:clamp(1.55rem,3vw,2rem); font-weight:750; letter-spacing:-.045em; }
    .member-subtitle { margin:4px 0 0; color:var(--member-muted); font-size:.9rem; }
    .member-count { padding:8px 12px; border:1px solid #e0e7ff; border-radius:10px; color:#4338ca; background:#eef2ff; font-size:.8rem; font-weight:700; white-space:nowrap; }
    .member-card { overflow:hidden; border:1px solid #edf0f7; border-radius:19px; background:#fff; box-shadow:0 9px 24px rgba(15,23,42,.045); }
    .member-card-top { padding:19px 23px; border-bottom:1px solid #edf0f7; }.member-card-title { margin:0; color:var(--member-ink); font-size:1rem; font-weight:750; letter-spacing:-.02em; }.member-card-caption { margin:3px 0 0; color:var(--member-muted); font-size:.84rem; }
    .member-table { margin:0; }.member-table thead th { padding:14px 17px; border:0; color:#64748b; background:#f8fafc; font-size:.7rem; font-weight:750; letter-spacing:.075em; text-transform:uppercase; white-space:nowrap; }.member-table tbody td { padding:15px 17px; border-color:#f0f2f6; color:#475569; font-size:.9rem; vertical-align:middle; }.member-table tbody tr { transition:background .16s ease; }.member-table tbody tr:hover { background:#fafbff; }
    .member-no { color:#94a3b8; font-size:.8rem; font-weight:700; }.member-id { color:#64748b; font-family:ui-monospace, SFMono-Regular, Menlo, monospace; font-size:.8rem; }.member-name { display:flex; align-items:center; gap:11px; color:#334155; font-weight:700; }.member-avatar { display:grid; width:35px; height:35px; border-radius:50%; place-items:center; color:#4f46e5; background:#eef2ff; font-size:.78rem; font-weight:750; }.member-email { color:#64748b; }.role-badge { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:8px; font-size:.74rem; font-weight:700; }.role-admin { color:#6d28d9; background:#ede9fe; }.role-petugas { color:#0369a1; background:#e0f2fe; }.role-anggota { color:#047857; background:#d1fae5; }.role-other { color:#475569; background:#e2e8f0; }.member-empty { padding:58px 20px !important; color:var(--member-muted) !important; text-align:center; }.member-empty i { display:block; margin-bottom:10px; color:#c7d2fe; font-size:2rem; }
    @media (max-width:575.98px) { .member-header { align-items:flex-start; }.member-count { display:none; }.member-card-top { padding:18px; } }
</style>

<div class="member-page">
    <header class="member-header">
        <div class="d-flex align-items-center gap-3"><div class="member-header-icon"><i class="bi bi-people-fill"></i></div><div><div class="member-kicker">Manajemen Pengguna</div><h1 class="member-title">Data Anggota</h1><p class="member-subtitle">Daftar pengguna yang terdaftar pada sistem Bacapedia.</p></div></div>
        <span class="member-count"><i class="bi bi-people me-1"></i> <?= count($anggota) ?> Anggota</span>
    </header>

    <section class="member-card">
        <div class="member-card-top"><h2 class="member-card-title">Daftar anggota</h2><p class="member-card-caption">Informasi akun dan peran setiap pengguna perpustakaan.</p></div>
        <div class="table-responsive"><table class="table member-table align-middle"><thead><tr><th>No.</th><th>User ID</th><th>Nama</th><th>Email</th><th>Role</th></tr></thead><tbody>
            <?php if (empty($anggota)): ?>
                <tr><td colspan="5" class="member-empty"><i class="bi bi-people"></i>Belum ada anggota yang terdaftar.</td></tr>
            <?php else: ?>
                <?php $no = 1; ?>
                <?php foreach ($anggota as $a): ?>
                    <?php $role = strtoupper($a['role']); $roleClass = $role === 'ADMIN' ? 'role-admin' : ($role === 'PETUGAS' ? 'role-petugas' : ($role === 'ANGGOTA' ? 'role-anggota' : 'role-other')); $initial = strtoupper(substr(trim($a['nama']), 0, 1)); ?>
                    <tr><td class="member-no"><?= $no++ ?></td><td class="member-id">#<?= esc($a['user_id']) ?></td><td><div class="member-name"><span class="member-avatar"><?= esc($initial ?: '?') ?></span><?= esc($a['nama']) ?></div></td><td class="member-email"><i class="bi bi-envelope me-1"></i><?= esc($a['email']) ?></td><td><span class="role-badge <?= $roleClass ?>"><i class="bi bi-person-badge"></i><?= esc($role) ?></span></td></tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody></table></div>
    </section>
</div>

<?= $this->endSection() ?>
