<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\VehicleOrder;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class VehicleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'vehicle_id' => 'required|exists:vehicles,id',
            'driver_id' => 'nullable|exists:drivers,id',
            'date' => 'required|date',
            'destination' => 'required|string',
            'approver_ids' => 'required|array|size:2',
            'approver_ids.*' => 'exists:users,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //save the vehicle order
        $order = VehicleOrder::create([
            'vehicle_id' => $request->vehicle_id,
            'driver_id' => $request->driver_id,
            'requested_by' => Auth::id(),
            'date' => $request->date,
            'destination' => $request->destination,
            'status' => 'pending',
        ]);

        //save the approvals
        foreach ($request->approver_ids as $index => $approverId) {
            Approval::create([
                'vehicle_order_id' => $order->id,
                'approver_id' => $approverId,
                'level' => $index + 1,
                'status' => 'pending',
            ]);
        }
        return response()->json([
            'message' => 'Vehicle order created successfully',
            'order' => $order
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = VehicleOrder::findOrFail($id);

        if (!$order) {
            return response()->json(['message' => 'Vehicle order not found'], 404);
        }
        $request->validate([
            'vehicle_id' => 'sometimes|exists:vehicles,id',
            'driver_id' => 'sometimes|exists:drivers,id',
            'date' => 'sometimes|date',
            'destination' => 'sometimes|string',
        ]);

        $order->update($request->only(['vehicle_id', 'driver_id', 'date', 'destination']));
        return response()->json([
            'message' => 'Vehicle order updated successfully',
            'data' => $order
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = VehicleOrder::findOrFail($id);

        if (!$order) {
            return response()->json(['message' => 'Vehicle order not found'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Vehicle order deleted successfully'], 200);
    }
}
