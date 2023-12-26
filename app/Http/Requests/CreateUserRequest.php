<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            "name" => "min:8|max:255|required",
            "email" => "email|min:8|max:255|required",
            "password" => "min:8|max:255|required",
            "confirm_password" => "min:8|max:255|required"
        ];
    }
}
