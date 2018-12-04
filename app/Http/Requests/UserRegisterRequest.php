<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'username' => 'required|min:3|max:15|alpha_num|unique:user,username',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required'
        ];
    }
}
