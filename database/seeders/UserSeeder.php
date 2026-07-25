<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'fullname' => 'Administrator',
            'email' => 'admin@admin.com',
            'role' => 'Admin',
            'password' => Hash::make('password123'),
        ]);
    }
}
