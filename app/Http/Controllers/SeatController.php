<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    public function index($sessionId): \Illuminate\Http\JsonResponse
    {
        return response()->json(Seat::where('session_id', $sessionId)->get());
    }

    public function reserve(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'seat_ids' => 'required|array',
            'seat_ids.*' => 'exists:seats,id',
        ]);

        Seat::whereIn('id', $request->seat_ids)->update(['status' => 'reserved']);

        return response()->json(['message' => 'Seats reserved successfully']);
    }
}
