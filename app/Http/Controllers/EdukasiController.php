<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EdukasiController extends Controller
{
    public function index()
    {
        $active = 'edukasi';
        
        return view('edukasi.index', compact('active'));
    }
}
