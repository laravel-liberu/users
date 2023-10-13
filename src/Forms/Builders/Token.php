<?php

namespace LaravelLiberu\Users\Forms\Builders;

use LaravelLiberu\Forms\Services\Form;
use LaravelLiberu\Users\Models\User;

class Token
{
    private const TemplatePath = __DIR__.'/../Templates/token.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = new Form($this->templatePath());
    }

    public function create(User $user)
    {
        return $this->form
            ->routeParams(['user' => $user->id])
            ->create();
    }

    protected function templatePath(): string
    {
        return self::TemplatePath;
    }
}
