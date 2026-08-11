<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Akun - Bacapedia</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root { --primary:#4f46e5; --primary-dark:#312e81; --ink:#172033; --muted:#6b7280; }
        * { box-sizing:border-box; }
        body { min-height:100vh; margin:0; color:var(--ink); font-family:Inter,ui-sans-serif,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif; background:#eef2ff; }
        .register-page { position:relative; display:grid; min-height:100vh; overflow:hidden; padding:32px 20px; place-items:center; background:radial-gradient(circle at 8% 12%,rgba(129,140,248,.5),transparent 26rem),radial-gradient(circle at 93% 85%,rgba(45,212,191,.28),transparent 24rem),linear-gradient(135deg,#eef2ff 0%,#f8faff 48%,#ecfeff 100%); }
        .orb { position:absolute; border-radius:50%; filter:blur(2px); opacity:.55; pointer-events:none; }.orb-one { width:240px;height:240px;top:-105px;right:12%;background:#818cf8; }.orb-two { width:160px;height:160px;bottom:-55px;left:12%;background:#5eead4; }
        .register-card { position:relative; z-index:1; width:min(100%,1050px); min-height:630px; overflow:hidden; border:1px solid rgba(255,255,255,.85); border-radius:28px; background:rgba(255,255,255,.82); box-shadow:0 28px 70px rgba(49,46,129,.18); backdrop-filter:blur(16px); }
        .brand-panel { position:relative; display:flex; flex-direction:column; justify-content:space-between; min-height:630px; overflow:hidden; padding:52px; color:#fff; background:linear-gradient(145deg,#312e81 0%,#4338ca 48%,#4f46e5 100%); }.brand-panel::after { position:absolute;width:330px;height:330px;right:-125px;bottom:-145px;border:50px solid rgba(255,255,255,.08);border-radius:50%;content:""; }.brand-panel::before { position:absolute;width:180px;height:180px;top:-75px;left:-65px;border-radius:50%;background:rgba(255,255,255,.08);content:""; }.brand-content,.brand-footer { position:relative;z-index:1; }
        .brand-logo { display:inline-flex;width:58px;height:58px;margin-bottom:28px;border:1px solid rgba(255,255,255,.23);border-radius:18px;align-items:center;justify-content:center;background:rgba(255,255,255,.14);box-shadow:0 10px 22px rgba(20,16,80,.2);font-size:1.65rem; }.brand-kicker { margin-bottom:12px;color:#c7d2fe;font-size:.72rem;font-weight:700;letter-spacing:.15em;text-transform:uppercase; }.brand-title { max-width:390px;margin:0 0 18px;font-size:clamp(2.25rem,4vw,3.35rem);font-weight:750;letter-spacing:-.055em;line-height:1.08; }.brand-description { max-width:390px;margin:0;color:rgba(255,255,255,.78);line-height:1.75; }.feature-chip { display:inline-flex;gap:10px;padding:12px 16px;border:1px solid rgba(255,255,255,.15);border-radius:14px;align-items:center;background:rgba(12,15,70,.18);color:rgba(255,255,255,.9);font-size:.9rem; }
        .form-panel { display:flex;align-items:center;padding:52px; }.form-content { width:100%;max-width:385px;margin:auto; }.welcome-icon { display:grid;width:48px;height:48px;margin-bottom:25px;border-radius:14px;place-items:center;color:var(--primary);background:#eef2ff;font-size:1.35rem; }.form-title { margin:0;font-size:1.8rem;font-weight:750;letter-spacing:-.04em; }.form-subtitle { margin:10px 0 27px;color:var(--muted);font-size:.96rem; }.form-label { margin-bottom:8px;color:#374151;font-size:.88rem;font-weight:650; }
        .input-group { position:relative; }.input-icon { position:absolute;z-index:3;top:50%;left:16px;color:#9ca3af;transform:translateY(-50%); }.form-control { min-height:53px;padding:.8rem 46px;border:1px solid #e5e7eb;border-radius:13px!important;color:var(--ink);background:#f9fafb;box-shadow:none!important; }.form-control::placeholder { color:#adb5bd; }.form-control:focus { border-color:#818cf8;background:#fff;box-shadow:0 0 0 4px rgba(99,102,241,.12)!important; }
        .password-toggle { position:absolute;z-index:4;top:50%;right:7px;width:38px;height:38px;border:0;border-radius:10px;color:#9ca3af;background:transparent;transform:translateY(-50%); }.password-toggle:hover { color:var(--primary);background:#eef2ff; }.register-button { min-height:53px;border:0;border-radius:13px;background:linear-gradient(135deg,#4f46e5,#6366f1);box-shadow:0 10px 20px rgba(79,70,229,.24);font-weight:650;transition:transform .2s,box-shadow .2s; }.register-button:hover,.register-button:focus { background:linear-gradient(135deg,#4338ca,#4f46e5);box-shadow:0 14px 26px rgba(79,70,229,.3);transform:translateY(-2px); }.login-link { color:var(--primary);font-weight:700;text-decoration:none; }.login-link:hover { color:var(--primary-dark);text-decoration:underline; }.alert { border:0;border-radius:13px;font-size:.9rem; }
        @media(max-width:767.98px) { .register-page { padding:18px; }.register-card { max-width:480px;min-height:auto;border-radius:22px; }.brand-panel { display:none; }.form-panel { min-height:620px;padding:36px 26px; } }
    </style>
</head>
<body>
    <main class="register-page">
        <span class="orb orb-one"></span><span class="orb orb-two"></span>
        <section class="register-card"><div class="row g-0 h-100">
            <div class="col-md-6"><div class="brand-panel"><div class="brand-content"><div class="brand-logo"><i class="bi bi-book-half"></i></div><div class="brand-kicker">Perpustakaan Digital</div><h1 class="brand-title">Mulai perjalanan membaca Anda.</h1><p class="brand-description">Bergabunglah dengan Bacapedia untuk menemukan koleksi buku dan menikmati pengalaman perpustakaan yang lebih modern.</p></div><div class="brand-footer"><span class="feature-chip"><i class="bi bi-stars"></i> Akses koleksi di satu tempat</span></div></div></div>
            <div class="col-md-6"><div class="form-panel"><div class="form-content"><div class="welcome-icon"><i class="bi bi-person-plus"></i></div><h2 class="form-title">Buat akun baru</h2><p class="form-subtitle">Isi data berikut untuk bergabung dengan Bacapedia.</p>
                <?php if (session()->getFlashdata('error')): ?><div class="alert alert-danger d-flex gap-2 align-items-center mb-4" role="alert"><i class="bi bi-exclamation-circle-fill"></i><span><?= esc(session()->getFlashdata('error')) ?></span></div><?php endif; ?>
                <?php if (session()->getFlashdata('success')): ?><div class="alert alert-success d-flex gap-2 align-items-center mb-4" role="alert"><i class="bi bi-check-circle-fill"></i><span><?= esc(session()->getFlashdata('success')) ?></span></div><?php endif; ?>
                <form action="<?= site_url('register') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3"><label for="nama" class="form-label">Nama lengkap</label><div class="input-group"><i class="bi bi-person input-icon"></i><input type="text" id="nama" name="nama" class="form-control" value="<?= esc(old('nama')) ?>" placeholder="Masukkan nama lengkap" autocomplete="name" required autofocus></div></div>
                    <div class="mb-3"><label for="email" class="form-label">Alamat email</label><div class="input-group"><i class="bi bi-envelope input-icon"></i><input type="email" id="email" name="email" class="form-control" value="<?= esc(old('email')) ?>" placeholder="nama@email.com" autocomplete="email" required></div></div>
                    <div class="mb-4"><label for="password" class="form-label">Password</label><div class="input-group"><i class="bi bi-lock input-icon"></i><input type="password" id="password" name="password" class="form-control" placeholder="Buat password Anda" autocomplete="new-password" required><button class="password-toggle" type="button" id="passwordToggle" aria-label="Tampilkan password" aria-pressed="false"><i class="bi bi-eye"></i></button></div></div>
                    <button type="submit" class="btn btn-primary register-button w-100">Buat Akun <i class="bi bi-arrow-right ms-2"></i></button>
                </form>
                <p class="mb-0 mt-4 text-center text-muted small">Sudah punya akun? <a href="<?= site_url('login') ?>" class="login-link">Masuk sekarang</a></p>
            </div></div></div>
        </div></section>
    </main>
    <script>
        const password = document.getElementById('password');
        const passwordToggle = document.getElementById('passwordToggle');
        passwordToggle.addEventListener('click', () => {
            const isHidden = password.type === 'password';
            password.type = isHidden ? 'text' : 'password';
            passwordToggle.setAttribute('aria-label', isHidden ? 'Sembunyikan password' : 'Tampilkan password');
            passwordToggle.setAttribute('aria-pressed', String(isHidden));
            passwordToggle.querySelector('i').className = isHidden ? 'bi bi-eye-slash' : 'bi bi-eye';
        });
    </script>
</body>
</html>
