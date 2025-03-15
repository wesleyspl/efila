<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-user"></i> <strong>Atendente</strong></h3>
        <div class="card-tools">
            <a href="{{ route('atendente.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Novo</a>
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
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($atendente)
                        @foreach ($atendente as $atendentes)
                            <tr>
                                <td>{{ $atendentes['pessoa']->id_pessoa }}</td>
                                <td>{{ $atendentes['pessoa']->nome }}</td>
                                <td>{{ $atendentes['pessoa']->cpf }}</td>
                                <td>{{ $atendentes['pessoa']->email }}</td>
                                <td>
                                    <a class="btn btn-danger btn-sm" title="Deletar" href="{{ route('atendente.delete', $atendentes->id_atendente) }}"><i class="fa fa-trash-o"></i></a>
                                    <a class="btn btn-warning btn-sm" title="Editar" href="{{ route('atendente.edit', $atendentes->id_atendente) }}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">NENHUM CADASTRO</td>
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
                <p>Página Atual: {{ $atendente->currentPage('pagination::simple-bootstrap-4') }} de {{ $atendente->lastPage('pagination::simple-bootstrap-4') }}</p>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $atendente->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->