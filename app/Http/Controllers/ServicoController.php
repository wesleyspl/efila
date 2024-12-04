<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServicoRequest;
use App\Models\Contador;
use App\Models\Departamento;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
      public $titulo;
      public $subtilulo;
     public function __construct()


    {
       $this->titulo='Serviços';
       $this->subtilulo='Gerir Serviços';



    }


    public function index()
    {




        $departamentos = Departamento::with('servicos')->get();



        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'servicos'=>Servico::paginate(5)
         ];
            return view('servicos.list',$data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {


        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'departamentos'=>Departamento::all(['nome'])
         ];
         return view('servicos.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServicoRequest $request)
    {
            //validar o formulario
        $request->validated();

        $departamento = Departamento::where('nome', $request->departamento)
                             ->first(['id_departamento']);




        //validado agora é salvar
       $dados=['nome'=>$request->nome,
            'sigla'=>$request->sigla,
            'departamento_id'=>$departamento->id_departamento

    ];



       Servico::create($dados);
       $id_servico=Servico::latest()->first();
      # se não existir um contador para o serviço escolhido criar
      $numero=Contador::where('servico_id',$id_servico)->where('departamento_id',$departamento->id_departamento)->first();
      //dd($id_servico->id_servico);
      if(!$numero){
         $sn=[
             'servico_id'=>$id_servico->id_servico,
             'departamento_id'=>$departamento->id_departamento,
             'numero'=>0
         ];
        Contador::create($sn);
     }

       return redirect()->route('servicos')->with('success','Servico cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Servico $servico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Servico $servico)
    {
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'servico'=>$servico,
            'departamentos'=>Departamento::all()

         ];
       return view('servicos.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServicoRequest $request, Servico $servico)
    {
        $request->validated();
        $departamento = Departamento::where('nome', $request->departamento)
        ->first(['id_departamento']);




//validado agora é salvar
$dados=['nome'=>$request->nome,
'sigla'=>$request->sigla,
'departamento_id'=>$departamento->id_departamento

];       $id=['id_servico'=>$request->route('servico')];
         $servico->update($dados,$id);
         return redirect()->route('servicos')->with('success','Serviço Atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Servico $servico)
    {
        //
    }
}
