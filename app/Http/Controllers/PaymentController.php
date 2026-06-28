<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class PaymentController extends Controller
{
    public function processPayment(Request $request): \Inertia\Response
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'seats' => 'required|array',
            'seats.*.id' => 'required|exists:seats,id',
            'seats.*.price' => 'required|numeric|min:0',
            'session_id' => 'required|exists:sessions,id',
            'total' => 'required|numeric|min:0',
        ]);

        DB::beginTransaction();

        // Создаем билет
        $ticket = Ticket::create([
            'session_id' => $validated['session_id'],
            'customer_name' => $validated['name'],
            'customer_email' => $validated['email'],
            'total_price' => $validated['total'],
        ]);

        // Привязываем места к билету
        foreach ($validated['seats'] as $seatData) {
            $ticket->seats()->attach($seatData['id'], [
                'price' => $seatData['price']
            ]);

            Seat::where('id', $seatData['id'])
                ->update(['status' => 'sold']);
        }

        DB::commit();

        // Загружаем данные с отношениями
        $ticket->load([
            'seats' => fn($q) => $q->withPivot('price'),
            'session' => function ($query) {
                $query->with(['hall', 'movie'])
                    ->select('id', 'date_time', 'hall_id', 'movie_id'); // Явно выбираем нужные поля
            }
        ]);

        return Inertia::render('payment/success', [
            'message' => 'Билет успешно создан!',
            'ticket' => $ticket
        ]);
    }
}
