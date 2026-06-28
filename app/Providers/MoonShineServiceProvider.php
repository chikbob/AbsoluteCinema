<?php

declare(strict_types=1);

namespace App\Providers;

use MoonShine\Providers\MoonShineApplicationServiceProvider;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;
use MoonShine\Contracts\Resources\ResourceContract;
use MoonShine\Menu\MenuElement;
use MoonShine\Pages\Page;

use App\MoonShine\Resources\UserResource;
use App\MoonShine\Resources\CinemaResource;
use App\MoonShine\Resources\HallResource;
use App\MoonShine\Resources\MovieResource;
use App\MoonShine\Resources\SessionResource;
use App\MoonShine\Resources\SeatResource;
use App\MoonShine\Resources\TicketResource;
use App\MoonShine\Resources\TicketSeatResource;
use App\MoonShine\Resources\SeatStatusResource;
use App\MoonShine\Resources\ContactMessageResource;

use Closure;

class MoonShineServiceProvider extends MoonShineApplicationServiceProvider
{
    public function resources(): array
    {
        return [
            new UserResource(),
            new CinemaResource(),
            new HallResource(),
            new MovieResource(),
            new SessionResource(),
            new SeatResource(),
            new TicketResource(),
            new TicketSeatResource(),
            new SeatStatusResource(),
            new ContactMessageResource(),
        ];
    }

    protected function pages(): array
    {
        return [];
    }

    protected function menu(): array
    {
        return [
            MenuGroup::make('Система', [
                MenuItem::make('Адміністратори', new MoonShineUserResource())
                    ->icon('heroicons.outline.user'),
                MenuItem::make('Ролі', new MoonShineUserRoleResource())
                    ->icon('heroicons.outline.lock-closed'),
            ]),

//            MenuGroup::make('Користувачі', [
//                MenuItem::make('Користувачі', new UserResource())
//                    ->icon('heroicons.outline.users'),
//            ]),

            MenuGroup::make('Кінотеатр', [
                MenuItem::make('Кінотеатри', new CinemaResource())
                    ->icon('heroicons.outline.building-library'),
                MenuItem::make('Зали', new HallResource())
                    ->icon('heroicons.outline.rectangle-stack'),
                MenuItem::make('Фільми', new MovieResource())
                    ->icon('heroicons.outline.film'),
                MenuItem::make('Сеанси', new SessionResource())
                    ->icon('heroicons.outline.clock'),
                MenuItem::make('Місця', new SeatResource())
                    ->icon('heroicons.outline.table-cells'),
//                MenuItem::make('Статуси місць', new SeatStatusResource())
//                    ->icon('heroicons.outline.adjustments-vertical'),
            ]),

            MenuGroup::make('Квитки', [
                MenuItem::make('Квитки', new TicketResource())
                    ->icon('heroicons.outline.ticket'),
                MenuItem::make('Місця квитків', new TicketSeatResource())
                    ->icon('heroicons.outline.view-columns'),
            ]),

            MenuGroup::make('Контакти', [
                MenuItem::make('Повідомлення', new ContactMessageResource())
                    ->icon('heroicons.outline.chat-bubble-left-right'),
            ]),
        ];
    }

    protected function theme(): array
    {
        return [];
    }
}
