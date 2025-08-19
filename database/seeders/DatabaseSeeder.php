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
        // Create a test user with the custom fields structure
        Users::create([
            'user_id' => '666',
            'username' => 'rey',
            'name' => 'Raekhandi Yoga',
            'no_handphone' => '085158338027',
            'email' => 'rey@example.com',
            'password' => bcrypt('Rey@21'),
            'is_login' => false, // Default to false
            'date_created' => now()->format('d-m-Y H:i'),
            'date_updated' => now()->format('d-m-Y H:i'),
        ]);

        Statistic::create([
            'user_id' => '666',
            'balance' => '10000',
            'poin' => 50,
            'bottle_count' => 10,
            'date_created' => now()->format('d-m-Y H:i'),
            'date_updated' => now()->format('d-m-Y H:i'),
        ]);

        Connection::create([
            'user_id' => '666',
            'is_connect' => true,
            'machine_id' => 'MCH001',
            'date_created' => now()->format('d-m-Y H:i'),
            'date_updated' => now()->format('d-m-Y H:i'),
        ]);
    }
}
