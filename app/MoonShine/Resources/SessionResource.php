<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Session;
use MoonShine\Fields\Date;
use MoonShine\Fields\Enum;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Select;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Session>
 */
class SessionResource extends ModelResource
{
    protected string $model = Session::class;

    protected string $title = 'Сеанси';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Movie', 'movie', fn($item) => $item->id .') '. $item->title),
            BelongsTo::make('Cinema', 'cinema', fn($item) => $item->id .') '. $item->name),
            BelongsTo::make('Hall', 'hall'),
            Date::make('Date Time', 'date_time')->withTime(),
            Select::make('Status')
                ->options([
                    'pending' => 'Pending',
                    'finished' => 'Finished'
                ])
        ];
    }

    /**
     * @param Session $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
