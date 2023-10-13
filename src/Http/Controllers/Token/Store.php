<?php

namespace LaravelLiberu\Users\Http\Controllers\Token;

use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Http\Requests\ValidateToken;
use LaravelLiberu\Users\Models\User;

class Store extends Controller
{
    public function __invoke(ValidateToken $request, User $user)
    {
        return [
            'message' => 'Token was generated successfully',
            'token'   => $user->createToken($request->get('name'))->plainTextToken,
        ];
    }
}
