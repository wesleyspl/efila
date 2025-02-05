<?php

namespace App\Http\Controllers;

use App\Http\Requests\PainelRequest;
use App\Models\Atendimento;
use App\Models\Historico;
use App\Models\Painel;
use App\Models\Painel_Senha;
use App\Models\Painel_Servico;
use App\Models\Servico;
use Illuminate\Container\Attributes\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class PainelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $titulo;
    public $subtilulo;








    public function __construct()


    {
       $this->titulo='Painel';
       $this->subtilulo='Gerir Painel';



    }




    public function index()
    {     $data=[
        "titulo"=>$this->titulo,
        'subtitulo'=>$this->subtilulo,
        'painel'=>Painel::where('status','=','ativo')->paginate(10)
     ];
        //buscar os painel criados

        return view('painel.list',$data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'painel'=>Painel::paginate(10)
         ];
            //buscar os painel criados

            return view('painel.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PainelRequest $request)
    {
           //validar o formulario
        $request->validated();

        //validado agora é salvar
       $dados=['nome'=>$request->nome,
               'obs'=>$request->obs


    ];

       Painel::create($dados);
       //redirecionar
       return redirect()->route('painel')->with('success','Painel cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id_painel)
    {
       /* $ultimasSenhas = Historico::where('status', '=', 'chamado') // Onde o status não é 'finalizado'
        ->orderBy('id_historico', 'desc')
        ->limit(5)
        ->get();

        $ultimasChamada = Atendimento::where('status', '=', 'chamado') // Onde o status não é 'finalizado'
        ->orderBy('id_atendimento', 'desc')
        ->limit(1)
        ->get();
       // dd($ultimasChamada[0]);
        $dados['senha']=$ultimasChamada[0];
       // Adiciona a nova senha ao início do array

        $dados['ultimas_senhas']=$ultimasSenhas;
       // Exemplo para o seu caso com as últimas senhas chamadas: */
        $dados['id_painel']=$id_painel;

       return view('painel.painel',$dados);
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
    public function destroy(string $id)
    {
        //
    }

  public function config(Painel $painel){


    $servicos = Painel_Servico::where('painel_id',$painel->id_painel)->get();
 // dd($servicos);
// Extrai os IDs dos serviços
 $ids_servicos = $servicos->pluck('servico_id')->toArray();
 $rs=Servico::whereIn('id_servico', $ids_servicos)->get();
 //dd($rs);
    $data=[
        "titulo"=>$this->titulo,
        'subtitulo'=>$this->subtilulo,
        'painel'=>$painel,
        'meus_servicos'=>Servico::whereIn('id_servico', $ids_servicos)->where('status','ativo')->get(),
        'servico'=>Servico::whereNotIn('id_servico', $ids_servicos)->where('status','ativo')->get()
     ];

    return view('painel.config',$data);


  }


  public function save(Request $request){


        $painel_id=$request->id_painel;
        $servico_id=$request->input('id_servico', []);
      foreach ($servico_id as $servico) {
        $s=Painel_Servico::where('servico_id',$servico)
        ->where('painel_id',$painel_id)
        ->get();
        if($s->isEmpty()){
            $dados=['painel_id'=>$painel_id,
                    'servico_id'=>$servico
      ];
           Painel_Servico::create($dados);
      }else{

        $dados=['painel_id'=>$painel_id,
        'servico_id'=>$servico ];
        $s->update($dados);
      }
    }

    return redirect()->route('painel')->with('success','Painel Atualizado!');

  }

  public function painelAtualiza(string $id)
  {
      $ultimasSenhas = [];
      $ultimasChamada = [];

      // Pegar os serviços que estão cadastrados para esse painel
      $servicos = Painel_Servico::where('painel_id', '=', $id)
          ->pluck('servico_id'); // Obtém os IDs dos serviços diretamente

      // Verifica se o painel possui serviços cadastrados
      if ($servicos->isEmpty()) {
          return response()->json(['message' => 'Nenhum serviço encontrado para esse painel'], 404);
      }
     // dd($servicos);

       // faazer um foreach buscando os servicos no historico
       $historico=[];

                $historico= Historico::whereIn('servico_id',$servicos)
                ->orderBy('created_at', 'desc') // Ordena pela coluna created_at, mais recente primeiro
                ->limit(5)
                ->get();
              if($historico->isNotEmpty()){
                $ultimasChamada[]=$historico;
              }
              #### SENHA PRA CHAMAR VAI CHAMAR A PRIMEIRA QUE ENCONTAR



        //dd($historico);
      ///monta o array com 5 valores
      $tem_senha= Painel_Senha::whereIn('servico_id',$servicos)
      ->where('status', '=', 'chamar')
      ->get();

     // dd($tem_senha);


          if ($tem_senha->isNotEmpty()) {
              // Quando há resultados
              $ultimasSenhas[]=$tem_senha[0];
              //salva na tabela historico
              // dd($ultimasSenhas[0]);
              $dados=[
                 'sigla'=>$tem_senha[0]->sigla,
                 'numero'=>$tem_senha[0]->numero,
                 'nome_local'=>$tem_senha[0]->nome_local,
                 'numero_local'=>$tem_senha[0]->numero_local,
                 'status'=>'chamado',
                 'servico_id'=>$tem_senha[0]->servico_id,
                 'painel_id'=>$id
              ];
             Historico::create($dados);
              Painel_Senha::where('id_painel', '=', $tem_senha[0]->id_painel)
              ->update(['status'=>'chamado']);
              // ->delete();


          } else {
              // Quando não há resultados

             $ultimasSenhas[] = $ultimasChamada[0][0];
             
            // break;
          }


     return response()->json(['senha' => $ultimasSenhas[0], 'historico' => $ultimasChamada], 200);



      }


    public function destivaServico(string  $id_painel,string $id){

       ##deleta servico para o painel

       $s=Painel_Servico::where('servico_id',$id)
       ->where('painel_id',$id_painel)
        ->first();
        try {
            $s->delete();
            return redirect()->route('painel.config',$id_painel)->with('success','Serviços Atualizados!');
        } catch (\Throwable $th) {
            echo "Erro: " . $th->getMessage();
        }
    }

public function desativarPainel(Painel $painel){

       $painel->update(['status'=>'inativo']);
       return redirect()->route('painel')->with('success','Painel desativado!');


}


  }

