<?php

namespace Database\Factories;

use App\Models\Seat;
use App\Models\Session;
use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Ticket::class;

    public function definition(): array
    {
        return [
            'session_id' => Session::factory(),
            'seat_id' => Seat::factory(),
            'price' => $this->faker->randomFloat(2, 100, 500),
        ];
    }
}
