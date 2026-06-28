<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\Hall;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hall>
 */
class HallFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Hall::class;

    public function definition(): array
    {
        return [
            'cinema_id' => Cinema::factory(),
            'name' => 'Зал ' . $this->faker->numberBetween(1, 10),
            'total_rows' => $this->faker->numberBetween(5, 10),
            'total_seats_per_row' => $this->faker->numberBetween(5, 15),
        ];
    }
}
