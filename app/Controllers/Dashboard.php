<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use App\Models\BukuModel;
use App\Models\PeminjamanModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $kategori = new KategoriModel();
        $buku = new BukuModel();
        $peminjaman = new PeminjamanModel();
        $isAnggota = session()->get('role') === 'ANGGOTA';

        $data = [
            'title' => 'Dashboard',
            'isAnggota' => $isAnggota,
        ];

        if ($isAnggota) {
            $userId = session()->get('user_id');
            $data['ringkasanTitle'] = 'Ringkasan aktivitas Anda';
            $data['statistik'] = [
                ['label' => 'Buku Tersedia', 'value' => $buku->where('stok >', 0)->countAllResults(), 'class' => 'stat-books', 'icon' => 'bi-book-half'],
                ['label' => 'Pinjaman Aktif', 'value' => $peminjaman->where('user_id', $userId)->where('status', 'DIPINJAM')->countAllResults(), 'class' => 'stat-borrowed', 'icon' => 'bi-journal-arrow-up'],
                ['label' => 'Menunggu Validasi', 'value' => $peminjaman->where('user_id', $userId)->where('status', 'MENUNGGU_VALIDASI')->countAllResults(), 'class' => 'stat-categories', 'icon' => 'bi-hourglass-split'],
                ['label' => 'Riwayat Selesai', 'value' => $peminjaman->where('user_id', $userId)->where('status', 'DIKEMBALIKAN')->countAllResults(), 'class' => 'stat-returned', 'icon' => 'bi-check2-circle'],
            ];
        } else {
            $data['ringkasanTitle'] = 'Ringkasan koleksi';
            $data['statistik'] = [
                ['label' => 'Total Kategori', 'value' => $kategori->countAll(), 'class' => 'stat-categories', 'icon' => 'bi-tags-fill'],
                ['label' => 'Total Buku', 'value' => $buku->countAll(), 'class' => 'stat-books', 'icon' => 'bi-book-half'],
                ['label' => 'Sedang Dipinjam', 'value' => $peminjaman->where('status', 'DIPINJAM')->countAllResults(), 'class' => 'stat-borrowed', 'icon' => 'bi-arrow-left-right'],
                ['label' => 'Sudah Dikembalikan', 'value' => $peminjaman->where('status', 'DIKEMBALIKAN')->countAllResults(), 'class' => 'stat-returned', 'icon' => 'bi-check2-circle'],
            ];
        }

        return view('dashboard', $data);
    }
}
