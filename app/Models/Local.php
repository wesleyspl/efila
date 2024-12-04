<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Local extends Model
{
    protected $table='local';


    protected $primaryKey = 'id_local';


     protected $fillable=[
         'nome'

     ];



      public function atendente_local():HasMany{
        return $this->hasMany(Atendente_Local::class,'local_id');
      }
}
