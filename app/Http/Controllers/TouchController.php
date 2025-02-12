<?php

namespace App\Http\Controllers;

use App\Http\Requests\TouchRequest;
use App\Models\Servico;
use App\Models\Touch;
use App\Models\Touch_Servico;
use Illuminate\Http\Request;

class TouchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $titulo;
    public $subtilulo;


    public function __construct()


    {
       $this->titulo='Painel Touch';
       $this->subtilulo='Gerir touch';



    }




    public function index()
    {    
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'painel'=>Touch::paginate(10)
         ];
        return view('touch.list',$data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'painel'=>Touch::paginate(10)
         ];
            //buscar os Touchs  criados

            return view('touch.create',$data);
    }

    /**v
     * Store a newly created resource in storage.
     */
    public function store(TouchRequest $request)
    {
       
           //validar o formulario
           $request->validated();

           //validado agora é salvar
          $dados=['nome'=>$request->nome,
                  'obs'=>$request->obs
   
   
       ];
   
          Touch::create($dados);
          //redirecionar
          return redirect()->route('touch')->with('success','Painel Touch cadastrado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Touch $touch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Touch $touch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Touch $touch)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Touch $touch)
    {
        //
    }
    
    public function config(Touch $touch)
    {
        $meus_servicos=Touch_Servico::with('servico')->where('touch_id','=',$touch->id_touch)->get();  
        $meus_servicos_id= $meus_servicos->pluck('servico_id')->toArray();
        $servicos=Servico::whereNotIn('id_servico', $meus_servicos_id)->where('status','ativo')->get();
       //dd($meus_servicos);
      
        $data=[
            "titulo"=>$this->titulo,
            'subtitulo'=>$this->subtilulo,
            'painel'=>$touch,
            'meus_servicos'=>$meus_servicos,
            'servico'=>$servicos
        ];
           return view('touch.config',$data);
    }

    public function save(Request $request){


        $touch_id=$request->id_painel;
        $servico_id=$request->input('id_servico', []);
      foreach ($servico_id as $servico) {
        $s=Touch_Servico::where('servico_id',$servico)
        ->where('touch_id',$touch_id)
        ->get();
        if($s->isEmpty()){
            $dados=['touch_id'=>$touch_id,
                    'servico_id'=>$servico
      ];
           Touch_Servico::create($dados);
      }else{

        $dados=['touch_id'=>$touch_id,
        'servico_id'=>$servico ];
        $s->update($dados);
      }
    }

    return redirect()->route('touch')->with('success','Painel Atualizado!');

  }

  public function destivaServico(string  $id_touch,string $id){

    ##deleta servico para o painel

    $s=Touch_Servico::where('servico_id',$id)
    ->where('touch_id',$id_touch)
     ->first();
     try {
         $s->delete();
         return redirect()->route('touch.config',$id_touch)->with('success','Serviços Atualizados!');
     } catch (\Throwable $th) {
         echo "Erro: " . $th->getMessage();
     }
 }

}
