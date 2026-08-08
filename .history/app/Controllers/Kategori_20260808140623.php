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
        $data = $this->request->getJSON(true);

        if (!$data) {

            return $this->fail('Body harus JSON',400);

        }

        $rules = [

            'nama_kategori'=>'required|min_length[3]'

        ];

        if(!$this->validateData($data,$rules)){

            return $this->failValidationErrors(

                $this->validator->getErrors()

            );

        }

        $this->kategori->insert([

            'nama_kategori'=>$data['nama_kategori']

        ]);

        return $this->respondCreated([

            'status'=>201,

            'message'=>'Kategori berhasil ditambahkan'

        ]);
    }

    public function update($id = null)
    {
        $kategori = $this->kategori->find($id);

        if(!$kategori){

            return $this->failNotFound(

                'Kategori tidak ditemukan'

            );

        }

        $data = $this->request->getJSON(true);

        $this->kategori->update($id,[

            'nama_kategori'=>$data['nama_kategori']

        ]);

        return $this->respond([

            'status'=>200,

            'message'=>'Kategori berhasil diupdate'

        ]);
    }

    public function delete($id = null)
    {
        $kategori = $this->kategori->find($id);

        if (!$kategori) {
            return $this->failNotFound('Kategori tidak ditemukan');
        }

        $this->kategori->delete($id);

        return $this->respond([
            'status' => 200,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }

    public function web()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('kategori/index', [
            'title' => 'Data Kategori',
            'kategori' => $this->kategori->findAll()
        ]);
    }

    public function createWeb()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('kategori/form', [
            'title' => 'Tambah Kategori',
            'action' => '/kategori/tambah',
            'kategoriData' => null
        ]);
    }

    public function storeWeb()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $this->kategori->insert([
            'nama' => $this->request->getPost('nama')
        ]);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function editWeb($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('kategori/form', [
            'title' => 'Edit Kategori',
            'action' => '/kategori/edit/' . $id,
            'kategoriData' => $this->kategori->find($id)
        ]);
    }

    public function updateWeb($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $this->kategori->update($id, [
            'nama' => $this->request->getPost('nama')
        ]);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil diupdate');
    }

    public function deleteWeb($id)
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $this->kategori->delete($id);

        return redirect()->to('/kategori')->with('success', 'Kategori berhasil dihapus');
    }

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