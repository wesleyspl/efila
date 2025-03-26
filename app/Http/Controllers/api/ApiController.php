<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\AtendenteController;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiController extends Controller
{
      # atualização não precisa mais estar logado p/ acesssar
      # funcionando perfeitamente tem que estar logado p/ acessar.
   
    public function atualizaFila($id)
    {   
       
        $fila= new AtendenteController();
       
        return  $fila->atualizaFila($id);
       
}





}