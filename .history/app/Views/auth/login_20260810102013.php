<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Bacapedia</title>


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
    color:rgba(255, 255, 255, 0.9);
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


</head>
<body>

<div class="login-page">

    <!-- Background Decoration -->
    <div class="bg-orb orb-1"></div>
    <div class="bg-orb orb-2"></div>
    <div class="bg-grid"></div>

    <div class="container">
        <div class="login-card">

            <!-- LEFT -->
            <div class="login-left">

                <div class="brand">
                    <div class="brand-icon">
                        <i class="bi bi-book-half"></i>
                    </div>

                    <div>
                        <span class="brand-name">Bacapedia</span>
                        <small>Library Management System</small>
                    </div>
                </div>

                <div class="hero-content">

                    <span class="badge-modern">
                        <i class="bi bi-stars"></i>
                        Smart Library Platform
                    </span>

                    <h1>
                        Kelola Perpustakaan
                        <span>Lebih Cerdas.</span>
                    </h1>

                    <p>
                        Platform manajemen perpustakaan modern untuk mengelola
                        buku, anggota, peminjaman, pengembalian, hingga laporan
                        dalam satu sistem yang terintegrasi.
                    </p>

                    <div class="feature-list">

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-lightning-charge-fill"></i>
                            </div>
                            <div>
                                <strong>Cepat & Efisien</strong>
                                <span>Proses pengelolaan lebih praktis</span>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                            <div>
                                <strong>Aman & Terintegrasi</strong>
                                <span>Data perpustakaan tersimpan terstruktur</span>
                            </div>
                        </div>

                        <div class="feature-item">
                            <div class="feature-icon">
                                <i class="bi bi-bar-chart-line-fill"></i>
                            </div>
                            <div>
                                <strong>Monitoring & Laporan</strong>
                                <span>Informasi tersedia secara real-time</span>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="left-footer">
                    <span>
                        <i class="bi bi-code-slash"></i>
                        Built with CodeIgniter 4
                    </span>

                    <span>
                        <i class="bi bi-circle-fill status-dot"></i>
                        System Online
                    </span>
                </div>

            </div>


            <!-- RIGHT -->
            <div class="login-right">

                <div class="login-form-wrapper">

                    <div class="mobile-brand">
                        <div class="brand-icon">
                            <i class="bi bi-book-half"></i>
                        </div>
                        <strong>Bacapedia</strong>
                    </div>

                    <div class="login-header">

                        <div class="welcome-icon">
                            <i class="bi bi-person-lock"></i>
                        </div>

                        <h2>Selamat Datang 👋</h2>

                        <p>
                            Masuk ke dashboard Bacapedia Anda
                        </p>

                    </div>


                    <?php if(session()->getFlashdata('error')): ?>

                        <div class="alert-modern alert-error">
                            <i class="bi bi-exclamation-circle-fill"></i>

                            <div>
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        </div>

                    <?php endif; ?>


                    <?php if(session()->getFlashdata('success')): ?>

                        <div class="alert-modern alert-success">
                            <i class="bi bi-check-circle-fill"></i>

                            <div>
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        </div>

                    <?php endif; ?>


                    <form action="/login" method="post">

                        <!-- EMAIL -->
                        <div class="form-field">

                            <label>
                                Email
                            </label>

                            <div class="modern-input">

                                <i class="bi bi-envelope"></i>

                                <input
                                    type="email"
                                    name="email"
                                    placeholder="admin@bacapedia.com"
                                    autocomplete="email"
                                    required>

                            </div>

                        </div>


                        <!-- PASSWORD -->
                        <div class="form-field">

                            <div class="password-label">

                                <label>
                                    Password
                                </label>

                                <a href="#">
                                    Lupa password?
                                </a>

                            </div>

                            <div class="modern-input">

                                <i class="bi bi-lock"></i>

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    placeholder="Masukkan password"
                                    autocomplete="current-password"
                                    required>

                                <button
                                    type="button"
                                    class="password-toggle"
                                    onclick="togglePassword()">

                                    <i
                                        class="bi bi-eye"
                                        id="passwordIcon">
                                    </i>

                                </button>

                            </div>

                        </div>


                        <!-- REMEMBER -->
                        <div class="remember-row">

                            <label class="remember">

                                <input type="checkbox" name="remember">

                                <span class="checkmark"></span>

                                <span>Ingat saya</span>

                            </label>

                        </div>


                        <!-- LOGIN BUTTON -->
                        <button
                            type="submit"
                            class="login-button">

                            <span>
                                Masuk ke Dashboard
                            </span>

                            <i class="bi bi-arrow-right"></i>

                        </button>

                    </form>


                    <div class="register-divider">

                        <span>atau</span>

                    </div>


                    <div class="register-text">

                        <span>Belum memiliki akun?</span>

                        <a href="/register">
                            Buat akun sekarang
                            <i class="bi bi-arrow-up-right"></i>
                        </a>

                    </div>


                    <div class="security-info">

                        <i class="bi bi-shield-lock-fill"></i>

                        <span>
                            Koneksi Anda aman dan terenkripsi
                        </span>

                    </div>

                </div>

            </div>

        </div>
    </div>

</div>

</body>
</html>
