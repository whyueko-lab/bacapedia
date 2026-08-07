<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function hash()
    {
        echo password_hash('wahyu123', PASSWORD_DEFAULT);
    }
}