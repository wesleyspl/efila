<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Departamento extends Model
{
    protected $table='departamento';


   protected $primaryKey = 'id_departamento';


    protected $fillable=[
        'nome'
    ];



    // Relacionamento: Um departamento tem muitos serviços
    public function servicos():HasMany
    {
        return $this->hasMany(Servico::class, 'departamento_id');
    }
    public function atendente_servico():HasMany
    {
        return $this->hasMany(Atendente_Servico::class, 'departamento_id','id_departamento');
    }
}
