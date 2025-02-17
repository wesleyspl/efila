<?php
// filepath: /c:/laragon/www/efila/app/Helpers/QueueHelper.php

namespace App\Helpers;

use App\Models\Fila;
use App\Models\Ordenacao;
use App\Models\Painel_Senha;
use Illuminate\Support\Facades\Session;

class QueueHelper
{
    public static function updateCounters($ord)
    {
        return [
            'prio_cont' => $ord->prio_cont,
            'prio_total' => $ord->prio_total,
            'nor_cont' => $ord->nor_cont,
            'nor_total' => $ord->nor_total,
        ];
    }

    public static function createAtendimento($fila, $local_nome, $local_numero)
    {
        $dados = [
            'sigla' => $fila->sigla,
            'numero' => $fila->numero,
            'status' => 'chamar',
            'nome_local' => $local_nome,
            'numero_local' => $local_numero,
            'servico_id' => $fila->servico_id,
            'peso' => $fila->peso
        ];

        $fila->delete();
        $atendimento = Painel_Senha::create($dados);
        // Salva o usuário na sessão
        Session::put('type','chamando');
       Session::put('senha',$fila->sigla . '' . $fila->numero);        
        return response()->json(['senha' => $atendimento->sigla . '' . $atendimento->numero, 'id_atendimento' => $atendimento->id_painel], 201);
    }

    public static function handlePriorityTickets($preferenciais,$normais, $local_nome, $local_numero)
    {
        $ord = Ordenacao::where('servico_id', $preferenciais[0]->servico_id)->first();
        $counters = self::updateCounters($ord);

        if (($counters['prio_cont'] == $counters['prio_total']) and ($counters['nor_cont'] == $counters['nor_total'])) {
            $ord->update(['prio_cont' => 0, 'nor_cont' => 0]);
            //SE ACAABAR PRIORITARIAS E NORMAIS ZERO OS CONTADORES
        }

        if (($counters['nor_cont'] != $counters['nor_total']) and ($preferenciais[0]->peso != 0) and ($counters['prio_cont'] == $counters['prio_total']) ) {
            // echo 'ta cheio e ainda tenho preferenciais';
             $ord->update(['prio_cont' => $counters['prio_cont'] + 1]);
           return self::createAtendimento($preferenciais[0], $local_nome, $local_numero);

            //SE TIVER NORMAIS E PREFERENCIAIS E CONTADOR PREFERENCIAL CHEGAR NO FINAL
        }
    
        if (($counters['nor_cont'] != $counters['nor_total']) and ($preferenciais[0]->peso != 0) and ($counters['prio_cont'] == $counters['prio_total']) and $normais[0]->peso == 0 ) {
          //  echo 'ta cheio e ainda tenho preferenciais';
            $ord->update(['prio_cont' => $counters['prio_cont'] + 1]);
          return self::createAtendimento($preferenciais[0], $local_nome, $local_numero);

           //SE TIVER NORMAIS E PREFERENCIAIS E CONTADOR PREFERENCIAL CHEGAR NO FINAL
       }



        $counters = self::updateCounters($ord);

        if (($preferenciais[0]->peso != 0) and ($counters['prio_cont'] < $counters['prio_total'])) {
            $ord->update(['prio_cont' => $counters['prio_cont'] + 1]);
            echo 'aqui';
            return self::createAtendimento($preferenciais[0], $local_nome, $local_numero);
        }
    }

    public static function handleNormalTickets($normais,$preferenciais, $local_nome, $local_numero)
    {
        $ord = Ordenacao::where('servico_id', $normais[0]->servico_id)->first();
        $counters = self::updateCounters($ord);

        if (($counters['prio_cont'] == $counters['prio_total']) and ($counters['nor_cont'] == $counters['nor_total'])) {
            $ord->update(['prio_cont' => 0, 'nor_cont' => 0]);
        }

       
        if (($counters['nor_cont'] == $counters['nor_total']) and ($normais[0]->peso == 0) ) {
           //  echo 'ta cheio e ainda tenho normais';
             $ord->update(['nor_cont' => $counters['nor_cont'] - 1]);
            // $ord->update(['prio_cont' => $counters['prio_cont'] + 1]);
            return self::createAtendimento($normais[0], $local_nome, $local_numero);
         }




        if (($counters['nor_cont'] == $counters['nor_total']) and ($normais[0]->peso == 0) and ($counters['prio_cont'] != $counters['prio_total']) and $preferenciais[0]->peso != 0 ) {
            $ord->update(['nor_cont' => $counters['nor_cont'] - 1]);
          //  $ord->update(['prio_cont' => $counters['prio_cont'] + 1]);
            return self::createAtendimento($normais[0], $local_nome, $local_numero);
        }

        $counters = self::updateCounters($ord);

        if (($normais[0]->peso == 0) and ($counters['nor_cont'] < $counters['nor_total'])) {
            $ord->update(['nor_cont' => $counters['nor_cont'] + 1]);
            
            return self::createAtendimento($normais[0], $local_nome, $local_numero);
        }
    }
}