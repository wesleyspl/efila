<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartamentoRequest;
use App\Models\Departamento;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class DepartamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $titulo;
    public $subtilulo;








    public function __construct()


    {
       $this->titulo='Departamento';
       $this->subtilulo='Gerir Departamento';



    }






    public function index()
    {
        $data=[
           "titulo"=>$this->titulo,
           'subtitulo'=>$this->subtilulo,
           'departamentos'=>Departamento::paginate(5)
        ];
        // Acessar os dados da sessão
      //  $user = FacadesAuth::user();
  //  $user_id = session()->all();  // ou session()->get('user_id');

           return view('departamento.list',$data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'departamentos'=>Departamento::paginate(5)
         ];
         return view('departamento.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartamentoRequest $request)
    {
        //validar o formulario
        $request->validated();

        //validado agora é salvar
       $dados=['nome'=>$request->nome];
       Departamento::create($dados);
       //redirecionar
       return redirect()->route('departamento')->with('success','Departamento cadastrado com sucesso!');

    }

    /**
     * Display the specified resource.
     */
    public function show(Departamento $departamento)
    {
        dd($departamento);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Departamento $departamento)
    {
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'departamento'=>$departamento
         ];
       return view('departamento.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DepartamentoRequest $request, Departamento $departamento)
    {
         $request->validated();
         $dados=[
            'nome'=>$request->nome
         ];
         $id=['id_departamento'=>$request->route('departamento')];
         $departamento->update($dados,$id);
         return redirect()->route('departamento')->with('success','Departamento Atualizado!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Departamento $departamento)
    {
        //
    }
}
