<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atendimento extends Model
{
    protected $table='atendimento';


    protected $primaryKey = 'id_atendimento';


     protected $fillable=[
         'atendimento_id',
         'numero_local',
         'nome_local',
         'status',
         'sigla',
         'numero',
         'servico_id'

     ];

}
