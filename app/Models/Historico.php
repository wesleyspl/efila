<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model
{
    protected $table='historico';


    protected $primaryKey = 'id_historico';


     protected $fillable=[
         'id_historico',
         'numero_local',
         'nome_local',
         'status',
         'sigla',
         'numero'

     ];
}
