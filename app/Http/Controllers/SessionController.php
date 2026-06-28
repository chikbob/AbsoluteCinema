<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Session;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SessionController extends Controller
{
    // Показать сеанс и доступные места
    public function showSeats(Session $session): \Inertia\Response
    {
        return Inertia::render('session/select-seats', [
            'session' => [
                'id' => $session->id,
                'movie' => [
                    'title' => $session->movie->title,
                    'description' => $session->movie->description,
                    'poster_url' => $session->movie->poster_url,
                ],
                'date_time' => $session->date_time,
                'hall' => $session->hall->name, // Название зала
            ],
            'seats' => $session->seats->map(function ($seat) {
                return [
                    'id' => $seat->id,
                    'seat_number' => $seat->seat_number,
                    'row_number' => $seat->row_number,
                    'seat_type' => $seat->seat_type,
                    'status' => $seat->status,
                    'price' => $seat->price,
                ];
            }),
        ]);
    }


    // Обновить статус места
    public function updateSeatStatus(Session $session, Seat $seat, Request $request): \Illuminate\Http\JsonResponse
    {
        // Логика обновления статуса места
        $seat->status = $request->status;
        $seat->save();

        return response()->json([
            'message' => 'Seat status updated successfully.',
            'seat' => $seat,
        ]);
    }
}
