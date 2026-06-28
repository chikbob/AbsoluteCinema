<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class TicketSeat extends Pivot
{
    protected $table = 'ticket_seats';

    // Указываем, что используется автоинкрементный id
    public $incrementing = true;

    protected $fillable = [
        'ticket_id',
        'seat_id',
        'price'
    ];

    protected $casts = [
        'price' => 'decimal:2'
    ];

    /**
     * Связь с моделью Ticket
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Связь с моделью Seat
     */
    public function seat()
    {
        return $this->belongsTo(Seat::class);
    }
}
