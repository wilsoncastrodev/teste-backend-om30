<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportPatientRequest extends FormRequest
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
            'file' => 'required|file|mimes:csv'
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
            'file.required' => 'O arquivo CSV é obrigatório',
            'file.mimes' => 'Formato de arquivo inválido. Você só pode fazer upload de arquivo CSV',
        ];
    }
}
