<?php

namespace LaravelLiberu\Users\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use LaravelLiberu\Avatars\Http\Resources\Avatar;
use LaravelLiberu\People\Http\Resources\Person;
use LaravelLiberu\Roles\Http\Resources\Role;
use LaravelLiberu\UserGroups\Http\Resources\Group;

class User extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'       => $this->id,
            'isActive' => $this->is_active,
            'email'    => $this->email,
            'person'   => new Person($this->whenLoaded('person')),
            'avatar'   => new Avatar($this->whenLoaded('avatar')),
            'role'     => new Role($this->whenLoaded('role')),
            'group'    => new Group($this->whenLoaded('group')),
        ];
    }
}
