<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CamController extends Controller
{
    public function index()
    {
        return view('testcam.testcam');
    }

    public function scanResult(Request $request)
    {
        $qrData = $request->query('data', '');
        
        // Process QR data and determine what to do
        $result = $this->processQRData($qrData);
        
        return view('testcam.scan-result', compact('qrData', 'result'));
    }

    private function processQRData($qrData)
    {
        $result = [
            'type' => 'unknown',
            'action' => 'display',
            'message' => 'QR Code berhasil dipindai',
            'data' => $qrData
        ];

        // Check if it's a URL
        if (filter_var($qrData, FILTER_VALIDATE_URL)) {
            $result['type'] = 'url';
            $result['action'] = 'redirect';
            $result['message'] = 'Akan diarahkan ke: ' . $qrData;
        }
        // Check for specific patterns
        else if (stripos($qrData, 'product') !== false) {
            $result['type'] = 'product';
            $result['action'] = 'show_product';
            $result['message'] = 'Produk ditemukan';
        }
        else if (stripos($qrData, 'user') !== false || stripos($qrData, 'profile') !== false) {
            $result['type'] = 'profile';
            $result['action'] = 'show_profile';
            $result['message'] = 'Data profil ditemukan';
        }
        else if (is_numeric($qrData)) {
            $result['type'] = 'number';
            $result['action'] = 'process_number';
            $result['message'] = 'Kode numerik: ' . $qrData;
        }

        return $result;
    }
}
