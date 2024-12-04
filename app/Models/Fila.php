<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fila extends Model
{
    protected $table='fila';


    protected $primaryKey = 'id_fila';


     protected $fillable=[
         'servico_id',
         'numero',
         'departamento_id',
         'sigla',
         'peso'

     ];

}
