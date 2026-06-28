<?php

namespace Database\Seeders;

use App\Models\Cinema;
use App\Models\Movie;
use App\Models\Session;
use App\Models\Seat;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создадим 10 кинотеатров
        Cinema::factory(10)->create()->each(function ($cinema) {
            // В каждом кинотеатре 2-5 залов
            $cinema->halls()->saveMany(\App\Models\Hall::factory(rand(2, 5))->make());
        });

        // Создадим 10 фильмов
        $movies = Movie::factory(10)->create();

        // Для каждого фильма и каждого кинотеатра создаем случайные сеансы
        $movies->each(function ($movie) {
            // Выбираем случайные кинотеатры для фильма (1–5)
            $randomCinemas = Cinema::inRandomOrder()->limit(rand(1, 10))->get();

            $randomCinemas->each(function ($cinema) use ($movie) {
                // Получаем залы этого кинотеатра (1–3 зала)
                $randomHalls = $cinema->halls()->inRandomOrder()->limit(rand(1, 3))->get();

                $randomHalls->each(function ($hall) use ($movie, $cinema) {
                    // Для каждого зала создаем несколько сеансов (5–10)
                    foreach (range(1, rand(5, 10)) as $index) {
                        $session = Session::create([
                            'movie_id' => $movie->id,
                            'hall_id' => $hall->id,
                            'cinema_id' => $cinema->id,
                            'date_time' => now()->addDays(rand(0, 30))->setTime(rand(10, 22), rand(0, 59)),
                            'status' => fake()->randomElement(['pending', 'finished']),
                        ]);

                        $hall->sessions()->each(function ($session) {
                            $session->seats()->saveMany(\App\Models\Seat::factory(rand(5, 10))->make([
                                'session_id' => $session->id
                            ]));
                        });
                    }
                });
            });
        });
    }
}
