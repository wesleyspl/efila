<?php

namespace App\Http\Controllers;

use App\Models\Atendimento;
use App\Models\Historico;
use Illuminate\Http\Request;

class PainelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $ultimasSenhas = Historico::where('status', '=', 'chamado') // Onde o status não é 'finalizado'
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
       // Exemplo para o seu caso com as últimas senhas chamadas:


       return view('painel.painel',$dados);
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
    public function show(string $id)
    {
        //
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
}
