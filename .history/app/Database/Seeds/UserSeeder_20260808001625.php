<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [

            [
                'user_id'  => 'USR001',
                'nama'     => 'Administrator',
                'email'    => 'admin@bacapedia.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'role'     => 'ADMIN'
            ],

            [
                'user_id'  => 'USR002',
                'nama'     => 'Petugas',
                'email'    => 'petugas@bacapedia.com',
                'password' => password_hash('petugas123', PASSWORD_DEFAULT),
                'role'     => 'PETUGAS'
            ]

        ];

        $this->db->table('users')->insertBatch($data);
    }
}