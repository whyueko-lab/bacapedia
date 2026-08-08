<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\JWTLibrary;

class StaffFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');

        if (!$header) {
            return service('response')->setJSON([
                'status' => 401,
                'message' => 'Token tidak ditemukan'
            ])->setStatusCode(401);
        }

        $token = str_replace('Bearer ', '', $header);

        try {
            $jwt = new JWTLibrary();
            $decoded = $jwt->verifyToken($token);

            $role = $decoded->data->role;

            if ($role !== 'ADMIN' && $role !== 'PETUGAS') {
                return service('response')->setJSON([
                    'status' => 403,
                    'message' => 'Hanya Admin atau Petugas yang dapat mengakses endpoint ini'
                ])->setStatusCode(403);
            }

        } catch (\Exception $e) {
            return service('response')->setJSON([
                'status' => 401,
                'message' => 'Token tidak valid'
            ])->setStatusCode(401);
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}