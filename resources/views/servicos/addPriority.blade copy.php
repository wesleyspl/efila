@extends('templates.admin')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif

<div class="col-sm-12 portlets ui-sortable">
    <div class="widget">
        <div class="widget-header ">
            <h3><i class="fa fa-ticket"></i> <strong> </strong>Configurar senhas </h2>

        </div>
        <div class="widget-content padding">
           <h4><strong>SERVIÇO:</strong> {{$servico->nome}} </h4>
        </hr>
        <h4><strong>SIGLA:</strong> {{$servico->sigla}} </h4>
    </hr>
    <h4><strong>DEPARTAMENTO:</strong> {{$departamento->nome}} </h4>
        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Prioridades</strong></h2>

        </div>

        <div class="widget-content">
            <div class="table-responsive">
                <table data-sortable="" class="table" data-sortable-initialized="true">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Prioridade</th>
                            <th>Peso</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>

                          <?php $i=0;?>
                           @if ($pri)
                               @foreach ($pri as $pris)

                           <td>{{$pris->id_prioridade}} </td>
                           <td>{{$pris->nome}} </td>
                           <td>{{$pris->peso}} </td>
                           <td>
                            <form method="post" action="{{route('prioridade.store')}}">
                             @csrf



                            <input type="submit" class="btn btn-success" value="Adicionar">
                            <input type="hidden" value="{{$servico->id_servico}}" name="id_servico">
                            <input type="hidden" value="{{$pris->id_prioridade}}" name="id_prioridade">

                              </form>
                            <tr>
                        </td>


                           @endforeach

                           <tr>
                           </tr>
                           @endif











                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





 @endsection
