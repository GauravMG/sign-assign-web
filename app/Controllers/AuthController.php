<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsersModel;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    // public function register()
    // {
    //     return view('auth/register');
    // }

    public function forgotPassword()
    {
        return view('auth/forgot-password');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
}
