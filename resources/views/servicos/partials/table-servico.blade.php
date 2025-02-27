<div class="widget-content">
    <div class="widget-header ">
        <h2><i class="icon-folder-3"></i> <strong>Serviços </strong></h2>
    
    </div>
    <div class="data-table-toolbar">
        <div class="row">

            <div class="col-md-12">
                <div class="toolbar-btn-action">
                    <a href="servico.create" class="btn btn-success"><i class="fa fa-plus-circle"></i> Novo</a>

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
                    <th>Sigla</th>
                    <th>Ações</th>

                </tr>
            </thead>

            <tbody>

             @if ($servicos)
             @foreach ($servicos as $servico)
             <tr>
              <td>{{$servico->id_servico}}</td>
              <td>{{$servico->nome}}</td>
              <td>{{$servico->sigla}}</td>
              <td>
                <a class="btn btn-primary" href="{{route('servico.prioridade',$servico->id_servico)}}" ><i class="fa fa-trash-o"></i> Configurar</a>
                <a class="btn btn-danger" href="{{route('servico.delete',$servico->id_servico)}}" ><i class="fa fa-trash-o"></i> Deletar</a>
                <a class="btn btn-primary" href="{{ route('servicos.edit',$servico->id_servico) }}"><i class="fa fa-refresh"></i> Atualizar</a>

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
    Página Atual: {{ $servicos->currentPage('pagination::simple-bootstrap-4') }} de {{ $servicos->lastPage('pagination::simple-bootstrap-4') }}
        </p>
<!-- Exibe os links de paginação -->
        </div>
      <div class="mt-4">
{{ $servicos->links('pagination::simple-bootstrap-4') }}
</div>
</div>