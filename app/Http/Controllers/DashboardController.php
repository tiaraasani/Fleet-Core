<?php

namespace App\Http\Controllers;

use App\Models\VehicleOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $orders = VehicleOrder::all();

        $grouped = $orders->groupBy(function ($order) {
            return Carbon::parse($order->created_at)->format('Y-m');
        });

        $labels = $grouped->keys();

        $statuses = ['approved', 'pending', 'rejected'];
        $datasets = [];

        foreach ($statuses as $status) {
            $datasets[] = [
                'label' => ucfirst($status),
                'data' => $labels->map(function ($month) use ($grouped, $status) {
                    return $grouped[$month]->where('status', $status)->count();
                }),
                'backgroundColor' => match ($status) {
                    'approved' => 'rgba(75, 192, 192, 0.7)',
                    'pending' => 'rgba(255, 205, 86, 0.7)',
                    'rejected' => 'rgba(255, 99, 132, 0.7)',
                },
                'borderColor' => match ($status) {
                    'approved' => 'rgba(75, 192, 192, 1)',
                    'pending' => 'rgba(255, 205, 86, 1)',
                    'rejected' => 'rgba(255, 99, 132, 1)',
                },
                'borderWidth' => 1
            ];
        }

        return view('dashboard', compact('labels', 'datasets')); // Return the dashboard view
    }
}
