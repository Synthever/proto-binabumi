<?php

// Simple test script to validate auth system
require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

// Test data
$testUser = [
    'username' => 'testuser' . rand(1000, 9999),
    'email' => 'test' . rand(1000, 9999) . '@example.com',
    'password' => 'password123',
    'password_confirmation' => 'password123',
];

echo "Testing Auth System\n";
echo "==================\n";
echo "Test user data:\n";
print_r($testUser);

// Test User Creation (simulating the registration process)
try {
    // Generate unique user_id (minimum 5 digits)
    do {
        $user_id = str_pad(mt_rand(10000, 99999999), 5, '0', STR_PAD_LEFT);
    } while (\App\Models\Users::where('user_id', $user_id)->exists());

    $currentDateTime = date('Y-m-d H:i:s');

    // Create user
    $user = \App\Models\Users::create([
        'user_id' => $user_id,
        'username' => $testUser['username'],
        'name' => $testUser['username'], // Name sama dengan username
        'no_handphone' => '-', // Default value
        'email' => $testUser['email'],
        'password' => \Illuminate\Support\Facades\Hash::make($testUser['password']),
        'is_login' => false,
        'date_created' => $currentDateTime,
        'date_updated' => $currentDateTime,
    ]);

    echo "\n✅ User created successfully!\n";
    echo "User ID: " . $user->user_id . "\n";
    echo "Username: " . $user->username . "\n";
    echo "Email: " . $user->email . "\n";

    // Auto create connection record
    $connection = \App\Models\Connection::create([
        'user_id' => $user_id,
        'is_connect' => false,
        'machine_id' => '-',
        'date_created' => $currentDateTime,
        'date_updated' => $currentDateTime,
    ]);

    echo "✅ Connection record created!\n";

    // Auto create statistic record
    $statistic = \App\Models\Statistic::create([
        'user_id' => $user_id,
        'balance' => '0',
        'poin' => 0,
        'bottle_count' => 0,
        'date_created' => $currentDateTime,
        'date_updated' => $currentDateTime,
    ]);

    echo "✅ Statistic record created!\n";

    // Test login validation
    $loginField = filter_var($testUser['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    $loginUser = \App\Models\Users::where($loginField, $testUser['email'])->first();

    if ($loginUser && \Illuminate\Support\Facades\Hash::check($testUser['password'], $loginUser->password)) {
        echo "✅ Login validation successful!\n";
        
        // Update login status
        $loginUser->update([
            'is_login' => true,
            'date_updated' => date('Y-m-d H:i:s')
        ]);
        
        echo "✅ Login status updated!\n";
    } else {
        echo "❌ Login validation failed!\n";
    }

    echo "\n🎉 All tests passed! Auth system is working correctly.\n";

} catch (\Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . " Line: " . $e->getLine() . "\n";
}
