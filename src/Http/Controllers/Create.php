<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\People\Models\Person;
use LaravelLiberu\Users\Forms\Builders\User;

class Create extends Controller
{
    public function __invoke(Person $person, User $form)
    {
        return ['form' => $form->create($person)];
    }
}
