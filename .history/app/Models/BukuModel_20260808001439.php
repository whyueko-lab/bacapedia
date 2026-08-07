<?php

namespace App\Models;

use CodeIgniter\Model;

class BukuModel extends Model
{
    protected $table = 'buku';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'buku_id',
        'judul',
        'penulis',
        'penerbit',
        'kategori_id',
        'stok',
        'tahun_terbit'
    ];

    protected $useTimestamps = true;
}