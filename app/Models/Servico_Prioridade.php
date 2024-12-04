<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Servico_Prioridade extends Model
{
    protected $table='servico_prioridade';


   protected $primaryKey = 'id_servico_prioridade';


    protected $fillable=[
        'servico_id',
        'prioridade_id'


    ];

    public function servicos() : BelongsTo{

        return $this->belongsTo(Servico::class,'id_servico');

    }

}
