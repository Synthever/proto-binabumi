<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\Users;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class ScanController extends Controller
{
    public function index()
    {
        // Logic to display the scan page
        return view('scan.scan');
    }

    /**
     * Show scan success page
     */
    public function success(Request $request)
    {
        // Get current logged in user
        $currentUser = AuthController::getCurrentUser();
        
        if (!$currentUser) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Pass any success data to the view
        $data = [
            'points' => $request->get('points', 100), // Default 100 points
            'machine_id' => $request->get('machine_id', ''),
            'user' => $currentUser
        ];

        return view('scan.scan-success', $data);
    }

    /**
     * Process scan result and validate machine code
     */
    public function processScan(Request $request)
    {
        try {
            // Get current logged in user
            $currentUser = AuthController::getCurrentUser();
            
            if (!$currentUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi. Silakan login kembali.'
                ], 401);
            }

            // Validate request
            $request->validate([
                'machine_code' => 'required|string'
            ]);

            $machineCode = $request->input('machine_code');

            // Load valid codes from JSON file
            $validCodes = $this->loadValidCodes();
            
            if (!$validCodes) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memuat data kode valid. Silakan coba lagi.'
                ], 500);
            }

            // Check if the scanned code is valid
            $isValid = $this->isValidCode($machineCode, $validCodes);
            
            if (!$isValid) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kode mesin tidak valid. Pastikan Anda memindai QR code yang benar.',
                    'scanned_code' => $machineCode
                ], 400);
            }

            // Check if user already has a connection
            $existingConnection = Connection::where('user_id', $currentUser->user_id)->first();
            
            if ($existingConnection) {
                // Update existing connection
                $existingConnection->machine_id = $this->extractMachineId($machineCode);
                $existingConnection->is_connect = true;
                $existingConnection->date_updated = Carbon::now()->format('Y-m-d H:i:s');
                $existingConnection->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil terhubung ke mesin! Koneksi Anda telah diperbarui.',
                    'connection_data' => [
                        'machine_id' => $existingConnection->machine_id,
                        'is_connect' => $existingConnection->is_connect,
                        'date_updated' => $existingConnection->date_updated
                    ]
                ]);
            } else {
                // Create new connection
                $connection = Connection::create([
                    'user_id' => $currentUser->user_id,
                    'machine_id' => $this->extractMachineId($machineCode),
                    'is_connect' => true,
                    'date_created' => Carbon::now()->format('Y-m-d H:i:s'),
                    'date_updated' => Carbon::now()->format('Y-m-d H:i:s'),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil terhubung ke mesin! Koneksi baru telah dibuat.',
                    'connection_data' => [
                        'machine_id' => $connection->machine_id,
                        'is_connect' => $connection->is_connect,
                        'date_created' => $connection->date_created
                    ]
                ]);
            }

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak valid: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            Log::error('Scan processing error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat memproses scan. Silakan coba lagi.'
            ], 500);
        }
    }

    /**
     * Get current user connection status
     */
    public function getConnectionStatus(Request $request)
    {
        try {
            $currentUser = AuthController::getCurrentUser();
            
            if (!$currentUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi.'
                ], 401);
            }

            $connection = Connection::where('user_id', $currentUser->user_id)->first();

            if ($connection) {
                return response()->json([
                    'success' => true,
                    'connection' => [
                        'is_connected' => $connection->is_connect,
                        'machine_id' => $connection->machine_id,
                        'date_created' => $connection->date_created,
                        'date_updated' => $connection->date_updated
                    ]
                ]);
            } else {
                return response()->json([
                    'success' => true,
                    'connection' => [
                        'is_connected' => false,
                        'machine_id' => null,
                        'date_created' => null,
                        'date_updated' => null
                    ]
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Connection status error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mendapatkan status koneksi.'
            ], 500);
        }
    }

    /**
     * Disconnect user from machine
     */
    public function disconnect(Request $request)
    {
        try {
            $currentUser = AuthController::getCurrentUser();
            
            if (!$currentUser) {
                return response()->json([
                    'success' => false,
                    'message' => 'User tidak terautentikasi.'
                ], 401);
            }

            $connection = Connection::where('user_id', $currentUser->user_id)->first();

            if ($connection) {
                $connection->is_connect = false;
                $connection->machine_id = '-';
                $connection->date_updated = Carbon::now()->format('Y-m-d H:i:s');
                $connection->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Berhasil terputus dari mesin.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada koneksi yang ditemukan.'
                ], 404);
            }

        } catch (\Exception $e) {
            Log::error('Disconnect error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal memutuskan koneksi.'
            ], 500);
        }
    }

    /**
     * Load valid codes from JSON file
     */
    private function loadValidCodes()
    {
        try {
            $filePath = public_path('scan-pass/valid-codes.json');
            
            if (!File::exists($filePath)) {
                Log::error('Valid codes file not found: ' . $filePath);
                return null;
            }

            $jsonContent = File::get($filePath);
            $data = json_decode($jsonContent, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                Log::error('Invalid JSON in valid-codes.json: ' . json_last_error_msg());
                return null;
            }

            return $data['validCodes'] ?? [];
        } catch (\Exception $e) {
            Log::error('Error loading valid codes: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Check if the scanned code is valid
     */
    private function isValidCode($scannedCode, $validCodes)
    {
        // Clean the scanned code (remove whitespace, normalize)
        $cleanScannedCode = trim($scannedCode);
        
        foreach ($validCodes as $validCode) {
            $cleanValidCode = trim($validCode);
            
            // Exact match
            if ($cleanScannedCode === $cleanValidCode) {
                return true;
            }
            
            // Check if scanned code contains the valid code (for URL variations)
            if (strpos($cleanScannedCode, $cleanValidCode) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Extract machine ID from the scanned code
     */
    private function extractMachineId($scannedCode)
    {
        // If it's a URL, extract the ID part
        if (filter_var($scannedCode, FILTER_VALIDATE_URL)) {
            $path = parse_url($scannedCode, PHP_URL_PATH);
            $segments = explode('/', trim($path, '/'));
            return end($segments); // Get the last segment as machine ID
        }
        
        // If it's not a URL, use the code as is (but limit length)
        return substr($scannedCode, 0, 50);
    }
}
