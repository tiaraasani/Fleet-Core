<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleOrder extends Model
{
    protected $fillable = [
        'vehicle_id',
        'driver_id',
        'requested_by',
        'date',
        'destination',
        'status',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function requestedBy()
    {
        return $this->belongsTo(User::class, 'requested_by');
    }
}
