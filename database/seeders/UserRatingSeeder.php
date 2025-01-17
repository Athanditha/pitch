<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserRatingSeeder extends Seeder
{
    public function run()
    {
        User::all()->each(function ($user) {
            $user->update([
                'rating' => rand(30, 50) / 10 // Random rating between 3.0 and 5.0
            ]);
        });
    }
} 