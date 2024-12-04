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
            <div class="additional-btn">
                <a href="{{route('servico.prioridade.show',$servico->id_servico)}}" class="btn btn-primary"><i class="fa fa-wheelchair"></i> Adicionar</a>

            </div>
        </div>

        <div class="widget-content">
            <div class="table-responsive">
                <table data-sortable="" class="table" data-sortable-initialized="true">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>Prioridade</th>
                            <th>Peso</th>
                            <th>Status</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                      <?php $i=0; ?>
                        <tr>
                            @if  ($prioridade)
                                @foreach ($prioridade as $prioridades)
                                <td>{{$prioridades[0]->id_prioridade}}</td>
                                <td>{{$prioridades[0]->nome}}</td>
                                <td>{{$prioridades[0]->peso}}</td>

                                    @if ($servico_prior['prioridades'][$i]->status=='ativo')
                                    <td>
                                    <span class="label  label-success">Active</span>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <form action="{{route('servico.prioridade.destroy',$prioridades[0]->id_prioridade)}}" method="post">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="servico_id" value="{{$servico_prior['prioridades'][$i]->servico_id}}" >
                                        <input data-toggle="tooltip" value="Desativar" title="Desativar" type="submit" class="btn btn-default fa fa-power-off">
                                        </form>
                                    </div>
                                </td>
                                @else
                                <td><span class="label  btn-darkblue-1">Inativo</span> </td>

                                <td>
                                    <div class="btn-group btn-group-xs">
                                        <a data-toggle="tooltip" title="Ativar" class="btn btn-success"><i class="fa  fa-check-circle"></i></a>

                                    </div>
                                </td>
                                @endif
                        </tr>    <?php $i++; ?>
                                @endforeach
                            @else
                        </tr>
                            @endif




                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>





 @endsection
