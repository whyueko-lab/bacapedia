<?php

namespace App\Controllers;

use App\Models\KategoriModel;
use CodeIgniter\RESTful\ResourceController;

class Kategori extends ResourceController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }

    public function index()
    {
        return $this->respond([
            'status' => 200,
            'data' => $this->kategori->findAll()
        ]);
    }
}