<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="icon-window"></i> <strong>Painel de Senha</strong></h3>
        <div class="card-tools">
            <a href="{{ route('painel.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Novo</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
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
                                <td>{{ $paineis->id_painel }}</td>
                                <td>{{ $paineis->nome }}</td>
                                <td>{{ $paineis->obs }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" target="_blank" title="Abrir painel" href="{{ route('painel.show', $paineis->id_painel) }}"><i class="fa fa-share"></i></a>
                                    <a class="btn btn-danger btn-sm" title="Deletar" href="{{ route('painel.desativarPainel', $paineis->id_painel) }}"><i class="fa fa-trash-o"></i></a>
                                    <a class="btn btn-primary btn-sm" title="Configurar" href="{{ route('painel.config', $paineis->id_painel) }}"><i class="fa fa-gear"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">NENHUM CADASTRO</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                <p>Página Atual: {{ $painel->currentPage('pagination::simple-bootstrap-4') }} de {{ $painel->lastPage('pagination::simple-bootstrap-4') }}</p>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $painel->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->