<?php

namespace Database\Seeders;

use App\Models\Vehicle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vehicle::create([
            'plate_number' => 'B 1234 AB',
            'type' => 'angkutan_orang',
            'is_rented' => false,
            'region' => 'Jakarta',
        ]);
        Vehicle::create([
            'plate_number' => 'B 5678 CD',
            'type' => 'angkutan_barang',
            'is_rented' => true,
            'region' => 'Bandung',
        ]);
        Vehicle::create([
            'plate_number' => 'B 9101 EF',
            'type' => 'angkutan_orang',
            'is_rented' => false,
            'region' => 'Surabaya',
        ]);
    }
}
