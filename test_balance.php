<?php

// Test script untuk membuat test data dan test BalanceController
require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "=== Testing BalanceController::add() ===\n\n";

try {
    // 1. Buat user test jika belum ada
    $testUserId = 'TEST12345';
    $testMachineId = 'MACHINE001';
    
    echo "1. Creating test user...\n";
    $user = \App\Models\Users::where('user_id', $testUserId)->first();
    
    if (!$user) {
        $currentDateTime = date('Y-m-d H:i:s');
        
        $user = \App\Models\Users::create([
            'user_id' => $testUserId,
            'username' => 'testuser_balance',
            'name' => 'Test User Balance',
            'no_handphone' => '-',
            'email' => 'testbalance@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'is_login' => false,
            'date_created' => $currentDateTime,
            'date_updated' => $currentDateTime,
        ]);
        
        echo "✅ Test user created: {$testUserId}\n";
    } else {
        echo "✅ Test user already exists: {$testUserId}\n";
    }
    
    // 2. Update connection dengan machine_id dan set is_connect = true
    echo "\n2. Setting up connection data...\n";
    $connection = \App\Models\Connection::where('user_id', $testUserId)->first();
    
    if ($connection) {
        $connection->update([
            'machine_id' => $testMachineId,
            'is_connect' => true,
            'date_updated' => date('Y-m-d H:i:s')
        ]);
        echo "✅ Connection updated: Machine ID = {$testMachineId}, Is Connect = true\n";
    } else {
        echo "❌ Connection not found for user {$testUserId}\n";
        exit;
    }
    
    // 3. Cek current balance
    echo "\n3. Checking current balance...\n";
    $statistic = \App\Models\Statistic::where('user_id', $testUserId)->first();
    
    if ($statistic) {
        $currentBalance = (int) $statistic->balance;
        echo "✅ Current balance: {$currentBalance}\n";
    } else {
        echo "❌ Statistic not found for user {$testUserId}\n";
        exit;
    }
    
    // 4. Test function add balance
    echo "\n4. Testing BalanceController::add()...\n";
    echo "Test URL: http://127.0.0.1:8000/saldo/add?machine_id={$testMachineId}\n";
    
    // Simulate the request
    $controller = new \App\Http\Controllers\BalanceController();
    $request = new \Illuminate\Http\Request();
    $request->merge(['machine_id' => $testMachineId]);
    
    $response = $controller->add($request);
    $responseData = json_decode($response->getContent(), true);
    
    echo "Response Status: " . $response->getStatusCode() . "\n";
    echo "Response Data:\n";
    print_r($responseData);
    
    // 5. Verify balance update
    echo "\n5. Verifying balance update...\n";
    $updatedStatistic = \App\Models\Statistic::where('user_id', $testUserId)->first();
    $newBalance = (int) $updatedStatistic->balance;
    
    echo "Previous balance: {$currentBalance}\n";
    echo "New balance: {$newBalance}\n";
    echo "Difference: " . ($newBalance - $currentBalance) . "\n";
    
    if ($newBalance == $currentBalance + 100) {
        echo "✅ Balance correctly updated!\n";
    } else {
        echo "❌ Balance update failed!\n";
    }
    
    echo "\n=== Test Results ===\n";
    echo "• Function works: " . ($responseData['status'] === 'valid' ? '✅ YES' : '❌ NO') . "\n";
    echo "• Balance added: " . ($newBalance == $currentBalance + 100 ? '✅ YES' : '❌ NO') . "\n";
    echo "• Response message: " . $responseData['message'] . "\n";
    
    // 6. Test invalid case (machine not connected)
    echo "\n6. Testing invalid case (is_connect = false)...\n";
    $connection->update(['is_connect' => false]);
    
    $invalidRequest = new \Illuminate\Http\Request();
    $invalidRequest->merge(['machine_id' => $testMachineId]);
    
    $invalidResponse = $controller->add($invalidRequest);
    $invalidResponseData = json_decode($invalidResponse->getContent(), true);
    
    echo "Invalid case response:\n";
    print_r($invalidResponseData);
    
    // Reset connection for future tests
    $connection->update(['is_connect' => true]);
    
} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
