<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\Tables\Traits\Init;
use LaravelLiberu\Users\Tables\Builders\User;

class InitTable extends Controller
{
    use Init;

    protected $tableClass = User::class;
}
