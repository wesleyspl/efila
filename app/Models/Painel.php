<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Painel extends Model
{
    protected $table='painel';


    protected $primaryKey = 'id_painel';


     protected $fillable=[

         'nome',
         'obs',
         'key',
        'status'
     ];
}
