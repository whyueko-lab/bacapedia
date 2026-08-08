<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


<title><?= $title ?? 'Bacapedia'; ?></title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/dashboard">Bacapedia</a>

    
        <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">

            <li class="nav-item">
                <a class="nav-link" href="/dashboard">Dashboard</a>
            </li>

            <?php if(session()->get('role') === 'ADMIN'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/kategori">Kategori</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="/anggota">Anggota</a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link" href="/buku">Buku</a>
            </li>

            <?php if(session()->get('role') === 'ADMIN' || session()->get('role') === 'PETUGAS'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/peminjaman">Peminjaman</a>
                </li>
            <?php endif; ?>

            <?php if(session()->get('role') === 'ANGGOTA'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="/riwayat">Riwayat</a>
                </li>
            <?php endif; ?>

            <li class="nav-item">
                <a class="nav-link text-warning" href="/logout">Logout</a>
            </li>

        </ul>
    </div>
</div>
```

</nav>

<div class="container mt-4">

```
<?= $this->renderSection('content'); ?>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
