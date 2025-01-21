<?php

namespace App\Livewire;

use Livewire\Component;
use App\Http\Controllers\SenhaController;
use Mpdf\Mpdf;

class Counter extends Component
{
    public $pdfContent;

    public function gerarPdf()
    {
        $senha = new SenhaController();
        $pdfContent = $senha->emitir(1, 1);

        $this->pdfContent=$pdfContent;
    }


    public function render()
    {
        return view('livewire.counter');
    }
}
