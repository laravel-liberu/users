<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Models\User;
use LaravelLiberu\Users\Services\ProfileBuilder;

class Show extends Controller
{
    use AuthorizesRequests;

    public function __invoke(User $user)
    {
        $this->authorize('profile', $user);

        (new ProfileBuilder($user))->set();

        return ['user' => $user];
    }
}
