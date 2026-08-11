<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .loan-page { --loan-primary: #4f46e5; --loan-ink: #172033; --loan-muted: #64748b; padding: 12px 0 28px; }
    .loan-header { display:flex; align-items:center; justify-content:space-between; gap:20px; margin-bottom:25px; }
    .loan-header-icon { display:grid; width:50px; height:50px; border-radius:15px; place-items:center; flex:0 0 50px; color:var(--loan-primary); background:#eef2ff; font-size:1.4rem; }
    .loan-kicker { margin-bottom:4px; color:#818cf8; font-size:.7rem; font-weight:750; letter-spacing:.12em; text-transform:uppercase; }
    .loan-title { margin:0; color:var(--loan-ink); font-size:clamp(1.55rem,3vw,2rem); font-weight:750; letter-spacing:-.045em; }
    .loan-subtitle { margin:4px 0 0; color:var(--loan-muted); font-size:.9rem; }
    .loan-count { padding:8px 12px; border:1px solid #e0e7ff; border-radius:10px; color:#4338ca; background:#eef2ff; font-size:.8rem; font-weight:700; white-space:nowrap; }
    .loan-alert { display:flex; align-items:center; gap:10px; border:0; border-radius:14px; font-size:.9rem; }
    .loan-card { overflow:hidden; border:1px solid #edf0f7; border-radius:19px; background:#fff; box-shadow:0 9px 24px rgba(15,23,42,.045); }
    .loan-card-top { padding:19px 23px; border-bottom:1px solid #edf0f7; }
    .loan-card-title { margin:0; color:var(--loan-ink); font-size:1rem; font-weight:750; letter-spacing:-.02em; }
    .loan-card-caption { margin:3px 0 0; color:var(--loan-muted); font-size:.84rem; }
    .loan-table { margin:0; }
    .loan-table thead th { padding:14px 16px; border:0; color:#64748b; background:#f8fafc; font-size:.7rem; font-weight:750; letter-spacing:.075em; text-transform:uppercase; white-space:nowrap; }
    .loan-table tbody td { padding:15px 16px; border-color:#f0f2f6; color:#475569; font-size:.88rem; vertical-align:middle; }
    .loan-table tbody tr { transition:background .16s ease; }.loan-table tbody tr:hover { background:#fafbff; }
    .loan-no { color:#94a3b8; font-size:.8rem; font-weight:700; }
    .loan-book { display:flex; align-items:center; gap:10px; min-width:160px; color:#334155; font-weight:700; }
    .loan-book-icon { display:grid; width:34px; height:34px; border-radius:10px; place-items:center; flex:0 0 34px; color:#4f46e5; background:#eef2ff; }
    .loan-person { color:#334155; font-weight:650; }.loan-date { color:#64748b; white-space:nowrap; }
    .status-badge { display:inline-flex; align-items:center; gap:6px; padding:6px 10px; border-radius:8px; font-size:.74rem; font-weight:700; white-space:nowrap; }
    .status-borrowed { color:#a16207; background:#fef3c7; }.status-pending { color:#0369a1; background:#e0f2fe; }.status-returned { color:#047857; background:#d1fae5; }.status-other { color:#475569; background:#e2e8f0; }
    .fine { color:#334155; font-weight:650; white-space:nowrap; }.fine-empty { color:#94a3b8; font-weight:500; }
    .loan-action { border-radius:9px; padding:7px 10px; font-size:.77rem; font-weight:650; white-space:nowrap; }.loan-action:disabled { opacity:.72; }
    .loan-empty { padding:58px 20px !important; color:var(--loan-muted) !important; text-align:center; }.loan-empty i { display:block; margin-bottom:10px; color:#c7d2fe; font-size:2rem; }
    @media (max-width:575.98px) { .loan-header { align-items:flex-start; }.loan-count { display:none; }.loan-card-top { padding:18px; } }
</style>

<div class="loan-page">
    <header class="loan-header">
        <div class="d-flex align-items-center gap-3"><div class="loan-header-icon"><i class="bi bi-arrow-left-right"></i></div><div><div class="loan-kicker">Aktivitas Perpustakaan</div><h1 class="loan-title"><?= esc($title) ?></h1><p class="loan-subtitle">Pantau proses peminjaman dan pengembalian buku.</p></div></div>
        <span class="loan-count"><i class="bi bi-journal-check me-1"></i> <?= count($riwayat) ?> Riwayat</span>
    </header>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success loan-alert mb-4" role="alert"><i class="bi bi-check-circle-fill"></i><span><?= esc(session()->getFlashdata('success')) ?></span></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger loan-alert mb-4" role="alert"><i class="bi bi-exclamation-circle-fill"></i><span><?= esc(session()->getFlashdata('error')) ?></span></div>
    <?php endif; ?>

    <section class="loan-card">
        <div class="loan-card-top"><h2 class="loan-card-title">Riwayat peminjaman</h2><p class="loan-card-caption">Status setiap transaksi dapat dipantau secara langsung.</p></div>
        <div class="table-responsive"><table class="table loan-table align-middle"><thead><tr><th>No.</th><?php if (in_array(session()->get('role'), ['ADMIN', 'PETUGAS'], true)): ?><th>Peminjam</th><?php endif; ?><th>Buku</th><th>Tgl. Pinjam</th><th>Jatuh Tempo</th><th>Dikembalikan</th><th>Status</th><th>Denda</th><th class="text-end">Aksi</th></tr></thead>
            <tbody>
                <?php $columnCount = in_array(session()->get('role'), ['ADMIN', 'PETUGAS'], true) ? 9 : 8; ?>
                <?php if (empty($riwayat)): ?>
                    <tr><td colspan="<?= $columnCount ?>" class="loan-empty"><i class="bi bi-journal-x"></i>Belum ada riwayat peminjaman.</td></tr>
                <?php else: ?>
                    <?php $no = 1; ?>
                    <?php foreach ($riwayat as $item): ?>
                        <?php
                            $status = $item['status'];
                            $statusClass = $status === 'DIPINJAM' ? 'status-borrowed' : ($status === 'MENUNGGU_VALIDASI' ? 'status-pending' : ($status === 'DIKEMBALIKAN' ? 'status-returned' : 'status-other'));
                            $statusText = $status === 'MENUNGGU_VALIDASI' ? 'Menunggu Validasi' : ucwords(strtolower(str_replace('_', ' ', $status)));
                        ?>
                        <tr>
                            <td class="loan-no"><?= $no++ ?></td>
                            <?php if (in_array(session()->get('role'), ['ADMIN', 'PETUGAS'], true)): ?><td class="loan-person"><?= esc($item['nama']) ?></td><?php endif; ?>
                            <td><div class="loan-book"><span class="loan-book-icon"><i class="bi bi-book"></i></span><span><?= esc($item['judul']) ?></span></div></td>
                            <td class="loan-date"><?= esc($item['tanggal_pinjam']) ?></td><td class="loan-date"><?= esc($item['tanggal_jatuh_tempo']) ?></td><td class="loan-date"><?= esc($item['tanggal_kembali'] ?? '-') ?></td>
                            <td><span class="status-badge <?= $statusClass ?>"><i class="bi <?= $status === 'DIKEMBALIKAN' ? 'bi-check-circle-fill' : ($status === 'MENUNGGU_VALIDASI' ? 'bi-hourglass-split' : 'bi-clock-fill') ?>"></i><?= esc($statusText) ?></span></td>
                            <td class="fine <?= (float) $item['denda'] <= 0 ? 'fine-empty' : '' ?>">Rp <?= number_format((float) $item['denda'], 0, ',', '.') ?></td>
                            <td class="text-end">
                                <?php if (session()->get('role') === 'ANGGOTA'): ?>
                                    <?php if ($status === 'DIPINJAM'): ?><a href="<?= site_url('riwayat/ajukan/' . $item['id']) ?>" class="btn btn-warning loan-action" onclick="return confirm('Ajukan pengembalian buku ini?')"><i class="bi bi-arrow-return-left me-1"></i> Ajukan Kembali</a>
                                    <?php elseif ($status === 'MENUNGGU_VALIDASI'): ?><button class="btn btn-info loan-action" disabled><i class="bi bi-hourglass-split me-1"></i> Menunggu</button>
                                    <?php else: ?><button class="btn btn-light text-muted loan-action" disabled><i class="bi bi-check2 me-1"></i> Selesai</button><?php endif; ?>
                                <?php else: ?>
                                    <?php if ($status === 'MENUNGGU_VALIDASI'): ?><a href="<?= site_url('peminjaman/validasi/' . $item['id']) ?>" class="btn btn-success loan-action" onclick="return confirm('Validasi pengembalian buku ini?')"><i class="bi bi-check2-circle me-1"></i> Validasi</a>
                                    <?php elseif ($status === 'DIPINJAM'): ?><button class="btn btn-warning loan-action" disabled><i class="bi bi-clock me-1"></i> Menunggu</button>
                                    <?php else: ?><button class="btn btn-light text-muted loan-action" disabled><i class="bi bi-check2 me-1"></i> Selesai</button><?php endif; ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table></div>
    </section>
</div>

<?= $this->endSection() ?>
