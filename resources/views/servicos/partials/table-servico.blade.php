<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="icon-folder-3"></i> <strong>Serviços</strong></h3>
        <div class="card-tools">
            <a href="#" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Novo</a>
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
                        <th>Sigla</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($servicos)
                        @foreach ($servicos as $servico)
                            <tr>
                                <td>{{ $servico->id_servico }}</td>
                                <td>{{ $servico->nome }}</td>
                                <td>{{ $servico->sigla }}</td>
                                <td>
                                    <a class="btn btn-primary btn-sm" title="Configurar" href="{{ route('servico.prioridade', $servico->id_servico) }}"><i class="fa fa-solid fa-gamepad"></i></a>
                                    <a class="btn btn-danger btn-sm" title="Deletar" href="{{ route('servico.delete', $servico->id_servico) }}"><i class="fa fa-solid fa-trash"></i></a>
                                    <a class="btn btn-warning btn-sm" title="Editar" href="{{ route('servicos.edit', $servico->id_servico) }}"><i class="fa fa-edit"></i></a>
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
                <p>Página Atual: {{ $servicos->currentPage('pagination::simple-bootstrap-4') }} de {{ $servicos->lastPage('pagination::simple-bootstrap-4') }}</p>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $servicos->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->