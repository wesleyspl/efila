@extends('templates.admin')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif

<div class="widget">

    <div class="widget-content">
        <div class="data-table-toolbar">
            <div class="row">

                <div class="col-md-12">
                    <div class="toolbar-btn-action">
                        <a href="{{route('atendente.create')}}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Novo</a>

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
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Ações</th>

                    </tr>
                </thead>

                <tbody>

                 @if ($atendente)
                 @foreach ($atendente as $atendentes)
                 <tr>
                  <td>{{$atendentes['pessoa']->id_pessoa}}</td>
                  <td>{{$atendentes['pessoa']->nome}}</td>
                  <td>{{$atendentes['pessoa']->cpf}}</td>
                  <td>{{$atendentes['pessoa']->email}}</td>

                  <td>

                    <a class="btn btn-danger" ><i class="fa fa-trash-o"></i> Deletar</a>
                    <a class="btn btn-primary" href="{{ route('atendente.edit',$atendentes->id_atendente) }}"><i class="fa fa-refresh"></i> Atualizar</a>

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
      </div>
        <div class="data-table-toolbar">
            <!-- Exibe os links de paginação -->
 <!-- Exibe o número da página atual e o total de páginas -->
            <div class="mt-4">
          <p>
        Página Atual: {{ $atendente->currentPage('pagination::simple-bootstrap-4') }} de {{ $atendente->lastPage('pagination::simple-bootstrap-4') }}
            </p>
    <!-- Exibe os links de paginação -->
            </div>
          <div class="mt-4">
    {{ $atendente->links('pagination::simple-bootstrap-4') }}
   </div>
 </div>
 </div>






 @endsection