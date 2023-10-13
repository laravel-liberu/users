<?php

namespace LaravelLiberu\Users\Http\Controllers\Token;

use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Forms\Builders\Token;
use LaravelLiberu\Users\Models\User;

class Create extends Controller
{
    public function __invoke(Token $form, User $user)
    {
        return ['form' => $form->create($user)];
    }
}
