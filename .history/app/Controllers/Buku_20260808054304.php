<?php

namespace App\Controllers;

use App\Models\BukuModel;
use CodeIgniter\RESTful\ResourceController;

class Buku extends ResourceController
{
    protected $buku;

    public function __construct()
    {
        $this->buku = new BukuModel();
    }

    public function index()
    {
        $data = $this->buku
            ->select('buku.*, kategori.nama_kategori')
            ->join('kategori', 'kategori.id = buku.kategori_id')
            ->findAll();

        return $this->respond([
            'status' => 200,
            'data' => $data
        ]);
    }

    public function create()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Body harus berupa JSON', 400);
        }

        $rules = [
            'judul' => 'required|min_length[3]',
            'penulis' => 'required|min_length[3]',
            'penerbit' => 'required|min_length[3]',
            'kategori_id' => 'required|integer',
            'stok' => 'required|integer',
            'tahun_terbit' => 'required|integer'
        ];

        if (!$this->validateData($data, $rules)) {
            return $this->failValidationErrors($this->validator->getErrors());
        }

        $this->buku->insert([
            'buku_id' => 'BK' . rand(1000, 9999),
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'kategori_id' => $data['kategori_id'],
            'stok' => $data['stok'],
            'tahun_terbit' => $data['tahun_terbit']
        ]);

        return $this->respondCreated([
            'status' => 201,
            'message' => 'Buku berhasil ditambahkan'
        ]);
    }

    public function update($id = null)
    {
        $buku = $this->buku->find($id);

        if (!$buku) {
            return $this->failNotFound('Buku tidak ditemukan');
        }

        $data = $this->request->getJSON(true);

        $this->buku->update($id, [
            'judul' => $data['judul'],
            'penulis' => $data['penulis'],
            'penerbit' => $data['penerbit'],
            'kategori_id' => $data['kategori_id'],
            'stok' => $data['stok'],
            'tahun_terbit' => $data['tahun_terbit']
        ]);

        return $this->respond([
            'status' => 200,
            'message' => 'Buku berhasil diupdate'
        ]);
    }

    public function delete($id = null)
    {
        $buku = $this->buku->find($id);

        if (!$buku) {
            return $this->failNotFound('Buku tidak ditemukan');
        }

        $this->buku->delete($id);

        return $this->respond([
            'status' => 200,
            'message' => 'Buku berhasil dihapus'
        ]);
    }
}
            'id' => $id
        ]);
    }
}