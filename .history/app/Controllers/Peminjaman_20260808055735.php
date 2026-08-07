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
}