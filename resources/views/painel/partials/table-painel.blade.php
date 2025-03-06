

<div class="widget-header ">
    <h2><i class="icon-window"></i> <strong>Painel de </strong>Senha</h2>

</div>
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
    <table  class="table table-hover table-striped" >
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
            <a class="btn btn-info"  target="_blank"  title="Abrir painel" href="{{ route('painel.show',$paineis->id_painel) }}"><i class="fa fa-share"></i> </a>
            <a class="btn btn-danger" title="deletar"  href="{{ route('painel.desativarPainel',$paineis->id_painel) }}"><i class="fa fa-trash-o"></i> </a>
            <a class="btn btn-primary" title="configurar" href="{{ route('painel.config',$paineis->id_painel) }}"><i class="fa fa-gear"></i> </a>

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