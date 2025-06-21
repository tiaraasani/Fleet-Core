<?php

namespace App\Http\Controllers;

use App\Models\Approval;
use App\Models\VehicleOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    public function approve($id)
    {
        $approval = Approval::where('id', $id)
            ->where('approver_id', Auth::id())
            ->first();

        if (!$approval) {
            return response()->json(['message' => 'Approval not found or you are not authorized to approve this request.'], 404);
        }
        //check if the approval is already approved or rejected by another approver
        if ($approval->level == 2) {
            $prevApproval = Approval::where('vehicle_order_id', $approval->vehicle_order_id)
                ->where('level', 1)
                ->first();

            if ($prevApproval->status !== 'approved') {
                return response()->json(['message' => 'Previous approval is not approved yet.'], 400);
            }
        }
        //update the approval status
        $approval->status = 'approved';
        $approval->save();

        $allApproved = Approval::where('vehicle_order_id', $approval->vehicle_order_id)
            ->where('status', '!=', 'approved')
            ->count() === 0;

        if ($allApproved) {
            $order = VehicleOrder::find($approval->vehicle_order_id);
            $order->status = 'approved';
            $order->save();
        }
        return response()->json(['message' => 'Approval approved successfully.'], 200);
    }

    public function reject($id)
    {
        $approval = Approval::where('id', $id)
            ->where('approver_id', Auth::id())
            ->first();

        if (!$approval) {
            return response()->json(['message' => 'Approval not found or you are not authorized to reject this request.'], 404);
        }

        //update the approval status
        $approval->status = 'rejected';
        $approval->save();

        //update the vehicle order status
        $order = VehicleOrder::find($approval->vehicle_order_id);
        $order->status = 'rejected';
        $order->save();

        return response()->json(['message' => 'Approval rejected.'], 200);
    }

    public function pending()
    {
        $approverId = Auth::id(); // ID user yang login
        $pendingApprovals = Approval::with('vehicleOrder') // include relasi kalau perlu
            ->where('approver_id', $approverId)
            ->where('status', 'pending')
            ->get();

        return response()->json($pendingApprovals);
    }
}
