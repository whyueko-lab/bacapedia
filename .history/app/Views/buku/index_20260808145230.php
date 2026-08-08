<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <h3>Daftar Buku</h3>

```

    <a href="/buku/tambah" class="btn btn-primary mb-3">
        Tambah Buku
    </a>
<?php endif; ?>
```

</div>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Tahun</th>
            <th>Aksi</th>
        </tr>
    </thead>

```
<tbody>

<?php if(empty($buku)): ?>

    <tr>
        <td colspan="7" class="text-center">Belum ada data buku</td>
    </tr>

<?php else: ?>

    <?php $no = 1; ?>

    <?php foreach($buku as $item): ?>

    <tr>
        <td><?= $no++ ?></td>
        <td><?= esc($item['judul']) ?></td>
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
        
        <td><?= esc($item['penulis']) ?></td>
        <td><?= esc($item['nama_kategori']) ?></td>
        <td><?= esc($item['stok']) ?></td>
        <td><?= esc($item['tahun_terbit']) ?></td>
        <td>

            <?php if(session()->get('role') === 'ANGGOTA'): ?>

                <?php if($item['stok'] > 0): ?>

                    <a href="/peminjaman/pinjam/<?= $item['id'] ?>"
                       class="btn btn-success btn-sm">
                       Pinjam
                    </a>

                <?php else: ?>

                    <button class="btn btn-secondary btn-sm" disabled>
                        Habis
                    </button>

                <?php endif; ?>

            <?php else: ?>

                <button class="btn btn-warning btn-sm">Edit</button>
                <button class="btn btn-danger btn-sm">Hapus</button>

            <?php endif; ?>

        </td>
    </tr>

    <?php endforeach; ?>

<?php endif; ?>

</tbody>
```

</table>

<?= $this->endSection() ?>
