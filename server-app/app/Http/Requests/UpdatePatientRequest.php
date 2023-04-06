<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePatientRequest extends FormRequest
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
            'photo' => 'mimes:jpg,png,jpeg|max:2000',
            'name' => 'required|string|min:3',
            'mother_name' => 'required|string|min:3',
            'birth_date' => 'required|date_format:d/m/Y',
            'cpf' => 'cpf|required|string|min:14|unique:patients,cpf,' . request()->segment(4),
            'cns' => 'cns|required|string|unique:patients,cns,' . request()->segment(4),
            'zipcode' => 'cep_format|required|string|min:9',
            'address' => 'required|string',
            'number' => 'required|integer',
            'complement' => 'string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string'
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
            'photo.mimes' => 'Formato de imagem inválido. Você só pode fazer upload do arquivo JPG, JPEG ou PNG',
            'photo.max' => 'O tamanho máximo do arquivo para upload é de 2mb.',
            'name.required' => 'O campo "Nome" é obrigatório',
            'name.min' => 'O campo "Nome" não pode ser inferior a :min caracteres',
            'mother_name.required' => 'O campo "Nome da Mãe" é obrigatório',
            'mother_name.min' => 'O campo "Nome da Mãe" não pode ser inferior a :min caracteres',
            'birth_date.required' => 'O campo "Data de Nascimento" é obrigatório',
            'birth_date.date_format' => 'Formato da data inválido. O formato da data deve ser da seguinte maneira: 01/01/2020',
            'cpf' => 'O campo "CPF" é inválido.',
            'cpf.required' => 'O campo "CPF" é obrigatório',
            'cpf.min' => 'O campo "CPF" não pode ser inferior a :min caracteres',
            'cpf.unique' => 'O campo "CPF" já está sendo utilizado',
            'cns.required' => 'O campo "CNS" já é obrigatório',
            'cns' => 'O campo "CNS" é inválido.',
            'cep_format' => 'O campo "CEP" é inválido.',
            'zipcode.required' => 'O campo "CEP" é obrigatório',
            'zipcode.min' => 'O campo "CEP" não pode ser inferior a :min caracteres',
            'address' => 'O campo "Endereço" é obrigatório',
            'number' => 'O campo "Número" é obrigatório',
            'complement' => 'O campo "Complemento" é obrigatório',
            'neighborhood' => 'O campo "Bairro" é obrigatório',
            'city' => 'O campo "Cidade" é obrigatório',
            'state' => 'O campo "Estado" é obrigatório',
        ];
    }
}
