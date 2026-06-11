<?php

namespace App\Controllers;
use App\Core\View;

class AuthController 
{
    public function login()
    {
        View::render('auth/login');
    }
}