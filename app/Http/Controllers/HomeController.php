<?php

namespace App\Http\Controllers;

use App\Models\Atendente;
use App\Models\Home;
use App\Models\Local;
use App\Models\Painel;
use App\Models\Painel_Senha;
use App\Models\Servico;
use App\Models\Touch;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as FacadesSession;

class HomeController extends Controller
{   
     public $titulo;
     public $subtilulo;
    /**
     * Display a listing of the resource.
     */
    public function __construct()


    {
       $this->titulo='Dashboard';
       $this->subtilulo='';
 
 
 
    }
 
 
     public function index()
     {
        
    
        // Acessando a sessão corretamente
        $sessionData = FacadesSession::all();
        $total_servicos=Servico::where('status','=','ativo')->count();
        $total_atendentes=Atendente::where('status','=','ativo')->count();
        $total_locais=Local::where('status','=','ativo')->count();
        $total_PSenha=Painel::where('status','=','ativo')->count();
        $total_touch=Touch::where('status','=','ativo')->count();
       // dd($sessionData);
      //  dd($session);
       
         $data=[
             "titulo"=>$this->titulo,
             'subtitulo'=>$this->subtilulo,
             'total_servicos'=>$total_servicos,
             'total_atendentes'=>$total_atendentes,
             'total_locais'=>$total_locais,
             'total_PSenha'=>$total_PSenha,
             'total_touch'=>$total_touch,
         ];
             return view('home',$data);
     }



   public function adm(){


   
    $data=[
        "titulo"=>$this->titulo,
        'subtitulo'=>$this->subtilulo,
        'servicos'=>Servico::where('status','=','ativo')->paginate(5)
     ];
        return view('teste',$data);

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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
