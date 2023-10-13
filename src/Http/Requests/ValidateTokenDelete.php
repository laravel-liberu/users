<?php

namespace LaravelLiberu\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ValidateTokenDelete extends FormRequest
{
    public function authorize()
    {
        return Auth::user()->isAdmin()
            || Auth::user()->id === $this->route('user')->id;
    }

    public function rules()
    {
        return [
            'id' => 'required|exists:personal_access_tokens,id',
        ];
    }
}
