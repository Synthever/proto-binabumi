<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.loginPages', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function daftar()
    {
        return view('auth.daftarPages', [
            'name' => 'Daftar - SIGMA'
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

    public function loginManual()   
    {
        return view('auth.loginManual', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function loginManualStep1()   
    {
        return view('auth.loginManual1', [
            'name' => 'Login - SIGMA'
        ]);
    }

    public function forgotPassword()
    {
        return view('auth.forgotPassword', [
            'name' => 'Forgot Password - SIGMA'
        ]);
    }

    public function forgotPasswordVerifikasi()
    {
        return view('auth.forgotPasswordVerifikasi', [
            'name' => 'Forgot Password Verification - SIGMA'
        ]);
    }

    public function forgotPasswordNew()
    {
        return view('auth.forgotPasswordNew', [
            'name' => 'Forgot Password New - SIGMA'
        ]);
    }
}