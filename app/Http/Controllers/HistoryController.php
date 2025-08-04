<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return view('history/HistoryMain');
    }

    public function detailTransaksi($id)
    {
        return view('history.detail-transaksi');
    }

    public function detailTransaksiDua($id)
    {
        return view('history.detail-transaksi-2');
    }

    public function detailTransaksiTiga($id)
    {
        return view('history.detail-transaksi-3');
    }

    public function detailTransaksiEmpat($id)
    {
        return view('history.detail-transaksi-4');
    }

    public function detailTransaksiLima($id)
    {
        return view('history.detail-transaksi-5');
    }

    public function detailTransaksiEnam($id)
    {
        return view('history.detail-transaksi-6');
    }

    public function downloadBuktiTransfer($id)
    {
        // Logika untuk mengunduh bukti transfer akan ditambahkan di sini
        return response()->json([
            'message' => 'Fitur download bukti transfer akan segera tersedia'
        ]);
    }
}