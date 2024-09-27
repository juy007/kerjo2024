<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'email' => 'admin@example.com',
            'phone' => '',
            'password' => Hash::make('password123'),
            'name' => 'admin',
            'bio' => '',
            'role' => 'ADMIN'
        ]);
    }
}
