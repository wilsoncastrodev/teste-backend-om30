<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchAddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'zipcode' => 'cep_format|required|string|min:9',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'cep_format' => 'O campo "CEP" é inválido.',
            'zipcode.required' => 'O campo "CEP" é obrigatório',
            'zipcode.min' => 'O campo "CEP" não pode ser inferior a :min caracteres',
        ];
    }
}
