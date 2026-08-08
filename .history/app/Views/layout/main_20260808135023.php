<!DOCTYPE html>

<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Bacapedia' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="/dashboard">Bacapedia</a>

```
<div class="navbar-nav ms-auto">
  <a class="nav-link" href="/dashboard">Dashboard</a>
  <a class="nav-link" href="/buku">Buku</a>
  <a class="nav-link" href="/riwayat">Peminjaman</a>
  <a class="nav-link text-warning" href="/logout">Logout</a>
</div>
```

  </div>
</nav>

<div class="container mt-4">

```
<?php if(session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<?php if(session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
    </div>
<?php endif; ?>

<?= $this->renderSection('content') ?>
```

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
