<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PainelTouchController extends Controller
{
   public function __construct()
   {
      
   }

 
public function index()
{
    return view('touch.touch');


}
}