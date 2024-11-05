<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the first user
        $user1 = User::create([
            'first_name' => 'Admin',
            'last_name' => 'Admin',
            'email' => 'adminpilar@gmail.com',
            'role' => 'NORMAL_ADMIN',
            'password' => Hash::make('admin123'),
        ]);

        // Create the first user
        $user2 = User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'superadminpilar@gmail.com',
            'role' => 'SUPER_ADMIN',
            'password' => Hash::make('superadmin123'),
        ]);

        // Create the first user
        $user3 = User::create([
            'first_name' => 'Content',
            'last_name' => 'Manager',
            'email' => 'content_admin@gmail.com',
            'role' => 'CONTENT_ADMIN',
            'password' => Hash::make('contentadmin123'),
        ]);
    }
}
