<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Seat;

use MoonShine\Fields\Enum;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Seat>
 */
class SeatResource extends ModelResource
{
    protected string $model = Seat::class;

    protected string $title = 'Місця';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Session', 'session'),
            Number::make('Row Number', 'row_number'),
            Number::make('Seat Number', 'seat_number'),
            Select::make('Seat Type', 'seat_type')->options([
                'standard' => 'Standard',
                'vip' => 'VIP',
                'disabled' => 'Disabled',
                'sofa' => 'Sofa'
            ]),
            Select::make('Status')->options([
                'available' => 'Available',
                'reserved' => 'Reserved',
                'sold' => 'Sold',
                'unavailable' => 'Unavailable'
            ]),
            Number::make('Price')
        ];
    }

    /**
     * @param Seat $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
