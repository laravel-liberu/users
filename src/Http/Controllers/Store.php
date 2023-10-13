<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Http\Requests\ValidateUser;
use LaravelLiberu\Users\Models\User;

class Store extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateUser $request, User $user)
    {
        $user->fill($request->validated());

        $this->authorize('handle', $user);

        tap($user)->save()
            ->sendResetPasswordEmail();

        return [
            'message'  => __('The user was successfully created'),
            'redirect' => 'administration.users.edit',
            'param'    => ['user' => $user->id],
        ];
    }
}
