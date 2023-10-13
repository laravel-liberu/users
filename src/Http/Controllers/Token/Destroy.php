<?php

namespace LaravelLiberu\Users\Http\Controllers\Token;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Models\User;

class Destroy extends Controller
{
    public function __invoke(Request $request, User $user)
    {
        $user->tokens()->whereId($request->get('id'))
            ->delete();

        return [
            'message' => __('The token was deleted successfully'),
        ];
    }
}
