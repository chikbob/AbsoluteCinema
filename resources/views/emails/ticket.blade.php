<!DOCTYPE html>
<html>
<head>
    <title>Ваш квиток</title>
</head>
<body>
<h2>Вітаємо, {{ $name }}!</h2>
<p>Ви придбали квитки на сеанс {{ $session }}.</p>
<h3>Ваші місця:</h3>
<ul>
    @foreach($seats as $seat)
        <li>Ряд {{ $seat->row_number }}, місце {{ $seat->seat_number }} — {{ $seat->pivot->price }} грн.</li>
    @endforeach
</ul>
<p><strong>Підсумкова сума:</strong> {{ $total }} грн.</p>
<p>Дякуємо за покупку!</p>
</body>
</html>
