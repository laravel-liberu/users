<?php

namespace LaravelLiberu\Users\Http\Controllers\Session;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use LaravelLiberu\Users\Models\Session;
use LaravelLiberu\Users\Models\User;

class Destroy extends Controller
{
    use AuthorizesRequests;

    public function __invoke(Request $request, User $user)
    {
        $this->authorize('handle-session', $user);

        Session::find($request->get('id'))->delete();

        return [
            'message' => __('The session was deleted successfully'),
        ];
    }
}
