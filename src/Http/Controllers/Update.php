<?php

namespace LaravelLiberu\Users\Http\Controllers;

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Event;
use LaravelLiberu\Users\Http\Requests\ValidateUser;
use LaravelLiberu\Users\Models\User;

class Update extends Controller
{
    use AuthorizesRequests;

    public function __invoke(ValidateUser $request, User $user)
    {
        $this->authorize('handle', $user);

        if ($request->filled('password')) {
            $this->authorize('change-password', $user);
            $user->password = bcrypt($request->get('password'));
        }

        $user->fill($request->validated());

        if ($user->isDirty('group_id')) {
            $this->authorize('change-group', $user);
        }

        if ($user->isDirty('role_id')) {
            $this->authorize('change-role', $user);
        }

        $user->save();

        if ((new Collection($user->getChanges()))->keys()->contains('password')) {
            Event::dispatch(new PasswordReset($user));
        }

        return ['message' => __('The user was successfully updated')];
    }
}
