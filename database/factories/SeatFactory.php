<?php

namespace Database\Factories;

use App\Models\Hall;
use App\Models\Seat;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Seat>
 */
class SeatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Seat::class;

    public function definition(): array
    {
        return [
            'session_id' => Session::inRandomOrder()->first()->id ?? Session::factory(),
            'row_number' => fake()->numberBetween(1, 10),
            'seat_number' => fake()->numberBetween(1, 20),
            'seat_type' => fake()->randomElement(['standard', 'vip', 'disabled', 'sofa']),
            'status' => fake()->randomElement(['available', 'reserved', 'sold', 'unavailable']),
            'price' => fake()->randomFloat(2, 100, 1000),
        ];
    }
}
