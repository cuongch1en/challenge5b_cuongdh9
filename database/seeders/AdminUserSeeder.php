<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('123456a@A'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'student1',
            'email' => 'student1@example.com',
            'password' => Hash::make('123456a@A'),
            'role' => 'user',
        ]);
    }
}
