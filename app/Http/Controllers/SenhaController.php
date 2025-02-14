<?php

namespace App\Http\Controllers;

use App\Models\Atendente_Servico;
use App\Models\Contador;
use App\Models\Departamento;
use App\Models\Fila;
use App\Models\Ordenacao;
use App\Models\Senha;
use App\Models\Servico;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Mpdf\Mpdf;

class SenhaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $titulo;
    public $subtilulo;


    public function __construct()


    {
        $this->titulo = 'Senhas';
        $this->subtilulo = 'Emissão de senhas';
    }
    public function index()
    {
        $Servico=Servico::paginate(10);

        $data = [
            "titulo" => $this->titulo,
            'subtitulo' => $this->subtilulo,
            'servico'=>$Servico

        ];

        return view('senhas.list', $data);
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
    public function show(Senha $senha)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Senha $senha)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Senha $senha)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Senha $senha)
    {
        //
    }

 public function triagem(string $id_triagem,string $departamento){

     $servico=Servico::where('id_servico',$id_triagem)->get();
    //$servicos=$rs->find($id_triagem);
    $servico=Atendente_Servico::where('servico_id',$id_triagem)->get();

    //montar os dados do servico
    $servico1=[];
        foreach ($servico as $servicos) {
          $servico1[]=Servico::where('id_servico',$servicos->servico_id)->get();
    }


  //exit;
    $data = [
        "titulo" => $this->titulo,
        'subtitulo' => $this->subtilulo,
        'servicos'=>$servico1,
        'departamento'=>$departamento

    ];

    return view('senhas.create', $data);

 }

 public function emitir(string $id_servico,string $prioridade){

    ####################################################################################################
    #   EMITIR SENHA  PRECISA DO ID_SERVICO ID_DEPARTAMENTO E A PRIORIDADE//NO CASO AINDA NÃO TERA PESO
    #
    #
    //$id_departamento=Departamento::where('nome',$id_departamento)->first();
    $sigla=Servico::where('id_servico',$id_servico)->first();
    $numero=Contador::where('servico_id',$id_servico)->first();

    # se não existir um contador para o serviço escolhido criar
    if(!$numero){
        $sn=[
            'servico_id'=>$id_servico,
            //'departamento_id'=>$id_departamento->id_departamento
        ];
       Contador::create($sn);
    }


   // $id_departamento->id_departamento;
    $numero->numero=$numero->numero+1;
     $sig= $sigla->sigla;
    
    if($prioridade!=0){
         $sig='P'.$sigla->sigla;
    }
     
   $dados=[
      'sigla'=>$sig,
      'numero'=>$numero->numero,
     // 'departamento_id'=>$id_departamento->id_departamento,
      'servico_id'=>$id_servico,
      'peso'=>$prioridade
   ];

   ### VERIFICA SE EXISTE DADOS PARA A TABELA ORDENAÇÃO CASO NÃO CRIA // TROCA DE LUGAR ESSA FUNC
   $ord=Ordenacao::where('servico_id',$id_servico)->first();
    if(!$ord){
        $data=[
            'servico_id'=>$id_servico,
           // 'departamento_id'=>$id_departamento->id_departamento
        ];
        Ordenacao::create($data);

    };
    Fila::create($dados); // CRIA A SENHA
    #ATUALIZA O CONTADOR
    $numero->update(['numero'=>$numero->numero]);

    $senha=[
       // 'departamento'=>$id_departamento->nome,
        'sigla'=>$sig,
        'numero'=>$numero->numero
    ];

    try {
        // Initialize mPDF with desired settings
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => [58, 70], // 58mm width and 70mm height
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);

        // Render the view to HTML string
        $html = view('senhas.print',$senha)->render();

        // Pass the HTML content to mPDF
        $mpdf->WriteHTML($html);

        /* Output the PDF directly to the browser (inline)
        return response()->stream(function() use ($mpdf) {
            $mpdf->Output('', 'I');  // 'I' for inline display in browser
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="generated.pdf"',
        ]); */
         $mpdf->Output();
      return view('senhas.print');
    } catch (\Mpdf\MpdfException $e) {
        // Handle errors gracefully
        return response()->json(['error' => $e->getMessage()], 500);
    }

}

public function  gerarSenha(array $senha)
{


    try {
        // Initialize mPDF with desired settings
        $mpdf = new Mpdf([
            'mode' => 'utf-8',
            'format' => [58, 70], // 58mm width and 70mm height
            'margin_left' => 0,
            'margin_right' => 0,
            'margin_top' => 0,
            'margin_bottom' => 0,
        ]);

        // Render the view to HTML string
        $html = view('senhas.print',$senha)->render();

        // Pass the HTML content to mPDF
        $mpdf->WriteHTML($html);

        // Output the PDF directly to the browser (inline)
        return response()->stream(function() use ($mpdf) {
            $mpdf->Output('', 'I');  // 'I' for inline display in browser
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="generated.pdf"',
        ]);

    } catch (\Mpdf\MpdfException $e) {
        // Handle errors gracefully
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

}



