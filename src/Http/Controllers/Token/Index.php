<?php

namespace LaravelLiberu\Users\Http\Controllers\Token;

use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Http\Resources\Token;
use LaravelLiberu\Users\Models\User;

class Index extends Controller
{
    public function __invoke(User $user)
    {
        return Token::collection($user->tokens);
    }
}
