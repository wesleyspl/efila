<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Painel_Senha extends Model
{
    protected $table='painel_senha';


    protected $primaryKey = 'id_painel';


     protected $fillable=[
         //'atendimento_id',
         'numero_local',
         'nome_local',
         'status',
         'sigla',
         'numero',
         'servico_id',
         'peso'

     ];
}
