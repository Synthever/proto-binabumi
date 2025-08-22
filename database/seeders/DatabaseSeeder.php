<?php

namespace Database\Seeders;

use App\Models\Users;
use App\Models\Statistic;
use App\Models\Connection;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Check if test user already exists to avoid duplicate entry
        $existingUser = Users::where('user_id', '666')->first();
        
        if (!$existingUser) {
            // Create a test user with the custom fields structure
            $user = Users::create([
                'user_id' => '666',
                'username' => 'rey',
                'name' => 'Raekhandi Yoga',
                'no_handphone' => '085158338027',
                'email' => 'rey@example.com',
                'password' => bcrypt('Qwerty@21'),
                'is_login' => false, // Default to false
                'profile_picture' => null,
                'date_created' => now()->format('Y-m-d H:i:s'), // Updated format to match migration
                'date_updated' => now()->format('Y-m-d H:i:s'), // Updated format to match migration
            ]);

            // Create corresponding statistic record
            Statistic::create([
                'user_id' => '666',
                'balance' => '10000',
                'poin' => 50,
                'bottle_count' => 10,
                'date_created' => now()->format('Y-m-d H:i:s'), // Updated format to match migration
                'date_updated' => now()->format('Y-m-d H:i:s'), // Updated format to match migration
            ]);

            // Create corresponding connection record
            Connection::create([
                'user_id' => '666',
                'is_connect' => true,
                'machine_id' => '6v8f37wfvo2f',
                'date_created' => now()->format('Y-m-d H:i:s'), // Updated format to match migration
                'date_updated' => now()->format('Y-m-d H:i:s'), // Updated format to match migration
            ]);
            
            echo "Test user with ID 666 created successfully.\n";
        } else {
            echo "Test user with ID 666 already exists, skipping creation.\n";
        }

        // Create additional test users for better testing
        $this->createAdditionalTestUsers();
    }

    /**
     * Create additional test users for comprehensive testing
     */
    private function createAdditionalTestUsers(): void
    {
        $testUsers = [
            [
                'user_id' => '12345',
                'username' => 'testuser1',
                'name' => 'Test User 1',
                'email' => 'testuser1@example.com',
                'machine_id' => 'MACHINE001',
                'is_connect' => true,
                'balance' => '5000'
            ],
            [
                'user_id' => '54321',
                'username' => 'testuser2',
                'name' => 'Test User 2',
                'email' => 'testuser2@example.com',
                'machine_id' => 'MACHINE002',
                'is_connect' => false,
                'balance' => '7500'
            ],
            [
                'user_id' => '99999',
                'username' => 'testuser3',
                'name' => 'Test User 3',
                'email' => 'testuser3@example.com',
                'machine_id' => 'MACHINE003',
                'is_connect' => true,
                'balance' => '2000'
            ]
        ];

        foreach ($testUsers as $userData) {
            // Check if user already exists
            $existingUser = Users::where('user_id', $userData['user_id'])->first();
            
            if (!$existingUser) {
                // Create user
                Users::create([
                    'user_id' => $userData['user_id'],
                    'username' => $userData['username'],
                    'name' => $userData['name'],
                    'no_handphone' => '-',
                    'email' => $userData['email'],
                    'password' => bcrypt('password123'),
                    'is_login' => false,
                    'profile_picture' => null,
                    'date_created' => now()->format('Y-m-d H:i:s'),
                    'date_updated' => now()->format('Y-m-d H:i:s'),
                ]);

                // Create corresponding statistic record
                Statistic::create([
                    'user_id' => $userData['user_id'],
                    'balance' => $userData['balance'],
                    'poin' => rand(10, 100),
                    'bottle_count' => rand(1, 20),
                    'date_created' => now()->format('Y-m-d H:i:s'),
                    'date_updated' => now()->format('Y-m-d H:i:s'),
                ]);

                // Create corresponding connection record
                Connection::create([
                    'user_id' => $userData['user_id'],
                    'is_connect' => $userData['is_connect'],
                    'machine_id' => $userData['machine_id'],
                    'date_created' => now()->format('Y-m-d H:i:s'),
                    'date_updated' => now()->format('Y-m-d H:i:s'),
                ]);
                
                echo "Test user {$userData['username']} (ID: {$userData['user_id']}) created successfully.\n";
            } else {
                echo "Test user {$userData['username']} (ID: {$userData['user_id']}) already exists, skipping.\n";
            }
        }
    }
}
