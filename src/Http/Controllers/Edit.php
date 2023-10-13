<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Forms\Builders\User as Form;
use LaravelLiberu\Users\Models\User;

class Edit extends Controller
{
    public function __invoke(User $user, Form $form)
    {
        return ['form' => $form->edit($user)];
    }
}
