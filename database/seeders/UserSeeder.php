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
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@role.test',
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('admin');

        $user = User::create([
            'name' => 'User',
            'email' => 'user@role.test',
            'password' => Hash::make('12345678')
        ]);
        $user->assignRole('user');
    }
}
