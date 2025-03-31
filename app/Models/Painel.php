<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Painel extends Model
{
    protected $table='painel';


    protected $primaryKey = 'id_painel';


     protected $fillable=[

         'nome',
         'obs',
         'key',
        'status',
        'player',
        'url_midia'
     ];


     public static function updatePainel($id,$data)
     {  

        dd($data);
        try {
            $ok = Painel::where('id_painel', $id)->update($data);
            return $ok; // Retorna o resultado da operação
        } catch (\Throwable $th) {
            // Log do erro ou tratamento personalizado
            Log::error('Erro ao atualizar o painel: ' . $th->getMessage());
            return false; // Retorna false em caso de erro
        }
     }
}
