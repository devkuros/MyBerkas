<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'avatar' => ['nullable', 'image', 'max:2048', 'mimes:jpeg,png,jpg,gif,svg'],
            'username' => ['required', 'string', Rule::unique('users', 'username')->ignore(Auth::user()->id)],
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
        ];
    }
}
