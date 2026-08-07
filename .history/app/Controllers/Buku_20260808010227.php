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
}
