<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Routing\Controller;
use LaravelLiberu\Tables\Traits\Excel;
use LaravelLiberu\Users\Tables\Builders\User;

class ExportExcel extends Controller
{
    use Excel;

    protected $tableClass = User::class;
}
