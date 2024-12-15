<?php

namespace App\Http\Controllers;

use App\Http\Requests\PainelRequest;
use App\Models\Atendimento;
use App\Models\Historico;
use App\Models\Painel;
use App\Models\Painel_Servico;
use App\Models\Servico;
use Illuminate\Http\Request;

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
        'painel'=>Painel::paginate(10)
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

    $data=[
        "titulo"=>$this->titulo,
        'subtitulo'=>$this->subtilulo,
        'painel'=>$painel,
        'servico'=>Servico::all()
     ];

    return view('painel.config',$data);


  }


  public function save(Request $request){


        $painel_id=$request->id_painel;
        $servico_id=$request->input('id_servico', []);
      foreach ($servico_id as $servico) {
        $s=Painel_Servico::where('servico_id',$servico)
        ->first();
        if(!$s){
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



      // Itera sobre cada serviço
      foreach ($servicos as $servicoId) {

           // Histórico de chamadas para o serviço, limitando a 5 e ordenando por 'created_at' decrescente
       $historico = Historico::where('servico_id', '=', $servicoId)
       ->orderBy('created_at', 'desc') // Ordena para pegar o mais recente
       ->limit(2) // Limita a 5 registros
       ->get(); // Obtém os históricos

          // Consulta os atendimentos com status "chamado" para o serviço
          $senha = Atendimento::where('servico_id', '=', $servicoId)
              ->where('status', '=', 'chamado')
             // Ordena os atendimentos para pegar o mais recente
              ->first(); // Aqui é pegado o primeiro atendimento (último que foi chamado)

          // Verifica se há registros de histórico
          if ($historico) {
              $ultimasChamada[] = $historico;
             // Historico::where('servico_id', $servicoId)->delete();
            // $ultimasChamada= array_reverse($ultimasChamada);
          }

          // Verifica se há atendimento para esse serviço
          if ($senha) {
              $ultimasSenhas[] = $senha;
              $senha->update(['status'=>'ok']);
          }
      }

      // Retorna os dados como JSON
      return response()->json(['senha' => $ultimasSenhas, 'historico' => $ultimasChamada], 200);
  }

}
