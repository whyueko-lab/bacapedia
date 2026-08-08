<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
    protected $table = 'kategori';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'nama_kategori'
    ];

    protected $useTimestamps = true;

    public function storeWeb()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $this->kategori->insert([
            'nama_kategori' => $this->request->getPost('nama')
        ]);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }
}