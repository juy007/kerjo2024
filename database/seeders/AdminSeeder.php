<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'email' => 'admin',
            'phone' => '', // Bisa diisi atau dibiarkan kosong
            'password' => Hash::make('admin'), // Hash password
            'name' => 'Administrator',
            'bio' => '', // Bisa diisi atau dibiarkan kosong
            'role' => 'ADMIN'
        ]);
    }
}
