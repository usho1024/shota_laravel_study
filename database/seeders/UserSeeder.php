<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shota = User::create([
            'email' => 'shota@test.com',
            'password' => Hash::make('password'),
        ]);
    }
}
