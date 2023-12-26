<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEmpresaRequest extends FormRequest
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
            "name" => "required|min:4",
            "cnpj" => "required|regex:/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/",
            "tipo_empresa" => "required|",
        ];
    }
}
