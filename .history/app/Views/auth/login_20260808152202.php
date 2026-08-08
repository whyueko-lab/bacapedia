<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bacapedia</title>

```
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>
    body{
    background:#f4f7fb;
    min-height:100vh;
}

.login-wrapper{
    min-height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
    padding:24px;
}

.login-card{
    width:100%;
    max-width:760px;      /* diperkecil dari 960px */
    border:none;
    border-radius:20px;
    overflow:hidden;
    box-shadow:0 16px 36px rgba(0,0,0,.10);
}

.login-left{
    background:linear-gradient(135deg,#2563eb,#1d4ed8);
    color:white;
    padding:32px;         /* lebih kecil */
    display:flex;
    flex-direction:column;
    justify-content:center;
    min-height:430px;     /* diperkecil */
}

.login-left .brand-icon{
    width:60px;
    height:60px;
    border-radius:16px;
    background:rgba(255,255,255,.15);
    display:flex;
    align-items:center;
    justify-content:center;
    margin-bottom:18px;
}

.login-left h1{
    font-size:1.8rem;
    font-weight:700;
    margin-bottom:10px;
}

.login-left p{
    color:rgba(255,255,255,.9);
    line-height:1.6;
    font-size:0.95rem;
    margin-bottom:0;
}

.login-right{
    background:#fff;
    padding:32px;         /* lebih kecil */
    display:flex;
    align-items:center;
}

.login-right h3{
    font-size:1.5rem;
    font-weight:700;
    color:#0f172a;
}

.form-control{
    border-radius:12px;
    padding:.75rem .9rem;
}

.input-group-text{
    border-radius:12px 0 0 12px;
    background:#f8fafc;
}

.btn-primary{
    border-radius:12px;
    padding:.8rem;
    font-weight:600;
}

@media (max-width:768px){
    .login-left{
        display:none;
    }

    .login-right{
        padding:24px;
    }

    .login-card{
        max-width:420px;
    }
}
</style>
```

</head>
<body>

<div class="login-wrapper">
    <div class="card login-card">
        <div class="row g-0">

```
        <div class="col-md-6 login-left">
            <div class="brand-icon">
                <i class="bi bi-book-half fs-2"></i>
            </div>

            <h1>Bacapedia</h1>
            <p>
                Sistem Manajemen Perpustakaan berbasis CodeIgniter 4.
                Kelola buku, kategori, anggota, peminjaman, pengembalian,
                dan laporan secara sederhana, cepat, dan aman.
            </p>
        </div>

        <div class="col-md-6 login-right">
            <div class="w-100">

                <div class="mb-4">
                    <h3>Selamat Datang</h3>
                    <p class="text-muted mb-0">
                        Masuk menggunakan akun Bacapedia Anda
                    </p>
                </div>

                <?php if(session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if(session()->getFlashdata('success')): ?>
                    <div class="alert alert-success">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <form action="/login" method="post">

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-envelope"></i>
                            </span>
                            <input
                                type="email"
                                name="email"
                                class="form-control"
                                placeholder="admin@bacapedia.com"
                                required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text">
                                <i class="bi bi-lock"></i>
                            </span>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                placeholder="Masukkan password"
                                required>
                        </div>
                    </div>

                    <button class="btn btn-primary w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Login
                    </button>

                </form>

                <div class="text-center mt-4">
                    <span class="text-muted">Belum punya akun?</span>
                    <a href="/register" class="fw-semibold text-decoration-none">
                        Register
                    </a>
                </div>

            </div>
        </div>

    </div>
</div>
```

</div>

</body>
</html>
