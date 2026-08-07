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

        return view('dashboard', [
            'title' => 'Dashboard',
            'jumlahKategori' => $kategori->countAll(),
            'jumlahBuku' => $buku->countAll(),
            'sedangDipinjam' => $peminjaman->where('status', 'DIPINJAM')->countAllResults(),
            'sudahKembali' => $peminjaman->where('status', 'DIKEMBALIKAN')->countAllResults(),
        ]);
    }
}