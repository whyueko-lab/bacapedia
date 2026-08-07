<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2>Dashboard Bacapedia</h2>
<p>Selamat datang, <strong><?= session()->get('nama') ?></strong></p>

<div class="row mt-4">

```
<div class="col-md-3">

    <div class="card text-bg-primary">
        <div class="card-body">
            <h3><?= $jumlahKategori ?></h3>
            <p>Kategori</p>
        </div>
    </div>

</div>

<div class="col-md-3">

    <div class="card text-bg-success">
        <div class="card-body">
            <h3><?= $jumlahBuku ?></h3>
            <p>Buku</p>
        </div>
    </div>

</div>

<div class="col-md-3">

    <div class="card text-bg-warning">
        <div class="card-body">
            <h3><?= $sedangDipinjam ?></h3>
            <p>Sedang Dipinjam</p>
        </div>
    </div>

</div>

<div class="col-md-3">

    <div class="card text-bg-danger">
        <div class="card-body">
            <h3><?= $sudahKembali ?></h3>
            <p>Sudah Dikembalikan</p>
        </div>
    </div>

</div>
```

</div>

<?= $this->endSection() ?>
