<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ScanController extends Controller
{
    public function index()
    {
        // Logic to display the scan page
        return view('scan.scan');
    }
}
