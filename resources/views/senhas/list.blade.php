@extends('templates.admin')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif
@if (session('error'))

<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('error')}}.
</div>

@endif


    <div class="widget">
        <div class="widget-header ">
            <h2><i class="icon-chart-pie-1"></i> <strong>Departamentos</strong> Triagem</h2>

        </div>
        <div class="widget-content padding">

             <table class="table responsive">
                <tr>
                    <th>ID</th>
                    <th>SERVICO</th>
                    <th>SIGLA</th>
                    <th><center>EMITIR</center></th>
                </tr>
                @if ($servico)
                     @foreach ($servico as $servicos)
                         <tr>
                            <td>{{$servicos->id_servico}}</td>
                            <td>{{$servicos->nome}}</td>
                            <td>{{$servicos->sigla}}</td>
                            <td ><center><a href="{{route('senha.emitir',[$servicos->id_servico,1])}}" class="btn btn-primary"><i class="fa fa-ticket"></i> Normal</a>
                                <a href="" class="btn btn-danger"><i class="fa fa-ticket"></i> Preferencial</a> </center>
                            </td>
                         </tr>
                      @endforeach
                @else
                <tr>
                 <td colspan="3">NENHUM DEPARTAMENTO</td>
                </tr>
                @endif

             </table>


        </div>
    </div>








 @endsection
