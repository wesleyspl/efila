<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Atendente extends Model
{
    protected $table='atendente';


    protected $primaryKey = 'id_atendente';


     protected $fillable=[
         'pessoa_id',
         'status'

     ];

   public function pessoa(): HasOne{
      return $this->hasOne(Pessoa::class,'id_pessoa','pessoa_id');
   }
   public function servicos():HasMany{
    return $this->hasMany(Atendente_Servico::class,'atendente_id');
 }

}
