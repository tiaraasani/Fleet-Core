<?php

namespace Database\Seeders;

use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Driver::create([
            'name' => 'John Doe',
            'phone' => '08123456789',
        ]);
        Driver::create([
            'name' => 'Jane Smith',
            'phone' => '08234567890',
        ]);
        Driver::create([
            'name' => 'Alice Johnson',
            'phone' => '08345678901',
        ]);
        Driver::create([
            'name' => 'Bob Brown',
            'phone' => '08456789012',
        ]);
        Driver::create([
            'name' => 'Charlie Davis',
            'phone' => '08567890123',
        ]);
    }
}
