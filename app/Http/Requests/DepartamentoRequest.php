<?php

namespace App\Http\Requests;

use App\Models\Departamento;
use Illuminate\Foundation\Http\FormRequest;

class DepartamentoRequest extends FormRequest
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
         $id_departamtno=$this->route('departamento');
        return [
            'nome'=>'required|min:4|unique:departamento,nome',
        ];
    }



    public function messages():array
    {
         return [
            'nome.required'=>'O campo nome não pode ficar em branco.',
            'nome.min'=>'O campo nome deve conter no minimo 4 caracteres.',
            'nome.unique'=>'Esse departamento já existe!'
         ];
    }
}
