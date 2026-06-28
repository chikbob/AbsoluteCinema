<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Hall;

use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Hall>
 */
class HallResource extends ModelResource
{
    protected string $model = Hall::class;

    protected string $title = 'Зали';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('Cinema', 'cinema', fn($item) => $item->id . ' | ' . $item->name),
            Text::make('Name'),
            Number::make('Total Rows', 'total_rows'),
            Number::make('Seats Per Row', 'total_seats_per_row'),
        ];
    }

    /**
     * @param Hall $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
