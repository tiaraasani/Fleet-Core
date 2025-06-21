<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'plate_number',
        'type',
        'is_rented',
        'region',
    ];

    public function vehicleOrders()
    {
        return $this->hasMany(VehicleOrder::class);
    }

    public function getTypeAttribute($value)
    {
        return ucfirst(str_replace('_', ' ', $value));
    }
}
