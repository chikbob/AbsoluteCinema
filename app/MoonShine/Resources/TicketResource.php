<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ticket;

use MoonShine\Fields\Email;
use MoonShine\Fields\Number;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<Ticket>
 */
class TicketResource extends ModelResource
{
    protected string $model = Ticket::class;

    protected string $title = 'Квитки';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make(),
            BelongsTo::make('Session', 'session', resource: new SessionResource()),
            BelongsTo::make('User', 'user', resource: new UserResource())->nullable(),
            Text::make('Customer Name', 'customer_name'),
            Email::make('Customer Email', 'customer_email'),
            Number::make('Total Price', 'total_price'),
        ];
    }

    /**
     * @param Ticket $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
