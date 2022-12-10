<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->user()->hasRole('Developer')) {
            return true;
        }

        if (!auth()->user()->hasAllPermissions(['add_user', 'edit_user', 'edit_profile'])) {
            return false;
        }

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
            'name' => 'required|max:250',
            'email' => 'required|email|max:250',
            'photo' => 'image|file|max:2048',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|same:password|min:8',
            'role' => 'required|numeric'
        ];
    }
}
