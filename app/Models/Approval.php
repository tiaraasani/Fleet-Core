<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $fillable = [
        'vehicle_order_id',
        'approver_id',
        'level',
        'status',
    ];
    public function vehicleOrder()
    {
        return $this->belongsTo(VehicleOrder::class);
    }
}
