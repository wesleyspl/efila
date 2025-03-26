<?php

namespace App\Helpers;

use App\Models\Atendente;
use App\Models\Atendente_Local;
use App\Models\Atendente_Servico;
use App\Models\Fila;
use App\Models\Ordenacao;
use App\Models\Painel_Senha;
use App\Models\Pessoa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class QueueHelper
{
    /**
     * Atualiza os contadores de prioridade e normal.
     *
     * @param  \App\Models\Ordenacao  $ord
     * @return array
     */
    public static function updateCounters($ord)
    {
        return [
            'prio_cont' => $ord->prio_cont,
            'prio_total' => $ord->prio_total,
            'nor_cont' => $ord->nor_cont,
            'nor_total' => $ord->nor_total,
        ];
    }



public static function header(){
     // Obtém o usuário autenticado
     $user = Auth::user();
      
     // Busca o atendente vinculado ao usuário
     $atendente = Atendente::where('pessoa_id', $user->pessoa_id)->first();
    
     if (!$atendente) {
         return response()->json(['fila' => []]); // Retorna fila vazia se não houver atendente
     }

     // Obtém os serviços associados ao atendente
     $servicos = Atendente_Servico::with('servicos')
         ->where('atendente_id', $atendente->id_atendente)
         ->get();
      
     // Extrai os IDs dos serviços
     $ids_servicos = $servicos->pluck('servicos.*.id_servico')->flatten()->toArray();
      
     if (empty($ids_servicos)) {
         return response()->json(['fila' => []]); // Retorna fila vazia se não houver serviços
     }

     // Busca todos os serviços asociados ao usuario
     $preferenciais = Fila::whereIn('servico_id', $ids_servicos)
     ->where('peso','=','1')
     ->get();
      
     $normais = Fila::whereIn('servico_id', $ids_servicos)
     ->where('peso','=','0')
     ->get();

     $ord=Ordenacao::whereIn('servico_id', $ids_servicos)->get();
     
     $local=Atendente_Local::with('local')->where('atendente_id',$atendente->id_atendente)->get();

    //dados da senha p/ salvar na tabela atendimeto
   //  dd($local[0]['local'][0]->nome);
    $local_nome=$local[0]['local'][0]['nome'];
     $local_numero=$local[0]->numero;

       #achei o bug tem que pegar a ordenação do serviço em si.
      /*
        */
       if(isset($preferenciais[0])){
        $ord = Ordenacao::where('servico_id', $preferenciais[0]->servico_id)->first();
       }
// dd($ord);
// Handle priority tickets
     return ['preferenciais' => $preferenciais, 'normais' => $normais, 'ord' => $ord, 'local_nome' => $local_nome, 'local_numero' => $local_numero];


}






    /**
     * Cria um novo atendimento e salva na sessão.
     *
     * @param  \App\Models\Fila  $fila
     * @param  string  $local_nome
     * @param  int  $local_numero
     * @return \Illuminate\Http\JsonResponse
     */
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
        Session::put('id_atendimento', $atendimento->id_painel);
        Session::put('type', 'chamando');
        Session::put('senha', $fila->sigla . '' . $fila->numero);
        return response()->json(['senha' => $atendimento->sigla . '' . $atendimento->numero, 'id_atendimento' => $atendimento->id_painel], 201);
    }

    /**
     * Lida com os tickets prioritários.
     *
     * @param  array  $preferenciais
     * @param  array  $normais
     * @param  string  $local_nome
     * @param  int  $local_numero
     * @return \Illuminate\Http\JsonResponse|null
     */
    public static function handlePriorityTickets($preferenciais, $normais, $local_nome, $local_numero)
    {
        $ord = Ordenacao::where('servico_id', $preferenciais[0]->servico_id)->first();
        $counters = self::updateCounters($ord);

    
    

        if ( $counters['prio_cont'] < $counters['prio_total']) {
            $ord->update(['prio_cont' => $counters['prio_cont'] + 1]);
            return self::createAtendimento($preferenciais[0], $local_nome, $local_numero);
        }


        $counters = self::updateCounters($ord);

        // Se houver tickets prioritários e o contador de prioritários não atingir o total
        if ($counters['prio_cont'] == $counters['prio_total'] and isset($normais[0])) {
                
                       if($counters['nor_cont'] < $counters['nor_total']){
                        $ord->update(['nor_cont' => $counters['nor_cont'] + 1]);
                        return self::createAtendimento($normais[0], $local_nome, $local_numero);
                       }else{
                        $ord->update(['prio_cont' =>1, 'nor_cont' =>0]);
                        return self::createAtendimento($preferenciais[0], $local_nome, $local_numero);
                       }
        }
        $counters = self::updateCounters($ord);

        //aqui p/ normais
        if ($counters['prio_cont'] == $counters['prio_total'] and !isset($normais[0])) {
          
             return self::createAtendimento($preferenciais[0], $local_nome, $local_numero);
       }


        return 'oi';
    }

    /**
     * Lida com os tickets normais.
     *
     * @param  array  $normais
     * @param  array  $preferenciais
     * @param  string  $local_nome
     * @param  int  $local_numero
     * @return \Illuminate\Http\JsonResponse|null
     */
    public static function handleNormalTickets($normais, $preferenciais, $local_nome, $local_numero)
    {
        $ord = Ordenacao::where('servico_id', $normais[0]->servico_id)->first();
        $counters = self::updateCounters($ord);


        $counters = self::updateCounters($ord);

        if ( $counters['nor_cont'] < $counters['nor_total'])  {
            $ord->update(['nor_cont' => $counters['nor_cont'] + 1]);
            return self::createAtendimento($normais[0], $local_nome, $local_numero);
        }else{
            $ord->update(['nor_cont' =>1]);
            return self::createAtendimento($normais[0], $local_nome, $local_numero);
        }

     
        
    }

    public static function UserLogin($id_pessoa):object{
         
          $user=Pessoa::find($id_pessoa);
          return $user;

    }

}