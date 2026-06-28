<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\ContactMessage;

use MoonShine\Fields\Email;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;

/**
 * @extends ModelResource<ContactMessage>
 */
class ContactMessageResource extends ModelResource
{
    protected string $model = ContactMessage::class;

    protected string $title = 'Повідомлення';

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            ID::make(),
            Text::make('First Name', 'first_name'),
            Text::make('Last Name', 'last_name'),
            Email::make('Email'),
            Textarea::make('Message'),
        ];
    }

    /**
     * @param ContactMessage $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
