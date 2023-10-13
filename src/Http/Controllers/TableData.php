<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\Tables\Traits\Data;
use LaravelLiberu\Users\Tables\Builders\User;

class TableData extends Controller
{
    use Data;

    protected $tableClass = User::class;
}
