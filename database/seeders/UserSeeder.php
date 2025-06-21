<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Approver 1',
            'email' => 'approver1@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'approver',
        ]);
        User::create([
            'name' => 'Approver 2',
            'email' => 'approver2@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'approver',
        ]);
    }
}
