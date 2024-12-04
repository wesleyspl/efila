<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prioridade extends Model
{
    protected $table='prioridade';


    protected $primaryKey = 'id_prioridade';


     protected $fillable=[
         'nome',
         'peso',
         'ativo'
     ];

     public function prioridades() : HasMany{

        return $this->hasMany(Servico_Prioridade::class,'prioridade_id');

    }

}
