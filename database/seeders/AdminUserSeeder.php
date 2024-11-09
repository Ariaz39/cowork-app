<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('password'),
            'role' => 'adm',
        ]);

        User::create([
            'name' => 'User1',
            'email' => 'user1@test.com',
            'password' => Hash::make('password'),
            'role' => 'usr',
        ]);

        User::create([
            'name' => 'User2',
            'email' => 'user2@test.com',
            'password' => Hash::make('password'),
            'role' => 'usr',
        ]);
    }
}
