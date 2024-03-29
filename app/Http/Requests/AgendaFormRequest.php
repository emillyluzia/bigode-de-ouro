<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AgendaFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'profissional_id' => 'required',
            'cliente_id' => '',
            'servico_id' => '',
            'dataHora' => 'required|date',
            'tipo_pagamento' => 'max:20|min:3',
            'valor' => '|decimal:2',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()
        ]));
    }
    public function messages()
    {
        return [
            'profissional_id.required' => 'o profissional é obrigatorio',
            'dataHora.required' => 'o campo data/hora é obrigatorio',
        ];
    }
}
