<?php

use App\Http\Controllers\CinemaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SeatController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TicketPdfController;
use App\Models\Movie;
use App\Models\Session;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $latestMovie = Movie::latest()->first(); // Получаем последний добавленный фильм

    return Inertia::render('index', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'latestMovie' => $latestMovie, // Передаем последний фильм
    ]);
});

// Кинотеатры
Route::apiResource('cinemas', CinemaController::class);

// Залы
Route::apiResource('halls', HallController::class);

// Места
Route::apiResource('seats', SeatController::class);

// Фильмы
Route::apiResource('movies', MovieController::class);

// Сеансы
Route::apiResource('sessions', SessionController::class);

// Билеты
Route::apiResource('tickets', TicketController::class);

Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
Route::get('/movies/{movie}/cinemas', [MovieController::class, 'cinemas'])->name('movies.cinemas');
Route::get('/cinemas/{cinema}/sessions', [CinemaController::class, 'sessions'])->name('cinemas.sessions');

// Отображение сеанса и мест для выбора
Route::get('/sessions/{session}/seats', [SessionController::class, 'showSeats'])->name('sessions.showSeats');

Route::get('/tickets/{ticket}/download', [TicketPdfController::class, 'download'])
    ->name('tickets.download');

Route::get('/payment', function () {
    $sessionId = request()->input('session_id');
    $session = Session::with(['movie', 'hall.cinema'])->findOrFail($sessionId);

    return Inertia::render('payment/payment', [
        'selectedSeats' => request()->input('selectedSeats', []),
        'totalPrice' => round(request()->input('totalPrice', 0), 2),
        'session_id' => $sessionId,
        'movie' => $session->movie,
        'hall' => $session->hall,
        'cinema' => $session->hall->cinema,
        'session' => [
            'date' => \Carbon\Carbon::parse($session->date_time)->format('d.m.Y'),
            'time' => \Carbon\Carbon::parse($session->date_time)->format('H:i'),
        ]
    ]);
})->name('payment');

// Обновление статуса места (когда пользователь выбирает или отменяет выбор)
Route::patch('/sessions/{session}/seats/{seat}', [SessionController::class, 'updateSeatStatus'])->name('sessions.updateSeatStatus');

Route::post('/payment', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContactController::class, 'store'])->name('contacts.store');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
