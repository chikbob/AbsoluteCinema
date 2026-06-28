<?php

namespace App\MoonShine\Resources;

use App\Models\User;
use MoonShine\Resources\ModelResource;
use MoonShine\Fields\ID;
use MoonShine\Fields\Text;
use Illuminate\Database\Eloquent\Model;

class UserResource extends ModelResource
{
    protected string $model = User::class;

    protected string $title = 'Пользователи';

    public function fields(): array
    {
        return [
            ID::make()->sortable(),
            Text::make('Имя', 'name'),
            Text::make('Email', 'email'),
        ];
    }

    public function rules(Model $item): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
        ];
    }
}
