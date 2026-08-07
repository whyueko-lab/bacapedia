<?php

namespace App\Filters;

use App\Libraries\JWTLibrary;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
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

            $jwt->verifyToken($token);

        } catch (\Exception $e) {

            return service('response')
                ->setStatusCode(401)
                ->setJSON([
                    'status' => 401,
                    'message' => 'Token tidak valid'
                    'error' => $e->getMessage();
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