<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\BukuModel;
use App\Libraries\JWTLibrary;
use CodeIgniter\RESTful\ResourceController;

class Peminjaman extends ResourceController
{
    protected $peminjaman;
    protected $buku;

    public function __construct()
    {
        $this->peminjaman = new PeminjamanModel();
        $this->buku = new BukuModel();
    }

    public function pinjam()
    {
        $data = $this->request->getJSON(true);

        if (!$data || !isset($data['buku_id'])) {
            return $this->fail('buku_id wajib diisi', 400);
        }

        // Ambil user dari token JWT
        $jwt = new JWTLibrary();
        $header = $this->request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $header);
        $decoded = $jwt->verifyToken($token);

        $userId = $decoded->data->id;

        // Cari buku
        $buku = $this->buku->find($data['buku_id']);

        if (!$buku) {
            return $this->failNotFound('Buku tidak ditemukan');
        }

        // Aturan 1: stok harus tersedia
        if ($buku['stok'] <= 0) {
            return $this->fail('Stok buku habis', 422);
        }

        // Aturan 2: maksimal 3 buku aktif
        $jumlahAktif = $this->peminjaman
            ->where('user_id', $userId)
            ->where('status', 'DIPINJAM')
            ->countAllResults();

        if ($jumlahAktif >= 3) {
            return $this->fail('Maksimal peminjaman aktif adalah 3 buku', 422);
        }

        $tanggalPinjam = date('Y-m-d');
        $tanggalJatuhTempo = date('Y-m-d', strtotime('+7 days'));

        $this->peminjaman->insert([
            'user_id' => $userId,
            'buku_id' => $data['buku_id'],
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_jatuh_tempo' => $tanggalJatuhTempo,
            'status' => 'DIPINJAM',
            'denda' => 0
        ]);

        // Kurangi stok
        $this->buku->update($buku['id'], [
            'stok' => $buku['stok'] - 1
        ]);

        return $this->respondCreated([
            'status' => 201,
            'message' => 'Peminjaman berhasil',
            'tanggal_pinjam' => $tanggalPinjam,
            'tanggal_jatuh_tempo' => $tanggalJatuhTempo
        ]);
    }

    public function kembalikan($id = null)
    {
        $pinjam = $this->peminjaman->find($id);

        if (!$pinjam) {
            return $this->failNotFound('Data peminjaman tidak ditemukan');
        }

        if ($pinjam['status'] === 'DIKEMBALIKAN') {
            return $this->fail('Buku sudah dikembalikan', 409);
        }

        $tanggalKembali = date('Y-m-d');
        $jatuhTempo = strtotime($pinjam['tanggal_jatuh_tempo']);
        $kembali = strtotime($tanggalKembali);

        $denda = 0;

        if ($kembali > $jatuhTempo) {
            $hariTerlambat = floor(($kembali - $jatuhTempo) / (60 * 60 * 24));
            $denda = $hariTerlambat * 2000;
        }

        // Update peminjaman
        $this->peminjaman->update($id, [
            'tanggal_kembali' => $tanggalKembali,
            'status' => 'DIKEMBALIKAN',
            'denda' => $denda
        ]);

        // Tambah stok buku
        $buku = $this->buku->find($pinjam['buku_id']);

        $this->buku->update($buku['id'], [
            'stok' => $buku['stok'] + 1
        ]);

        return $this->respond([
            'status' => 200,
            'message' => 'Buku berhasil dikembalikan',
            'tanggal_kembali' => $tanggalKembali,
            'denda' => $denda
        ]);
    }
}