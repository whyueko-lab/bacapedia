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
    public function loginProcess()
    {
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->user->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'Email tidak ditemukan');
        }

        if (!password_verify($password, $user['password'])) {
            return redirect()->back()->with('error', 'Password salah');
        }

        session()->set([
            'user_id' => $user['id'],
            'nama'    => $user['nama'],
            'email'   => $user['email'],
            'role'    => $user['role'],
            'logged_in' => true
        ]);

        return redirect()->to('/dashboard');
    }

    // Logout
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}