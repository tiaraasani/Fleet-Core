<?php

namespace App\Http\Controllers;

use App\Exports\VehicleOrderExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function export(Request $request){
        $request->validate([
           'start'=> 'required|date',
           'end'=> 'required|date|after_or_equal:start',
        ]);
        return Excel::download(new VehicleOrderExport($request->start, $request->end), 'vehicle_orders_report.xlsx');
    }
}
