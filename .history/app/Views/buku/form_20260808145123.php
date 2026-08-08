<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h3><?= $title ?></h3>

<form action="<?= $action ?>" method="post">

```
<div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="judul" class="form-control"
           value="<?= $buku['judul'] ?? '' ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Penulis</label>
    <input type="text" name="penulis" class="form-control"
           value="<?= $buku['penulis'] ?? '' ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Penerbit</label>
    <input type="text" name="penerbit" class="form-control"
           value="<?= $buku['penerbit'] ?? '' ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="kategori_id" class="form-select" required>
        <option value="">-- Pilih Kategori --</option>
        <?php foreach($kategori as $k): ?>
            <option value="<?= $k['id'] ?>"
                <?= (isset($buku) && $buku && $buku['kategori_id'] == $k['id']) ? 'selected' : '' ?>>
                <?= $k['nama'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Stok</label>
    <input type="number" name="stok" class="form-control"
           value="<?= $buku['stok'] ?? 1 ?>" required>
</div>

<div class="mb-3">
    <label class="form-label">Tahun Terbit</label>
    <input type="number" name="tahun_terbit" class="form-control"
           value="<?= $buku['tahun_terbit'] ?? date('Y') ?>" required>
</div>

<button class="btn btn-primary">Simpan</button>
<a href="/buku" class="btn btn-secondary">Kembali</a>
``` 

</form>

<?= $this->endSection() ?>
