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
        return $this->respond([
            'message' => 'Create buku'
        ]);
    }

    public function update($id = null)
    {
        return $this->respond([
            'message' => 'Update buku',
            'id' => $id
        ]);
    }

    public function delete($id = null)
    {
        return $this->respond([
            'message' => 'Delete buku',
            'id' => $id
        ]);
    }
}