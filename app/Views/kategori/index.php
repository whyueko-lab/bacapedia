<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Data Kategori</h3>
    <a href="/kategori/tambah" class="btn btn-primary">+ Tambah Kategori</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th width="80">No</th>
            <th>Nama Kategori</th>
            <th width="180">Aksi</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach($kategori as $k): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($k['nama_kategori']) ?></td>
            <td>
                <a href="/kategori/edit/<?= $k['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                <a href="/kategori/hapus/<?= $k['id'] ?>"
                   class="btn btn-sm btn-danger"
                   onclick="return confirm('Hapus kategori ini?')">Hapus</a>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
