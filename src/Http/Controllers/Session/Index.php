<?php

namespace LaravelLiberu\Users\Http\Controllers\Session;

use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Http\Resources\Session as Resource;
use LaravelLiberu\Users\Models\Session;
use LaravelLiberu\Users\Models\User;

class Index extends Controller
{
    public function __invoke(User $user)
    {
        return Resource::collection(Session::for($user)->get());
    }
}
