<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="icon-window"></i> <strong>Painel</strong> Touch</h3>
        <div class="card-tools">
            <a href="{{ route('touch.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Novo</a>
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
                                <td>{{ $paineis->id_touch }}</td>
                                <td>{{ $paineis->nome }}</td>
                                <td>{{ $paineis->obs }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" target="_blank" title="Abrir painel" href="{{ route('touch.show', $paineis->id_touch) }}"><i class="fa fa-solid fa-desktop"></i></a>
                                    <a class="btn btn-danger btn-sm" title="Deletar" href="{{ route('touch.desativarPainel', $paineis->id_touch) }}"><i class="fa fa-solid fa-trash"></i></a>
                                    <a class="btn btn-primary btn-sm" title="Configurar" href="{{ route('touch.config', $paineis->id_touch) }}"><i class="fa fa-solid fa-gamepad"></i></a>
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