@extends('templates.admin')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif

<div class="widget">
    <div class=" transparent">


    </div>
    <div class="widget-content">
        <div class="data-table-toolbar">
            <div class="row">

                <div class="col-md-12">
                    <div class="toolbar-btn-action">
                        <a href="{{route('painel.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Novo</a>

                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table data-sortable="" class="table table-hover table-striped" data-sortable-initialized="true">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Observação</th>
                        <th>Ações</th>

                    </tr>
                </thead>

                <tbody>

                 @if ($painel)
                 @foreach ($painel as $paineis)
                 <tr>
                  <td>{{$paineis->id_painel}}</td>
                  <td>{{$paineis->nome}}</td>
                  <td>{{$paineis->obs}}</td>
                  <td>
                    <a class="btn btn-danger"  href="{{ route('painel.desativarPainel',$paineis->id_painel) }}"><i class="fa fa-trash-o"></i> Deletar</a>
                    <a class="btn btn-primary" href="{{ route('painel.config',$paineis->id_painel) }}"><i class="fa fa-gear"></i> Configurar</a>

            </td>

              </tr>
                 @endforeach
                 @else
                 <tr>

                    <td colspan="3">
                       NENHUM CADASTRO
                    </td>
                </tr>
                 @endif


                </tbody>
            </table>
        </div>

        <div class="data-table-toolbar">
            <!-- Exibe os links de paginação -->
 <!-- Exibe o número da página atual e o total de páginas -->
 <div class="mt-4">
    <p>
        Página Atual: {{ $painel->currentPage('pagination::simple-bootstrap-4') }} de {{ $painel->lastPage('pagination::simple-bootstrap-4') }}
    </p>
    <!-- Exibe os links de paginação -->
   <div class="mt-4">
    {{ $painel->links('pagination::simple-bootstrap-4') }}
   </div>
   </div>
        </div>
   </div>








 @endsection
