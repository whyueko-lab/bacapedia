<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h3><?= $title ?></h3>

<form action="<?= $action ?>" method="post">

```
<div class="mb-3">
    <label class="form-label">Nama Kategori</label>
    <input type="text" name="nama" class="form-control"
           value="<?= $kategoriData['nama'] ?? '' ?>" required>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="/kategori" class="btn btn-secondary">Kembali</a>
```

</form>

<?= $this->endSection() ?>
