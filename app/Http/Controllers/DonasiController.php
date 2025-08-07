<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DonasiController extends Controller
{
    public function index()
    {
        return view('donasi.DonasiMain');
    }

    public function BiodataDonatur()
    {
        return view('donasi.BiodataDonatur');
    }

    public function BuktiTF(Request $request)
    {
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'nominal' => 'required|string|max:255',
        ]);

        return view('donasi.BuktiTF', $validated);
    }

    public function UploadBuktiTF()
    {
        return view('donasi.upload-BuktiTF');
    }
}