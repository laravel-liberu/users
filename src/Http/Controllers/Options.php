<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\Select\Traits\OptionsBuilder;
use LaravelLiberu\Users\Http\Resources\User as Resource;
use LaravelLiberu\Users\Models\User;

class Options extends Controller
{
    use OptionsBuilder;

    protected $queryAttributes = ['email', 'person.name', 'person.appellative'];

    protected $resource = Resource::class;

    public function query()
    {
        return User::active()
            ->with(['person:id,appellative,name', 'avatar:id,user_id']);
    }
}
