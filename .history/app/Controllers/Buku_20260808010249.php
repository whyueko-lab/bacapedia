<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Buku extends BaseController
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
}
