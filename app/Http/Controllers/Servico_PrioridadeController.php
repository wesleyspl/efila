<?php

namespace App\Http\Controllers;

use App\Http\Requests\Servico_PrioridadeRequest;
use App\Models\Departamento;
use App\Models\Prioridade;
use App\Models\Servico;
use App\Models\Servico_Prioridade;
use Illuminate\Http\Request;

class Servico_PrioridadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $titulo;
     public $subtilulo;


     public function __construct()


     {
         $this->titulo = 'Serviços';
         $this->subtilulo = 'Gerir Prioridades';
     }

    public function index(Servico $servico)
    {
        #############################################################################################
     ###inicio mudar para servico_prioridade ######
        //pegar o departamento
       // $departamento = Departamento::find(['id_departamento', $servico->departamento_id]);




        //pegar todos as prioridades do  seviço com hasmany
        $rs = Servico::with('prioridades')->find($servico->id_servico);

        // Verifica se o serviço foi encontrado
        if ($rs) {
            $prior = []; // Inicializa o array para armazenar as prioridades

            // Itera sobre as prioridades do serviço e adiciona ao array
            foreach ($rs->prioridades as $propriedade) {
                $prior[] = Prioridade::where('id_prioridade', $propriedade->prioridade_id)->get();
            }
        }

        // Exibe o array de prioridades para verificação

        $data = [
            "titulo" => $this->titulo,
            'subtitulo' => $this->subtilulo,
            'servico' => $servico,
            //'departamento' => $departamento[0],
            'prioridade' => $prior,
            'servico_prior'=>$rs
        ];

        return view('servicos.teste', $data);
        ##########################################
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
    public function store(Servico_PrioridadeRequest $request)
    {
          ///transferir esse funççao para o controller dela
        //dd($request->validated());
        $data=[
           'servico_id'=>$request->servico_id,
           'prioridade_id'=>$request->prioridade_id,
           'status'=>'ativo'



        ];

        Servico_Prioridade::create($data);

        return redirect()->route('servicos')->with('success','Prioridade adicionada ao servico com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {


       //pegar o departamento
    //   $departamento = Departamento::find(['id_departamento', $servico->departamento_id]);




       //pegar todos as prioridades do  seviço com hasmany
       $rs = Servico::with('prioridades')->find($servico->id_servico);

       // Verifica se o serviço foi encontrado
       if ($rs) {
           $prior = []; // Inicializa o array para armazenar as prioridades

           // Itera sobre as prioridades do serviço e adiciona ao array
           foreach ($rs->prioridades as $propriedade) {
               $prior[] = Prioridade::where('id_prioridade', $propriedade->prioridade_id)->get();
           }
       }


       // pegar as prioridades para adionar ao servico
       $pri=Prioridade::all();




       // Exibe o array de prioridades para verificação


       //valor p/ ativar desativar botao adicionar
       $des=Prioridade::with('prioridades')->get();
       $desativa=$des[0]['prioridades'];

$pri = Prioridade::whereNotIn('id_prioridade',Servico_Prioridade::where('servico_id',$servico->id_servico)->pluck('prioridade_id'))->get();

$data = [
           "titulo" => $this->titulo,
           'subtitulo' => $this->subtilulo,
           'servico' => $servico,
          // 'departamento' => $departamento[0],
           'prioridade' => $prior,
           'servico_prior'=>$rs,
           'pri'=>$pri,
           'desativa'=>$desativa
       ];

       return view('servicos.addPriority', $data);
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
        ###função movida de prioridade
        ///transferir esse funççao para o controller dela
        $request->validated();

        $data=[
           'servico_id'=>$request->id_servico,
           'prioridade_id'=>$request->id_prioridade



        ];

        Servico_Prioridade::create($data);

        return redirect()->route('servicos')->with('success','Prioridade adicionada ao servico com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Prioridade $prioridade,Servico_PrioridadeRequest $request)
    {

        Servico_Prioridade::where('prioridade_id', $prioridade->id_prioridade)->where('servico_id',$request->servico_id)->delete();
        return redirect()->route('servicos')->with('success','Prioridade desativada !');

    }
}
