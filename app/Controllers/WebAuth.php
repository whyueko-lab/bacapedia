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
            'foto_profil' => $user['foto_profil'] ?? null,
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

    public function profile()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $user = $this->user->find(session()->get('user_id'));

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Akun tidak ditemukan');
        }

        return view('auth/profile', [
            'title' => 'Profil Saya',
            'user' => $user,
        ]);
    }

    public function updateProfile()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $userId = session()->get('user_id');
        $user = $this->user->find($userId);

        if (!$user) {
            session()->destroy();
            return redirect()->to('/login')->with('error', 'Akun tidak ditemukan');
        }

        $rules = [
            'nama' => 'required|min_length[3]|max_length[100]',
            'email' => "required|valid_email|max_length[100]|is_unique[users.email,id,{$userId}]",
            'foto_profil' => 'permit_empty|is_image[foto_profil]|max_size[foto_profil,2048]|mime_in[foto_profil,image/jpg,image/jpeg,image/png,image/webp]',
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        }

        $data = [
            'nama' => $this->request->getPost('nama'),
            'email' => $this->request->getPost('email'),
        ];

        $foto = $this->request->getFile('foto_profil');
        if ($foto && $foto->isValid() && !$foto->hasMoved()) {
            $folder = FCPATH . 'uploads/profiles';
            if (!is_dir($folder)) {
                mkdir($folder, 0755, true);
            }

            $namaFoto = $foto->getRandomName();
            $foto->move($folder, $namaFoto);
            $data['foto_profil'] = $namaFoto;

            if (!empty($user['foto_profil'])) {
                $fotoLama = $folder . DIRECTORY_SEPARATOR . basename($user['foto_profil']);
                if (is_file($fotoLama)) {
                    unlink($fotoLama);
                }
            }
        }

        $this->user->update($userId, $data);
        session()->set([
            'nama' => $data['nama'],
            'email' => $data['email'],
            'foto_profil' => $data['foto_profil'] ?? ($user['foto_profil'] ?? null),
        ]);

        return redirect()->to('/profile')->with('success', 'Profil berhasil diperbarui');
    }

    // Tampilkan halaman register
    public function register()
    {
        if (session()->get('logged_in')) {
            return redirect()->to('/dashboard');
        }

        return view('auth/register');
    }

    // Proses register
    public function registerProcess()
    {
        $nama     = $this->request->getPost('nama');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Cek email sudah dipakai atau belum
        $cek = $this->user->where('email', $email)->first();

        if ($cek) {
            return redirect()->back()->with('error', 'Email sudah digunakan');
        }

        $this->user->insert([
            'user_id'  => 'USR' . rand(1000,9999),
            'nama'     => $nama,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'role'     => 'ANGGOTA'
        ]);

        return redirect()->to('/login')->with('success', 'Registrasi berhasil, silakan login');
    }
}
