<?php

namespace LaravelLiberu\Users\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelLiberu\People\Models\Person;
use LaravelLiberu\Roles\Models\Role;
use LaravelLiberu\UserGroups\Models\UserGroup;
use LaravelLiberu\Users\Models\User;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'person_id' => Person::factory(),
            'group_id'  => UserGroup::factory(),
            'email'     => fn ($attributes) => Person::find($attributes['person_id'])->email,
            'role_id'   => Role::factory(),
            'is_active' => $this->faker->boolean,
        ];
    }
}
