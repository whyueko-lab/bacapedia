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

        // User yang sedang login
        $userId = $decoded->data->id;

        // Hanya anggota yang boleh meminjam
        if ($decoded->data->role !== 'ANGGOTA') {
            return $this->failForbidden('Hanya anggota yang dapat meminjam buku');
        }

        // Cari buku
        $buku = $this->buku->find($data['buku_id']);

        if (!$buku) {
            return $this->failNotFound('Buku tidak ditemukan');
        }

        if ($buku['stok'] <= 0) {
            return $this->fail('Stok buku habis', 422);
        }

        // Maksimal 3 buku aktif
        $jumlahAktif = $this->peminjaman
            ->where('user_id', $userId)
            ->where('status', 'DIPINJAM')
            ->countAllResults();

        if ($jumlahAktif >= 3) {
            return $this->fail('Maksimal peminjaman aktif adalah 3 buku', 422);
        }

        // Cegah meminjam buku yang sama dua kali
        $sudahPinjam = $this->peminjaman
            ->where('user_id', $userId)
            ->where('buku_id', $data['buku_id'])
            ->where('status', 'DIPINJAM')
            ->first();

        if ($sudahPinjam) {
            return $this->fail('Buku ini masih sedang Anda pinjam', 409);
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
        // Verifikasi token dan role
        $jwt = new JWTLibrary();
        $header = $this->request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $header);
        $decoded = $jwt->verifyToken($token);

        $role = $decoded->data->role;

        // Hanya ADMIN/PETUGAS yang boleh memproses pengembalian
        if ($role !== 'ADMIN' && $role !== 'PETUGAS') {
            return $this->failForbidden('Hanya Admin/Petugas yang dapat memproses pengembalian buku');
        }

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

    public function index()
    {
        $jwt = new JWTLibrary();

        $header = $this->request->getHeaderLine('Authorization');
        $token = str_replace('Bearer ', '', $header);
        $decoded = $jwt->verifyToken($token);

        $userId = $decoded->data->id;
        $role   = $decoded->data->role;

        if ($role === 'ADMIN' || $role === 'PETUGAS') {

            $data = $this->peminjaman
                ->select('peminjaman.*, users.nama, buku.judul')
                ->join('users', 'users.id = peminjaman.user_id')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->findAll();

        } else {

            $data = $this->peminjaman
                ->select('peminjaman.*, buku.judul')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->where('peminjaman.user_id', $userId)
                ->findAll();
        }

        return $this->respond([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function pinjamWeb($bukuId)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');

        // Cek buku
        $buku = $this->buku->find($bukuId);

        if (!$buku) {
            return redirect()->back()->with('error', 'Buku tidak ditemukan');
        }

        if ($buku['stok'] <= 0) {
            return redirect()->back()->with('error', 'Stok buku habis');
        }

        // Maksimal 3 buku aktif
        $jumlahAktif = $this->peminjaman
            ->where('user_id', $userId)
            ->where('status', 'DIPINJAM')
            ->countAllResults();

        if ($jumlahAktif >= 3) {
            return redirect()->back()->with('error', 'Maksimal peminjaman aktif adalah 3 buku');
        }

        // Cegah pinjam buku yang sama dua kali
        $sudahPinjam = $this->peminjaman
            ->where('user_id', $userId)
            ->where('buku_id', $bukuId)
            ->where('status', 'DIPINJAM')
            ->first();

        if ($sudahPinjam) {
            return redirect()->back()->with('error', 'Buku ini masih sedang Anda pinjam');
        }

        $this->peminjaman->insert([
            'user_id' => $userId,
            'buku_id' => $bukuId,
            'tanggal_pinjam' => date('Y-m-d'),
            'tanggal_jatuh_tempo' => date('Y-m-d', strtotime('+7 days')),
            'status' => 'DIPINJAM',
            'denda' => 0
        ]);

        // Kurangi stok
        $this->buku->update($bukuId, [
            'stok' => $buku['stok'] - 1
        ]);

        return redirect()->to('/riwayat')->with('success', 'Buku berhasil dipinjam');
    }

    public function web()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $role   = session()->get('role');

        if ($role === 'ADMIN' || $role === 'PETUGAS') {

            $data = $this->peminjaman
                ->select('peminjaman.*, users.nama, buku.judul')
                ->join('users', 'users.id = peminjaman.user_id')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->orderBy('peminjaman.id', 'DESC')
                ->findAll();

        } else {

            $data = $this->peminjaman
                ->select('peminjaman.*, buku.judul')
                ->join('buku', 'buku.id = peminjaman.buku_id')
                ->where('peminjaman.user_id', $userId)
                ->orderBy('peminjaman.id', 'DESC')
                ->findAll();
        }

        return view('peminjaman/index', [
            'title' => 'Riwayat Peminjaman',
            'riwayat' => $data
        ]);
    }

    public function kembalikanWeb($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $pinjam = $this->peminjaman->find($id);

        if (!$pinjam) {
            return redirect()->back()->with('error', 'Data peminjaman tidak ditemukan');
        }

        if ($pinjam['status'] === 'DIKEMBALIKAN') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan');
        }

        $tanggalKembali = date('Y-m-d');
        $jatuhTempo = strtotime($pinjam['tanggal_jatuh_tempo']);
        $kembali = strtotime($tanggalKembali);

        $denda = 0;

        if ($kembali > $jatuhTempo) {
            $hariTerlambat = floor(($kembali - $jatuhTempo) / (60 * 60 * 24));
            $denda = $hariTerlambat * 2000;
        }

        $this->peminjaman->update($id, [
            'tanggal_kembali' => $tanggalKembali,
            'status' => 'DIKEMBALIKAN',
            'denda' => $denda
        ]);

        $buku = $this->buku->find($pinjam['buku_id']);

        $this->buku->update($buku['id'], [
            'stok' => $buku['stok'] + 1
        ]);

        return redirect()->to('/riwayat')->with('success', 'Buku berhasil dikembalikan');
    }

    public function laporan()
    {
        $data = $this->peminjaman
            ->select('peminjaman.*, users.nama, buku.judul')
            ->join('users', 'users.id = peminjaman.user_id')
            ->join('buku', 'buku.id = peminjaman.buku_id')
            ->orderBy('peminjaman.id', 'DESC')
            ->findAll();

        return $this->respond([
            'status' => 200,
            'data' => $data
        ]);
    }
}