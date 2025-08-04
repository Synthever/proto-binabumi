<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BerandaController extends Controller
{
    public function index()
    {
        // Sample data untuk testing - nanti bisa diganti dengan data dari database
        $userData = [
            'name' => 'Pamela Tri Anjani',
            'location' => 'Lokasi Kamu',
            'saldo' => 0,
            'koin' => 0,
            'botol' => 0,
            'pengumpulan' => 0,
            'berhasil' => 0,
            'pending' => 0
        ];

        return view('beranda.beranda', compact('userData'));
    }
}
