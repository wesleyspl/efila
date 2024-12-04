<?php

namespace App\Http\Controllers;

use App\Http\Requests\TriagemRequest;
use App\Models\Atendente;
use App\Models\Atendente_Local;
use App\Models\Atendente_Servico;
use App\Models\Contador;
use App\Models\Departamento;
use App\Models\Local;
use App\Models\Servico;
use Illuminate\Http\Request;

class TriagemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $titulo;
    public $subtilulo;


    public function __construct()


    {
        $this->titulo = 'Triagem';
        $this->subtilulo = 'Configurar atendimentos';
    }
    public function index()
    {
        $atendente = Atendente::with('pessoa')->paginate(10);
        // dd($atendente[0]['pessoa']);



          $data=[
              "titulo"=>$this->titulo,
              'subtitulo'=>$this->subtilulo,
              'atendente'=>$atendente
           ];
              return view('triagem.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
    */
     # TRIAGEM : CRIA O POSTO DE ATENDIMENTO NO USANDO LOCAL EX:GUICHE + NUMERO
     # SELECIONA O DEPARTAMENTO QUE O ATENDENTE VAI TRABALHAR
     # SALVA A CONTAGEM DA SENHA NA TABELA CONTADOR
     #


    public function store(TriagemRequest $request,Atendente $atendente)
    {
       /*
         SALVAR TODOS SO DADOS FORMANDO ASSIM ATENDENTE DE UM DEPARTAMENTO
          QUE ATENDE A N SERVICOS EM UM LOCAL COM NUMERO
          PEGAR O ID DO LOCAL  OK
          PEGAR O NUMERO OK
          PEGAR O ID DO DEPARTAMENTO OK
          PEGAR O ID DO ATENDENTE OK
          PEGAR O ARRAY DE SERVICOS OK
          CADASTRO ATENDENTE, SERVICOS E DEPARTAMENTO NA TABELA ATENDENTE-SERVICO  COM VERIFICAÇÃO DE EXISTENCIA OK
          ATENDENTE LOCAL OK
          CRIA CONTADOR PARA O SERVICO CASO NÃO TENHA .OK
          */

       $id_local=Local::where('nome',$request->local)->get();
       $id_local=$id_local[0]->id_local;
       $numero=$request->numero;
       $departamento=Departamento::select('id_departamento')->where('nome',$request->departamento)->get();
       $id_atendente=$atendente->id_atendente;
       $id_servicos=$request->input('id_servico', []);



///  O ATENDENTE SO PODE TRABALHAR EM UM DEPARTAMENTO
////////
       foreach ($id_servicos as $servicos) {


        $id=$departamento[0]['id_departamento'];
        $s=Atendente_Servico::where('servico_id',$servicos)->where('departamento_id',$id)
        ->where('atendente_id', $id_atendente)
        ->first();

        #VERIFICA SE O ATENDENTE JÁ  ESTA NO DEPARTAMENTO SE NÃO CADASTRA SE JA EXISTE ATUALIZA DADOS.
        if(!$s){
            $dados=[
                'servico_id'=>$servicos,
                'atendente_id'=>$id_atendente,
                'departamento_id'=> $departamento[0]['id_departamento']
            ];

            Atendente_Servico::create($dados);
           //zerar a variavel  */
       }else{
        $dados=[
            'servico_id'=>$servicos,
            'atendente_id'=>$id_atendente,
            'departamento_id'=> $departamento[0]['id_departamento']
        ];
        $s->update($dados);
       }



       }
       ///agora salvar atendente_local

       $s=Atendente_Local::where('atendente_id',$id_atendente)->where('local_id',$id_local)->first();
       if(!$s){

       $dados=[
          'atendente_id'=>$id_atendente,
          'local_id'=>$id_local,
          'numero'=>$numero
       ];
       Atendente_Local::create($dados);
    }else{
        $s->update(['numero'=>$numero]);
    }
     //criar a contagem para os servicos

########  CRIA O SERVIÇO NA TABELA CONTADOR FILTRANDO PARA TER SOMENTE UM SERVIÇO POR DEPARTAMENTO ############
     foreach ($id_servicos as $servicos) {
        $id=$departamento[0]['id_departamento'];
       $s=Contador::where('servico_id',$servicos)->where('departamento_id',$id)->first();
        if(!$s){
        $dados=[
            'servico_id'=>$servicos,
            'departamento_id'=> $departamento[0]['id_departamento'],
            'numero'=>0
        ];

          Contador::create($dados);
          //zerar a variavel  */

      }
     }


       return redirect()->route('triagem')->with('success','Configuração da Triagem salva!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atendente $atendente)
    {
       $pessoa = Atendente::with('pessoa')->where('id_atendente',$atendente->id_atendente)->first();

        $departamento=Atendente_Servico::where('atendente_id',$atendente->id_atendente)->first();


      #####SE NÃO TIVER NENHUM SERVICO CADASTRADO PARA O USARIO MANDA PARA ROTA TRIAGEM COM MESSAGEM 'NENHUM SERVICO CADASTRADO PARA ESSE ATENDENTE'
      if(!$departamento){
        return redirect()->route('triagem')->with('error','NENHUM SERVICO CADASTRADO PARA ESSE ATENDENTE');

      }




      $departamentos = Departamento::whereHas('atendente_servico', function ($query) use ($atendente) {
        $query->where('atendente_id', $atendente->id_atendente);
    })->with('atendente_servico')->get();

         $local=Atendente_Local::whereHas('local',function ($query) use ($atendente){
            $query->where('atendente_id',$atendente->id_atendente);
         })->with('local')->get();

         $nLocal=Local::find($local[0]->local_id);

      $servico=Atendente_Servico::with('servicos')->where('atendente_id',$atendente->id_atendente)->get();
   // dd($servico[0]->servico_id);
     $serv=[];
       foreach ($servico as $servicos) {
           $serv[]= Servico::find($servicos['servico_id']);
       }

          $data=[
              "titulo"=>$this->titulo,
              'subtitulo'=>$this->subtilulo,
              'atendente'=>$atendente,
              'pessoa'=>$pessoa['pessoa']->nome,
              'departamento'=>$departamentos,
              'local'=>$nLocal,
              'numero'=>$local[0]->numero,
              'servico'=>$serv

           ];
              return view('triagem.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id,string $id_departamento,string $id_atendente)
    {
        echo $id;
        echo $id_departamento;
        echo $id_atendente;
        Atendente_Servico::where('servico_id',$id)
        ->where('departamento_id',$id_departamento)
        ->where('atendente_id',$id_atendente)
        ->delete();

     return redirect()->route('triagem.show',$id_atendente)->with('success','Configuração da Triagem salva!');


    }

    public function config(Atendente $atendente) #ok
    {
         /* pegar o nome da pessoa relação atendente pessoa
            pegar todos os locais
            pegar todos os servicos
            pegar todos os departamentos
                                           */



        $atendente = Atendente::with('pessoa')->find($atendente->id_atendente);
        // dd($atendente[0]['pessoa']);
        $local=Local::all();
        $servicos=Servico::all();
        $departamento=Departamento::all();

          $data=[
              "titulo"=>$this->titulo,
              'subtitulo'=>$this->subtilulo,
              'atendente'=>$atendente,
              'local'=>$local,
              'servicos'=>$servicos,
               'departamento'=>$departamento
           ];
              return view('triagem.create',$data);
    }

}
