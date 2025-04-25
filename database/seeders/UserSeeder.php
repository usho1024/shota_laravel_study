<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'email' => 'shota@test.com',
            'password' => Hash::make('password'),
        ]);

        User::create([
            'email' => 'shota2@test.com',
            'password' => Hash::make('password'),
        ]);
        
        User::factory()->count(10)->create();
    }
}
