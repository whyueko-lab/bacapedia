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