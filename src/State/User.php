<?php

namespace LaravelLiberu\Users\State;

use Illuminate\Support\Facades\Auth;
use LaravelLiberu\Core\Contracts\ProvidesState;
use LaravelLiberu\Users\Http\Resources\User as Resource;

class User implements ProvidesState
{
    public function mutation(): string
    {
        return 'setUser';
    }

    public function state(): mixed
    {
        Auth::user()->load(['person', 'avatar', 'role', 'group']);

        return new Resource(Auth::user());
    }
}
