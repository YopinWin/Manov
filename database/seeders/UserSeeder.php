<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin Account
        $admin = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'admin',
        ]);

        // Standard User Account
        $user = \App\Models\User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => 'user',
        ]);

        // Seed Progress
        \Illuminate\Support\Facades\DB::table('user_progress')->insert([
            ['user_id' => $admin->id, 'nilai' => 85, 'created_at' => now()],
            ['user_id' => $user->id, 'nilai' => 45, 'created_at' => now()],
        ]);
    }
}
