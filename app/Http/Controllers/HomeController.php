<?php

namespace App\Http\Controllers;

use App\Models\Home;
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
       $this->titulo='Home';
       $this->subtilulo='Sistema de gerenciamento de senhas';
 
 
 
    }
 
 
     public function index()
     {
        
    
        // Acessando a sessão corretamente
        $sessionData = FacadesSession::all();
       // dd($sessionData);
      //  dd($session);
       
         $data=[
             "titulo"=>$this->titulo,
             'subtitulo'=>$this->subtilulo
         ];
             return view('home',$data);
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
