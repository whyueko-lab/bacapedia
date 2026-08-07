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

        $r

    }

}