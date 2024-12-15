<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PainelRequest extends FormRequest
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
            'nome'=>'required|unique:painel,nome',
            'obs'=>'required'

        ];
    }
    public function messages() : array
    {
        return [
          'nome.required'=>'O campo nome não pode ficar em branco',
          'nome.unique'=>'Esse Nome já esta em uso',
          'obs.required'=>'O campo observação não pode ficar e branco'

        ];
}
}
