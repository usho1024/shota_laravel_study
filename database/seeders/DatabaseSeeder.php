<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 他のシーダーを呼び出すことも可能
        $this->call([
            UserSeeder::class,
            PostSeeder::class,
            CommentSeeder::class,
            AdminSeeder::class,
        ]);
    }
}