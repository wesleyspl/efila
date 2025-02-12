<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Touch_Servico extends Model
{
    protected $table = 'touch_servicos';
    protected $primaryKey = 'id_touch_servico';
    protected $fillable = [
        'touch_id',
        'servico_id',
        'status',
        'created_at',
        'updated_at',
    ];

public function servico()
{
    return $this->belongsTo(Servico::class, 'servico_id', 'id_servico');

}

}