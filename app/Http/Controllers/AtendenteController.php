<?php

namespace App\Http\Controllers;

use App\Http\Requests\PessoaRequest;
use App\Models\Atendente;
use App\Models\Atendente_Local;
use App\Models\Atendente_Servico;
use App\Models\Atendimento;
use App\Models\Fila;
use App\Models\Local;
use App\Models\Ordenacao;
use App\Models\Pessoa;
use App\Models\User;
use FontLib\Table\Type\loca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AtendenteController extends Controller
{
    /**
     * Display a listing of the resource.
     */


     public $titulo;
     public $subtilulo;
    public function __construct()


   {
      $this->titulo='Atendente';
      $this->subtilulo='Gerir Atendentes';



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
    public function update(PessoaRequest $request, Atendente $atendente)
    {
        $request->validated();

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
        //
    }

    public function painel()
    {
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo
         ];
           // Acessar os dados da sessão
       $user = Auth::user();
      $user_id = session()->all();  // ou session()->get('user_id');
      //dd($user->pessoa_id);
       $atendente=Atendente::where('pessoa_id',$user->pessoa_id)->first();
      // dd($atendente);
       $atendente->id_atendente;//
       $servico=Atendente_Servico::with('servicos')->where('atendente_id',$atendente->id_atendente)->get();
       //salvando servicos para o atendente
       $user_atend=[];
      // $minhaFila['fila']=null;
       foreach ($servico as $servicos) {
           $user_atend[]= $servicos['servicos'][0]['id_servico'];
          //$minhaFila['fila']=Fila::where('servico_id',$servicos['servicos'][0]['id_servico'])->get();
       }
     //  dd($user_atend);
       foreach ($user_atend as $key => $id_servicos) {
        DB::enableQueryLog();
        $id=$id_servicos;
        $minhaFila['fila'] = Fila::select('*')->get('servico_id',$id);
       // dd(DB::getQueryLog());
       }

      // dd($minhaFila);
       return view('atendente.painel',$minhaFila);

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

         // Busca todas as filas associadas aos serviços
         $fila = Fila::whereIn('servico_id', $ids_servicos)->get();

      //   dd($fila);
         $ord=Ordenacao::where('servico_id', $ids_servicos)->where('departamento_id',1)->get();
         $local=Atendente_Local::with('local')->where('atendente_id',$atendente->id_atendente)->get();

        //dados da senha p/ salvar na tabela atendimeto
       //  dd($local[0]['local'][0]->nome);
        $local_nome=$local[0]['local'][0]['nome'];
         $local_numero=$local[0]->numero;

        // dd($ord[0]);
         $prio_cont=$ord[0]->prio_cont;
            $prio_total=$ord[0]->prio_total;
            $nor_cont=$ord[0]->nor_cont;
            $nor_total=$ord[0]->nor_total;
        foreach ($fila as $filas) {

           ###### verificações
           ######IF SENHAS NORMAIS ACABAREM E SENHAS PRIORITARIAS ACABAREM RESETAR AS DUAS ####
           if(($prio_cont==$prio_total) and ($nor_cont==$nor_total)){
            $ord=Ordenacao::where('servico_id', $ids_servicos)->where('departamento_id',1)->first(); //seleciona o registro p/ atualizar
            $ord->update(['prio_cont'=>0]); // ZERA PRIORIDADE
            $ord->update(['nor_cont'=>0]); // ZERA normal
           }
           // var_dump($prio_cont==$prio_total);
            if(($nor_cont<>$nor_total) and ($filas->peso!=0) and ($prio_cont==$prio_total)){
                $ord=Ordenacao::where('servico_id', $ids_servicos)->where('departamento_id',1)->first(); //seleciona o registro p/ atualizar
                $ord->update(['prio_cont'=>$prio_cont-1]); // tiro um
// Recuperar o registro atualizado
               // $ord->update(['nor_cont'=>0]); // ZERA normal

            }


            #####  acabou espaco para senha normal não tem fila preferencial na espera
            #####  entao subtrai uma da normal
            #####
            if(($nor_cont==$nor_total) and ($filas->peso==0) and ($prio_cont<>$prio_total)){
                $ord=Ordenacao::where('servico_id', $ids_servicos)->where('departamento_id',1)->first(); //seleciona o registro p/ atualizar
                $ord->update(['nor_cont'=>$nor_cont-1]); // tiro um
// Recuperar o registro atualizado
               // $ord->update(['nor_cont'=>0]); // ZERA normal

            }


            ###pega os dados atualizados
            $ord=Ordenacao::where('servico_id', $ids_servicos)->where('departamento_id',1)->get();


           // dd($ord[0]);
               $prio_cont=$ord[0]->prio_cont;

               $nor_cont=$ord[0]->nor_cont;


           // dd($nor_cont);
           if (($filas->peso!=0) and ($prio_cont < $prio_total)) {//verifica se tem prioridades na fila

                    foreach ($fila as $prioridade) { //passar por todas as senhas
                         //  dd($prioridade->peso);
                            $p=$prioridade->peso;
                        if ($p>0) { // filtrar as prioridades
                               $ord=Ordenacao::where('servico_id', $ids_servicos)->where('departamento_id',1)->first(); //seleciona o registro p/ atualizar
                              // $prio_cont=$ord->prio_cont;
                               $ord->update(['prio_cont'=>$prio_cont+1]); // atualiza a tabela ordenação
                               $fila = Fila::where('servico_id', $prioridade->servico_id)->where('departamento_id',1)->first();
                               //monta a senha p/ salvar na tabela atendimento
                               $dados=[
                                  'sigla'=>$fila->sigla,
                                  'numero'=>$fila->numero,
                                  'status'=>'chamado',
                                  'nome_local'=>$local_nome,
                                  'numero_local'=>$local_numero
                               ];

                              $fila->delete($fila->id_fila);//deleta da fila
                              $atendimento= Atendimento::create($dados); //salva na tabela atendimento


                             return response()->json(['senha'=>$atendimento->sigla.''.$atendimento->numero], 201);//finaliza a função
                         }


                    }



           }else{// se não tiver chama as senhas normais
            foreach ($fila as $prioridade) { //passar por todas as senhas
                  // $p=$prioridade->peso;
                   //dd($prioridade->peso);
                 if($nor_cont<$nor_total){ //se ainda tiver senha p/ chamar normal chama

                    if ($prioridade->peso==0) {
                    $ord=Ordenacao::where('servico_id', $ids_servicos)->where('departamento_id',1)->first(); //seleciona o registro p/ atualizar
                    $ord->update(['nor_cont'=>$nor_cont+1]); // atualiza a tabela ordenação
                    $fila = Fila::where('servico_id', $prioridade->servico_id)->where('departamento_id',1)->first();
                    //monta a senha p/ salvar na tabela atendimento
                    $dados=[
                       'sigla'=>$fila->sigla,
                       'numero'=>$fila->numero,
                       'status'=>'chamado',
                       'nome_local'=>$local_nome,
                       'numero_local'=>$local_numero
                    ];

                   // dd($fila->id_fila);
                   $fila->delete($fila->id_fila);//deleta da fila
                   Atendimento::create($dados); //salva na tabela atendimento
                   return true; //finaliza a função
                }
                 }

                }

           }

        }




    }




}