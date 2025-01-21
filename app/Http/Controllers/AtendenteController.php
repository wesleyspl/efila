<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Atendente;
use App\Models\Atendente_Local;
use App\Models\Atendente_Servico;
use App\Models\Atendimento;
use App\Models\Departamento;
use App\Models\Fila;
use App\Models\Historico;
use App\Models\Local;
use App\Models\Ordenacao;
use App\Models\Painel_Senha;
use App\Models\Pessoa;
use App\Models\User;
use FontLib\Table\Type\loca;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class AtendenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public $titulo;
     public $subtilulo;



     public $prio_cont;
     public $prio_total;
     public $nor_cont;
     public $nor_total;
    public function __construct()


   {
      $this->titulo='Atendente';
      $this->subtilulo='Gerir Atendentes';



   }


    public function index()
    {
        $atendente = Atendente::where('status','=','ativo')->with('pessoa')->paginate(10);
      // dd($atendente[0]['pessoa']);



        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'atendente'=>$atendente
         ];
            return view('atendente.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,

         ];
            return view('atendente.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PessoaRequest $request)
    {
        $request->validated();
        $dados=[
            'nome'=>$request->nome,
            'cpf'=>$request->cpf,
            'email'=>$request->email
        ];

        $pessoa=Pessoa::create($dados); //salva nova pessoa
        //cria um novo atendente com o  id da pessoa criada
        //echo $pessoa->id_pessoa;
        $dados=[
            'pessoa_id'=>$pessoa->id_pessoa
        ];
        $atendente=Atendente::create($dados);

        $user = User::create([
            'name' => $request->nome,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'pessoa_id'=>$pessoa->id_pessoa,
            'perfil_id'=>1
        ]);
        return redirect()->route('atendente')->with('success','Atendente adicionado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Atendente $atendente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atendente $atendente)
    {
        //dd($atendente);
        $atendente = Atendente::with('pessoa')->where('pessoa_id',$atendente->pessoa_id)->get();
        //dd($atendente[0]);
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'atendente'=>$atendente[0]
         ];
            return view('atendente.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atendente $atendente)
    {
      // Encontre a pessoa pelo ID

      $dados=[
            'nome'=>$request->nome,
            'email'=>$request->email,
            'cpf'=>$request->cpf
        ];
        $rs=Pessoa::find($atendente->pessoa_id);

        $rs->update($dados);

        return redirect()->route('atendente')->with('success','Atendente atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Atendente $atendente)
    {
        $atendente->update(['status'=>'inativo']);
        return redirect()->route('atendente')->with('success','Atendente Inativado!');
    }

    public function painel()
    {
            // Acessar os dados da sessão
            $user = Auth::user();
            $user_id = session()->all();  // ou session()->get('user_id');
           // dd($user->pessoa_id);
             $atendente=Atendente::where('pessoa_id',$user->pessoa_id)->first();
           //  dd($atendente);
             $atendente->id_atendente;//
             $servico=Atendente_Servico::with('servicos')->where('atendente_id',$atendente->id_atendente)->get();



        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo

         ];

       //salvando servicos para o atendente
       $user_atend=[];
      // $minhaFila['fila']=null;
       foreach ($servico as $servicos) {
           $user_atend[]= $servicos['servicos'][0]['id_servico'];
          //$minhaFila['fila']=Fila::where('servico_id',$servicos['servicos'][0]['id_servico'])->get();
       }
     //  dd($user_atend);
     $local=Atendente_Local::with('local')->where('atendente_id',$atendente->id_atendente)->get();

     //dados da senha p/ salvar na tabela atendimeto
    //  dd($local[0]['local'][0]->nome);
     $local_nome=$local[0]['local'][0]['nome'];
      $local_numero=$local[0]->numero;
       foreach ($user_atend as $key => $id_servicos) {
        DB::enableQueryLog();
        $id=$id_servicos;
        $minhaFila['fila'] = Fila::select('*')->get('servico_id',$id);
       // dd(DB::getQueryLog());
     //  dd($minhaFila);
       $minhaFila['local']=$local_nome;
       $minhaFila['numero']=$local_numero;
       }

       if($user_atend==null){
         echo 'VOCE NÃO TEM SERVICOS ATIVOS, PROCURE  O ADMINISTRADOR DO SISTEMA.';

       }else{
       return view('atendente.painel',$minhaFila);
       }
    }

    public function atualizaFila()
    {
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

        // Busca todas as filas associadas aos serviços
        $fila = Fila::whereIn('servico_id', $ids_servicos)->get();

        // Retorna os dados como JSON
        return response()->json(['fila' => $fila]);
    }

  ######    FUNÇÃO MAIS IMPORTANTE DO SISTEMA
  #     CHAMAR PROXIMO VAI CHAMAR A SENHA SEGUINDO OS PARAMENTROS DO SISTEMA
  #     PARA INICIO VAI CHAMAR POR PADRAO 5 PRIORIDADES E 5 NORMAIS
  #     LOGICA
 #      VERIFICA SE TEM PRIORIDADES NA FILA
 #      SE TIVER CHAMA ATE QTD TOTAL=5
 #      SE NÃO TIVER CHAMA NORMAL ATE QTD TOTAL=5
 #      NORMAL E PRORITARIAS IGUAIS  LIMITE RESETA AS DUAS
###    CRIAR UM HELPER PARA  ESSA FUNÇÃO FICOU MUITO COMPLEXA
    public function chamarProximo()
    {

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
         //dd($ord);
         $local=Atendente_Local::with('local')->where('atendente_id',$atendente->id_atendente)->get();

        //dados da senha p/ salvar na tabela atendimeto
       //  dd($local[0]['local'][0]->nome);
        $local_nome=$local[0]['local'][0]['nome'];
         $local_numero=$local[0]->numero;

           #achei o bug tem que pegar a ordenação do serviço em si.
          /*
            */




     if ($preferenciais->isNotEmpty()) {


         $ord=Ordenacao::where('servico_id',$preferenciais[0]->servico_id)->first(); //seleciona o registro p/ atualizar
         $this->prio_cont=$ord->prio_cont;
         $this->prio_total=$ord->prio_total;
         $this->nor_cont=$ord->nor_cont;
         $this->nor_total=$ord->nor_total;


        ##SE SENHA PRIORIDADE E SENHA NORMAL CHEGAM AO FIM RESETA TODAS E RECOMEÇA
        if(($this->prio_cont==$this->prio_total) and ($this->nor_cont==$this->nor_total)){
            $ord=Ordenacao::where('servico_id',$preferenciais[0]->servico_id)->first(); //seleciona o registro p/ atualizar
            $ord->update(['prio_cont'=>0]); // ZERA PRIORIDADE
            $ord->update(['nor_cont'=>0]); // ZERA normal
           }


   // var_dump($prio_cont==$prio_total);
   if(($this->nor_cont<>$this->nor_total) and ($preferenciais[0]->peso!=0) and ($this->prio_cont==$this->prio_total)){
    $ord=Ordenacao::where('servico_id', $preferenciais[0]->servico_id)->first(); //seleciona o registro p/ atualizar
    $ord->update(['prio_cont'=>$this->prio_cont-1]); // tiro um
// Recuperar o registro atualizado
   // $ord->update(['nor_cont'=>0]); // ZERA normal

}

            #### PEGA ORDENAÇÃO MAIS UMA VEZ APOS ATUALIZAR
        $ord=Ordenacao::where('servico_id',$preferenciais[0]->servico_id)->first(); //seleciona o registro p/ atualizar

        $this->prio_cont=$ord->prio_cont;
        $this->prio_total=$ord->prio_total;
        $this->nor_cont=$ord->nor_cont;
        $this->nor_total=$ord->nor_total;






        if (($preferenciais[0]->peso!=0) and ($this->prio_cont < $this->prio_total)) {
        // $prio_cont=$ord->prio_cont;
         $ord->update(['prio_cont'=>$this->prio_cont+1]); // atualiza a tabela ordenação

         $dados=[
            'sigla'=>$preferenciais[0]->sigla,
            'numero'=>$preferenciais[0]->numero,
            'status'=>'chamar',
            'nome_local'=>$local_nome,
            'numero_local'=>$local_numero,
            'servico_id'=>$preferenciais[0]->servico_id,
             'peso'=>$preferenciais[0]->peso
         ];

        $fila= Fila::where('id_fila',$preferenciais[0]->id_fila)->first();//deleta da fila
         $fila->delete();
        $atendimento=Painel_Senha::create($dados);
        return response()->json(['senha'=>$atendimento->sigla.''.$atendimento->numero,'id_atendimento'=>$atendimento->id_painel], 201);//finaliza a função

        }


     }else{
        $ord=Ordenacao::where('servico_id',$normais[0]->servico_id)->first(); //seleciona o registro p/ atualizar

        $this->prio_cont=$ord->prio_cont;
        $this->prio_total=$ord->prio_total;
        $this->nor_cont=$ord->nor_cont;
        $this->nor_total=$ord->nor_total;


         ##SE SENHA PRIORIDADE E SENHA NORMAL CHEGAM AO FIM RESETA TODAS E RECOMEÇA
         if(($this->prio_cont==$this->prio_total) and ($this->nor_cont==$this->nor_total)){
            $ord=Ordenacao::where('servico_id',$normais[0]->servico_id)->first(); //seleciona o registro p/ atualizar
            $ord->update(['prio_cont'=>0]); // ZERA PRIORIDADE
            $ord->update(['nor_cont'=>0]); // ZERA normal
           }





        if(($this->nor_cont==$this->nor_total) and ($normais[0]->peso==0) and ($this->prio_cont<>$this->prio_total)){
            $ord=Ordenacao::where('servico_id', $normais[0]->servico_id)->first(); //seleciona o registro p/ atualizar
            $ord->update(['nor_cont'=>$this->nor_cont-1]); // tiro um
// Recuperar o registro atualizado
           // $ord->update(['nor_cont'=>0]); // ZERA normal


        }




        #### PEGA ORDENAÇÃO MAIS UMA VEZ APOS ATUALIZAR
        $ord=Ordenacao::where('servico_id',$normais[0]->servico_id)->first(); //seleciona o registro p/ atualizar

        $this->prio_cont=$ord->prio_cont;
        $this->prio_total=$ord->prio_total;
        $this->nor_cont=$ord->nor_cont;
        $this->nor_total=$ord->nor_total;




        if (($normais[0]->peso==0) and ($this->nor_cont < $this->nor_total)) {
         $ord->update(['nor_cont'=>$this->nor_cont+1]); // atualiza a tabela ordenação

         $dados=[
            'sigla'=>$normais[0]->sigla,
            'numero'=>$normais[0]->numero,
            'status'=>'chamar',
            'nome_local'=>$local_nome,
            'numero_local'=>$local_numero,
            'servico_id'=>$normais[0]->servico_id,
            'peso'=>$normais[0]->peso
         ];

        $fila= $normais->where('id_fila',$normais[0]->id_fila)->first();//deleta da fila

        $fila->delete();
        $atendimento=Painel_Senha::create($dados);
        return response()->json(['senha'=>$atendimento->sigla.''.$atendimento->numero,'id_atendimento'=>$atendimento->id_painel], 201);//finaliza a função
        }

     }




    }

  public function iniciaAtendimento(Painel_Senha $atendimento){

       // dd($atendimento->id_atendimento);
        ### PRIMEIRO  ATUALIZAR O STATOS DO ATENDIMENTO PARA ATENDENDO.
        #####

        $atendimento->update(['status'=>'atendendo']);


        $dados=[
            "painel_id"=>$atendimento->id_painel,
            "sigla" =>$atendimento->sigla,
            "numero" =>$atendimento->numero,
            "status" =>$atendimento->status,
            "nome_local" =>$atendimento->nome_local,
            "numero_local" =>$atendimento->numero_local,
            "servico_id" =>$atendimento->servico_id
        ];
        Atendimento::create($dados);
        $atendimento->delete($atendimento->id_painel);

      // dd($atendimento);
     ##  CRIAR ROTINA AQUI CRIAR ATENDIMENTO QUANDO A SENHA TIVER STATUS ATENDENDO





         return response()->json(['senha'=>$atendimento->sigla.''.$atendimento->numero,
                                   'id'=>$atendimento->id_painel], 201);//finaliza a função



  }

  public function encerraAtendimento($id){

        ### PRIMEIRO  ATUALIZAR O STATOS DO ATENDIMENTO PARA ATENDENDO.
        #####
       ## ERRO LEVAR ID DO PAINEL OU FAZER
      //  dd($atendimento);

        Atendimento::where('painel_id','=',$id)
        ->update(['status'=>'finalizado']);
        /* return response()->json(['senha'=>$atendimento->sigla.''.$atendimento->numero,
                                   'id'=>$atendimento->id_atendimento], 201);//finaliza a função
              */

              return 1;
  }

   public function naoComapareceu(Atendimento $atendimento){

     // dd($atendimento->id_atendimento);
        ### PRIMEIRO  ATUALIZAR O STATOS DO ATENDIMENTO PARA nao compareceu.
        #####

        $atendimento->update(['status'=>'n_compareceu']);
        /* return response()->json(['senha'=>$atendimento->sigla.''.$atendimento->numero,
                                   'id'=>$atendimento->id_atendimento], 201);//finaliza a função
              */
              return 1;

   }

}
