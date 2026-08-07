<?php

namespace App\Controllers;

use App\Models\UserModel;

class WebAuth extends BaseController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    // Tampilkan halaman login
    public function login()
    {
        return view('auth/login');
    }

    // Proses login
    public function login()
{
    // Kalau sudah login, langsung ke dashboard
    if (session()->get('logged_in')) {
        return redirect()->to('/dashboard');
    }

    return view('auth/login');
}

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}