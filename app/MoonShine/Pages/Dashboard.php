<?php

declare(strict_types=1);

namespace App\MoonShine\Pages;

use MoonShine\Pages\Page;
use MoonShine\Metrics\ValueMetric;

use App\Models\Cinema;
use App\Models\Hall;
use App\Models\Movie;
use App\Models\Session;
use App\Models\Ticket;
use App\Models\ContactMessage;
use App\Models\User;

class Dashboard extends Page
{
    public function breadcrumbs(): array
    {
        return ['#' => $this->title()];
    }

    public function title(): string
    {
        return $this->title ?: 'Головна';
    }

    public function components(): array
    {
        return [
            ValueMetric::make('Кінотеатри')->value(fn() => Cinema::count()),
            ValueMetric::make('Зали')->value(fn() => Hall::count()),
            ValueMetric::make('Фільми')->value(fn() => Movie::count()),
            ValueMetric::make('Сеанси')->value(fn() => Session::count()),
            ValueMetric::make('Квитки')->value(fn() => Ticket::count()),
            ValueMetric::make('Повідомлення')->value(fn() => ContactMessage::count()),
        ];
    }
}
