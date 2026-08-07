<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2>Dashboard Bacapedia</h2>

<div class="row mt-4">

```
<div class="col-md-3">

    <div class="card text-bg-primary">
        <div class="card-body">
            <h5>Kategori</h5>
            <p>Kelola kategori buku</p>
        </div>
    </div>

</div>

<div class="col-md-3">

    <div class="card text-bg-success">
        <div class="card-body">
            <h5>Buku</h5>
            <p>Kelola data buku</p>
        </div>
    </div>

</div>

<div class="col-md-3">

    <div class="card text-bg-warning">
        <div class="card-body">
            <h5>Peminjaman</h5>
            <p>Transaksi peminjaman</p>
        </div>
    </div>

</div>

<div class="col-md-3">

    <div class="card text-bg-danger">
        <div class="card-body">
            <h5>Riwayat</h5>
            <p>Riwayat transaksi</p>
        </div>
    </div>

</div>
```

</div>

<?= $this->endSection() ?>
