<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalRequest extends FormRequest
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
            'nome'=>'required|min:3|unique:local,nome'
        ];
    }
    public function messages():array
    {
        return [
            'nome.required'=>'O campo não pode ficar em branco',
            'nome.min'=>'O campo deve conter no minimo 3 caracteres',
            'nome.unique'=>'Esse local já existe'
        ];
    }
}
