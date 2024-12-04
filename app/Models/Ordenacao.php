<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordenacao extends Model
{
    protected $table='ordenacao';


    protected $primaryKey = 'id_ordenacao';


     protected $fillable=[
         'servico_id',
         'departamento_id',
         'prio_total',
         'prio_cont',
         'nor_total',
         'nor_cont'
     ];

}
