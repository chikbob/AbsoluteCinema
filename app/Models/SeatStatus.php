<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeatStatus extends Model
{
    protected $fillable = ['seat_id', 'session_id', 'status', 'changed_at'];

    protected $casts = [
        'changed_at' => 'datetime'
    ];

    public function seat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->BelongsTo(Seat::class);
    }

    public function session(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->BelongsTo(Session::class);
    }
}
