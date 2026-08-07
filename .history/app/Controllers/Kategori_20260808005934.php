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

    public function create()
    {
        return $this->respond([
            'message' => 'Create kategori'
        ]);
    }

    public function update($id = null)
    {
        return $this->respond([
            'message' => 'Update kategori',
            'id' => $id
        ]);
    }

    public function delete($id = null)
    {
        return $this->respond([
            'message' => 'Delete kategori',
            'id' => $id
        ]);
    }
}