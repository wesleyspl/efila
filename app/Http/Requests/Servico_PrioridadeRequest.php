<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Servico_PrioridadeRequest extends FormRequest
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
            # 'nome'=>'required|min:4|unique:servico,nome',
            // 'prioridade_id'=>'unique:servico_prioridade,prioridade_id',
         ];


     }
     public function messages():array
     {
          return [

             //'prioridade_id.unique'=>'Essa sigla esta em uso!',
          ];
     }
}
