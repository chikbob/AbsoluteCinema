<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\TicketSeat;

use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<TicketSeat>
 */
class TicketSeatResource extends ModelResource
{
    protected string $model = TicketSeat::class;

    protected string $title = 'Місця квитків';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                BelongsTo::make('Ticket', 'ticket', fn($item) => $item->id .') '. $item->customer_email),
                BelongsTo::make('Seat', 'seat', resource: new SeatResource()),
                Number::make('Price', 'price'),
            ])

        ];
    }

    /**
     * @param TicketSeat $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
