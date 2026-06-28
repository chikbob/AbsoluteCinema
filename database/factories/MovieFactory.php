<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Movie>
 */
class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3), // Генерируем случайное название
            'description' => $this->faker->paragraph(), // Генерируем описание
            'poster_url' => 'https://i.postimg.cc/LX2GVPjp/placeholder.jpg',
            'duration' => $this->faker->numberBetween(80, 180), // Длительность фильма в минутах
            'release_year' => $this->faker->year(), // Год выхода
        ];
    }
}
