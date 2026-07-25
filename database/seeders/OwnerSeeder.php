<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class OwnerSeeder extends Seeder
{
    public function run(): void
    {
        // Check if owner already exists
        $ownerExists = DB::table('users')
            ->where('username', 'owner')
            ->orWhere('role', 'owner')
            ->first();

        if (!$ownerExists) {
            DB::table('users')->insert([
                'username' => 'owner',
                'fullname' => 'Owner / Manager',
                'email' => 'owner@company.com',
                'role' => 'owner',
                'password' => Hash::make('owner123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            echo "✓ Owner user created: username='owner', password='owner123'\n";
        } else {
            echo "⚠ Owner user already exists.\n";
        }
    }
}
