<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        $salesNames = ['Natan', 'Yehu', 'Trias', 'Sarah', 'Jena'];

        foreach ($salesNames as $name) {
            $username = strtolower($name);
            
            // Skip if already exists
            if (DB::table('users')->where('username', $username)->exists()) {
                continue;
            }

            DB::table('users')->insert([
                'username' => $username,
                'fullname' => $name,
                'email' => $username . '@sales.com',
                'role' => 'Sales',
                'password' => Hash::make('password123'),
            ]);
        }
    }
}
