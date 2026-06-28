<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Movie;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('movies/movies', [
            'movies' => Movie::all()
        ]);
    }

    public function cinemas(Movie $movie): \Inertia\Response
    {
        $cinemas = Cinema::whereHas('sessions', function ($query) use ($movie) {
            $query->where('movie_id', $movie->id);
        })->get();

        return Inertia::render('movies/cinema-list', [
            'movie' => $movie,
            'cinemas' => $cinemas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
