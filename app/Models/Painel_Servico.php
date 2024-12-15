<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Painel_Servico extends Model
{
    protected $table='painel_servicos';


    protected $primaryKey = 'id_painel_servicos';


     protected $fillable=[
         'servico_id',
         'painel_id'

     ];

}
