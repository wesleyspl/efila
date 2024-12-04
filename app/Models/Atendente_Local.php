<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Atendente_Local extends Model
{
    protected $table='atendente_local';


    protected $primaryKey = 'id_atendente_local';


     protected $fillable=[
         'atendente_id',
         'local_id',
         'numero'

     ];

     public function local():HasMany{
        return $this->hasMany(Local::class,'id_local','local_id');
     }
}
