<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Квиток №{{ $ticket->id }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }

        .ticket {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 15px;
        }

        .seats {
            margin-top: 15px;
        }

        .seats-table {
            width: 100%;
            border-collapse: collapse;
        }

        .seats-table th, .seats-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
<div class="ticket">
    <div class="header">
        <h1>Квиток №{{ $ticket->id }}</h1>
        <h2>Кінотеатр ABSOLUTECINEMA</h2>
    </div>

    <div class="info">
        <p><strong>Клієнт:</strong> {{ $ticket->customer_name }}</p>
        <p><strong>Email:</strong> {{ $ticket->customer_email }}</p>
        <p><strong>Фільм:</strong> {{ $ticket->session?->movie?->title ?? 'Не вказано' }}</p>
        @if($ticket->session?->hall)
            <p><strong>Зал:</strong> {{ $ticket->session->hall->name }}</p>
        @endif
        <p><strong>Дата та час сеансу:</strong>
            @if($ticket->session?->date_time)
                {{ \Carbon\Carbon::parse($ticket->session->date_time)->setTimezone('Europe/Kiev')->translatedFormat('d.m.Y H:i') }}
            @else
                Не вказано
            @endif
        </p>
        <p><strong>Дата покупки:</strong>
            {{ $ticket->created_at->setTimezone('Europe/Kiev')->translatedFormat('d.m.Y H:i') }}
        </p>
    </div>

    <div class="seats">
        <h3>Місця:</h3>
        <table class="seats-table">
            <thead>
            <tr>
                <th>Ряд</th>
                <th>Місце</th>
                <th>Ціна</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ticket->seats->sortBy(['row_number', 'seat_number']) as $seat)
                <tr>
                    <td>{{ $seat->row_number }}</td>
                    <td>{{ $seat->seat_number }}</td>
                    <td>{{ number_format($seat->pivot->price, 2, '.', '') }} грн</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="total">
        <h3>Разом: {{ number_format($ticket->total_price, 2, '.', '') }} грн</h3>
    </div>

    <div class="footer">
        <p>Дякуємо за покупку! Приємного перегляду!</p>
        <p>Після пред’явлення квитка співробітнику кінотеатру він стає недійсним.</p>
    </div>
</div>
</body>
</html>
