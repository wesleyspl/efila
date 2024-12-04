<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contador extends Model
{
    protected $table='contador';


    protected $primaryKey = 'id_contador';


     protected $fillable=[
         'servico_id',
         'numero',
         'departamento_id'
     ];





}
