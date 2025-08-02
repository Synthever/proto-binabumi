<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.loginPages', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function googleLogin()
    {
        return view('auth.loginPages1', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function googleStep1()   
    {
        return view('auth.loginPages2', [
            'name' => 'Login - SIGMA'
        ]);
    }
}