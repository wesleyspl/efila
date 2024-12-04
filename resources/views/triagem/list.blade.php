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

    <div class="widget-content">
        <div class="data-table-toolbar">
            <div class="row">

                <div class="col-md-12">
                    <div class="toolbar-btn-action">


                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table data-sortable="" class="table table-hover table-striped" data-sortable-initialized="true">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Atendente</th>
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

                    <a class="btn btn-primary" href="{{ route('triagem.show',$atendentes->id_atendente) }}"><i class="fa fa-eye"></i> Visualizar</a>

                    <a class="btn btn-primary" href="{{ route('triagem.config',$atendentes->id_atendente) }}"><i class="fa fa-refresh"></i> Config. Triagem</a>

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
