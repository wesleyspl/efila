<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Servico extends Model
{
   protected $table='servico';


   protected $primaryKey = 'id_servico';


    protected $fillable=[
        'nome',
        'sigla',
        'departamento_id'
    ];


public function prioridades() : HasMany {

    return $this->hasMany(Servico_Prioridade::class,'servico_id');

}

public function atendente_servico():HasMany{
    return $this->hasMany(Atendente_Servico::class,'servico_id','id_servico');
}

  // Relacionamento: Um serviço pertence a um departamento
  public function departamento()
  {
      return $this->belongsTo(Departamento::class, 'departamento_id');
  }

}
