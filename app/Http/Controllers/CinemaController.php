<?php

namespace App\Http\Controllers;

use App\Models\Cinema;
use App\Models\Session;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CinemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function sessions(Cinema $cinema): \Inertia\Response
    {
        // Получаем все сеансы с фильтрацией по статусу
        $sessions = Session::where('cinema_id', $cinema->id)
            ->where('status', 'pending') // Только не начавшиеся сеансы
            ->with('movie', 'hall')
            ->get();

        return Inertia::render('session/session-list', [
            'cinema' => $cinema,
            'sessions' => $sessions,
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
