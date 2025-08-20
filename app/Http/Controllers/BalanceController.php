<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Connection;
use App\Models\Statistic;

class BalanceController extends Controller
{
    public function add(Request $request)
    {
        $machineId = $request->query('machine_id');
        
        // Validasi jika machine_id tidak ada
        if (!$machineId) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Machine ID is required'
            ], 400);
        }

        try {
            // Cari user yang memiliki machine_id yang sama di table users_connections
            $connection = Connection::where('machine_id', $machineId)->first();
            
            // Jika tidak ditemukan connection dengan machine_id tersebut
            if (!$connection) {
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'No user found with this machine ID'
                ]);
            }
            
            // Pastikan is_connect bernilai true
            if (!$connection->is_connect) {
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'User is not connected to this machine'
                ]);
            }
            
            // Ambil user_id dari connection
            $userId = $connection->user_id;
            
            // Cari user statistics berdasarkan user_id
            $statistic = Statistic::where('user_id', $userId)->first();
            
            if (!$statistic) {
                return response()->json([
                    'status' => 'invalid',
                    'message' => 'User statistics not found'
                ]);
            }
            
            // Tambahkan balance sebanyak 100
            $currentBalance = (int) $statistic->balance;
            $newBalance = $currentBalance + 100;
            
            // Update balance dan date_updated
            $statistic->update([
                'balance' => (string) $newBalance,
                'date_updated' => date('Y-m-d H:i:s')
            ]);
            
            return response()->json([
                'status' => 'valid',
                'message' => 'Balance successfully added',
                'data' => [
                    'user_id' => $userId,
                    'machine_id' => $machineId,
                    'previous_balance' => $currentBalance,
                    'added_amount' => 100,
                    'new_balance' => $newBalance
                ]
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'invalid',
                'message' => 'Error processing request: ' . $e->getMessage()
            ], 500);
        }
    }
}
