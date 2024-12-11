<?php

namespace App\Http\Controllers;

use App\Http\Requests\PrioridadeRequest;
use App\Models\Departamento;
use App\Models\Prioridade;
use App\Models\Servico;
use App\Models\Servico_Prioridade;
use Illuminate\Http\Request;

class PrioridadeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public $titulo;
    public $subtilulo;


    public function __construct()


    {
        $this->titulo = 'Prioridades';
        $this->subtilulo = 'Gerir Prioridades';
    }

    public function index(Servico $servico)
    {

        $prioridade=Prioridade::paginate(10);

        $data = [
            "titulo" => $this->titulo,
            'subtitulo' => $this->subtilulo,
            'prioridade' =>$prioridade,

        ];

        return view('prioridade.list', $data);




    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            "titulo" => $this->titulo,
            'subtitulo' => $this->subtilulo
        ];
        return view('prioridade.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PrioridadeRequest $request)
    {




 $request->validated();
 $data=[
    'nome'=>$request->nome,
    'peso'=>$request->peso



 ];

 Prioridade::create($data);

 return redirect()->route('prioridade')->with('success','Prioridade adicionada  com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    { //pegar o departamento
        $departamento = Departamento::find(['id_departamento', $servico->departamento_id]);




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
    public function edit(Prioridade $prioridade)
    {
        //$prioridade=Prioridade::paginate(10);

        $data = [
            "titulo" => $this->titulo,
            'subtitulo' => $this->subtilulo,
            'prioridade' =>$prioridade,

        ];

        return view('prioridade.edit', $data);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PrioridadeRequest $request, Prioridade $prioridade)
    {
        $request->validated();

        $dados=[

                'nome'=>$request->nome,
                'peso'=>$request->peso
        ];

        $prioridade->update($dados);
        return redirect()->route('prioridade')->with('success','Prioridade Atualizada!');

        /*######isso mover para servico_prioridde
        $request->validated();
        $dados=[
            'ativo'=>'destivado'
        ];
        $id=$request->route('prioridade');
        $ids=['prioridade_id'=>$id->id_prioridade];
        $rs= $prioridade->prioridades()->where($ids)->first();


        if($rs){
           // $rs->update(['status'=>'destivado']);
           $rs->delete();
            return redirect()->route('servicos')->with('success','Serviço Atualizado!');
        }

    }  */
    }

    public function destroy(Prioridade $prioridade)
    {
        $prioridade->id_prioridade;
        Servico_Prioridade::destroy($prioridade->id_prioridade);
    }
}
