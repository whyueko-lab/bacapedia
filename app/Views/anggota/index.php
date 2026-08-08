<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h3>Data Anggota</h3>

<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>No</th>
            <th>User ID</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Role</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1; foreach($anggota as $a): ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= esc($a['user_id']) ?></td>
            <td><?= esc($a['nama']) ?></td>
            <td><?= esc($a['email']) ?></td>
            <td><?= esc($a['role']) ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?= $this->endSection() ?>
