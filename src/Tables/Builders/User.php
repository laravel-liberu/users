<?php

namespace LaravelLiberu\Users\Tables\Builders;

use Illuminate\Database\Eloquent\Builder;
use LaravelLiberu\Tables\Contracts\Table;
use LaravelLiberu\Users\Models\User as Model;

class User implements Table
{
    private const TemplatePath = __DIR__.'/../Templates/users.json';

    protected $query;

    public function query(): Builder
    {
        return Model::with('avatar:id,user_id')->selectRaw('
            users.id, user_groups.name as "group", people.name, people.appellative,
            people.phone, users.email, roles.name as role, users.is_active,
            users.created_at, users.person_id
        ')->join('people', 'users.person_id', '=', 'people.id')
            ->join('user_groups', 'users.group_id', '=', 'user_groups.id')
            ->join('roles', 'users.role_id', '=', 'roles.id');
    }

    public function templatePath(): string
    {
        return self::TemplatePath;
    }
}
