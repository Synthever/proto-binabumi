<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $welcomeData = [
            'title' => 'Transformasi Pengelolaan Sampah Plastik di Indonesia',
            'subtitle' => 'Biru Bumi menghadirkan solusi inovatif bersama mesin pintar SIGMA yang mengubah botol plastik menjadi E-Money, untuk Indonesia yang lebih bersih dan bermilai.',
            'images' => [
                'bg-1' => asset('assets/images/welcome/bg-1.jpg'),
                'bg-2' => asset('assets/images/welcome/bg-2.jpg'),
                'bg-3' => asset('assets/images/welcome/bg-3.jpg'),
                'bg-4' => asset('assets/images/welcome/bg-4.jpg'),
                'bg-5' => asset('assets/images/welcome/bg-5.jpg'),
                'bg-6' => asset('assets/images/welcome/bg-6.jpg'),
            ]
        ];

        return view('welcome.index', compact('welcomeData'));
    }

    public function start()
    {
        // Redirect ke halaman beranda setelah user klik mulai
        return redirect()->route('beranda');
    }
}
