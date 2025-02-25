<?php

namespace App\Livewire;

use App\Helpers\QueueHelper;
use App\Http\Controllers\AtendenteController;
use App\Models\Atendente;
use App\Models\Atendente_Local;
use App\Models\Atendente_Servico;
use App\Models\Fila;
use App\Models\Ordenacao;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Painel extends Component
{
    public $btnChamar = false;
    public $btnIniciaAtendento = false;
    public $btnFinalizaAtendimento = false;
    public $senha=[];
    public $atendente;
   
    public function chamar(){

        $this->senha = $this->chamarSenha();
    }


   
    public function chamarSenha()
    {
           QueueHelper::header();
           $dados=QueueHelper::header(); 

           $preferenciais=$dados['preferenciais'];
           $normais=$dados['normais'];
           $ord=$dados['ord'];
           $local_nome=$dados['local_nome'];
           $local_numero=$dados['local_numero'];
       
        
        if ($preferenciais->isNotEmpty() ) {
           return QueueHelper::handlePriorityTickets($preferenciais,$normais, $local_nome, $local_numero);
       } else {
        return QueueHelper::handleNormalTickets($normais,$preferenciais, $local_nome, $local_numero);
     
    }
    }


    public function render()
    {
        return view('livewire.painel');
    }
}
