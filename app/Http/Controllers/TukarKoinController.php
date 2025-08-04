<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TukarKoinController extends Controller
{
    public function index()
    {
        // Sample data untuk testing - nanti bisa diganti dengan data dari database
        $userData = [
            'name' => 'Pamela Tri Anjani',
            'koin' => 150,
            'saldo' => 0,
            'conversion_rate' => 100, // 1 koin = Rp 100
        ];

        $tukarOptions = [
            [
                'amount' => 10,
                'value' => 1000,
                'available' => true
            ],
            [
                'amount' => 25,
                'value' => 2500,
                'available' => true
            ],
            [
                'amount' => 50,
                'value' => 5000,
                'available' => true
            ],
            [
                'amount' => 100,
                'value' => 10000,
                'available' => false // Tidak tersedia jika koin user kurang
            ]
        ];

        return view('tukar-koin.index', compact('userData', 'tukarOptions'));
    }

    public function exchange(Request $request)
    {
        $amount = $request->get('amount');
        
        // Logic untuk proses tukar koin
        // Nanti bisa ditambahkan validasi dan update database
        
        return redirect()->route('tukar-koin')->with('success', 'Berhasil menukar ' . $amount . ' koin');
    }
}