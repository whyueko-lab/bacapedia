<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Cek apakah user sudah login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        return view('dashboard', [
            'title' => 'Dashboard'
        ]);
    }
}