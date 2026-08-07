<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\RESTful\ResourceController;

class Auth extends ResourceController
{
    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }

    public function register()
    {
        $data = $this->request->getJSON(true);

        if(!$data){

            return $this->fail(
                'Body request harus JSON',
                400
            );

        }

        $rules = [
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (!$this->validate($rules)) {
            return $this->fail($this->validator->getErrors(), 400);
        }

        $user = $this->user
            ->where('email',$data['email'])
            ->first();

        if($user){

            return $this->fail(

                'Email sudah digunakan',

                409

            );

        }

        $this->user->insert([

        'user_id'=>'USR'.rand(1000,9999),

        'nama'=>$data['nama'],

        'email'=>$data['email'],

        'password'=>password_hash(

            $data['password'],

            PASSWORD_DEFAULT

        ),

        'role'=>'ANGGOTA'

    ]);

            return $this->respondCreated([

                'message'=>'User berhasil didaftarkan'

            ]);

    }

    public function login()
    {
        $data = $this->request->getJSON(true);

        if (!$data) {
            return $this->fail('Body request harus berupa JSON', 400);
        }

        // Cari user berdasarkan email
        $user = $this->user
            ->where('email', $data['email'])
            ->first();

        if (!$user) {
            return $this->failUnauthorized('Email tidak ditemukan');
        }

        // Cek password
        if (!password_verify($data['password'], $user['password'])) {
            return $this->failUnauthorized('Password salah');
        }

        // Generate JWT
        $jwt = new \App\Libraries\JWTLibrary();

        $token = $jwt->generateToken($user);

        return $this->respond([
            'status' => 200,
            'message' => 'Login berhasil',
            'token' => $token,
            'user' => [
                'id' => $user['id'],
                'nama' => $user['nama'],
                'email' => $user['email'],
                'role' => $user['role']
            ]
        ]);
    }

}