<?php

namespace App\Exports;

use App\Models\VehicleOrder;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VehicleOrderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    
    protected $startDate;
    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    public function collection()
    {
        return VehicleOrder::with(['vehicle', 'driver', 'requestedBy'])
            ->whereBetween('date', [$this->startDate, $this->endDate])
            ->get()
            ->map(function ($order) {
                return [
                    'Vehicle Plate Number' => $order->vehicle->plate_number,
                    'Driver Name' => $order->driver->name,
                    'Requested By' => $order->requestedBy->name,
                    'Date' => $order->date,
                    'Destination' => $order->destination,
                    'Status' => $order->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Vehicle Plate Number',
            'Driver Name',
            'Requested By',
            'Date',
            'Destination',
            'Status',
        ];
    }
}
