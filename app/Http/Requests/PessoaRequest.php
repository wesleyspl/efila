<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
            'nome'=>'required|unique:pessoa,nome',
            'cpf'=>'required|unique:pessoa,cpf',
            'email'=>'required|email|unique:pessoa,email'
        ];
    }
    public function messages() : array
    {
        return [
          'nome.required'=>'O campo nome não pode ficar em branco',
          'nome.unique'=>'Esse Nome já esta em uso',
          'cpf.required'=>'O campo cpf não pode ficar em branco',
          'cpf.unique'=>'Esse cpf já esta em uso',
          'email.required'=>'O campo email não pode ficar em branco',
          'email.email'=>'Formato do email invalido',
          'email.unique'=>'O email já esta em uso'
        ];
    }
}
