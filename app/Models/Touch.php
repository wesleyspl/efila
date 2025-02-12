<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Touch extends Model
{   
    
    protected $table = 'touch';
    protected $primaryKey = 'id_touch';
    protected $fillable = [
        'nome',
        'obs',
        'status',
        'created_at',
        'updated_at',
    ];
}
