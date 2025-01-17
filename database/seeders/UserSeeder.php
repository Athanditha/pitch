<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create admin user first
        User::create([
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
            'contact_no' => '+1234567890',
            'rating' => 5.0,
            'remember_token' => Str::random(10),
        ]);

        // Create some dummy users
        $users = [
            [
                'name' => 'John Doe',
                'username' => 'johndoe',
                'email' => 'john@example.com',
                'contact_no' => '+1234567890',
                'rating' => 4.5,
            ],
            [
                'name' => 'Jane Smith',
                'username' => 'janesmith',
                'email' => 'jane@example.com',
                'contact_no' => '+1987654321',
                'rating' => 4.8,
            ],
            [
                'name' => 'Mike Johnson',
                'username' => 'mikej',
                'email' => 'mike@example.com',
                'contact_no' => '+1122334455',
                'rating' => 4.2,
            ],
            [
                'name' => 'Sarah Wilson',
                'username' => 'sarahw',
                'email' => 'sarah@example.com',
                'contact_no' => '+1555666777',
                'rating' => 4.9,
            ],
            [
                'name' => 'David Brown',
                'username' => 'davidb',
                'email' => 'david@example.com',
                'contact_no' => '+1999888777',
                'rating' => 4.3,
            ]
        ];

        foreach ($users as $userData) {
            User::create([
                'name' => $userData['name'],
                'username' => $userData['username'],
                'email' => $userData['email'],
                'email_verified_at' => now(),
                'password' => bcrypt('password'), // Default password for all users
                'contact_no' => $userData['contact_no'],
                'rating' => $userData['rating'],
                'remember_token' => Str::random(10),
            ]);
        }
    }
}
