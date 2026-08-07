<?php

namespace App\Libraries;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTLibrary
{
    // Secret Key
    private $key = "BACAPEDIA_SECRET_KEY_2026";

    public function generateToken($user)
    {
        $payload = [
            'iss' => 'bacapedia',
            'aud' => 'bacapedia-user',
            'iat' => time(),
            'exp' => time() + (60 * 60 * 24), // 1 hari

            'data' => [

                'id'      => $user['id'],
                'user_id' => $user['user_id'],
                'nama'    => $user['nama'],
                'email'   => $user['email'],
                'role'    => $user['role']

            ]
        ];

        return JWT::encode($payload, $this->key, 'HS256');
    }

    public function verifyToken($token)
    {
        return JWT::decode($token, new Key($this->key, 'HS256'));
    }
}