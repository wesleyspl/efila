<?php

namespace App\Http\Controllers;

use App\Http\Requests\LocalRequest;
use App\Models\Local;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public $titulo;
     public $subtilulo;
    public function __construct()


   {
      $this->titulo='Locais';
      $this->subtilulo='Gerir Locais';



   }


    public function index()
    {

        $local = Local::paginate(10);



        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'local'=>$local
         ];
            return view('locais.list',$data);
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
        return view('locais.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LocalRequest $request)
    {

         $request->validated();
         $data=[
            'nome'=>$request->nome
         ];

        Local::create($data);

         return redirect()->route('local')->with('success','Local adicionado  com sucesso!');


    }

    /**
     * Display the specified resource.
     */
    public function show(Local $local)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Local $local)
    {

        //$local = Local::paginate(10);



        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'local'=>$local
         ];
            return view('locais.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LocalRequest $request, Local $local)
    {
        $request->validated();

        $dados=[

                'nome'=>$request->nome,

        ];

        $local->update($dados);
        return redirect()->route('local')->with('success','Local Atualizado!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Local $local)
    {
        //
    }
}
