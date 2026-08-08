<tbody>

<?php if(empty($riwayat)): ?>

```
<tr>
    <td colspan="9" class="text-center">Belum ada riwayat</td>
</tr>
```

<?php else: ?>

```
<?php $no = 1; ?>

<?php foreach($riwayat as $item): ?>

<tr>
    <td><?= $no++ ?></td>

    <?php if(session()->get('role') === 'ADMIN' || session()->get('role') === 'PETUGAS'): ?>
        <td><?= esc($item['nama']) ?></td>
    <?php endif; ?>

    <td><?= esc($item['judul']) ?></td>
    <td><?= esc($item['tanggal_pinjam']) ?></td>
    <td><?= esc($item['tanggal_jatuh_tempo']) ?></td>
    <td><?= $item['tanggal_kembali'] ?? '-' ?></td>

    <!-- STATUS -->
    <td>
        <?php if($item['status'] === 'DIPINJAM'): ?>
            <span class="badge bg-warning text-dark">Dipinjam</span>
        <?php elseif($item['status'] === 'MENUNGGU_VALIDASI'): ?>
            <span class="badge bg-info text-dark">Menunggu Validasi</span>
        <?php elseif($item['status'] === 'DIKEMBALIKAN'): ?>
            <span class="badge bg-success">Dikembalikan</span>
        <?php else: ?>
            <span class="badge bg-secondary"><?= esc($item['status']) ?></span>
        <?php endif; ?>
    </td>

    <td>Rp <?= number_format($item['denda'],0,',','.') ?></td>

    <!-- AKSI -->
    <td>

    <?php if(session()->get('role') === 'ANGGOTA'): ?>

        <?php if($item['status'] === 'DIPINJAM'): ?>
            <a href="/riwayat/ajukan/<?= $item['id'] ?>"
               class="btn btn-warning btn-sm"
               onclick="return confirm('Ajukan pengembalian buku ini?')">
                Ajukan Pengembalian
            </a>

        <?php elseif($item['status'] === 'MENUNGGU_VALIDASI'): ?>
            <button class="btn btn-info btn-sm" disabled>
                Menunggu Validasi
            </button>

        <?php else: ?>
            <button class="btn btn-secondary btn-sm" disabled>
                Selesai
            </button>
        <?php endif; ?>

    <?php else: ?>

        <?php if($item['status'] === 'MENUNGGU_VALIDASI'): ?>
            <a href="/peminjaman/validasi/<?= $item['id'] ?>"
               class="btn btn-success btn-sm"
               onclick="return confirm('Validasi pengembalian buku ini?')">
                Validasi Pengembalian
            </a>

        <?php elseif($item['status'] === 'DIPINJAM'): ?>
            <button class="btn btn-warning btn-sm" disabled>
                Menunggu Pengembalian
            </button>

        <?php else: ?>
            <button class="btn btn-secondary btn-sm" disabled>
                Selesai
            </button>
        <?php endif; ?>

    <?php endif; ?>

    </td>

</tr>

<?php endforeach; ?>
```

<?php endif; ?>

</tbody>
