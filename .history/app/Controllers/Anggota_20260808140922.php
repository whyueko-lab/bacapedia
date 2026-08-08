<?php

namespace App\Controllers;

use App\Models\UserModel;

class Anggota extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function web()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $data = $this->user
            ->where('role', 'ANGGOTA')
            ->findAll();

        return view('anggota/index', [
            'title' => 'Data Anggota',
            'anggota' => $data
        ]);
    }   
}