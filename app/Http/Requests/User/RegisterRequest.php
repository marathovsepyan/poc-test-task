<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            "first_name" => "required|string|max:50",
            "last_name" => "required|string|max:50",
            "email" => "required|email|unique:users",
            "password" => "required|string|min:6|confirmed",
            "phone" => "required|string|max:20",
            "address1" => "required|string",
            "address2" => "required|string",
            "city" => "required|string|max:100",
            "state" => "required|string|max:100",
            "country" => "required|string|max:100",
            "phone_no1" => "required|string|max:20",
            "phone_no2" => "nullable|string|max:20",
            "zip" => "required|string|max:20"
        ];
    }
}
