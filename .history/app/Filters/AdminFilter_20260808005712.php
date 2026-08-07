<?php

namespace App\Filters;

use App\Libraries\JWTLibrary;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AdminFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $header = $request->getHeaderLine('Authorization');

        if (!$header) {
            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 401,
                    'message' => 'Token tidak ditemukan'
                ]);
        }

        $token = str_replace('Bearer ', '', $header);

        try {

            $jwt = new JWTLibrary();

            $decoded = $jwt->verifyToken($token);

            if ($decoded->data->role != 'ADMIN') {

                return service('response')
                    ->setStatusCode(403)
                    ->setJSON([
                        'status' => 403,
                        'message' => 'Hanya Admin yang boleh mengakses'
                    ]);
            }

        } catch (\Exception $e) {

            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 401,
                    'message' => 'Token tidak valid'
                ]);
        }
    }

    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
    }
}