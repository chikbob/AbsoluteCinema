<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $casts = [
        'date_time' => 'datetime',
        'created_at' => 'datetime',
    ];

    protected $fillable = ['session_id', 'user_id', 'total_price', 'customer_name', 'customer_email'];

    /**
     * Связь с моделью Seat через таблицу ticket_seats (многие ко многим)
     */
    public function seats(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Seat::class, 'ticket_seats')
            ->using(TicketSeat::class)
            ->withPivot('price', 'id'); // Добавляем id, так как у вас есть автоинкрементное поле
    }

    /**
     * Связь с моделью Session
     */
    public function session(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Session::class);
    }

    /**
     * Связь с моделью User
     */
    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
