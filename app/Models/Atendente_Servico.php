<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Atendente_Servico extends Model
{
    protected $table='atendente_servico';


    protected $primaryKey = 'id_atendente_servico';


     protected $fillable=[
         'servico_id',
         'atendente_id',
         'departamento_id'

     ];

public function servicos():HasMany{

    return $this->hasMany(Servico::class,'id_servico','servico_id');
}

public function departamentos():BelongsTo{
    return $this->belongsTo(Departamento::class,'id_departamento','departemento_id');
}
public function atendente():BelongsTo{
    return $this->belongsTo(Atendente::class,'id_atendente','atendente_id');
}


}
