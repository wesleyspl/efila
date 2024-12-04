<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pessoa extends Model
{
    protected $table='pessoa';


    protected $primaryKey = 'id_pessoa';


     protected $fillable=[
         'nome',
          'email',
          'cpf'

     ];

     public function atendente(): BelongsTo{
        return $this->belongsTo(Atendente::class,'pessoa_id');
     }

}
