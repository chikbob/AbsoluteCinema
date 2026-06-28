<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'row_number',
        'seat_number',
        'seat_type',
        'status',
        'price'
    ];


    public function session(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(\App\Models\Session::class);
    }

    public function statuses(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(SeatStatus::class);
    }

    public function currentStatus(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(SeatStatus::class)->latestOfMany();
    }

    public function tickets(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Ticket::class, 'ticket_seats')
            ->withPivot('price', 'id');
    }
}
