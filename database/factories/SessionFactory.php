<?php

namespace Database\Factories;

use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Session>
 */
class SessionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Session::class;

    public function definition(): array
    {
        return [
            'movie_id' => Movie::factory(),
            'cinema_id' => Cinema::factory(), // добавлено для связи с кинотеатром
            'hall_id' => Hall::factory(), // добавлено для связи с залом
            'date_time' => $this->faker->dateTimeBetween('now', '+1 week'),
            'status' => $this->faker->randomElement(['pending', 'finished']), // добавлен статус
        ];
    }


}
