<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\SeatStatus;

use MoonShine\Fields\Date;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<SeatStatus>
 */
class SeatStatusResource extends ModelResource
{
    protected string $model = SeatStatus::class;

    protected string $title = 'SeatStatuses';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('Seat', 'seat', resource: new SeatResource()),
            BelongsTo::make('Session', 'session', resource: new SessionResource())->nullable(),
            Enum::make('Status')->options([
                'available' => 'Available',
                'reserved' => 'Reserved',
                'sold' => 'Sold',
                'unavailable' => 'Unavailable'
            ]),
            Date::make('Changed At', 'changed_at')->withTime(),
        ];
    }

    /**
     * @param SeatStatus $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
